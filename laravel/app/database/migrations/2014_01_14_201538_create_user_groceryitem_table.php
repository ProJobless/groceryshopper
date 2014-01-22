<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGroceryitemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shoppinglists', function(Blueprint $table)
		{
			$table->timestamps();
			$table->increments('id');
			$table->integer('groceryitem_id')->unsigned()->index();
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('groceryitem_id')->references('id')->on('groceryitems')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shoppinglists');
	}

}
