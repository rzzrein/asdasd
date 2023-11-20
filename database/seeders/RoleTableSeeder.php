<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::beginTransaction();
        $super_admin = new Role();
        $super_admin->name         = 'super';
        $super_admin->display_name = 'Super'; // optional
        $super_admin->description  = 'Highest Level'; // optional
        $super_admin->save();
        
        $admin = new Role();
        $admin->name         = 'admin';
        $admin->display_name = 'admin'; // optional
        $admin->description  = 'Second level'; // optional
        $admin->save();    

        /**Attach for user super */
        $user = User::whereEmail('super@seni.cloud')->first();
        if ($user) {
            $user->attachRole($super_admin);         
        }
        
        /**Attach for user admin */
        $user = User::whereEmail('admin@seni.cloud')->first();
        if ($user) {
            $user->attachRole($admin);         
        }

        $page = ['admin-page' => 'Admin Page', 'admin-user' => 'Admin User', 'admin-permission-role' => 'Admin Permission Role', 'admin-role' => 'Admin Role', 'admin-permission' => 'Admin Permission', 'admin-seeder' => 'Admin Seeder', 'admin-artisan' => 'Admin Artisan'];
        $superAdminPermissionArray = [];

        foreach ($page as $key => $value) {
            /**Create Permission to INDEX */
            $index = Permission::create(['name' => $key.'-index', 'display_name' => $value.' Index']);

            /**Create Permission to CREATE */
            $create = Permission::create(['name' => $key.'-create', 'display_name' => $value.' Create']);
            
            /**Create Permission to EDIT */
            $edit = Permission::create(['name' => $key.'-edit', 'display_name' => $value.' Edit']);
            
            /**Create Permission to VIEW */
            $show = Permission::create(['name' => $key.'-show', 'display_name' => $value.' Show']);
            
            /**Create Permission to delete */
            $delete = Permission::create(['name' => $key.'-delete', 'display_name' => $value.' Delete']);

            /**Attach Permission to Sysadmin */
            $superAdminPermissionArray[] = $index->id;
            $superAdminPermissionArray[] = $create->id;
            $superAdminPermissionArray[] = $edit->id;
            $superAdminPermissionArray[] = $show->id;
            $superAdminPermissionArray[] = $delete->id;
        }

        $super_admin->permissions()->sync($superAdminPermissionArray);           

        \DB::commit();        
    }
}
