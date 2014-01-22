<?php

class DatabaseSeeder extends Seeder {

    public function run()
    {
        Eloquent::unguard();

        // Add calls to Seeders here
        $this->call('UsersTableSeeder');
        //$this->call('PostsTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('PermissionsTableSeeder');
        $this->call('StoresTableSeeder');
		    $this->call('GroceryitemsTableSeeder');
        $this->call('ProductsTableSeeder');
        $this->call('CategoriesTableSeeder');
        //$this->call('TagsTableSeeder');
		    $this->call('UnitsTableSeeder');
	}

}
