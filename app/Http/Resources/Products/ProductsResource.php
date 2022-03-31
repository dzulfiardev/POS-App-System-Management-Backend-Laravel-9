<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
	public function toArray($request)
	{
		return [
			'id' => $this->id,
			'company_id' => $this->company_id,
			'name' => $this->product_name,
			'brand' => $this->brand->brand_name,
			'code' => $this->product_code,
			'barcode' => $this->product_barcode,
			'sellPrice' => $this->product_selling_price,
			'purchasePrice' => $this->product_purchase_price,
			'discount'	=> $this->product_discount_price,
			'final_price' => $this->product_final_price,
			'stock' => $this->product_stock,
			'createdBy' => $this->createdBy->name,
			'updatedBy' => $this->updatedBy->name,
		];
	}
}
