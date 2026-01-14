<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SupplierBillingSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // -----------------------------
        // Fetch ACTIVE dependencies
        // -----------------------------
        $supplierIds = DB::table('suppliers')
            ->where('status', 0)
            ->pluck('id')
            ->toArray();

        $unitIds = DB::table('units')
            ->where('status', 0)
            ->pluck('id')
            ->toArray();

        $categories = DB::table('categories')
            ->where('status', 0)
            ->get();

        $purities = DB::table('purities')
            ->where('status', 0)
            ->select('id', 'category_id')
            ->get();

        if (
            empty($supplierIds) ||
            empty($unitIds) ||
            $categories->isEmpty() ||
            $purities->isEmpty()
        ) {
            return;
        }

        // Group purities by category
        $puritiesByCategory = $purities->groupBy('category_id');

        // -----------------------------
        // Create Supplier Billings
        // -----------------------------
        for ($i = 0; $i < 10; $i++) {

            $billingId = DB::table('supplier_billings')->insertGetId([
                'supplier_id' => $faker->randomElement($supplierIds),
                'bill_image' => null,
                'bill_amount' => 0,
                'paid' => 0,
                'payment_mode' => $faker->randomElement([1, 2, 3, 4]),
                'transaction_id' => strtoupper(Str::random(12)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // -----------------------------
            // Create Billing Items
            // -----------------------------
            $numItems = $faker->numberBetween(2, 4);

            for ($j = 0; $j < $numItems; $j++) {

                // Pick category
                $category = $faker->randomElement($categories->all());

                // Ensure purity exists for category
                if (! isset($puritiesByCategory[$category->id])) {
                    continue;
                }

                $purity = $faker->randomElement(
                    $puritiesByCategory[$category->id]->values()->all()
                );

                DB::table('supplier_billing_items')->insert([
                    'supplier_billing_id' => $billingId,
                    'category_id' => $category->id, // FIXED
                    'purity_id' => $purity->id,
                    'unit_id' => $faker->randomElement($unitIds),
                    'total_weight' => $faker->randomFloat(2, 10, 500),
                    'line_total' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // -----------------------------
            // Update billing totals
            // -----------------------------
            DB::table('supplier_billings')
                ->where('id', $billingId)
                ->update([
                    'bill_amount' => $faker->numberBetween(50000, 800000),
                    'paid' => 0,
                ]);
        }
    }
}
