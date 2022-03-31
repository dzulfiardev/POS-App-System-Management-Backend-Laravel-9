<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
	use HasFactory;

	protected $table = 'products';
	protected $primaryKey = 'id';
	protected $guarded = [];


	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function createdBy()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

	public function updatedBy()
	{
		return $this->belongsTo(User::class, 'updated_by');
	}

	public function category()
	{
		return $this->hasMany(Category::class);
	}

	public function brand()
	{
		return $this->belongsTo(Brand::class);
	}
}
