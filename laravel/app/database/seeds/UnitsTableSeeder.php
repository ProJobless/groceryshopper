<?php

class UnitsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('units')->delete();

		$units = array(
         array(
             'name'      => 'pounds',
             'title'       => 'Pounds',
             'symbol'    => 'lb',
             'created_at' => new DateTime,
             'updated_at' => new DateTime,
          ),
         array(
             'name'      => 'Ounces',
             'title'       => 'ounces',
             'symbol'    => 'oz',
             'created_at' => new DateTime,
             'updated_at' => new DateTime,
          ),
         array(
             'name'      => 'Gallons',
             'title'       => 'Gallons',
             'symbol'    => 'gal',
             'created_at' => new DateTime,
             'updated_at' => new DateTime,
          ),
         array(
             'name'      => 'Quart',
             'title'       => 'Quart',
             'symbol'    => 'qt',
             'created_at' => new DateTime,
             'updated_at' => new DateTime,
          ),
         array(
             'name'      => 'Pint',
             'title'       => 'Pint',
             'symbol'    => 'pt',
             'created_at' => new DateTime,
             'updated_at' => new DateTime,
          ),
         array(
             'name'      => 'Kilograms',
             'title'       => 'Kilograms',
             'symbol'    => 'kg',
             'created_at' => new DateTime,
             'updated_at' => new DateTime,
          ),
         array(
             'name'      => 'Grams',
             'title'       => 'Grams',
             'symbol'    => 'g',
             'created_at' => new DateTime,
             'updated_at' => new DateTime,
          ),
         array(
             'name'      => 'Liters',
             'title'       => 'Liters',
             'symbol'    => 'l',
             'created_at' => new DateTime,
             'updated_at' => new DateTime,
          ),
         array(
             'name'      => 'milliliters',
             'title'       => 'milliliters',
             'symbol'    => 'l',
             'created_at' => new DateTime,
             'updated_at' => new DateTime,
          ),

		);

		// Uncomment the below to run the seeder
		DB::table('units')->insert($units);
	}

}
