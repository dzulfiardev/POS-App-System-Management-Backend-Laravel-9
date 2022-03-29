<?php

namespace App\Http\Controllers\Products;

use App\Http\Resources\Products\ProductsResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Company;
use App\Models\Brand;

class ProductsController extends Controller
{
	public function showAll()
	{
		$request = null;
		$products = Products::query()->with('brand')->with('company')->with('createdBy')->with('updatedBy');

		if ($request) {
			$results = $products->where('id', $request)->get();
		}
		$results = $products->get();
		return ProductsResource::collection($results);
	}

	public function companyWithProduct()
	{
		$company = Company::query()->with('products')->with('user');
		$results = $company->paginate();

		$data = [];
		foreach ($results as $res) {
			$data[] = [
				'id' => $res->id,
				'name' => $res->company_name,
				'address' => $res->company_address,
				'phone' => $res->company_phone,
				'user' => $res->user->name,
				'userId' => $res->user->id,
				'created_at' => $res->created_at,
				'updated_at' => $res->updated_at,
			];
		}
		return response($data, 200);
	}
}
