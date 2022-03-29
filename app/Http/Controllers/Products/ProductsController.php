<?php

namespace App\Http\Controllers\Products;

use App\Http\Resources\Products\ProductsResource;
use App\Http\Resources\CompanyResource;
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
		$results = $company->all();

		return new CompanyResource($results);
	}
}
