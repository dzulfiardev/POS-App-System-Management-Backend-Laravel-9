<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Company;

class CategoryControllerTest extends TestCase
{
	use RefreshDatabase;

	public function test_category_store()
	{
		$this->withoutExceptionHandling();
		$user = User::factory()->create();
		$this->actingAs($user);

		$company = Company::create([
			'company_name' => 'Company Name',
			'company_phone' => '000-0000-0000',
			'company_address' => 'Company Address Street'
		]);

		$res = $this->post("/api/category", [
			'company_id' => $company->id,
			'category_code' => '3321',
			'category_name' => 'Food',
		]);
		$res->assertStatus(200);
	}

	public function test_category_store_update_with_same_unique_value()
	{
		$this->withoutExceptionHandling();
		$user = User::factory()->create();
		$this->actingAs($user);

		$company = Company::create([
			'company_name' => 'Company Name',
			'company_phone' => '000-0000-0000',
			'company_address' => 'Company Address Street'
		]);

		$this->post("/api/category", [
			'company_id' => $company->id,
			'category_code' => '3321',
			'category_name' => 'Food',
		]);
		$category = Category::first();

		$res = $this->post("/api/category", [
			'id' => $category->id,
			'company_id' => $company->id,
			'category_code' => '3321',
			'category_name' => 'Non Food',
		]);

		$res->assertStatus(200)
			->assertJson(['success' => true]);
	}

	public function test_category_store_update_unique_field()
	{
		$this->withoutExceptionHandling();
		$user = User::factory()->create();
		$this->actingAs($user);

		$company = Company::create([
			'company_name' => 'Company Name',
			'company_phone' => '000-0000-0000',
			'company_address' => 'Company Address Street'
		]);

		Category::create([
			'id' => 1,
			'company_id' => $company->id,
			'category_code' => '3321',
			'category_name' => 'Food',
		]);
		Category::create([
			'id' => 2,
			'company_id' => $company->id,
			'category_code' => '3322',
			'category_name' => 'Beverage',
		]);

		$res = $this->post("/api/category", [
			'id' => 1,
			'company_id' => $company->id,
			'category_code' => '3330',
			'category_name' => 'Non Food',
		]);

		$res->assertStatus(200)
			->assertJson(['success' => true]);
	}

	public function test_category_required_error_validation()
	{
		$this->withoutExceptionHandling();
		$user = User::factory()->create();
		$this->actingAs($user);

		$res = $this->post('/api/category', [
			'company_id' => '',
			'category_code' => '',
			'category_name' => '',
		]);

		$res->assertStatus(409)
			->assertJson([
				'errors' => true,
			]);
	}

	public function test_category_unique_error_validation()
	{
		$this->withoutExceptionHandling();
		$user = User::factory()->create();
		$this->actingAs($user);

		$company = Company::create([
			'company_name' => 'Company Name',
			'company_phone' => '000-0000-0000',
			'company_address' => 'Company Address Street'
		]);

		$this->post('/api/category', [
			'company_id' => $company->id,
			'category_code' => '1999',
			'category_name' => 'Food',
		]);

		$res = $this->post('/api/category', [
			'company_id' => $company->id,
			'category_code' => '1999',
			'category_name' => 'Beverage',
		]);

		$res->assertStatus(409)
			->assertJson(['errors' => true]);
	}

	public function test_category_store_update_unique_error_validation()
	{
		$this->withoutExceptionHandling();
		$user = User::factory()->create();
		$this->actingAs($user);

		$company = Company::create([
			'company_name' => 'Company Name',
			'company_phone' => '000-0000-0000',
			'company_address' => 'Company Address Street'
		]);

		Category::create([
			'id' => 1,
			'company_id' => $company->id,
			'category_code' => '3321',
			'category_name' => 'Food',
		]);
		Category::create([
			'id' => 2,
			'company_id' => $company->id,
			'category_code' => '3322',
			'category_name' => 'Beverage',
		]);

		$res = $this->post("/api/category", [
			'id' => 1,
			'company_id' => $company->id,
			'category_code' => '3322',
			'category_name' => 'Non Food',
		]);

		$res->assertStatus(409)
			->assertJson(['errors' => true]);
	}
}
