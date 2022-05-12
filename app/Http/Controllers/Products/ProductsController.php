<?php

namespace App\Http\Controllers\Products;

use App\Http\Resources\Products\ProductsResource;
use App\Http\Resources\CompanyResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Company;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Exception;

class ProductsController extends Controller
{
	public function showAll()
	{
		$query = Products::query()->where('company_id', auth()->user()->id)
			->with('brand')
			->with('category')
			->with('supplier')
			->with('createdBy')
			->with('updatedBy');

		$results = $query->get();
		return ProductsResource::collection($results);
	}

	public function show($id)
	{
		$query = Products::query()->where('company_id', auth()->user()->id)
			->with('brand')
			->with('category')
			->with('supplier')
			->with('createdBy')
			->with('updatedBy');

		$result = $query->find($id);
		return new ProductsResource($result);
	}

	public function dataTable(Request $request)
	{
		$query = Products::query()->where('company_id', auth()->user()->id)
			->with('brand')
			->with('category')
			->with('supplier')
			->with('createdBy')
			->with('updatedBy');

		if ($request->search) {
			$query->where('product_name', 'like', "%$request->search%");
			$query->orWhere('product_code', 'like', "%$request->search%");
			$query->orWhere('product_barcode', 'like', "%$request->search%");
		}
		if ($request->category) {
			$query->where('category_id', $request->category);
		}
		if ($request->brand) {
			$query->where('brand_id', $request->brand);
		}

		$results = $query->orderBy('id', 'desc')->paginate();
		return ProductsResource::collection($results);
	}

	public function showAllByCompany()
	{
		$companyId = auth()->user()->company_id;

		$products = Products::query()
			->with('brand')
			->with('company')
			->with('supplier')
			->with('createdBy')
			->with('updatedBy');
		$results = $products->where('company_id', $companyId)->get();

		return ProductsResource::collection($results);
	}

	public function companyWithProduct()
	{
		$company = Company::query()->with('products')->with('user');
		$results = $company->all();

		return new CompanyResource($results);
	}

	public function store(Request $request)
	{
		if ($request->id) {
			$message = 'Success to Update product';
		} else {
			$message = 'Success to Add new product';
		}

		$validator = Validator::make($request->all(), [
			'company_id' => 'required',
			'category_id' => 'required',
			'brand_id' => 'required',
			'supplier_id' => 'required',
			'product_name' => 'required',
			'product_unit' => 'required',
			'product_code' => ['required', Rule::unique('products')->ignore($request->id)->where(fn ($query) => $query->where('company_id', $request->company_id))],
			'product_barcode' => 'nullable',
			'product_selling_price' => 'required',
			'product_image' => 'nullable|image|max:1024',
			'product_discount' => 'nullable',
			'product_final_price' => 'nullable',
			'product_stock' => 'nullable',
		]);

		if ($validator->fails()) {
			return response(['errors' => $validator->errors()], 409);
		}

		// Calculate final price
		$finalPrice = 0;
		if ($request->product_discount > 0) {
			$discountPrice = ($request->product_discount / 100) * $request->product_selling_price;
			$finalPrice = $request->product_selling_price - $discountPrice;
		} else {
			$finalPrice = $request->product_selling_price;
		}

		$product = Products::firstOrCreate(
			['id' => $request->id],
			[
				'company_id' => $request->company_id,
				'category_id' => $request->category_id,
				'brand_id' => $request->brand_id,
				'supplier_id' => $request->supplier_id,
				'product_name' => $request->product_name,
				'product_unit' => $request->product_unit,
				'product_code' => $request->product_code,
				'product_barcode' => $request->product_barcode,
				'product_selling_price' => $request->product_selling_price,
				'product_purchase_price' => $request->product_purchase_price,
				'product_discount' => $request->product_discount,
				'product_final_price' => $finalPrice,
				'product_stock' => 0,
			]
		);

		if ($request->file('product_image')) {
			$this->uploadImage($request->product_image, $product);
		}

		if ($request->id) {
			$product->updated_by = auth()->user()->id;
			$product->save();
		} else {
			$product->created_by = auth()->user()->id;
			$product->updated_by = auth()->user()->id;
			$product->save();
		}

		return response(['success' => $message, 'product' => $product], 200);
	}

	public function uploadImage($file = null, $product = null)
	{
		try {
			$product = Products::find($product->id);
			$user = auth()->user();

			if ($product->product_image) {
				$oldImage = explode('/', $product->product_image);
				Storage::delete('storage/product/company-' . $user->company_id . '/' . end($oldImage));
				// unlink('storage/product/company-' . $user->company_id . '/' . end($oldImage));
			}

			$filePath = Storage::disk('public')
				->putFile('/product/company-' . $user->company_id . '/', $file, 'public');
			$product->product_image = url('storage') . '/' . $filePath;
			$product->save();
		} catch (Exception $exception) {
			return response(['error' => $exception->getMessage()], 409);
		}
	}

	public function destroy(Request $request)
	{
		$product = Products::find($request->id);
		if (!$product) {
			return response(['error' => 'Product Not Found!'], 409);
		}

		if ($product->product_image) {
			$oldImage = explode('/', $product->product_image);
			Storage::delete('storage/product/company' . auth()->user()->company_id . '/' . end($oldImage));
		}
		Products::destroy($request->id);
		return response(['success' => 'Success to delete product'], 200);
	}

	public function bulkDestroy(Request $request)
	{
		$idCount = count($request->id);
		Products::destroy($request->id);

		for ($i = 0; $idCount > $i; $i++) {
			$product = Products::find($request->id[$i]);
			if ($product->product_image) {
				$oldImage = explode('/', $product->product_image);
				Storage::delete('storage/product/company/' . auth()->user()->company_id . '/' . end($oldImage));
				// unlink('storage/product/company-' . $product->company_id . '/' . end($oldImage));
			}
		}
		return response(['success' => 'Success deleted ' . count($request->id) . ' products'], 200);
	}
}
