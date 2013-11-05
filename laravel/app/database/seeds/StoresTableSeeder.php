<?php

class StoresTableSeeder extends Seeder {

  public function run()
  {
    // Uncomment the below to wipe the table clean before populating
    DB::table('stores')->truncate();

    $stores = array(
            array(
                'name'    => "Maxi & Cie",
                'title'      => 'Lorem ipsum dolor sit amet',
                'phone_1'       => '514-890-0989',
                'phone_2'    => '514-900-7868',
                'fax' => NULL,
                'url' => 'http://www.maxincie.com',
                'notes' => 'Provigo company',
                'searchable' => TRUE,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'    => "Provigo",
                'title'      => 'Provigo Pierrefonds',
                'phone_1'       => '514-890-0989',
                'phone_2'    => '514-900-7868',
                'fax' => NULL,
                'url' => 'http://www.provigo.com',
                'notes' => 'Provigo company',
                'searchable' => TRUE,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'    => "Metro",
                'title'      => 'Metro WestIsland',
                'phone_1'       => '514-890-0989',
                'phone_2'    => '514-900-7868',
                'fax' => NULL,
                'url' => 'http://www.metro.com',
                'notes' => 'Metro',
                'searchable' => FALSE,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            )
      );

    // Uncomment the below to run the seeder
    DB::table('stores')->insert($stores);
  }

}
