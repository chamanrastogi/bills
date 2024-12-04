<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BillingFactory extends Factory
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

        $randomNumber = fake()->numberBetween(1, 5);
        $randomProducts = \App\Models\Product::inRandomOrder()->take($randomNumber)->get();

        // Generate random cart data
        $items = [];
        foreach ($randomProducts as $product) {
            $items[] = [
                'productId' => $product->id,
                'quantity' => rand(1, 30), // Random quantity between 1 and 30
                'price' => $product->price // Assuming the 'price' field exists in the product table 
            ];
        }

        // Customer ID - assuming the customer is logged in or retrieved from session
        $customer_id = 1; // Or get it from the session, or other method

        // Initialize grand total
        $grandTotal = 0;

        // Calculate the grand total from items in the cart
        foreach ($items as $item) {
            $grandTotal += $item['quantity'] * $item['price'];
        }

        // Optional: Apply discount and tax if necessary
        $discount = 0; // Assuming no discount for now
        $discountAmount = 0; // Assuming no discount amount for now
        $tax = 0; // Assuming no tax for now
        $taxAmount = 0; // Assuming no tax amount for now
        // return [
        //     'customer_id' => $customer_id,
        //     'cart' => json_encode($items),
        //     'discount' => 0,
        //     'discount_amount' => 0,
        //     'tax' => 0,
        //     'tax_amount' => 0,
        //     'freight_charges'=>0,
        //     'grand_total' => $grandTotal,
        //     'payment' =>0,
        //     'payment_mode' =>0,
        //     'created_at' => $randomDate,
        //     'updated_at' => $randomDate
        // ];

        return [
            'customer_id' => $customer_id,
            'cart' => '',
            'discount' => 0,
            'discount_amount' => 0,
            'tax' => 0,
            'tax_amount' => 0,
            'freight_charges'=>0,
            'grand_total' => 0,
            'payment' =>rand(100, 10000),
            'payment_mode' =>1,
            'created_at' => $randomDate,
            'updated_at' => $randomDate
        ];
    }
}
