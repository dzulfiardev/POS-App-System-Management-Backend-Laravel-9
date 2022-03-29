<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category', function (Blueprint $table) {
			$table->id();
			$table->foreignId('company_id')->nullable()->constrained('company')->onUpdate('cascade')->onDelete('cascade');
			$table->string('category_code');
			$table->string('category_name');
			$table->timestamps();
		});

		Schema::create('brand', function (Blueprint $table) {
			$table->id();
			$table->foreignId('company_id')->nullable()->constrained('company')->onUpdate('cascade')->onDelete('cascade');
			$table->string('brand_code');
			$table->string('brand_name');
			$table->timestamps();
		});

		Schema::create('unit', function (Blueprint $table) {
			$table->id();
			$table->foreignId('compay_id')->nullable()->constarined('company')->onUpdate('cascade')->onDelete('cascade');
			$table->string('unit_name');
			$table->timestamps();
		});

		Schema::create('product', function (Blueprint $table) {
			$table->id();
			$table->foreignId('company_id')->nullable()->constrained('company')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('category_id')->nullable()->constrained('category');
			$table->foreignId('unit_id')->nullable()->constrained('unit');
			$table->foreignId('brand_id')->nullable()->constrained('brand');
			$table->string('product_name');
			$table->string('product_code');
			$table->string('product_barcode');
			$table->double('product_selling_price');
			$table->double('product_purchase_price');
			$table->integer('product_discount_price');
			$table->double('product_final_price');
			$table->integer('product_stock');
			$table->integer('created_by')->nullable()->constrained('user');
			$table->integer('updated_by')->nullable()->constrained('user');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExist('category');
		Schema::dropIfExist('brand');
		Schema::dropIfExist('unit');
		Schema::dropIfExist('product');
	}
};
