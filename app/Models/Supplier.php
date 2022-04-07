<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
	use HasFactory;

	protected $table = 'supplier';
	protected $primaryKey = 'id';
	protected $guarded = [];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function products()
	{
		return $this->hasMany(Products::class);
	}
}
