<?php

namespace Database\Factories;

use App\Models\EquipmentCategory;
use App\Models\Lab;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipment>
 */
class EquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $code = strtoupper($this->faker->unique()->bothify('???-###'));
        
        return [
            'name' => $this->faker->words(3, true),
            'code' => $code,
            'category_id' => EquipmentCategory::factory(),
            'lab_id' => Lab::factory(),
            'description' => $this->faker->paragraph(),
            'specifications' => [
                'Model' => $this->faker->bothify('Model-####'),
                'Power' => $this->faker->numberBetween(100, 5000) . 'W',
                'Voltage' => $this->faker->randomElement(['110V', '220V', '380V']),
            ],
            'status' => $this->faker->randomElement(['available', 'borrowed', 'maintenance']),
            'risk_level' => $this->faker->randomElement(['low', 'medium', 'high']),
            'requires_lecturer_approval' => $this->faker->boolean(30),
            'brand' => $this->faker->company(),
            'model' => $this->faker->bothify('Model-####'),
            'serial_number' => $this->faker->unique()->bothify('SN########'),
            'purchase_date' => $this->faker->dateTimeBetween('-5 years', '-1 year'),
            'purchase_price' => $this->faker->numberBetween(5000000, 500000000),
            'usage_instructions' => $this->faker->paragraph(),
            'safety_notes' => $this->faker->sentence(),
            'qr_code' => 'QR-' . $code,
            'barcode' => 'BC-' . $code,
            'total_borrows' => $this->faker->numberBetween(0, 100),
            'total_damages' => $this->faker->numberBetween(0, 5),
            'is_active' => true,
        ];
    }
}