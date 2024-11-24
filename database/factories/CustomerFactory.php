<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Customer ' . $this->faker->unique()->numberBetween(1, 100),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber, // Use phoneNumber for realistic phone values
            'address' => $this->faker->address,
            'bill_address' => $this->faker->address // Use address for billing as well
        ];
    }
}
