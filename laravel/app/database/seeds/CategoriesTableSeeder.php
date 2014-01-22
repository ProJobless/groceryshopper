<?php

class CategoriesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		//DB::table('categories')->truncate();
    $user_id = User::first()->id;

		$categories = array(
         array(
             'title'      => 'Lorem ipsum dolor sit amet',
             'slug'       => 'lorem-ipsum-dolor-sit-amet',
             'meta title'    => 'Lorem',
             'rank' => 1,
             'updated_at' => new DateTime,
          ),

		);

		// Uncomment the below to run the seeder
		//DB::table('categories')->insert($categories);
	}

}
