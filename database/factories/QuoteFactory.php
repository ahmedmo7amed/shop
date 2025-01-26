<?php

namespace Database\Factories;

use App\Models\Quote;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuoteFactory extends Factory
{
    protected $model = Quote::class;

    public function definition(): array
    {
        return [
            'company_name' => $this->faker->company(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'expiration_date' => $this->faker->dateTimeBetween(now(), '+1 year'),
            'status' => $this->faker->randomElement(['pending', 'approved', 'declined']),
            'special_notes' => $this->faker->text(),
            'products' => json_encode([
                [
                    'product_id' => $this->faker->numberBetween(1, 100),
                    'quantity' => $this->faker->numberBetween(1, 10),
                    'unit_price' => $this->faker->randomFloat(2, 100, 1000),
                    'tax_rate' => $this->faker->randomFloat(2, 5, 20),
                ],
                [
                    'product_id' => $this->faker->numberBetween(1, 100),
                    'quantity' => $this->faker->numberBetween(1, 10),
                    'unit_price' => $this->faker->randomFloat(2, 100, 1000),
                    'tax_rate' => $this->faker->randomFloat(2, 5, 20),
                ],
            ]),
            'subtotal' => $this->faker->randomFloat(2, 100, 1000),
            'tax_total' => $this->faker->randomFloat(2, 100, 1000),
            'grand_total' => $this->faker->randomFloat(2, 100, 1000),
            //'expiration_date',
            //        'special_notes',
            //        'products',
            //        'subtotal',
            //        'tax_total',
            //        'grand_total'

        ];
    }
}
