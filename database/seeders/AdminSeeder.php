<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::collection('users')->delete();
        DB::collection('users')->insert([
            'full_name' => Str::random(10),
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'phone_number' => Str::random(10),
            'role' => 'ADMIN'
        ]);
    }
}
