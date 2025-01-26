<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    public function definition(): array
    {
        $subtotal = $this->faker->randomFloat(2, 100, 1000);
        $tax = $subtotal * 0.15;
        $total = $subtotal + $tax;

        return [
            'invoice_number' => 'INV-' . strtoupper(uniqid()),
            'order_id' => Order::factory(),
            'invoice_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'status' => $this->faker->randomElement(['paid', 'unpaid', 'overdue']),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
