<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFactualColsToGroceryitemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('groceryitems', function(Blueprint $table) {
		    $table->string('factual_id');
		    $table->text('factual_url');
		    $table->text('factual_image_urls')->nullable();
		    $table->text('factual_brand')->nullable();
		    $table->text('factual_product_name')->nullable();
		    $table->string('factual_size')->nullable();
		    $table->string('factual_upc')->nullable();
		    $table->string('factual_ean13')->nullable();
		    $table->string('factual_category')->nullable();
		    $table->text('factual_manufacturer')->nullable();
		    $table->decimal('factual_avg_price')->nullable();
		    
		    // Ingredients
		    $table->text('factual_ingredients')->nullable();
		    $table->string('factual_serving_size')->nullable();
		    $table->decimal('factual_servings')->nullable();
		    $table->decimal('factual_calories')->nullable();
		    $table->decimal('factual_fat_calories')->nullable();
		    $table->decimal('factual_total_fat')->nullable();
		    $table->decimal('factual_sat_fat')->nullable();
		    $table->decimal('factual_trans_fat')->nullable();
		    $table->decimal('factual_cholesterol')->nullable();
		    $table->decimal('factual_sodium')->nullable();
		    $table->decimal('factual_potassium')->nullable();
		    $table->decimal('factual_total_carb')->nullable();
		    $table->decimal('factual_dietary_fiber')->nullable();
		    $table->decimal('factual_sugars')->nullable();
		    $table->decimal('factual_protein')->nullable();
		    $table->string('factual_upc_e')->nullable();
			
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
