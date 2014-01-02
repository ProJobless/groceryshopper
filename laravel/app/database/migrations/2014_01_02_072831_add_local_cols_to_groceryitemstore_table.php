<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddLocalColsToGroceryitemstoreTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('groceryitem_store', function(Blueprint $table) {
		    $table->decimal('price');
		    $table->integer('quantity')->default('1');
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('groceryitem_store', function(Blueprint $table) {
			
		});
	}

}
