<?php

namespace App\Http\Controllers\Products;

use App\Http\Resources\Products\ProductsResource;
use App\Http\Resources\CompanyResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Company;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductsController extends Controller
{
	public function showAll()
	{
		$request = null;
		$products = Products::query()->with('brand')->with('createdBy')->with('updatedBy');

		if ($request) {
			$results = $products->where('id', $request)->get();
		}
		$results = $products->get();
		return ProductsResource::collection($results);
	}

	public function showAllByCompany()
	{
		$companyId = auth()->user()->company_id;

		$products = Products::query()->with('brand')->with('createdBy')->with('updatedBy');
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
			'product_name' => 'required',
			'product_unit' => 'required',
			'product_code' => ['required', Rule::unique('products')->ignore($request->id)],
			'product_barcode' => 'nullable',
			'product_selling_price' => 'required',
			'product_discount' => 'nullable',
			'product_final_price' => 'nullable',
			'product_stock' => 'nullable',
		]);

		if ($validator->fails()) {
			return response(['errors' => $validator->errors()], 409);
		}

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
		if ($request->id) {
			$product->updated_by = auth()->user()->id;
			$product->save();
		} else {
			$product->created_by = auth()->user()->id;
			$product->updated_by = auth()->user()->id;
			$product->save();
		}

		return response(['success' => $message], 200);
	}
}
