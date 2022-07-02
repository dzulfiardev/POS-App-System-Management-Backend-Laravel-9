<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Resources\Products\BrandResource;

class BrandController extends Controller
{
	public function showAll()
	{
		$brand = Brand::query()->with('company')->where('company_id', auth()->user()->id)->get();
		return BrandResource::collection($brand);
	}
}
