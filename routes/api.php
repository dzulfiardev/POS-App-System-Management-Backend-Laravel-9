<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\Products\CategoryController;
use App\Http\Controllers\Products\ProductsController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
	Route::get('/user/{id}', function ($id) {
		return User::findOrFail($id);
	});
	Route::get('/users/auth', AuthController::class);
	Route::post('/users/auth/avatar', [AvatarController::class, 'store']);

	Route::get('/products-by-company', [ProductsController::class, 'showAllByCompany']);
	Route::post('/products', [ProductsController::class, 'store']);
	Route::delete('/products', [ProductsController::class, 'destroy']);
	Route::delete('/products-bulk-delete', [ProductsController::class, 'bulkDestroy']);
	Route::get('/products-datatable', [ProductsController::class, 'dataTable']);

	Route::post('/category', [CategoryController::class, 'store']);
	Route::get('/category', [CategoryController::class, 'showAll']);
	Route::get('/category/{id}', [CategoryController::class, 'show']);
	Route::get('/category-datatable', [CategoryController::class, 'dataTable']);
	Route::delete('/category', [CategoryController::class, 'destroy']);
	Route::delete('/category-bulk-delete', [CategoryController::class, 'bulkDestroy']);
});
Route::post('/sanctum/token', TokenController::class);

// Testing route
Route::get('/users/auth-test', AuthController::class);
Route::get('/products-by-company-testing', [ProductsController::class, 'showAllByCompany']);
Route::get('/company-data-all-testing', [ProductsController::class, 'companyWithProduct']);
