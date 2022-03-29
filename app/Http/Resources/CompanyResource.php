<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
	public function toArray($request)
	{
		return [
			'id' => $this->id,
			'name' => $this->company_name,
			'address' => $this->company_address,
			'phone' => $this->company_phone,
			'user' => $this->user->name,
			'userId' => $this->user->id,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		];
	}
}
