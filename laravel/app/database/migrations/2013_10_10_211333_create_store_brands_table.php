<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoreBrandsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('store_brands', function(Blueprint $table) {

            $table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('title')->nullable();
			$table->text('url');
			$table->text('notes');
			$table->string('meta_title');
			$table->string('meta_description');
			$table->string('meta_keywords');
			$table->string('slug');
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
		Schema::drop('store_brands');
	}

}
