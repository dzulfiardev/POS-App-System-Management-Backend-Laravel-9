<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Products;
use App\Models\Brand;
use App\Models\Category;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		// User::factory(5)->has(Company::factory()->count(5))->create();
		Company::factory(5)->has(User::factory(5)->count(1))->has(Brand::factory(5)->count(10))->has(Category::factory(5)->count(10))->create();
		// Products::factory(200)->create();
	}
}
