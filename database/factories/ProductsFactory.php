<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsFactory extends Factory
{
	/**
	 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
	 */
	public function definition()
	{
		/**
		 * Define the model's default state.
		 *
		 * @return array<string, mixed>
		 */
		$sellingPrice = $this->faker->numberBetween(1, 50);
		return [
			'company_id' => $this->faker->numberBetween(1, 5),
			'product_name' => $this->faker->words(2),
			'product_code' => 'PC-' . $this->faker->unique()->numberBetween(1000, 3000),
			'product_barcode' => $this->faker->ean13(),
			'product_selling_price' => $sellingPrice,
			'product_purchase_price' => ($sellingPrice + 5),
			'product_discount_price' => 0,
			'product_final_price' => ($sellingPrice + 5),
			'product_stock' => $this->faker->numberBetween(100, 200),
		];
	}
}
