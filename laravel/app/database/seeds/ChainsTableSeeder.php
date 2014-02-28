<?php

class ChainsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('chains')->delete();

		$chains = array(
         array(
             'chain_name' => 'Loblaws',
             'url' => 'www.loblaws.ca',
             'alternate_name' => '',
             'created_at' => new DateTime,
             'updated_at' => new DateTime,
          ),
         array(
             'chain_name' => 'Super C',
             'url' => 'www.superc.ca',
             'alternate_name' => '',
             'created_at' => new DateTime,
             'updated_at' => new DateTime,
          ),
         array(
             'chain_name' => 'Farmboy',
             'url' => 'www.farmboy.ca',
             'alternate_name' => '',
             'created_at' => new DateTime,
             'updated_at' => new DateTime,
          ),
         array(
             'chain_name' => 'Walmart',
             'url' => 'www.walmart.ca',
             'alternate_name' => '',
             'created_at' => new DateTime,
             'updated_at' => new DateTime,
          ),
         array(
             'chain_name' => 'Metro',
             'url' => 'www.Metro.ca',
             'alternate_name' => '',
             'created_at' => new DateTime,
             'updated_at' => new DateTime,
          ),
         array(
             'chain_name' => 'Provigo',
             'url' => 'www.Provigo.ca',
             'alternate_name' => '',
             'created_at' => new DateTime,
             'updated_at' => new DateTime,
          ),
         array(
             'chain_name' => 'IGA',
             'url' => 'www.iga.net',
             'alternate_name' => 'IGA Extra',
             'created_at' => new DateTime,
             'updated_at' => new DateTime,
          ),
		);

		// Uncomment the below to run the seeder
		DB::table('chains')->insert($chains);
	}

}
