<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'shop_name' => $this->faker->company,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'address' => $this->faker->address,
            'gst_no' => $this->faker->unique()->regexify('[A-Z]{5}[0-9]{4}[A-Z][0-9]Z[A-Z]'),
            'account' => $this->faker->bankAccountNumber,
            'status' => $this->faker->boolean(70),
        ];
    }
}
