<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Seller;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::where('email', 'dio+99@softwareseni.com')->forceDelete();
        Seller::truncate();
        $user = User::create([
            'nick_name'         => 'Dealer',
            'full_name'         => 'Dealer SK',
            'email'             => 'dio+99@softwareseni.com',
            'email_verified_at' => time(),
            'type'              => 'customer',
            'password'          => bcrypt('dummy123'),
        ]);
        $user->attachRole(3);
        $seller = $user->seller_owner()->create([
            'name' => 'Dealer SK',
            'code' => 'OTO',
            'type' => 'dealer'
        ]);
        $user->seller_id = $seller->id;
        $user->save();
    }
}
