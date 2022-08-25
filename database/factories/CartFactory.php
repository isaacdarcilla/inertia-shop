<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'product_id' => 1,
            'price' => $this->faker->randomDigit(),
            'checkout_at' => now(),
        ];
    }
}
