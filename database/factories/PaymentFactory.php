<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_id' => 'ORD-' . strtoupper(Str::random(10)),
            'project_id' => \App\Models\Project::factory(), 
            'customer_name' => $this->faker->name(),
            'customer_email' => $this->faker->safeEmail(),
            'amount' => $this->faker->numberBetween(200000, 700000),
            'status' => $this->faker->randomElement(['pending', 'paid', 'rejected']),
        ];
    }
}