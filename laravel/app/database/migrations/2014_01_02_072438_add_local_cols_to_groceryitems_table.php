<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddLocalColsToGroceryitemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('groceryitems', function(Blueprint $table) {
		    $table->text('brand')->nullable();
		    $table->text('product_name')->nullable();
		    $table->string('size')->nullable();
		    $table->string('upc')->nullable();
		    $table->text('manufacturer')->nullable();
		    $table->integer('unit_id')->unsigned()->index();
		    $table->foreign('unit_id')->references('id')->on('units');
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('groceryitems', function(Blueprint $table) {
			
		});
	}

}
