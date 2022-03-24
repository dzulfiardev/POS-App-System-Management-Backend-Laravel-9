<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
	public function store(Request $request)
	{
		try {
			Validator::make($request->all(), [
				'file' => 'image|max:1024'
			])->validate();

			$user = Auth::user();

			if ($user->avatar) {
				$oldImage = explode('/', $user->avatar);
				$avatarUrl = end($oldImage);
				unlink('storage/avatars/user-' . $user->id . '/' . $avatarUrl);
			}

			$filePath = Storage::disk('public')
				->putFile('avatars/user-' . $user->id, $request->file, 'public');
			$user->avatar = url('storage') . '/' . $filePath;
			$user->save();
		} catch (Exception $exception) {
			return response()->json(['message' => $exception->getMessage()], 409);
		}
		return new UserResource($user);
	}
}
