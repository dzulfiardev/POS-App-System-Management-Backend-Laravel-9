<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
	public function toArray($request)
	{
		return [
			'id' => $this->id,
			'company_id' => $this->company_id,
			'supplier_name' => $this->supplier_name,
			'supplier_code' => $this->supplier_code,
			'supplier_contact' => $this->supplier_contact,
			'supplier_address' => $this->supplier_address,
		];
	}
}
