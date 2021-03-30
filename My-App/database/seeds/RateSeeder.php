<?php

use Illuminate\Database\Seeder;
use App\UsdRate;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rates = [
            ['id' =>1, 'rate' => '1500' ],
           
        ];

        foreach ($rates as $rate) {
            UsdRate::create($rate);
        }
    }
}