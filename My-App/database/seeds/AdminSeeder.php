<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('admins')->get()->count()==0) {
            DB::table('admins')->insert([
                'created_at'=>now(),
                'updated_at'=>now(),
                'name'=>'Mohammad Hassan',
                'email'=>'kataleya.parfum@gmail.com',
                'phone'=>'70123123',
                'password'=>bcrypt('admin123123'),
            ]);
        }
    }
}

