<?php

class StoresTableSeeder extends Seeder {

  public function run()
  {
    // Uncomment the below to wipe the table clean before populating
    DB::table('stores')->truncate();

    $stores = array(
            array(
                'slug'    => "maxi-and-cie",
                'title'      => 'Lorem ipsum dolor sit amet',
                'phone_1'       => '514-890-0989',
                'phone_2'    => '514-900-7868',
                'fax' => NULL,
                'url' => 'http://www.maxincie.com',
                'notes' => 'Provigo company',
                'searchable' => TRUE,
                'line_1'      => '325 boulevard St-Jean',
                'line_2'       => '514-697-6520',
                'city'    => 'Pointe-Claire',
                'province_state' => 'QC',
                'country' => 'Canada',
                'postal_zip' => 'H9R 3J1',
                'latitude' => '45.445003',
                'longitude' => '-73.815193',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'slug'    => "provigo",
                'title'      => 'Provigo Pierrefonds',
                'phone_1'       => '514-890-0989',
                'phone_2'    => '514-900-7868',
                'fax' => NULL,
                'url' => 'http://www.provigo.com',
                'notes' => 'Provigo company',
               'line_1'      => '2137 Blvd Labelle',
                'line_2'       => '',
                'city'    => 'Laval',
                'province_state' => 'QC',
                'country' => 'Canada',
                'postal_zip' => '',
                'latitude' => '45.557019',
                'longitude' => '-73.766682',
                'searchable' => FALSE,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'slug'    => "metro-westisland",
                'title'      => 'Metro WestIsland',
                'phone_1'       => '514-890-0989',
                'phone_2'    => '514-900-7868',
                'fax' => NULL,
                'url' => 'http://www.metro.com',
                'notes' => 'Metro',
                'line_1'      => '3801 Boul. St-Charles',
                'line_2'       => '',
                'city'    => 'Kirkland',
                'province_state' => 'QC',
                'country' => 'Canada',
                'postal_zip' => 'H9W 2X3',
                'latitude' => '45.461307',
                'longitude' => '-73.866279',
                'searchable' => FALSE,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            )
      );

    // Uncomment the below to run the seeder
    //DB::table('stores')->insert($stores);
  }

}
