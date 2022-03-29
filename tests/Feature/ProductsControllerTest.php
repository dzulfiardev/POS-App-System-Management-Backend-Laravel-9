<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Resources\Products\ProductsResource;
use App\Models\User;
use App\Models\Products;
use Tests\TestCase;

class ProductsControllerTest extends TestCase
{
	use RefreshDatabase;

	public function test_product_show_all()
	{
		$this->withoutExceptionHandling();
		$user = User::factory()->create();
		$this->actingAs($user);

		Products::create(
			[
				'product_name' => 'Sprite',
				'product_code' => 'SP-32323',
				'product_barcode' => '123123123',
				'product_selling_price' => 12.2,
				'product_purchase_price' => 10,
				'product_discount_price' => 0,
				'product_final_price' => 12.2,
				'product_stock' => 0,
				'created_by' => 1,
				'updated_by' => 1,
			],
			[
				'product_name' => 'Coca Cola',
				'product_code' => 'CC-323',
				'product_barcode' => '1313123123',
				'product_selling_price' => 12.2,
				'product_purchase_price' => 10,
				'product_discount_price' => 0,
				'product_final_price' => 12.2,
				'product_stock' => 0,
				'created_by' => 1,
				'updated_by' => 1,
			],
		);

		$res = $this->get('/api/products');
		dd(new ProductsResource(Products::all()));
		$res->assertStatus(200);
	}

	public function test_product_store()
	{
		$this->withoutExceptionHandling();
		$user = User::factory()->create();
		$this->actingAs($user);

		$res = $this->post('/api/products', [
			'company_id' => 1,
			'category_id' => 1,
			'brand_id' => 1,
			'product_name' => 'Coca Cola',
			'product_code' => 'PC-9993',
			'product_barcode' => '213828381283',
			'product_selling_price' => 100,
			'product_purchase_price' => 80,
			'proudct_discout_price'		=> 10,
		]);

		$res->assertStatus(200);
	}
}
