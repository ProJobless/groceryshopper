<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddLocalColsToChainsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('chains', function(Blueprint $table) {
		    $table->text('alternate_name')->nullable();
		    $table->string('url')->nullable();
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('chains', function(Blueprint $table) {
			
		});
	}

}
