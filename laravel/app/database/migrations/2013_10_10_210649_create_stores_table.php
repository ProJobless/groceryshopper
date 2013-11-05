<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoresTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', '255');
            $table->string('title', '40')->nullable()->default(NULL);
            $table->string('phone_1', '40')->nullable();
            $table->string('phone_2', '40')->nullable();
            $table->string('fax', 40)->nullable();
            $table->text('url')->nullable();
            $table->text('notes')->nullable;
            $table->boolean('searchable')->default();
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
        Schema::drop('stores');
    }

}
