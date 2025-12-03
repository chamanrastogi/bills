<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('units')->insert([
            ['id' => 1, 'name' => 'mg', 'fname' => 'Milligram (mg)', 'status' => 0],
            ['id' => 2, 'name' => 'g', 'fname' => 'Gram (g)', 'status' => 0],
            ['id' => 3, 'name' => 'kg', 'fname' => 'Kilogram (kg)', 'status' => 0],
            ['id' => 4, 'name' => 'tola', 'fname' => 'Tola', 'status' => 0],
            ['id' => 5, 'name' => 'carat', 'fname' => 'Carat (ct)', 'status' => 0],
            ['id' => 6, 'name' => 'piece', 'fname' => 'Piece (pcs)', 'status' => 0],
            ['id' => 7, 'name' => 'set', 'fname' => 'Set', 'status' => 0],
            ['id' => 8, 'name' => 'pair', 'fname' => 'Pair', 'status' => 0],
        ]);
    }
}
