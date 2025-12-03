<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PuritySeeder extends Seeder
{
    public function run()
    {
        DB::table('purities')->insert([
            [
                'id' => 1,
                'category_id' => 1,
                'name' => '24K - (99.9% Pure Gold)',
                'status' => 0,
            ],
            [
                'id' => 2,
                'category_id' => 1,
                'name' => '22K - (91.6% Gold)',
                'status' => 0,
            ],
            [
                'id' => 3,
                'category_id' => 1,
                'name' => '18K - (75% Gold)',
                'status' => 0,
            ],
            [
                'id' => 4,
                'category_id' => 1,
                'name' => '14K - (58.5% Gold)',
                'status' => 0,
            ],
            [
                'id' => 5,
                'category_id' => 1,
                'name' => '9K  - (37.5% Gold)',
                'status' => 0,
            ],
            [
                'id' => 6,
                'category_id' => 2,
                'name' => '999 - (Fine Silver 99.9%)',
                'status' => 0,
            ],
            [
                'id' => 7,
                'category_id' => 2,
                'name' => '958 - (Britannia Silver 95.8%)',
                'status' => 0,
            ],
            [
                'id' => 8,
                'category_id' => 2,
                'name' => '925 - (Sterling Silver 92.5%)',
                'status' => 0,
            ],
        ]);
    }
}
