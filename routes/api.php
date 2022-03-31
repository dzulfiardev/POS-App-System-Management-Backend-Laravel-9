<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvatarController;
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
});
Route::post('/sanctum/token', TokenController::class);

// Testing route
Route::get('/users/auth-test', AuthController::class);
Route::get('/products-by-company-testing', [ProductsController::class, 'showAllByCompany']);
Route::get('/company-data-all-testing', [ProductsController::class, 'companyWithProduct']);
