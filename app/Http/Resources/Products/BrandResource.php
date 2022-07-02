<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
	public function toArray($request)
	{
		return [
			'id' => $this->id,
			'company_id' => $this->company_id,
			'brand_code' => $this->brand_code,
			'brand_name' => $this->brand_name,
		];
	}
}
