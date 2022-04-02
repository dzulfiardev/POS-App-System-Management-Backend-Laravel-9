<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
	use PasswordValidationRules;

	/**
	 * Validate and create a newly registered user.
	 *
	 * @param  array  $input
	 * @return \App\Models\User
	 */
	public function create(array $input)
	{
		Validator::make($input, [
			'email' => [
				'required', 'string', 'email', 'max:255', Rule::unique(User::class),
			],
			'username' => ['required', 'string', 'max:255', Rule::unique(User::class)],
			'name' => ['required', 'string', 'max:255'],
			'password' => $this->passwordRules(),
		])->validate();

		$company = Company::create([
			'company_name' => 'Company Name',
			'company_phone' =>  '000-0000-0000',
			'company_address' => 'Company Address Street',
			'company_description' => '',
		]);

		return User::create([
			'company_id' => $company->id,
			'name' => $input['name'],
			'username' => $input['username'],
			'email' => $input['email'],
			'password' => Hash::make($input['password']),
			'active' => 1,
			'is_admin' => 1,
			'is_root' => 1,
		]);
	}
}
