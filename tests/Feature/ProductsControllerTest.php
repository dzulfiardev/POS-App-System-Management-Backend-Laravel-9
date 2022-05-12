<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Company;
use App\Models\Products;
use App\Models\Supplier;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class ProductsControllerTest extends TestCase
{
	use RefreshDatabase;

	public function test_products_show_all()
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

		$supplier = Supplier::create([
			'company_id' => $company->id,
			'supplier_code' => '3322',
			'supplier_name' => 'Supplier Name',
			'supplier_contact' => '000-0000-0000',
			'supplier_address' => 'Supplier address street'
		]);

		$file = UploadedFile::fake()->image('product.jpg');
		$insert1 = $this->post('/api/products', [
			'company_id' => $company->id,
			'category_id' => $category->id,
			'brand_id' => $brand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Zero Sugar',
			'product_image' => $file,
			'product_code' => 'PC-9993',
			'product_barcode' => '213828381283',
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 10,
		]);

		$res = $this->get('/api/products-by-company');

		$res->assertStatus(200);
	}

	public function test_products_show_all_datatable()
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

		$company2 = Company::create([
			'company_name' => 'Company Name 2',
			'company_phone' => '000-0000-0002',
			'company_address' => 'Company Address Street 2'
		]);
		$user2 = User::factory()->create();
		$user2->company_id = $company2->id;
		$user2->save();

		$brand = Brand::create([
			'company_id' => $company->id,
			'brand_code' => 'CC-00002',
			'brand_name' => 'Coca-Cola',
		]);
		$brand2 = Brand::create([
			'company_id' => $company2->id,
			'brand_code' => 'F-00003',
			'brand_name' => 'Fanta',
		]);

		$category = Category::create([
			'company_id' => $company->id,
			'category_code' => '1999',
			'category_name' => 'Beverage',
		]);
		$category2 = Category::create([
			'company_id' => $company2->id,
			'category_code' => '1998',
			'category_name' => 'Grocerry',
		]);

		$supplier = Supplier::create([
			'company_id' => $company->id,
			'supplier_code' => '3322',
			'supplier_name' => 'Supplier Name',
			'supplier_contact' => '000-0000-0000',
			'supplier_address' => 'Supplier address street'
		]);
		$supplier2 = Supplier::create([
			'company_id' => $company2->id,
			'supplier_code' => '5322',
			'supplier_name' => 'Supplier Name 2',
			'supplier_contact' => '000-0000-0000',
			'supplier_address' => 'Supplier address street'
		]);

		$insert1 = Products::create([
			'company_id' => $company->id,
			'category_id' => $category->id,
			'brand_id' => $brand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Zero Sugar',
			'product_code' => 'PC-9993',
			'product_barcode' => '213828381283',
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 0,
			'product_final_price' => 8,
			'created_by' => $user->id,
			'updated_by' => $user->id,
		]);
		$insert2 = Products::create([
			'company_id' => $company->id,
			'category_id' => $category->id,
			'brand_id' => $brand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Red',
			'product_code' => 'PC-9994',
			'product_barcode' => '21382551283',
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 0,
			'product_final_price' => 8,
			'created_by' => $user->id,
			'updated_by' => $user->id,
		]);
		$insert3 = Products::create([
			'company_id' => $company->id,
			'category_id' => $category->id,
			'brand_id' => $brand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Red',
			'product_code' => 'PC-9995',
			'product_barcode' => '213828381233',
			'product_selling_price' => 9,
			'product_purchase_price' => 7,
			'product_discount'	=> 0,
			'product_final_price' => 8,
			'created_by' => $user->id,
			'updated_by' => $user->id,
		]);
		$insertDiffrentCompany = Products::create([
			'company_id' => $company2->id,
			'category_id' => $category2->id,
			'brand_id' => $brand2->id,
			'supplier_id' => $supplier2->id,
			'product_unit' => 'pcs',
			'product_name' => 'Fanta Strawberry',
			'product_code' => 'PC-9922',
			'product_barcode' => '2138381233',
			'product_selling_price' => 9,
			'product_purchase_price' => 7,
			'product_discount'	=> 0,
			'product_final_price' => 9,
			'created_by' => $user2->id,
			'updated_by' => $user2->id,
		]);

		$res = $this->get('/api/products-datatable');
		$res->assertStatus(200)->assertJson(['data' => true, 'links' => true]);
	}

	public function test_products_filter_search_name_datatable()
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

		$company2 = Company::create([
			'company_name' => 'Company Name 2',
			'company_phone' => '000-0000-0002',
			'company_address' => 'Company Address Street 2'
		]);
		$user2 = User::factory()->create();
		$user2->company_id = $company2->id;
		$user2->save();

		$brand = Brand::create([
			'company_id' => $company->id,
			'brand_code' => 'CC-00002',
			'brand_name' => 'Coca-Cola',
		]);
		$brand2 = Brand::create([
			'company_id' => $company2->id,
			'brand_code' => 'F-00003',
			'brand_name' => 'Fanta',
		]);

		$category = Category::create([
			'company_id' => $company->id,
			'category_code' => '1999',
			'category_name' => 'Beverage',
		]);
		$category2 = Category::create([
			'company_id' => $company2->id,
			'category_code' => '1998',
			'category_name' => 'Grocerry',
		]);

		$supplier = Supplier::create([
			'company_id' => $company->id,
			'supplier_code' => '3322',
			'supplier_name' => 'Supplier Name',
			'supplier_contact' => '000-0000-0000',
			'supplier_address' => 'Supplier address street'
		]);
		$supplier2 = Supplier::create([
			'company_id' => $company2->id,
			'supplier_code' => '5322',
			'supplier_name' => 'Supplier Name 2',
			'supplier_contact' => '000-0000-0000',
			'supplier_address' => 'Supplier address street'
		]);

		$insert1 = Products::create([
			'company_id' => $company->id,
			'category_id' => $category->id,
			'brand_id' => $brand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Zero Sugar',
			'product_code' => 'PC-9993',
			'product_barcode' => '213828381283',
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 0,
			'product_final_price' => 8,
			'created_by' => $user->id,
			'updated_by' => $user->id,
		]);
		$insert2 = Products::create([
			'company_id' => $company->id,
			'category_id' => $category->id,
			'brand_id' => $brand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Red',
			'product_code' => 'PC-9994',
			'product_barcode' => '21382551283',
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 0,
			'product_final_price' => 8,
			'created_by' => $user->id,
			'updated_by' => $user->id,
		]);
		$insert3 = Products::create([
			'company_id' => $company->id,
			'category_id' => $category->id,
			'brand_id' => $brand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Blue',
			'product_code' => 'PC-9995',
			'product_barcode' => '213828381233',
			'product_selling_price' => 9,
			'product_purchase_price' => 7,
			'product_discount'	=> 0,
			'product_final_price' => 8,
			'created_by' => $user->id,
			'updated_by' => $user->id,
		]);
		$insertDiffrentCompany = Products::create([
			'company_id' => $company2->id,
			'category_id' => $category2->id,
			'brand_id' => $brand2->id,
			'supplier_id' => $supplier2->id,
			'product_unit' => 'pcs',
			'product_name' => 'Fanta Strawberry',
			'product_code' => 'PC-9922',
			'product_barcode' => '2138381233',
			'product_selling_price' => 9,
			'product_purchase_price' => 7,
			'product_discount'	=> 0,
			'product_final_price' => 9,
			'created_by' => $user2->id,
			'updated_by' => $user2->id,
		]);

		$res = $this->get('/api/products-datatable?search=blu');

		// $result = $res['data'][0]['name'];
		// $this->assertEquals($result, $insert3->product_name);
		$res->assertStatus(200)->assertJson(['data' => true, 'links' => true]);
	}

	public function test_products_filter_search_code_datatable()
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

		$company2 = Company::create([
			'company_name' => 'Company Name 2',
			'company_phone' => '000-0000-0002',
			'company_address' => 'Company Address Street 2'
		]);
		$user2 = User::factory()->create();
		$user2->company_id = $company2->id;
		$user2->save();

		$brand = Brand::create([
			'company_id' => $company->id,
			'brand_code' => 'CC-00002',
			'brand_name' => 'Coca-Cola',
		]);
		$brand2 = Brand::create([
			'company_id' => $company2->id,
			'brand_code' => 'F-00003',
			'brand_name' => 'Fanta',
		]);

		$category = Category::create([
			'company_id' => $company->id,
			'category_code' => '1999',
			'category_name' => 'Beverage',
		]);
		$category2 = Category::create([
			'company_id' => $company2->id,
			'category_code' => '1998',
			'category_name' => 'Grocerry',
		]);

		$supplier = Supplier::create([
			'company_id' => $company->id,
			'supplier_code' => '3322',
			'supplier_name' => 'Supplier Name',
			'supplier_contact' => '000-0000-0000',
			'supplier_address' => 'Supplier address street'
		]);
		$supplier2 = Supplier::create([
			'company_id' => $company2->id,
			'supplier_code' => '5322',
			'supplier_name' => 'Supplier Name 2',
			'supplier_contact' => '000-0000-0000',
			'supplier_address' => 'Supplier address street'
		]);

		$insert1 = Products::create([
			'company_id' => $company->id,
			'category_id' => $category->id,
			'brand_id' => $brand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Zero Sugar',
			'product_code' => 'PC-9993',
			'product_barcode' => '213828381283',
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 0,
			'product_final_price' => 8,
			'created_by' => $user->id,
			'updated_by' => $user->id,
		]);
		$insert2 = Products::create([
			'company_id' => $company->id,
			'category_id' => $category->id,
			'brand_id' => $brand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Red',
			'product_code' => 'PC-9994',
			'product_barcode' => '21382551283',
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 0,
			'product_final_price' => 8,
			'created_by' => $user->id,
			'updated_by' => $user->id,
		]);
		$insert3 = Products::create([
			'company_id' => $company->id,
			'category_id' => $category->id,
			'brand_id' => $brand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Blue',
			'product_code' => 'PC-9995',
			'product_barcode' => '213828381233',
			'product_selling_price' => 9,
			'product_purchase_price' => 7,
			'product_discount'	=> 0,
			'product_final_price' => 8,
			'created_by' => $user->id,
			'updated_by' => $user->id,
		]);
		$insertDiffrentCompany = Products::create([
			'company_id' => $company2->id,
			'category_id' => $category2->id,
			'brand_id' => $brand2->id,
			'supplier_id' => $supplier2->id,
			'product_unit' => 'pcs',
			'product_name' => 'Fanta Strawberry',
			'product_code' => 'PC-9922',
			'product_barcode' => '2138381233',
			'product_selling_price' => 9,
			'product_purchase_price' => 7,
			'product_discount'	=> 0,
			'product_final_price' => 9,
			'created_by' => $user2->id,
			'updated_by' => $user2->id,
		]);

		$res = $this->get('/api/products-datatable?search=93');

		// $result = $res['data'][0]['name'];
		// $this->assertEquals($result, 'Coca Cola Zero Sugar');
		$res->assertStatus(200)->assertJson(['data' => true, 'links' => true]);
	}

	public function test_products_filter_search_barcode_datatable()
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

		$company2 = Company::create([
			'company_name' => 'Company Name 2',
			'company_phone' => '000-0000-0002',
			'company_address' => 'Company Address Street 2'
		]);
		$user2 = User::factory()->create();
		$user2->company_id = $company2->id;
		$user2->save();

		$brand = Brand::create([
			'company_id' => $company->id,
			'brand_code' => 'CC-00002',
			'brand_name' => 'Coca-Cola',
		]);
		$brand2 = Brand::create([
			'company_id' => $company2->id,
			'brand_code' => 'F-00003',
			'brand_name' => 'Fanta',
		]);

		$category = Category::create([
			'company_id' => $company->id,
			'category_code' => '1999',
			'category_name' => 'Beverage',
		]);
		$category2 = Category::create([
			'company_id' => $company2->id,
			'category_code' => '1998',
			'category_name' => 'Grocerry',
		]);

		$supplier = Supplier::create([
			'company_id' => $company->id,
			'supplier_code' => '3322',
			'supplier_name' => 'Supplier Name',
			'supplier_contact' => '000-0000-0000',
			'supplier_address' => 'Supplier address street'
		]);
		$supplier2 = Supplier::create([
			'company_id' => $company2->id,
			'supplier_code' => '5322',
			'supplier_name' => 'Supplier Name 2',
			'supplier_contact' => '000-0000-0000',
			'supplier_address' => 'Supplier address street'
		]);

		$insert1 = Products::create([
			'company_id' => $company->id,
			'category_id' => $category->id,
			'brand_id' => $brand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Zero Sugar',
			'product_code' => 'PC-9993',
			'product_barcode' => '21382838123',
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 0,
			'product_final_price' => 8,
			'created_by' => $user->id,
			'updated_by' => $user->id,
		]);
		$insert2 = Products::create([
			'company_id' => $company->id,
			'category_id' => $category->id,
			'brand_id' => $brand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Red',
			'product_code' => 'PC-9994',
			'product_barcode' => '21382551283',
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 0,
			'product_final_price' => 8,
			'created_by' => $user->id,
			'updated_by' => $user->id,
		]);
		$insert3 = Products::create([
			'company_id' => $company->id,
			'category_id' => $category->id,
			'brand_id' => $brand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Blue',
			'product_code' => 'PC-9995',
			'product_barcode' => '202828381233',
			'product_selling_price' => 9,
			'product_purchase_price' => 7,
			'product_discount'	=> 0,
			'product_final_price' => 8,
			'created_by' => $user->id,
			'updated_by' => $user->id,
		]);
		$insertDiffrentCompany = Products::create([
			'company_id' => $company2->id,
			'category_id' => $category2->id,
			'brand_id' => $brand2->id,
			'supplier_id' => $supplier2->id,
			'product_unit' => 'pcs',
			'product_name' => 'Fanta Strawberry',
			'product_code' => 'PC-9922',
			'product_barcode' => '2138381233',
			'product_selling_price' => 9,
			'product_purchase_price' => 7,
			'product_discount'	=> 0,
			'product_final_price' => 9,
			'created_by' => $user2->id,
			'updated_by' => $user2->id,
		]);

		$res = $this->get('/api/products-datatable?search=21382838123');

		// $this->assertEquals($res['data'][0]['name'], 'Coca Cola Zero Sugar');
		$res->assertStatus(200)->assertJson(['data' => true, 'links' => true]);
	}

	public function test_products_filter_by_category_id_datatable()
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

		$company2 = Company::create([
			'company_name' => 'Company Name 2',
			'company_phone' => '000-0000-0002',
			'company_address' => 'Company Address Street 2'
		]);
		$user2 = User::factory()->create();
		$user2->company_id = $company2->id;
		$user2->save();

		$brand = Brand::create([
			'company_id' => $company->id,
			'brand_code' => 'CC-00002',
			'brand_name' => 'Coca-Cola',
		]);
		$brand2 = Brand::create([
			'company_id' => $company2->id,
			'brand_code' => 'F-00003',
			'brand_name' => 'Fanta',
		]);

		$firstCategory = Category::create([
			'company_id' => $company->id,
			'category_code' => '1999',
			'category_name' => 'Beverage',
		]);
		$secondCategory = Category::create([
			'company_id' => $company->id,
			'category_code' => '1998',
			'category_name' => 'Food',
		]);
		$firstCategory2 = Category::create([
			'company_id' => $company2->id,
			'category_code' => '1998',
			'category_name' => 'Grocerry',
		]);

		$supplier = Supplier::create([
			'company_id' => $company->id,
			'supplier_code' => '3322',
			'supplier_name' => 'Supplier Name',
			'supplier_contact' => '000-0000-0000',
			'supplier_address' => 'Supplier address street'
		]);
		$supplier2 = Supplier::create([
			'company_id' => $company2->id,
			'supplier_code' => '5322',
			'supplier_name' => 'Supplier Name 2',
			'supplier_contact' => '000-0000-0000',
			'supplier_address' => 'Supplier address street'
		]);

		$insert1 = Products::create([
			'company_id' => $company->id,
			'category_id' => $firstCategory->id,
			'brand_id' => $brand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Zero Sugar',
			'product_code' => 'PC-9993',
			'product_barcode' => '21382838123',
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 0,
			'product_final_price' => 8,
			'created_by' => $user->id,
			'updated_by' => $user->id,
		]);
		$insert2 = Products::create([
			'company_id' => $company->id,
			'category_id' => $firstCategory->id,
			'brand_id' => $brand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Red',
			'product_code' => 'PC-9994',
			'product_barcode' => '21382551283',
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 0,
			'product_final_price' => 8,
			'created_by' => $user->id,
			'updated_by' => $user->id,
		]);
		$insert3 = Products::create([
			'company_id' => $company->id,
			'category_id' => $secondCategory->id,
			'brand_id' => $brand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Blue',
			'product_code' => 'PC-9995',
			'product_barcode' => '202828381233',
			'product_selling_price' => 9,
			'product_purchase_price' => 7,
			'product_discount'	=> 0,
			'product_final_price' => 8,
			'created_by' => $user->id,
			'updated_by' => $user->id,
		]);
		$insertDiffrentCompany = Products::create([
			'company_id' => $company2->id,
			'category_id' => $firstCategory2->id,
			'brand_id' => $brand2->id,
			'supplier_id' => $supplier2->id,
			'product_unit' => 'pcs',
			'product_name' => 'Fanta Strawberry',
			'product_code' => 'PC-9922',
			'product_barcode' => '2138381233',
			'product_selling_price' => 9,
			'product_purchase_price' => 7,
			'product_discount'	=> 0,
			'product_final_price' => 9,
			'created_by' => $user2->id,
			'updated_by' => $user2->id,
		]);

		$res = $this->get('/api/products-datatable?category=' . $firstCategory->id);

		$res->assertStatus(200)->assertJson(['data' => true, 'links' => true]);
	}

	public function test_products_filter_by_brand_id_datatable()
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

		$company2 = Company::create([
			'company_name' => 'Company Name 2',
			'company_phone' => '000-0000-0002',
			'company_address' => 'Company Address Street 2'
		]);
		$user2 = User::factory()->create();
		$user2->company_id = $company2->id;
		$user2->save();

		$firstBrand = Brand::create([
			'company_id' => $company->id,
			'brand_code' => 'CC-00002',
			'brand_name' => 'Coca-Cola',
		]);
		$secondBrand = Brand::create([
			'company_id' => $company->id,
			'brand_code' => 'CC-00002',
			'brand_name' => 'Sprite',
		]);
		$firstBrand2 = Brand::create([
			'company_id' => $company2->id,
			'brand_code' => 'F-00003',
			'brand_name' => 'Fanta',
		]);

		$firstCategory = Category::create([
			'company_id' => $company->id,
			'category_code' => '1999',
			'category_name' => 'Beverage',
		]);
		$secondCategory = Category::create([
			'company_id' => $company->id,
			'category_code' => '1998',
			'category_name' => 'Food',
		]);
		$firstCategory2 = Category::create([
			'company_id' => $company2->id,
			'category_code' => '1998',
			'category_name' => 'Grocerry',
		]);

		$supplier = Supplier::create([
			'company_id' => $company->id,
			'supplier_code' => '3322',
			'supplier_name' => 'Supplier Name',
			'supplier_contact' => '000-0000-0000',
			'supplier_address' => 'Supplier address street'
		]);
		$supplier2 = Supplier::create([
			'company_id' => $company2->id,
			'supplier_code' => '5322',
			'supplier_name' => 'Supplier Name 2',
			'supplier_contact' => '000-0000-0000',
			'supplier_address' => 'Supplier address street'
		]);

		$insert1 = Products::create([
			'company_id' => $company->id,
			'category_id' => $firstCategory->id,
			'brand_id' => $firstBrand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Zero Sugar',
			'product_code' => 'PC-9993',
			'product_barcode' => '21382838123',
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 0,
			'product_final_price' => 8,
			'created_by' => $user->id,
			'updated_by' => $user->id,
		]);
		$insert2 = Products::create([
			'company_id' => $company->id,
			'category_id' => $firstCategory->id,
			'brand_id' => $firstBrand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Red',
			'product_code' => 'PC-9994',
			'product_barcode' => '21382551283',
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 0,
			'product_final_price' => 8,
			'created_by' => $user->id,
			'updated_by' => $user->id,
		]);
		$insert3 = Products::create([
			'company_id' => $company->id,
			'category_id' => $secondCategory->id,
			'brand_id' => $secondBrand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Sprite Water Lemon',
			'product_code' => 'PC-9995',
			'product_barcode' => '202828381233',
			'product_selling_price' => 9,
			'product_purchase_price' => 7,
			'product_discount'	=> 0,
			'product_final_price' => 8,
			'created_by' => $user->id,
			'updated_by' => $user->id,
		]);
		$insertDiffrentCompany = Products::create([
			'company_id' => $company2->id,
			'category_id' => $firstCategory2->id,
			'brand_id' => $firstBrand2->id,
			'supplier_id' => $supplier2->id,
			'product_unit' => 'pcs',
			'product_name' => 'Fanta Strawberry',
			'product_code' => 'PC-9922',
			'product_barcode' => '2138381233',
			'product_selling_price' => 9,
			'product_purchase_price' => 7,
			'product_discount'	=> 0,
			'product_final_price' => 9,
			'created_by' => $user2->id,
			'updated_by' => $user2->id,
		]);

		$res = $this->get('/api/products-datatable?brand=' . $firstBrand->id);

		$this->assertEquals($res['data'][0]['brand'], 'Coca-Cola');
		$res->assertStatus(200)->assertJson(['data' => true, 'links' => true]);
	}

	public function test_products_store_without_image_file()
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

		$supplier = Supplier::create([
			'company_id' => $company->id,
			'supplier_code' => '3322',
			'supplier_name' => 'Supplier Name',
			'supplier_contact' => '000-0000-0000',
			'supplier_address' => 'Supplier address street'
		]);

		$res = $this->post('/api/products', [
			'company_id' => $company->id,
			'category_id' => $category->id,
			'brand_id' => $brand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola',
			'product_image' => null,
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

	public function test_products_store_with_image_file()
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

		$supplier = Supplier::create([
			'company_id' => $company->id,
			'supplier_code' => '3322',
			'supplier_name' => 'Supplier Name',
			'supplier_contact' => '000-0000-0000',
			'supplier_address' => 'Supplier address street'
		]);

		// Storage::fake('avatar');
		$file = UploadedFile::fake()->image('product.jpg');

		$res = $this->post('/api/products', [
			'company_id' => $company->id,
			'category_id' => $category->id,
			'brand_id' => $brand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola',
			'product_code' => 'PC-9993',
			'product_barcode' => '213828381283',
			'product_image' => $file,
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 10,
			'created_at' => $user->id,
			'updated_at' => $user->id,
		]);
		// Storage::disk('avatar')->assertExists($file->hashName());
		$res->assertStatus(200);
	}

	public function test_products_store_update_without_image_file()
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
		$supplier = Supplier::create([
			'company_id' => $company->id,
			'supplier_code' => '3322',
			'supplier_name' => 'Supplier Name',
			'supplier_contact' => '000-0000-0000',
			'supplier_address' => 'Supplier address street'
		]);

		$insert = Products::create([
			'company_id' => $company->id,
			'category_id' => $category->id,
			'brand_id' => $brand->id,
			'supplier_id' => $supplier->id,
			'product_image' => null,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Less Sugar',
			'product_code' => 'PC-9993',
			'product_barcode' => '213828381283',
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 10,
		]);
		$insert2 = Products::create([
			'company_id' => $company->id,
			'category_id' => $category->id,
			'brand_id' => $brand->id,
			'supplier_id' => $supplier->id,
			'product_image' => null,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Blue',
			'product_code' => 'PC-9994',
			'product_barcode' => '21382832333',
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 0,
		]);

		// Update Action
		$res = $this->post('/api/products', [
			'id' => $insert->id,
			'company_id' => $company->id,
			'category_id' => $category->id,
			'brand_id' => $brand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Zero Sugar',
			'product_image' => null,
			'product_code' => 'PC-9993',
			'product_barcode' => '4828381283',
			'product_selling_price' => 8.5,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 10,
		]);

		$res->assertStatus(200)->assertJson(['success' => true]);
	}

	public function test_products_store_update_with_image_file()
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
		$supplier = Supplier::create([
			'company_id' => $company->id,
			'supplier_code' => '3322',
			'supplier_name' => 'Supplier Name',
			'supplier_contact' => '000-0000-0000',
			'supplier_address' => 'Supplier address street'
		]);

		$insertFile = UploadedFile::fake()->image('image1.jpg');
		$this->post('/api/products', [
			'company_id' => $company->id,
			'category_id' => $category->id,
			'brand_id' => $brand->id,
			'supplier_id' => $supplier->id,
			'product_image' => $insertFile,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Less Sugar',
			'product_code' => 'PC-9993',
			'product_barcode' => '213828381283',
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 10,
		]);

		$file = UploadedFile::fake()->image('image.jpg');
		// Update Action
		$res = $this->post('/api/products', [
			'id' => Products::first()->id,
			'company_id' => $company->id,
			'category_id' => $category->id,
			'brand_id' => $brand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Zero Sugar',
			'product_image' => $file,
			'product_code' => 'PC-9993',
			'product_barcode' => '4828381283',
			'product_selling_price' => 8.5,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 10,
		]);

		$res->assertStatus(200)->assertJson(['success' => true]);
	}

	public function test_products_required_validation_store()
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

	public function test_products_destroy()
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

		$company2 = Company::create([
			'company_name' => 'Company Name 2',
			'company_phone' => '000-0000-0002',
			'company_address' => 'Company Address Street 2'
		]);
		$user2 = User::factory()->create();
		$user2->company_id = $company2->id;
		$user2->save();

		$firstBrand = Brand::create([
			'company_id' => $company->id,
			'brand_code' => 'CC-00002',
			'brand_name' => 'Coca-Cola',
		]);
		$secondBrand = Brand::create([
			'company_id' => $company->id,
			'brand_code' => 'CC-00002',
			'brand_name' => 'Sprite',
		]);
		$firstBrand2 = Brand::create([
			'company_id' => $company2->id,
			'brand_code' => 'F-00003',
			'brand_name' => 'Fanta',
		]);

		$firstCategory = Category::create([
			'company_id' => $company->id,
			'category_code' => '1999',
			'category_name' => 'Beverage',
		]);
		$secondCategory = Category::create([
			'company_id' => $company->id,
			'category_code' => '1998',
			'category_name' => 'Food',
		]);
		$firstCategory2 = Category::create([
			'company_id' => $company2->id,
			'category_code' => '1998',
			'category_name' => 'Grocerry',
		]);

		$supplier = Supplier::create([
			'company_id' => $company->id,
			'supplier_code' => '3322',
			'supplier_name' => 'Supplier Name',
			'supplier_contact' => '000-0000-0000',
			'supplier_address' => 'Supplier address street'
		]);
		$supplier2 = Supplier::create([
			'company_id' => $company2->id,
			'supplier_code' => '5322',
			'supplier_name' => 'Supplier Name 2',
			'supplier_contact' => '000-0000-0000',
			'supplier_address' => 'Supplier address street'
		]);

		$insert1 = Products::create([
			'company_id' => $company->id,
			'category_id' => $firstCategory->id,
			'brand_id' => $firstBrand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Zero Sugar',
			'product_code' => 'PC-9993',
			'product_barcode' => '21382838123',
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 0,
			'product_final_price' => 8,
			'created_by' => $user->id,
			'updated_by' => $user->id,
		]);
		$insert2 = Products::create([
			'company_id' => $company->id,
			'category_id' => $firstCategory->id,
			'brand_id' => $firstBrand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Red',
			'product_code' => 'PC-9994',
			'product_barcode' => '21382551283',
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 0,
			'product_final_price' => 8,
			'created_by' => $user->id,
			'updated_by' => $user->id,
		]);
		$insert3 = Products::create([
			'company_id' => $company->id,
			'category_id' => $secondCategory->id,
			'brand_id' => $secondBrand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Sprite Water Lemon',
			'product_code' => 'PC-9995',
			'product_barcode' => '202828381233',
			'product_selling_price' => 9,
			'product_purchase_price' => 7,
			'product_discount'	=> 0,
			'product_final_price' => 8,
			'created_by' => $user->id,
			'updated_by' => $user->id,
		]);
		$insertDiffrentCompany = Products::create([
			'company_id' => $company2->id,
			'category_id' => $firstCategory2->id,
			'brand_id' => $firstBrand2->id,
			'supplier_id' => $supplier2->id,
			'product_unit' => 'pcs',
			'product_name' => 'Fanta Strawberry',
			'product_code' => 'PC-9922',
			'product_barcode' => '2138381233',
			'product_selling_price' => 9,
			'product_purchase_price' => 7,
			'product_discount'	=> 0,
			'product_final_price' => 9,
			'created_by' => $user2->id,
			'updated_by' => $user2->id,
		]);

		$res = $this->delete('/api/products', ['id' => $insert1->id]);
		$res->assertStatus(200)->assertJson(['success' => true]);
	}

	public function test_products_destroy_with_image()
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

		$firstBrand = Brand::create([
			'company_id' => $company->id,
			'brand_code' => 'CC-00002',
			'brand_name' => 'Coca-Cola',
		]);

		$firstCategory = Category::create([
			'company_id' => $company->id,
			'category_code' => '1999',
			'category_name' => 'Beverage',
		]);

		$supplier = Supplier::create([
			'company_id' => $company->id,
			'supplier_code' => '3322',
			'supplier_name' => 'Supplier Name',
			'supplier_contact' => '000-0000-0000',
			'supplier_address' => 'Supplier address street'
		]);

		$insertFile1 = UploadedFile::fake('reportslocal')->image('image1.jpg');
		$this->post('/api/products', [
			'company_id' => $company->id,
			'category_id' => $firstCategory->id,
			'brand_id' => $firstBrand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Zero Sugar',
			'product_image' => $insertFile1,
			'product_code' => 'PC-9993',
			'product_barcode' => '21382838123',
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 0,
			'product_final_price' => 8,
			'created_by' => $user->id,
			'updated_by' => $user->id,
		]);

		$prod = Products::where('company_id', $company->id)->first();
		$res = $this->delete('/api/products', ['id' => $prod->id]);
		$res->assertStatus(200)->assertJson(['success' => true]);
	}

	public function test_products_bulk_destroy_with_image()
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

		$company2 = Company::create([
			'company_name' => 'Company Name 2',
			'company_phone' => '000-0000-0002',
			'company_address' => 'Company Address Street 2'
		]);
		$user2 = User::factory()->create();
		$user2->company_id = $company2->id;
		$user2->save();

		$firstBrand = Brand::create([
			'company_id' => $company->id,
			'brand_code' => 'CC-00002',
			'brand_name' => 'Coca-Cola',
		]);
		$secondBrand = Brand::create([
			'company_id' => $company->id,
			'brand_code' => 'CC-00002',
			'brand_name' => 'Sprite',
		]);
		$firstBrand2 = Brand::create([
			'company_id' => $company2->id,
			'brand_code' => 'F-00003',
			'brand_name' => 'Fanta',
		]);

		$firstCategory = Category::create([
			'company_id' => $company->id,
			'category_code' => '1999',
			'category_name' => 'Beverage',
		]);
		$secondCategory = Category::create([
			'company_id' => $company->id,
			'category_code' => '1998',
			'category_name' => 'Food',
		]);
		$firstCategory2 = Category::create([
			'company_id' => $company2->id,
			'category_code' => '1998',
			'category_name' => 'Grocerry',
		]);

		$supplier = Supplier::create([
			'company_id' => $company->id,
			'supplier_code' => '3322',
			'supplier_name' => 'Supplier Name',
			'supplier_contact' => '000-0000-0000',
			'supplier_address' => 'Supplier address street'
		]);
		$supplier2 = Supplier::create([
			'company_id' => $company2->id,
			'supplier_code' => '5322',
			'supplier_name' => 'Supplier Name 2',
			'supplier_contact' => '000-0000-0000',
			'supplier_address' => 'Supplier address street'
		]);

		$fileInsert1 = UploadedFile::fake()->image('product1.jpg');
		$insert1 = $this->post('/api/products', [
			'company_id' => $company->id,
			'category_id' => $firstCategory->id,
			'brand_id' => $firstBrand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Zero Sugar',
			'product_image' => $fileInsert1,
			'product_code' => 'PC-9993',
			'product_barcode' => '21382838123',
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 0,
			'product_final_price' => 8,
		]);
		$fileInsert2 = UploadedFile::fake()->image('product2.jpg');
		$insert2 = $this->post('/api/products', [
			'company_id' => $company->id,
			'category_id' => $firstCategory->id,
			'brand_id' => $firstBrand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Red',
			'product_image' => $fileInsert2,
			'product_code' => 'PC-9994',
			'product_barcode' => '21382551283',
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 0,
			'product_final_price' => 8,
		]);
		$fileInsert3 = UploadedFile::fake()->image('product3.jpg');
		$insert3 = $this->post('/api/products', [
			'company_id' => $company->id,
			'category_id' => $secondCategory->id,
			'brand_id' => $secondBrand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Sprite Water Lemon',
			'product_image' => $fileInsert3,
			'product_code' => 'PC-9995',
			'product_barcode' => '202828381233',
			'product_selling_price' => 9,
			'product_purchase_price' => 7,
			'product_discount'	=> 0,
			'product_final_price' => 8,
		]);
		$insertDiffrentCompany = $this->post('/api/products', [
			'company_id' => $company2->id,
			'category_id' => $firstCategory2->id,
			'brand_id' => $firstBrand2->id,
			'supplier_id' => $supplier2->id,
			'product_unit' => 'pcs',
			'product_name' => 'Fanta Strawberry',
			'product_image' => null,
			'product_code' => 'PC-9922',
			'product_barcode' => '2138381233',
			'product_selling_price' => 9,
			'product_purchase_price' => 7,
			'product_discount'	=> 0,
			'product_final_price' => 9,
		]);

		$products = Products::query()->where('company_id', $company->id)->get();

		$res = $this->delete('/api/products-bulk-delete', ['id' => [$products[0]->id, $products[0]->id, $products[0]->id]]);

		$res->assertStatus(200)->assertJson(['success' => true]);
	}

	public function test_products_bulk_destroy()
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

		$company2 = Company::create([
			'company_name' => 'Company Name 2',
			'company_phone' => '000-0000-0002',
			'company_address' => 'Company Address Street 2'
		]);
		$user2 = User::factory()->create();
		$user2->company_id = $company2->id;
		$user2->save();

		$firstBrand = Brand::create([
			'company_id' => $company->id,
			'brand_code' => 'CC-00002',
			'brand_name' => 'Coca-Cola',
		]);
		$secondBrand = Brand::create([
			'company_id' => $company->id,
			'brand_code' => 'CC-00002',
			'brand_name' => 'Sprite',
		]);
		$firstBrand2 = Brand::create([
			'company_id' => $company2->id,
			'brand_code' => 'F-00003',
			'brand_name' => 'Fanta',
		]);

		$firstCategory = Category::create([
			'company_id' => $company->id,
			'category_code' => '1999',
			'category_name' => 'Beverage',
		]);
		$secondCategory = Category::create([
			'company_id' => $company->id,
			'category_code' => '1998',
			'category_name' => 'Food',
		]);
		$firstCategory2 = Category::create([
			'company_id' => $company2->id,
			'category_code' => '1998',
			'category_name' => 'Grocerry',
		]);

		$supplier = Supplier::create([
			'company_id' => $company->id,
			'supplier_code' => '3322',
			'supplier_name' => 'Supplier Name',
			'supplier_contact' => '000-0000-0000',
			'supplier_address' => 'Supplier address street'
		]);
		$supplier2 = Supplier::create([
			'company_id' => $company2->id,
			'supplier_code' => '5322',
			'supplier_name' => 'Supplier Name 2',
			'supplier_contact' => '000-0000-0000',
			'supplier_address' => 'Supplier address street'
		]);

		$insert1 = Products::create([
			'company_id' => $company->id,
			'category_id' => $firstCategory->id,
			'brand_id' => $firstBrand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Zero Sugar',
			'product_code' => 'PC-9993',
			'product_barcode' => '21382838123',
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 0,
			'product_final_price' => 8,
			'created_by' => $user->id,
			'updated_by' => $user->id,
		]);
		$insert2 = Products::create([
			'company_id' => $company->id,
			'category_id' => $firstCategory->id,
			'brand_id' => $firstBrand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Coca Cola Red',
			'product_code' => 'PC-9994',
			'product_barcode' => '21382551283',
			'product_selling_price' => 8,
			'product_purchase_price' => 6.5,
			'product_discount'	=> 0,
			'product_final_price' => 8,
			'created_by' => $user->id,
			'updated_by' => $user->id,
		]);
		$insert3 = Products::create([
			'company_id' => $company->id,
			'category_id' => $secondCategory->id,
			'brand_id' => $secondBrand->id,
			'supplier_id' => $supplier->id,
			'product_unit' => 'pcs',
			'product_name' => 'Sprite Water Lemon',
			'product_code' => 'PC-9995',
			'product_barcode' => '202828381233',
			'product_selling_price' => 9,
			'product_purchase_price' => 7,
			'product_discount'	=> 0,
			'product_final_price' => 8,
			'created_by' => $user->id,
			'updated_by' => $user->id,
		]);
		$insertDiffrentCompany = Products::create([
			'company_id' => $company2->id,
			'category_id' => $firstCategory2->id,
			'brand_id' => $firstBrand2->id,
			'supplier_id' => $supplier2->id,
			'product_unit' => 'pcs',
			'product_name' => 'Fanta Strawberry',
			'product_code' => 'PC-9922',
			'product_barcode' => '2138381233',
			'product_selling_price' => 9,
			'product_purchase_price' => 7,
			'product_discount'	=> 0,
			'product_final_price' => 9,
			'created_by' => $user2->id,
			'updated_by' => $user2->id,
		]);

		$res = $this->delete('/api/products-bulk-delete', ['id' => [$insert1->id, $insert2->id, $insert3->id]]);
		$res->assertStatus(200)->assertJson(['success' => true]);
	}
}
