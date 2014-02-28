<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotGroceryitemStoreTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('groceryitem_store', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('groceryitem_id')->unsigned()->index();
			$table->integer('store_id')->unsigned()->index();
			$table->foreign('groceryitem_id')->references('id')->on('groceryitems')->onDelete('cascade');
			$table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
		});
	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('groceryitem_store');
	}

}
