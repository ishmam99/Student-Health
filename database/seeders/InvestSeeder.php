<?php

namespace Database\Seeders;

use App\Models\Invest;
use Illuminate\Database\Seeder;

class InvestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Invest::create([
            'name'                    => 'BASIC',
            'money_return'            => 3,
            'accrual_days'            => 35,
            'amount'                  => 4000,
        ]);
        Invest::create([
            'name'                    => 'STANDARD',
            'money_return'            => 5,
            'accrual_days'            => 35,
            'amount'                  => 9500,
        ]);
        Invest::create([
            'name'                    => 'PROFESSIONAL',
            'money_return'            => 8,
            'accrual_days'            => 65,
            'amount'                  => 15000,
        ]);
        Invest::create([
            'name'                    => 'BUSINESS',
            'money_return'            => 10,
            'accrual_days'            => 65,
            'amount'                  => 22000,

        ]);
        Invest::create([
            'name'                    => 'ELITE',
            'money_return'            => 15,
            'accrual_days'            => 95,
            'amount'                  => 30000,
        ]);
    }
}
