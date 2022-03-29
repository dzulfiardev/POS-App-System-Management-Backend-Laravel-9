<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
	use HasFactory;

	protected $table = 'brand';
	protected $primaryKey = 'id';
	protected $guarded = [];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function product()
	{
		return $this->hasMany(Product::class);
	}
}
