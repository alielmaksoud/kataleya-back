<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['id' =>1, 'status' => 'Pending' ],
            ['id' =>2, 'status' => 'Delivering' ],
            ['id' => 3, 'status' => 'Delivered'],
            ['id' => 4, 'status' => 'cancelled'],
        ];

        foreach ($statuses as $status) {
            Status::create($status);
        }
    }
}