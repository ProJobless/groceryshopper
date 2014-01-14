<?php

class DatabaseSeeder extends Seeder {

    public function run()
    {
        Eloquent::unguard();

        // Add calls to Seeders here
        $this->call('UsersTableSeeder');
        $this->call('PostsTableSeeder');
        $this->call('CommentsTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('PermissionsTableSeeder');
        $this->call('StoresTableSeeder');
        $this->call('ProductsTableSeeder');
        $this->call('Store_addressesTableSeeder');
        $this->call('CategoriesTableSeeder');
        $this->call('TagsTableSeeder');
        $this->call('Store_brandsTableSeeder');
        $this->call('TweetsTableSeeder');
		$this->call('GroceryitemsTableSeeder');
		$this->call('UnitsTableSeeder');
	}

}
