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
		Schema::create('company', function (BluePrint $table) {
			$table->id();
			$table->string('company_name');
			$table->string('company_img')->nullable();
			$table->string('company_phone')->nullable();
			$table->text('company_address')->nullable();
			$table->text('company_description')->nullable();
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
		Schema::dropIfExists('company');
	}
};
