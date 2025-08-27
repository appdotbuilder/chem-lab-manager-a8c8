<?php

namespace Database\Factories;

use App\Models\LoanRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Approval>
 */
class ApprovalFactory extends Factory
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
            'approver_id' => User::factory(),
            'approver_type' => $this->faker->randomElement(['lecturer', 'laboran', 'head_of_lab', 'admin']),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'comments' => $this->faker->optional()->sentence(),
            'responded_at' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}