<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {        
        $startDate = '2023-01-01';
        $endDate = '2024-12-01';

        // Generate a random date between these two dates
        $randomDate = fake()->dateTimeBetween($startDate, $endDate)->format('Y-m-d');
        return [
            'customer_id' => 1,
            'amount' => rand(100, 10000),
            'payment_mode' => 1,
            'created_at' =>$randomDate,
            'updated_at' =>$randomDate           
        ];
    }
}
