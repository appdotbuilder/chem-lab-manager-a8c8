<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lab>
 */
class LabFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true) . ' Laboratory',
            'code' => strtoupper($this->faker->unique()->lexify('???')),
            'location' => 'Building ' . $this->faker->randomLetter() . ', Floor ' . $this->faker->numberBetween(1, 5),
            'capacity' => $this->faker->numberBetween(15, 50),
            'opening_time' => '08:00:00',
            'closing_time' => '17:00:00',
            'operating_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'],
            'contact_phone' => $this->faker->phoneNumber(),
            'contact_email' => $this->faker->safeEmail(),
            'description' => $this->faker->paragraph(),
            'rules' => $this->faker->paragraph(),
            'is_active' => true,
        ];
    }
}