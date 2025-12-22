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
        \App\Models\Customer::factory(10)->create();
        \App\Models\Supplier::factory(10)->create();
        //  \App\Models\Product::factory(10)->create();
        //  \App\Models\Billing::factory(5)->create();

        //  \App\Models\Payment::factory(10)->create();
        //  \App\Models\User::factory()->create([
        //      'name' => 'Admin',
        //     'email' => 'admin@g.com',
        //     'password' => bcrypt('12345678'),]);
        $this->call([
            CategorySeeder::class,
            PuritySeeder::class,
            UnitSeeder::class,
            ProductSeeder::class,
            SettingSeeder::class,
            TypeSeeder::class,
            UserSeeder::class,

        ]);
    }
}
