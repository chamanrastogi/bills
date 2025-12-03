<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['id' => 1, 'name' => 'Gold'],
            ['id' => 2, 'name' => 'Silver'],
        ];

        DB::table('categories')->insert($categories);
    }
}
