<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'quantity' => fake()->numberBetween(0, 100),
            'low_stock_threshold' => fake()->numberBetween(5, 20),
            'sku' => fake()->unique()->bothify('SKU-????-####'),
            'location' => fake()->word() . ' Warehouse - ' . fake()->word() . ' Section',
            'notes' => fake()->boolean(30) ? fake()->sentence() : null,
        ];
    }
}
