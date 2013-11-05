<?php

class Store_addressesTableSeeder extends Seeder {

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('store_addresses')->truncate();

        $store_addresses = array(
            array(
                'store_id'    => "1",
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
                'store_id'    => "2",
               'line_1'      => '2137 Blvd Labelle',
                'line_2'       => '',
                'city'    => 'Laval',
                'province_state' => 'QC',
                'country' => 'Canada',
                'postal_zip' => '',
                'latitude' => '45.557019',
                'longitude' => '-73.766682',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'store_id'    => '3',
               'line_1'      => '3801 Boul. St-Charles',
                'line_2'       => '',
                'city'    => 'Kirkland',
                'province_state' => 'QC',
                'country' => 'Canada',
                'postal_zip' => 'H9W 2X3',
                'latitude' => '45.461307',
                'longitude' => '-73.866279',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),

        );

        // Uncomment the below to run the seeder
        DB::table('store_addresses')->insert($store_addresses);
    }

}
