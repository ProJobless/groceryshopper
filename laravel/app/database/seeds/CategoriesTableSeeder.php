<?php

class CategoriesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		//DB::table('categories')->truncate();

		$categories = array(
         array(
             'title'      => 'Lorem ipsum dolor sit amet',
             'slug'       => 'lorem-ipsum-dolor-sit-amet',
             'meta_title'    => 'Lorem',
             'rank' => 1,
             'updated_at' => new DateTime,
          ),

		);

		// Uncomment the below to run the seeder
		DB::table('categories')->insert($categories);
	}

}
