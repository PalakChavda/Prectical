<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'App',
            'email' => 'admin@gmail.com',
            'dob' => Carbon::now(),
            'password' => Hash::make('123456789'),
            'phone' => '1234567890',
            'create_by' => '1',
            'status' => '1',
            'deleted_at' => null
        ]);
        DB::table('users')->insert([
            'first_name' => 'Palak',
            'last_name' => 'Chavda',
            'email' => 'palakchavda498@gmail.com',
            'dob' => Carbon::now(),
            'password' => Hash::make('123456789'),
            'phone' => '1234567891',
            'create_by' => '1',
            'status' => '1',
            'deleted_at' => null
        ]);
        
   
    }
}
