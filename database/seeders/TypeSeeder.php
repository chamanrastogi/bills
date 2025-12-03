<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [

            // Gold (category_id = 1)
            ['category_id' => 1, 'name' => 'Gold Ring'],
            ['category_id' => 1, 'name' => 'Gold Chain'],
            ['category_id' => 1, 'name' => 'Gold Necklace'],
            ['category_id' => 1, 'name' => 'Gold Bracelet'],
            ['category_id' => 1, 'name' => 'Gold Anklet'],
            ['category_id' => 1, 'name' => 'Gold Earrings'],
            ['category_id' => 1, 'name' => 'Gold Pendant'],
            ['category_id' => 1, 'name' => 'Gold Bangles'],
            ['category_id' => 1, 'name' => 'Gold Nose Pin'],
            ['category_id' => 1, 'name' => 'Gold Coin'],

            // Silver (category_id = 2)
            ['category_id' => 2, 'name' => 'Silver Ring'],
            ['category_id' => 2, 'name' => 'Silver Chain'],
            ['category_id' => 2, 'name' => 'Silver Necklace'],
            ['category_id' => 2, 'name' => 'Silver Bracelet'],
            ['category_id' => 2, 'name' => 'Silver Anklet'],
            ['category_id' => 2, 'name' => 'Silver Earrings'],
            ['category_id' => 2, 'name' => 'Silver Pendant'],
            ['category_id' => 2, 'name' => 'Silver Bangles'],
            ['category_id' => 2, 'name' => 'Silver Toe Ring'],
            ['category_id' => 2, 'name' => 'Silver Coin'],
        ];

        DB::table('types')->insert($types);
    }
}
