<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'       => 'admin',
            'uid'        => '1231231231',
            'phone'      => '01123123123',
            'email'      => 'admin@gmail.com',
            'password'   => Hash::make('123123123'),
            'package_id' => 5,
            // 'binance_id' => '22222222',
            'is_admin'   => 1,
            'balance'    => 100000,
        ]);
    }
}
