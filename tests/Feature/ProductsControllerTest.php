<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Company;
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

		$company = Company::create([
			'company_name' => 'Company Name',
			'company_phone' => '000-0000-0000',
			'company_address' => 'Company Address Street'
		]);
		$user->company_id = $company->id;
		$user->save();

		$brand = Brand::create([
			'company_id' => $company->id,
			'brand_code' => 'CC-00002',
			'brand_name' => 'Coca-Cola',
		]);

		$category = Category::create([
			'company_id' => $company->id,
			'category_code' => '1999',
			'category_name' => 'Beverage',
		]);

		$res = $this->post('/api/products', [
			'company_id' => $company->id,
			'category_id' => $category->id,
			'brand_id' => $brand->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Zero Sugar',
			'product_code' => 'PC-9993',
			'product_barcode' => '213828381283',
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 10,
			'created_at' => $user->id,
			'updated_at' => $user->id,
		]);

		$res = $this->get('/api/products-by-company');

		$res->assertStatus(200);
	}

	public function test_product_store()
	{
		$this->withoutExceptionHandling();
		$user = User::factory()->create();
		$this->actingAs($user);

		$company = Company::create([
			'company_name' => 'Company Name',
			'company_phone' => '000-0000-0000',
			'company_address' => 'Company Address Street'
		]);
		$user->company_id = $company->id;
		$user->save();

		$brand = Brand::create([
			'company_id' => $company->id,
			'brand_code' => 'CC-00002',
			'brand_name' => 'Coca-Cola',
		]);

		$category = Category::create([
			'company_id' => $company->id,
			'category_code' => '1999',
			'category_name' => 'Food',
		]);

		$res = $this->post('/api/products', [
			'company_id' => $company->id,
			'category_id' => $category->id,
			'brand_id' => $brand->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola',
			'product_code' => 'PC-9993',
			'product_barcode' => '213828381283',
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 10,
			'created_at' => $user->id,
			'updated_at' => $user->id,
		]);
		$res->assertStatus(200);
	}

	public function test_product_required_validation_store()
	{
		$this->withoutExceptionHandling();
		$user = User::factory()->create();
		$this->actingAs($user);

		$res = $this->post('/api/products', [
			'company_id' => '',
			'category_id' => '',
			'brand_id' => '',
			'product_unit' => '',
			'product_name' => '',
			'product_code' => '',
			'product_barcode' => '',
			'product_selling_price' => null,
			'product_purchase_price' => null,
			'product_discount'	=> null,
			'created_at' => null,
			'updated_at' => null,
		]);

		$res->assertStatus(409)
			->assertJson([
				'errors' => true
			]);
	}
}
