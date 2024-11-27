<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'username'=>'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'), // Ensure password is hashed
        ],[
            'name' => 'admin2',
            'username'=>'admin2',
            'email' => 'admin2@example.com',
            'password' => Hash::make('12345678'),  // Password is hashed
        ],); 
    }
}
