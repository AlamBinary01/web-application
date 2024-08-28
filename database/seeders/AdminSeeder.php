<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Admin User',
            'email' => 'alambinary011@gmail.com',
            'password' => Hash::make('password123'), // You can change the password as needed
        ]);
    }
}
