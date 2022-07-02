<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Http\Resources\Products\SupplierResource;

class SupplierController extends Controller
{
	public function showAll()
	{
		$supplier = Supplier::query()->with('company')->where('company_id', auth()->user()->id)->get();
		return SupplierResource::collection($supplier);
	}
}
