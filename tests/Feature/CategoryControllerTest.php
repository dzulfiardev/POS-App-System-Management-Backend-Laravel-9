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

	public function test_category_show_all_by_company_id()
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

		Category::create([
			'company_id' => $company->id,
			'category_code' => '3321',
			'category_name' => 'Food',
		]);
		Category::create([
			'company_id' => $company->id,
			'category_code' => '3322',
			'category_name' => 'Non Food',
		]);

		$res = $this->get('/api/category');

		$res->assertStatus(200)
			->assertJson(['data' => true]);
	}

	public function test_category_show_single_by_company_id()
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

		$firstInsert = Category::create([
			'company_id' => $company->id,
			'category_code' => '3321',
			'category_name' => 'Food',
		]);
		$secondInsert = Category::create([
			'company_id' => $company->id,
			'category_code' => '3322',
			'category_name' => 'Non Food',
		]);
		$thirdInsert = Category::create([
			'company_id' => $company->id,
			'category_code' => '3323',
			'category_name' => 'Beverage',
		]);

		$res = $this->get('/api/category/' . $thirdInsert->id);

		$res->assertStatus(200)
			->assertJson(['data' => true]);
	}

	public function test_category_show_all_by_company_id_on_datatable()
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

		Category::create([
			'company_id' => $company->id,
			'category_code' => '3321',
			'category_name' => 'Food',
		]);
		Category::create([
			'company_id' => $company->id,
			'category_code' => '3322',
			'category_name' => 'Non Food',
		]);
		Category::create([
			'company_id' => $company->id,
			'category_code' => '3323',
			'category_name' => 'Beverage',
		]);

		$res = $this->get('/api/category-datatable');

		$res->assertStatus(200)
			->assertJson(['data' => true, 'links' => true]);
	}

	public function test_category_show_all_by_company_id_on_datatable_with_search()
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

		Category::create([
			'company_id' => $company->id,
			'category_code' => '3321',
			'category_name' => 'Food',
		]);
		Category::create([
			'company_id' => $company->id,
			'category_code' => '3322',
			'category_name' => 'Non Food',
		]);
		Category::create([
			'company_id' => $company->id,
			'category_code' => '3323',
			'category_name' => 'Beverage',
		]);

		$res = $this->get('/api/category-datatable?search=bev');

		$res->assertStatus(200)
			->assertJson(['data' => true, 'links' => true]);
		$this->assertEquals($res['data'][0]['category_name'], 'Beverage');
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
		$user->company_id = $company->id;
		$user->save();

		$firstInsert = Category::create([
			'company_id' => $company->id,
			'category_code' => '3321',
			'category_name' => 'Food',
		]);
		$secondInsert = Category::create([
			'company_id' => $company->id,
			'category_code' => '3322',
			'category_name' => 'Beverage',
		]);

		$res = $this->post("/api/category", [
			'id' => $firstInsert->id,
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
			'company_address' => 'Company Address Street',
		]);

		$firstInsert = Category::create([
			'company_id' => $company->id,
			'category_code' => '1999',
			'category_name' => 'Food',
		]);

		$secondInsert = Category::create([
			'company_id' => $company->id,
			'category_code' => '1998',
			'category_name' => 'Electronics',
		]);

		// new insertion
		$res = $this->post('/api/category', [
			'company_id' => $company->id,
			'category_code' => '1999',
			'category_name' => 'Beverage',
		]);

		$res->assertStatus(409)
			->assertJson(['errors' => true]);
	}

	public function test_category_store_unique_not_error_if_diffrent_company_id()
	{
		$this->withoutExceptionHandling();
		$user = User::factory()->create();
		$this->actingAs($user);

		$company1 = Company::create([
			'company_name' => 'Company Name 1',
			'company_phone' => '000-0000-0000',
			'company_address' => 'Company Address Street',
		]);
		$user->company_id = $company1->id;
		$user->save();

		$company2 = Company::create([
			'company_name' => 'Company Name 2',
			'company_phone' => '000-0000-0000',
			'company_address' => 'Company Address Street'
		]);
		$user2 = User::factory()->create();
		$user2->company_id = $company2->id;
		$user2->save();

		$firstInsert = Category::create([
			'company_id' => $company1->id,
			'category_code' => '1999',
			'category_name' => 'Food',
		]);
		$secondInsert = Category::create([
			'company_id' => $company1->id,
			'category_code' => '1998',
			'category_name' => 'Beverages',
		]);

		$thirdInsert = Category::create([
			'company_id' => $company2->id,
			'category_code' => '1998',
			'category_name' => 'Electronics',
		]);
		$fourthInsert = Category::create([
			'company_id' => $company2->id,
			'category_code' => '1323',
			'category_name' => 'Electronics',
		]);

		// new insertion diffrent category_code but same other company
		$res = $this->post('/api/category', [
			'company_id' => $company1->id,
			'category_code' => '1323',
			'category_name' => 'Beverage',
		]);

		$res->assertStatus(200)
			->assertJson(['success' => true]);
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

		$firstInsert = Category::create([
			'company_id' => $company->id,
			'category_code' => '3321',
			'category_name' => 'Food',
		]);
		$secondInsert = Category::create([
			'company_id' => $company->id,
			'category_code' => '3322',
			'category_name' => 'Beverage',
		]);

		$res = $this->post("/api/category", [
			'id' => $firstInsert->id,
			'company_id' => $company->id,
			'category_code' => '3322',
			'category_name' => 'Non Food',
		]);

		$res->assertStatus(409)
			->assertJson(['errors' => true]);
	}

	public function test_category_delete()
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

		$firstInsert = Category::create([
			'company_id' => $company->id,
			'category_code' => '3321',
			'category_name' => 'Food',
		]);
		$secondInsert = Category::create([
			'company_id' => $company->id,
			'category_code' => '3322',
			'category_name' => 'Beverage',
		]);
		$thirdInsert = Category::create([
			'company_id' => $company->id,
			'category_code' => '3322',
			'category_name' => 'Beverage',
		]);

		$category = Category::find($thirdInsert->id);

		$res = $this->delete('/api/category', ['id' => $thirdInsert->id]);

		$res->assertStatus(200)->assertJson(['success' => true]);
		$this->assertEquals('Beverage', $category->category_name);
	}

	public function test_category_bulk_delete()
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

		$firstInsert = Category::create([
			'company_id' => $company->id,
			'category_code' => '3321',
			'category_name' => 'Food',
		]);
		$secondInsert = Category::create([
			'company_id' => $company->id,
			'category_code' => '3322',
			'category_name' => 'Beverage',
		]);
		$thirdInsert = Category::create([
			'company_id' => $company->id,
			'category_code' => '3322',
			'category_name' => 'Beverage',
		]);
		$fourthInsert = Category::create([
			'company_id' => $company->id,
			'category_code' => '3322',
			'category_name' => 'Beverage',
		]);

		$res = $this->delete('/api/category-bulk-delete', ['id' => [$firstInsert->id, $secondInsert->id, $thirdInsert->id]]);
		$res->assertStatus(200)->assertJson(['success' => true]);
	}
}
