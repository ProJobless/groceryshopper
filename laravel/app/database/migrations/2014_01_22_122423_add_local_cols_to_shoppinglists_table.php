<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddLocalColsToShoppinglistsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('shoppinglists', function(Blueprint $table) {
		    $table->integer('quantity')->default('1');
			  $table->integer('store_id')->unsigned()->index();
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
		Schema::table('shoppinglists', function(Blueprint $table) {
		});
	}

}
