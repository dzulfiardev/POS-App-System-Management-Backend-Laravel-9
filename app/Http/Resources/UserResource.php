<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
	public function toArray($request)
	{
		return [
			'id' => $this->id,
			'username' => $this->username,
			'name' => $this->name,
			'email' => $this->email,
			'avatar' => $this->avatar,
			'emailVerified' => $this->email_verified_at,
			'isAdmin' => $this->isAdmin(),
			'isRoot' => $this->isRoot(),
			'company' => $this->company,
		];
	}
}
