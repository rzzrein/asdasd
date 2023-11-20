<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrUser = [
            ['super','Super', 'Test','test@test.test'],
        ];
        foreach ($arrUser as $user) {
            User::create([
                'full_name' => $user[1] .' '. $user[2],
                'email' => $user[3],
                'email_verified_at' => time(),
                'password' => bcrypt('Test12345!'),
            ]); 
        }
    }
}
