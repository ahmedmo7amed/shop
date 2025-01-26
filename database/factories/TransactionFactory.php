<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'transaction_number' => 'TRX-' . fake()->unique()->numerify('######'),
            'payment_id' => Payment::factory(),
            'order_id' => Order::factory(),
            'user_id' => User::factory(),
            'amount' => fake()->randomFloat(2, 10, 1000),
            'type' => fake()->randomElement(['credit', 'debit']),
            'status' => fake()->randomElement(['pending', 'completed', 'failed', 'refunded']),
            'description' => fake()->sentence(),
            'metadata' => [
                'ip_address' => fake()->ipv4(),
                'user_agent' => fake()->userAgent(),
                'location' => fake()->city(),
            ],
        ];
    }
}
