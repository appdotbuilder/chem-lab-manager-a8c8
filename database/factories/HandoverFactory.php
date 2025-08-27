<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\LoanRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Handover>
 */
class HandoverFactory extends Factory
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
            'laboran_id' => User::factory(),
            'type' => $this->faker->randomElement(['checkout', 'checkin']),
            'condition' => $this->faker->optional()->randomElement(['good', 'damaged', 'incomplete', 'missing']),
            'condition_notes' => $this->faker->optional()->sentence(),
            'laboran_notes' => $this->faker->optional()->sentence(),
            'handover_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}