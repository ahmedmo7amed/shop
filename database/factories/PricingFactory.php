<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class PricingFactory extends Factory
{
    public function definition(): array
    {
        $regular_price = fake()->randomFloat(2, 10, 1000);
        
        return [
            'product_id' => Product::factory(),
            'regular_price' => $regular_price,
            'sale_price' => fake()->boolean(30) ? $regular_price * 0.8 : null,
            'sale_start' => fake()->boolean(30) ? fake()->dateTimeBetween('now', '+1 month') : null,
            'sale_end' => fake()->boolean(30) ? fake()->dateTimeBetween('+1 month', '+2 months') : null,
            'wholesale_price' => $regular_price * 0.6,
            'min_wholesale_quantity' => fake()->numberBetween(5, 50),
            'is_on_sale' => fake()->boolean(30),
        ];
    }
}
