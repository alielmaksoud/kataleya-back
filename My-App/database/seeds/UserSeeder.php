<?php

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
        if (DB::table('users')->get()->count()==0) {
            DB::table('users')->insert([
                'created_at'=>now(),
                'updated_at'=>now(),
                'email_verified_at'=>now(),
                'name'=>'khalil',
                'email'=>'khalil@gmail.com',
                'password'=>bcrypt('khalil123'),
            ]);
        }
    }
}