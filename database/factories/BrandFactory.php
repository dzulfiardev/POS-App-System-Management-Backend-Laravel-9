<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition()
	{
		return [
			'company_id' => $this->faker->numberBetween(1, 2),
			'brand_code' => $this->faker->numberBetween(1000, 2000),
			'brand_name' => ucwords($this->faker->word()),
		];
	}
}
