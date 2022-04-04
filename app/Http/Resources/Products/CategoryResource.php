<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
	public function toArray($request)
	{
		return [
			'id' => $this->id,
			'category_code' => $this->category_code,
			'company_id' => $this->company_id,
			'category_name' => $this->category_name,
		];
	}
}
