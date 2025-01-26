<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SellerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'company_name' => fake()->company(),
            'registration_number' => fake()->unique()->numerify('REG-####'),
            'tax_number' => fake()->unique()->numerify('TAX-####'),
            'phone' => fake()->phoneNumber(),
            'website' => fake()->url(),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['pending', 'active', 'suspended']),
            'is_featured' => fake()->boolean(20),
            'rating' => fake()->randomFloat(2, 0, 5),
        ];
    }
}
