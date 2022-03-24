<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition()
	{
		return [
			'company_name' => 'Company Name',
			'company_phone' => $this->faker->phoneNumber(),
			'company_address' => $this->faker->address(),
			'company_description' => $this->faker->paragraph(1),
		];
	}
}
