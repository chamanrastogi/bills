<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('site_settings')->insert([
            'id'                => 1,
            'logo'              => '',
            'favicon'           => '',
            'site_title'        => 'Demo Site',
            'app_name'          => 'Demo Site',
            'support_phone'     => '00-0000-0000',
            'email'             => 'info@demo.com',
            'tax'               => 0,
            'address'           => '',
            'gst'               => '',
            'bank_name'         => '',
            'bank_holder_name'  => '',
            'bank_ifsc'         => '',
            'bank_account'      => '',
            'bank_branch'       => '',
            'pan_no'            => '',
            'declaration'       => '',
            'message'           => '',
            'bank_qr_code'      => '',
        ]);
    }
}
