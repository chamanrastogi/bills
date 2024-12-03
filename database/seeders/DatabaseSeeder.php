<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Service::factory(50)->create();
        //  \App\Models\Customer::factory(50)->create();
         // \App\Models\Billing::factory(50)->create();

         \App\Models\Payment::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            //   BlogcategorySeeder::class
            // ServiceSeeder::class
           // SkillSeeder::class
        ]);
    }
}
