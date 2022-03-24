<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	use HasFactory;

	protected $table = 'company';
	protected $primaryKey = 'id';
	protected $fillable = [
		'company_name',
		'company_img',
		'company_phone',
		'company_address',
		'company_description',
	];

	public function user()
	{
		return $this->hasOne(User::class);
	}

	public function products()
	{
		return $this->hasMany(Products::class);
	}

	public function brand()
	{
		return $this->hasMany(Brand::class);
	}

	public function category()
	{
		return $this->hasMany(Category::class);
	}
}
