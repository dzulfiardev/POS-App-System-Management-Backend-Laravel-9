<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
	use HasFactory;

	protected $table = 'brand';
	protected $primaryKey = 'id';
	// protected $guarded = [];
	protected $fillable = [
		'company_id',
		'brand_code',
		'brand_name',
		'created_at',
		'updated_at',
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function product()
	{
		return $this->hasMany(Product::class);
	}
}
