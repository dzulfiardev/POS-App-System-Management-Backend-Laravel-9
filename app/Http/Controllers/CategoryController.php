<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'company_id' => 'required',
			'category_code' => ['required', Rule::unique('category')->ignore($request->id)],
			'category_name'	=> 'required',
		]);
		if ($validator->fails()) {
			return response(['errors' => $validator->errors()], 409);
		}

		Category::firstOrCreate(
			['id' => $request->id],
			[
				'company_id' => $request->company_id,
				'category_code' => $request->category_code,
				'category_name' => $request->category_name,
			]
		);

		return response(['success' => 'Success add new Category'], 200);
	}
}
