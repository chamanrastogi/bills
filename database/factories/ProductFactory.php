<?php

namespace Database\Factories;

use App\Models\Category;
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
        $category_id = Category::inRandomOrder()->value('id'); // Fetch a random category ID
        return [
            'category_id' => $category_id,
            'name' => 'Product ' . fake()->unique()->numberBetween(1, 100), // Generate names like "Product 1", "Product 2", etc.
            'image' => '',
            'price' => fake()->randomFloat(2, 1, 100), // Generate a random price with 2 decimal places
            'text' => fake()->text(),
        ];
    }
}
