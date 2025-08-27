<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\LoanRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LoanRequestItem>
 */
class LoanRequestItemFactory extends Factory
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
            'equipment_id' => Equipment::factory(),
            'quantity' => $this->faker->numberBetween(1, 3),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}