<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Validation\Rule;
use App\Http\Resources\Products\CategoryResource;

class CategoryController extends Controller
{
	public function showAll()
	{
		$category = Category::query()->with('company')->where('company_id', auth()->user()->id)->get();
		return CategoryResource::collection($category);
	}

	public function show($id)
	{
		$category = Category::query()->with('company')->where('company_id', auth()->user()->id)->find($id);

		return new CategoryResource($category);
	}

	public function dataTable(Request $request)
	{
		$query = Category::query()->where('company_id', auth()->user()->id)->with('company');

		if ($request->search) {
			$query->where('category_name', 'like', "%$request->search%")
				->orWhere('category_code', 'like', "%$request->search%");
		}
		$result = $query->orderBy('id', 'desc')->paginate();

		return CategoryResource::collection($result);
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'company_id' => 'required',
			'category_code' => ['required', Rule::unique('category')->ignore($request->id)->where(fn ($query) => $query->where('company_id', $request->company_id))],
			'category_name'	=> 'required',
		]);
		if ($validator->fails()) {
			return response(['errors' => $validator->errors()], 409);
		}

		if ($request->id) {
			$message = 'Success to update category';
		} else {
			$message = 'Success to add new category';
		}

		Category::firstOrCreate(
			['id' => $request->id],
			[
				'company_id' => $request->company_id,
				'category_code' => $request->category_code,
				'category_name' => $request->category_name,
			]
		);
		return response(['success' => $message], 200);
	}

	public function destroy(Request $request)
	{
		if (!Category::find($request->id)) {
			return response(['errors' => 'Category not found'], 409);
		}
		Category::destroy($request->id);
		return response(['success' => 'Success delete selected category'], 200);
	}

	public function bulkDestroy(Request $request)
	{
		if (!Category::find($request->id)) {
			return response(['errors' => 'Category not found'], 409);
		}

		Category::destroy($request->id);
		return response(['success' => 'Success deleted ' . count($request->id) . ' data'], 200);
	}
}
