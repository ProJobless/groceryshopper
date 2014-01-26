<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddChainIdColumnToStoresTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('stores', function(Blueprint $table) {
		    $table->integer('chain_id')->unsigned()->index();
		    $table->foreign('chain_id')->references('id')->on('chains');
      
    });
  }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('stores', function(Blueprint $table) {
			
		});
	}

}
