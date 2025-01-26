<?php

namespace Database\Factories;

use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

class SellerDetailFactory extends Factory
{
    public function definition(): array
    {
        return [
            'seller_id' => Seller::factory(),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'postal_code' => fake()->postcode(),
            'country' => fake()->country(),
            'bank_name' => fake()->company(),
            'bank_account_number' => fake()->bankAccountNumber(),
            'bank_holder_name' => fake()->name(),
            'bank_swift_code' => fake()->swiftBicNumber(),
            'social_media' => [
                'facebook' => fake()->url(),
                'twitter' => fake()->url(),
                'instagram' => fake()->url(),
            ],
            'return_policy' => fake()->paragraph(),
            'shipping_policy' => fake()->paragraph(),
        ];
    }
}
