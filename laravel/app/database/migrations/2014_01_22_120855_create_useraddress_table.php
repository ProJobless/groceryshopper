<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUseraddressTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('useraddresses', function(Blueprint $table) {
      $table->engine = 'InnoDB';
			$table->increments('id');
      $table->string('line_1')->nullable();
      $table->string('line_2')->nullable();
      $table->string('city');
      $table->string('province_state');
      $table->string('country');
      $table->string('postal_zip')->nullable();
      $table->decimal('latitude', 10, 8)->nullable();
      $table->decimal('longitude', 10, 8)->nullable();
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
		Schema::drop('useraddresses');
	}

}
