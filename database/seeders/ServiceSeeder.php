<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $json = File::get('database/json/services.json');
        // $schools = collect(json_decode($json));
        // $schools->each(function ($s) {
        //     \App\Models\Service::create([
        //         "category_id" => $s->category_id,
        //         "name" => $s->name,
        //         "parent" =>  $s->parent,
        //         "image" =>  $s->image,
        //         "small_text" => $s->small_text,
        //         "text" => $s->text,
        //         "status" =>  $s->status,
        //     ]);
        // });
    }
}
