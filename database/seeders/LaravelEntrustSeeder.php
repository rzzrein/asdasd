<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleUser;

class LaravelEntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        $config = config('entrust_seeder.role_structure');
        $mapPermission = collect(config('entrust_seeder.permissions_map'));

        foreach ($config as $key => $modules) {
            $role = Role::firstOrCreate([
                'name'         => $key,
                'display_name' => ucwords(str_replace('_', ' ', $key)),
                'description'  => ucwords(str_replace('_', ' ', $key))
            ]);
            $permissions = [];

            $this->command->info('Creating Role '. strtoupper($key));

            foreach ($modules as $module => $value) {

                foreach (explode(',', $value) as $p => $perm) {

                    $permissionValue = (string)$mapPermission->get($perm);

                    $permissions[] = Permission::firstOrCreate([
                        'name'         => $module.'-'.$permissionValue,
                        'display_name' => ucwords(str_replace('-', ' ', $module)).' '.ucfirst($permissionValue),
                    ])->id;

                    $this->command->info('Creating Permission to '.$permissionValue.' for '. $module);
                }
            }

            $role->permissions()->sync($permissions);
        }

        RoleUser::create([
            "role_id" => 1,
            "user_id" => 1
        ]);
    }

    /**
     * Truncates all the entrust tables and the users table
     *
     * @return    void
     */
    public function truncateEntrustTables()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('permission_role')->truncate();

        Role::truncate();
        Permission::truncate();

        Schema::enableForeignKeyConstraints();
    }
}
