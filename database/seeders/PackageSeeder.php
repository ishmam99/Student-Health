<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Package::create([
            'name'                    => 'Regular Package',
            'cost'                    => 2500,
            'minimum_withdraw_amount' => 500,
            'tasks' => 50,
            'ads_period_1_price' => 0.5,
            'ads_period_2_price' => 1,
            'ads_period_3_price' => 0.5,
            'ads_period_4_price' => 0.45
        ]);
        Package::create([
            'name'                    => 'Bronze package',
            'cost'                    => 4500,
            'minimum_withdraw_amount' => 500,
            'tasks' => 60,
            'ads_period_1_price' => 0.7,
            'ads_period_2_price' => 1.2,
            'ads_period_3_price' => 0.6,
            'ads_period_4_price' => 0.5
        ]);
        Package::create([
            'name'                    => 'Silver package',
            'cost'                    => 7500,
            'minimum_withdraw_amount' => 1500,
            'tasks' => 70,
            'ads_period_1_price' => 1,
            'ads_period_2_price' => 1.3,
            'ads_period_3_price' => 1,
            'ads_period_4_price' => 0.9
        ]);
        Package::create([
            'name'                    => 'Gold Package',
            'cost'                    => 9500,
            'minimum_withdraw_amount' => 2500,
            'tasks' => 80,
            'ads_period_1_price' => 1.2,
            'ads_period_2_price' => 1.7,
            'ads_period_3_price' => 1,
            'ads_period_4_price' => 0.9
        ]);
        Package::create([
            'name'                    => 'Platinum Package',
            'cost'                    => 13000,
            'minimum_withdraw_amount' => 5000,
            'tasks' => 90,
            'ads_period_1_price' => 1.5,
            'ads_period_2_price' => 2,
            'ads_period_3_price' => 1.3,
            'ads_period_4_price' => 1.1
        ]);
        Package::create([
            'name'                    => 'Titanium Package',
            'cost'                    => 17500,
            'minimum_withdraw_amount' => 8000,
            'tasks' => 100,
            'ads_period_1_price' => 1.8,
            'ads_period_2_price' => 2.8,
            'ads_period_3_price' => 1.3,
            'ads_period_4_price' => 1.1
        ]);
    }
}
