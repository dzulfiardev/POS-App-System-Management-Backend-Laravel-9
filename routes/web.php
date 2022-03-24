<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Company;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/csrf-token', function () {
//     echo csrf_token();
// });
// Route::get('/users/{id}', function ($id) {
//     return response(User::find($id)->company, 200);
// });
