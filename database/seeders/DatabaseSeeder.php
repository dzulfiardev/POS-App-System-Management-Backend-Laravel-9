<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Products;
use App\Models\Brand;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\User;
use Faker;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		Company::factory(5)->has(User::factory(5)->count(1))->has(Brand::factory(5)->count(10))->has(Category::factory(5)->count(10))->has(Supplier::factory(3)->count(10))->create();

		$faker = Faker\Factory::create();
		for ($i = 0; 100 > $i; $i++) {
			Products::create([
				'company_id' => 1,
				'category_id' => 1,
				'brand_id' => 1,
				'supplier_id' => 1,
				'product_unit' => 'pcs',
				'product_name' => $faker->word() . ' ' . $faker->word(),
				'product_code' => $faker->numberBetween(1000, 2000),
				'product_barcode' => $faker->ean8,
				'product_selling_price' => 9,
				'product_purchase_price' => 7,
				'product_discount'	=> 0,
				'product_final_price' => 9,
				'created_by' => 1,
				'updated_by' => 1,
			]);
		}
	}
}
