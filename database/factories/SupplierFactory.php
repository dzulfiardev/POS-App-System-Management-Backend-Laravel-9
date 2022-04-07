<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
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
			'supplier_name' => $this->faker->company(),
			'supplier_code' => $this->faker->numberBetween(1000, 1999),
			'supplier_contact' => $this->faker->phoneNumber(),
			'supplier_address' => $this->faker->address(),
		];
	}
}
