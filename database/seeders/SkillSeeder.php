<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get('database/json/skill.json');
        $skill = collect(json_decode($json));
        $skill->each(function ($s) {
            \App\Models\Skill::create([
                "name" => $s->name,
                "percentage" =>  $s->percentage,
                "status" =>  $s->status,
            ]);
        });
    }
}
