<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EquipmentCategory>
 */
class EquipmentCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'code' => strtoupper($this->faker->unique()->lexify('??')),
            'description' => $this->faker->sentence(),
            'icon' => '⚙️',
            'color_class' => $this->faker->randomElement([
                'bg-blue-100 text-blue-800',
                'bg-green-100 text-green-800',
                'bg-purple-100 text-purple-800',
                'bg-red-100 text-red-800',
                'bg-yellow-100 text-yellow-800',
            ]),
            'is_active' => true,
        ];
    }
}