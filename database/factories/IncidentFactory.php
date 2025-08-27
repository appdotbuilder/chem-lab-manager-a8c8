<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\LoanRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Incident>
 */
class IncidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'incident_number' => 'INC-' . strtoupper($this->faker->unique()->bothify('####??##')),
            'loan_request_id' => LoanRequest::factory(),
            'equipment_id' => Equipment::factory(),
            'reported_by' => User::factory(),
            'type' => $this->faker->randomElement(['damage', 'malfunction', 'accident', 'loss', 'other']),
            'severity' => $this->faker->randomElement(['minor', 'moderate', 'major', 'critical']),
            'description' => $this->faker->paragraph(),
            'cause_analysis' => $this->faker->optional()->paragraph(),
            'immediate_action' => $this->faker->optional()->sentence(),
            'preventive_measures' => $this->faker->optional()->sentence(),
            'incident_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'status' => $this->faker->randomElement(['open', 'investigating', 'resolved', 'closed']),
            'resolved_at' => $this->faker->optional()->dateTimeBetween('-1 week', 'now'),
        ];
    }
}