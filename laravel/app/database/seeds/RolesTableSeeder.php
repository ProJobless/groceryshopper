<?php

class RolesTableSeeder extends Seeder {

    public function run()
    {
		// Uncomment the below to wipe the table clean before populating
		DB::table('roles')->truncate();
        DB::table('roles')->delete();

        $adminRole = new Role;
        $adminRole->name = 'admin';
        $adminRole->save();

        $commentRole = new Role;
        $commentRole->name = 'comment';
        $commentRole->save();

        $user = User::where('username','=','admin')->first();
        $user->attachRole( $adminRole );

        $user = User::where('username','=','user')->first();
        $user->attachRole( $commentRole );
		// Uncomment the below to run the seeder
        //DB::table('roles')->insert($units);*/
    }

}
