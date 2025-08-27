<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LoanRequest>
 */
class LoanRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $requestedStart = $this->faker->dateTimeBetween('now', '+1 week');
        $requestedEnd = $this->faker->dateTimeBetween($requestedStart, $requestedStart->format('Y-m-d H:i:s') . ' + 7 days');

        return [
            'request_number' => 'REQ-' . strtoupper($this->faker->unique()->bothify('####??##')),
            'borrower_id' => User::factory(),
            'supervisor_id' => User::factory(),
            'purpose' => $this->faker->sentence(),
            'requested_start_date' => $requestedStart,
            'requested_end_date' => $requestedEnd,
            'status' => $this->faker->randomElement(['draft', 'submitted', 'approved', 'active', 'returned']),
            'notes' => $this->faker->optional()->paragraph(),
            'submitted_at' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}