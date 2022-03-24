<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	use HasFactory;

	protected $table = 'category';
	protected $primaryKey = 'id';
	protected $guarded = [];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function products()
	{
		return $this->belongsTo(Products::class);
	}

	public function brand()
	{
		return $this->belongsTo(Brand::class);
	}
}
