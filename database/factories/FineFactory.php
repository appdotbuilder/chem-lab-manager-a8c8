<?php

namespace Database\Factories;

use App\Models\LoanRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fine>
 */
class FineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'loan_request_id' => LoanRequest::factory(),
            'user_id' => User::factory(),
            'type' => $this->faker->randomElement(['late_return', 'damage', 'loss', 'other']),
            'description' => $this->faker->sentence(),
            'amount' => $this->faker->numberBetween(10000, 500000),
            'status' => $this->faker->randomElement(['pending', 'paid', 'waived', 'disputed']),
            'due_date' => $this->faker->dateTimeBetween('now', '+30 days'),
            'paid_at' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            'payment_notes' => $this->faker->optional()->sentence(),
        ];
    }
}