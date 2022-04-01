<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
	use HasApiTokens, HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'company_id',
		'name',
		'username',
		'email',
		'avatar',
		'password',
		'active',
		'is_admin',
		'is_root',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
		'is_admin'          => 'boolean',
	];

	public function isAdmin(): bool
	{
		return $this->is_admin;
	}

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function isRoot()
	{
		return $this->is_root;
	}

	public function product()
	{
		return $this->hasMany(Product::class);
	}
}
