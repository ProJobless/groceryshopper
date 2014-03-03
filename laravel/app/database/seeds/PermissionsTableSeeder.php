<?php

class PermissionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('permissions')->delete();


        $permissions = array(
            array(
                'name'      => 'manage_blogs',
                'display_name'      => 'manage blogs'
            ),
            array(
                'name'      => 'manage_posts',
                'display_name'      => 'manage posts'
            ),
            array(
                'name'      => 'manage_comments',
                'display_name'      => 'manage comments'
            ),
            array(
                'name'      => 'manage_users',
                'display_name'      => 'manage users'
            ),
            array(
                'name'      => 'manage_roles',
                'display_name'      => 'manage roles'
            ),
            array(
                'name'      => 'manage_stores',
                'display_name'      => 'manage stores'
            ),
            array(
                'name'      => 'post_comment',
                'display_name'      => 'post comment'
            ),
        );

        DB::table('permissions')->insert( $permissions );

        DB::table('permission_role')->delete();

        $role = Role::where('name', '=', 'admin')->first();
        foreach ($permissions as $key => $permission) {
            $permission = Permission::where('name', '=', $permission['name'])->first();
            $role->attachPermission($permission);
                
        }

        //DB::table('permission_role')->insert( $permissions );
    }

}
