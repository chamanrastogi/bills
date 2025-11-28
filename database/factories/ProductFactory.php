<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Purity;
use App\Models\Supplier;
use App\Models\Type;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $supplier_id = Supplier::where('status', 0)->inRandomOrder()->value('id');
        $type_id = Type::where('status', 0)->inRandomOrder()->value('id');
        $purity_id = Purity::where('status', 0)->where('type_id', $type_id)->inRandomOrder()->value('id');
        $unit_id = Unit::where('status', 0)->inRandomOrder()->value('id');

        return [
            'supplier_id' => $supplier_id,
            'sku' => fake()->unique()->bothify('SKU-#####'),
            'type_id' => $type_id,
            'name' => 'Product '.fake()->unique()->numberBetween(1, 100),
            'price' => fake()->numberBetween(500, 50000),
            'image' => '',
            'bill_image' => '',
            'purity_id' => $purity_id,
            'unit_id' => $unit_id,
            'gross_weight' => fake()->randomFloat(4, 1, 500),
            'net_weight' => fake()->randomFloat(4, 1, 500),
            'making_charge' => fake()->randomFloat(2, 50, 5000),
            'rate_per_gram' => fake()->randomFloat(2, 1000, 7000),
            'gst_percent' => fake()->randomFloat(2, 1, 18),
            'stock_qty' => fake()->randomFloat(4, 1, 50),
            'pstatus' => fake()->randomElement(['in_stock', 'sold', 'returned']),
            'status' => fake()->boolean(70),
        ];
    }
}
