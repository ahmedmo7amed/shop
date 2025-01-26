<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'payment_number' => 'PAY-' . fake()->unique()->numerify('######'),
            'order_id' => Order::factory(),
            'user_id' => User::factory(),
            'amount' => fake()->randomFloat(2, 10, 1000),
            'payment_method' => fake()->randomElement(['credit_card', 'paypal', 'bank_transfer']),
            'status' => fake()->randomElement(['pending', 'completed', 'failed', 'refunded']),
            'transaction_id' => fake()->uuid(),
            'payment_details' => [
                'card_type' => fake()->creditCardType(),
                'last_four' => fake()->numerify('####'),
            ],
            'paid_at' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
