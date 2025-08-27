<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'System administrator with full access to all features'
            ],
            [
                'name' => 'kepala_lab',
                'display_name' => 'Kepala Lab',
                'description' => 'Head of Laboratory with oversight and management privileges'
            ],
            [
                'name' => 'laboran',
                'display_name' => 'Laboran',
                'description' => 'Laboratory assistant responsible for equipment management'
            ],
            [
                'name' => 'dosen',
                'display_name' => 'Dosen',
                'description' => 'Lecturer with supervision and approval privileges'
            ],
            [
                'name' => 'mahasiswa',
                'display_name' => 'Mahasiswa',
                'description' => 'Student with equipment borrowing privileges'
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}