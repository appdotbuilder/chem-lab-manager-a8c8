<?php

namespace Database\Seeders;

use App\Models\EquipmentCategory;
use Illuminate\Database\Seeder;

class EquipmentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Analytical Instruments',
                'code' => 'AI',
                'description' => 'Precision instruments for chemical analysis and measurement',
                'icon' => '🔬',
                'color_class' => 'bg-blue-100 text-blue-800',
                'is_active' => true,
            ],
            [
                'name' => 'Process Equipment',
                'code' => 'PE',
                'description' => 'Equipment used in chemical processes and unit operations',
                'icon' => '⚙️',
                'color_class' => 'bg-green-100 text-green-800',
                'is_active' => true,
            ],
            [
                'name' => 'Control Systems',
                'code' => 'CS',
                'description' => 'Automation and process control instrumentation',
                'icon' => '🎛️',
                'color_class' => 'bg-purple-100 text-purple-800',
                'is_active' => true,
            ],
            [
                'name' => 'Safety Equipment',
                'code' => 'SE',
                'description' => 'Personal protective and safety monitoring equipment',
                'icon' => '🛡️',
                'color_class' => 'bg-red-100 text-red-800',
                'is_active' => true,
            ],
            [
                'name' => 'Measurement Tools',
                'code' => 'MT',
                'description' => 'Basic measurement and monitoring instruments',
                'icon' => '📏',
                'color_class' => 'bg-yellow-100 text-yellow-800',
                'is_active' => true,
            ],
            [
                'name' => 'Heating Equipment',
                'code' => 'HE',
                'description' => 'Furnaces, ovens, and heating systems',
                'icon' => '🔥',
                'color_class' => 'bg-orange-100 text-orange-800',
                'is_active' => true,
            ],
            [
                'name' => 'Mixing Equipment',
                'code' => 'ME',
                'description' => 'Mixers, agitators, and blending equipment',
                'icon' => '🌀',
                'color_class' => 'bg-cyan-100 text-cyan-800',
                'is_active' => true,
            ],
            [
                'name' => 'Separation Equipment',
                'code' => 'SEP',
                'description' => 'Centrifuges, filters, and separation systems',
                'icon' => '⚡',
                'color_class' => 'bg-indigo-100 text-indigo-800',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            EquipmentCategory::create($category);
        }
    }
}