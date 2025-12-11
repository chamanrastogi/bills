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
            'name' => 'Customer '.$this->faker->unique()->numberBetween(1, 100),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber, // Use phoneNumber for realistic phone values
            'address' => $this->faker->address,
            'gst' => $this->fakeGST(),
            'adhar_no' => $this->faker->unique()->numerify('##########'), // Generate a unique 10-digit number for Adhar No
        ];
    }
    private function fakeGST(): string
    {
        $stateCode = str_pad($this->faker->numberBetween(1, 35), 2, '0', STR_PAD_LEFT);
        $pan       = strtoupper($this->faker->bothify('?????####?')); // PAN format
        $entity    = $this->faker->randomElement(array_merge(range('0', '9'), range('A', 'Z')));
        $check     = strtoupper($this->faker->bothify('?'));

        return $stateCode.$pan.$entity.$check;
    }
}
