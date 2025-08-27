<?php

namespace Database\Seeders;

use App\Models\Lab;
use App\Models\User;
use Illuminate\Database\Seeder;

class LabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kepalaLabs = User::whereHas('role', function ($query) {
            $query->where('name', 'kepala_lab');
        })->get();

        $laborans = User::whereHas('role', function ($query) {
            $query->where('name', 'laboran');
        })->get();

        $labs = [
            [
                'name' => 'Process Control Laboratory',
                'code' => 'PCL',
                'location' => 'Building A, Floor 3',
                'capacity' => 30,
                'opening_time' => '08:00:00',
                'closing_time' => '17:00:00',
                'operating_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'],
                'head_of_lab_id' => $kepalaLabs->first()->id,
                'laboran_id' => $laborans->first()->id,
                'contact_phone' => '+62217863515',
                'contact_email' => 'pcl@che.ui.ac.id',
                'description' => 'Process Control Laboratory is equipped with modern instrumentation and control systems for studying process automation and control strategies.',
                'rules' => 'Students must wear safety equipment. No food or drink allowed. Equipment must be returned in good condition.',
                'is_active' => true,
            ],
            [
                'name' => 'Chemical Reaction Engineering Laboratory',
                'code' => 'CREL',
                'location' => 'Building A, Floor 2',
                'capacity' => 25,
                'opening_time' => '08:00:00',
                'closing_time' => '17:00:00',
                'operating_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'],
                'head_of_lab_id' => $kepalaLabs->skip(1)->first()->id,
                'laboran_id' => $laborans->skip(1)->first()->id,
                'contact_phone' => '+62217863516',
                'contact_email' => 'crel@che.ui.ac.id',
                'description' => 'Specialized laboratory for studying chemical reaction kinetics, reactor design, and catalysis.',
                'rules' => 'Mandatory safety briefing before first use. JSA required for all experiments. No unsupervised work.',
                'is_active' => true,
            ],
            [
                'name' => 'Separation Process Laboratory',
                'code' => 'SPL',
                'location' => 'Building B, Floor 1',
                'capacity' => 20,
                'opening_time' => '08:00:00',
                'closing_time' => '17:00:00',
                'operating_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'],
                'head_of_lab_id' => $kepalaLabs->first()->id,
                'laboran_id' => $laborans->skip(2)->first()->id,
                'contact_phone' => '+62217863517',
                'contact_email' => 'spl@che.ui.ac.id',
                'description' => 'Laboratory equipped with distillation columns, extraction units, and membrane separation systems.',
                'rules' => 'Students must complete safety training. Equipment booking required in advance.',
                'is_active' => true,
            ],
            [
                'name' => 'Analytical Chemistry Laboratory',
                'code' => 'ACL',
                'location' => 'Building C, Floor 2',
                'capacity' => 35,
                'opening_time' => '07:30:00',
                'closing_time' => '18:00:00',
                'operating_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'],
                'head_of_lab_id' => $kepalaLabs->skip(1)->first()->id,
                'laboran_id' => $laborans->first()->id,
                'contact_phone' => '+62217863518',
                'contact_email' => 'acl@che.ui.ac.id',
                'description' => 'State-of-the-art analytical laboratory with advanced instrumentation for chemical analysis.',
                'rules' => 'Strict safety protocols. No unauthorized access to instruments. Proper waste disposal required.',
                'is_active' => true,
            ],
        ];

        foreach ($labs as $labData) {
            Lab::create($labData);
        }
    }
}