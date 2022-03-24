<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
	public function index()
	{
		if (Auth::user()->isAdmin()) {
			return UserResource::collection(User::paginate());
		}
		return response()->json(["message" => "Forbidden"], 403);
	}

	public function show(User $user)
	{
		if (Auth::user()->isAdmin()) {
			return new UserResource($user);
		}
		return  response()->json(["message" => "Forbidden"], 403);
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'email' => 'required|email|unique:users',
			'name' => 'required',
			'username' => 'required|unique:users',
		]);

		if ($validator->fails()) {
			return response()->json(['message' => $validator->errors(), 409]);
		}

		$user = Auth::user();
		$user->email = $request->email;
		$user->name = $request->name;
		$user->username = $request->username;
		$user->save();
	}
}
