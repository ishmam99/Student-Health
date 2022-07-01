<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\WithdrawLimit;

class WithdrawLimitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WithdrawLimit::create([
            'amount'                  => 500,
        ]);
        WithdrawLimit::create([
            'amount'                  => 1200,
        ]);
        WithdrawLimit::create([
            'amount'                  => 2500,
        ]);
        WithdrawLimit::create([
            'amount'                  => 5000,
        ]);
        WithdrawLimit::create([
            'amount'                  => 10000,
        ]);
        WithdrawLimit::create([
            'amount'                  => 15000,
        ]);
    }
}
