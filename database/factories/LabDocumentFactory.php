<?php

namespace Database\Factories;

use App\Models\Lab;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LabDocument>
 */
class LabDocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lab_id' => Lab::factory(),
            'type' => $this->faker->randomElement(['sop', 'msds', 'manual', 'other']),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->optional()->paragraph(),
            'file_path' => 'documents/' . $this->faker->uuid() . '.pdf',
            'file_name' => $this->faker->words(3, true) . '.pdf',
            'file_type' => 'application/pdf',
            'file_size' => $this->faker->numberBetween(100000, 10000000),
            'uploaded_by' => User::factory(),
        ];
    }
}