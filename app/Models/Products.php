<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
	use HasFactory;

	protected $table = 'product';
	protected $primaryKey = 'id';
	protected $guarded = [];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function category()
	{
		return $this->hasMany(Category::class);
	}

	public function brand()
	{
		return $this->hasMany(Brand::class);
	}
}
