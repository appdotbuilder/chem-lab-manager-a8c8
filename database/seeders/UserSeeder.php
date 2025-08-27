<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $kepalaLabRole = Role::where('name', 'kepala_lab')->first();
        $laboranRole = Role::where('name', 'laboran')->first();
        $dosenRole = Role::where('name', 'dosen')->first();
        $mahasiswaRole = Role::where('name', 'mahasiswa')->first();

        // Admin users
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@che.ui.ac.id',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
            'status' => 'verified',
            'phone' => '+62812345678',
            'address' => 'Chemical Engineering Department, UI',
            'email_verified_at' => now(),
        ]);

        // Kepala Lab
        User::create([
            'name' => 'Dr. Ira Wati Panjaitan',
            'email' => 'ira.wati@che.ui.ac.id',
            'password' => Hash::make('password'),
            'role_id' => $kepalaLabRole->id,
            'status' => 'verified',
            'phone' => '+62812345679',
            'address' => 'Chemical Engineering Department, UI',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Prof. Dr. Nelson Saksono',
            'email' => 'nelson.saksono@che.ui.ac.id',
            'password' => Hash::make('password'),
            'role_id' => $kepalaLabRole->id,
            'status' => 'verified',
            'phone' => '+62812345680',
            'address' => 'Chemical Engineering Department, UI',
            'email_verified_at' => now(),
        ]);

        // Laborans
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi.santoso@che.ui.ac.id',
            'password' => Hash::make('password'),
            'role_id' => $laboranRole->id,
            'status' => 'verified',
            'phone' => '+62812345681',
            'address' => 'Chemical Engineering Department, UI',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti.aminah@che.ui.ac.id',
            'password' => Hash::make('password'),
            'role_id' => $laboranRole->id,
            'status' => 'verified',
            'phone' => '+62812345682',
            'address' => 'Chemical Engineering Department, UI',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Ahmad Rizki',
            'email' => 'ahmad.rizki@che.ui.ac.id',
            'password' => Hash::make('password'),
            'role_id' => $laboranRole->id,
            'status' => 'verified',
            'phone' => '+62812345683',
            'address' => 'Chemical Engineering Department, UI',
            'email_verified_at' => now(),
        ]);

        // Dosen/Lecturers
        User::create([
            'name' => 'Dr. Widodo Wahyu Purwanto',
            'email' => 'widodo.purwanto@che.ui.ac.id',
            'password' => Hash::make('password'),
            'role_id' => $dosenRole->id,
            'status' => 'verified',
            'phone' => '+62812345684',
            'address' => 'Chemical Engineering Department, UI',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Dr. Tania Surya Utami',
            'email' => 'tania.utami@che.ui.ac.id',
            'password' => Hash::make('password'),
            'role_id' => $dosenRole->id,
            'status' => 'verified',
            'phone' => '+62812345685',
            'address' => 'Chemical Engineering Department, UI',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Dr. Misri Gozan',
            'email' => 'misri.gozan@che.ui.ac.id',
            'password' => Hash::make('password'),
            'role_id' => $dosenRole->id,
            'status' => 'verified',
            'phone' => '+62812345686',
            'address' => 'Chemical Engineering Department, UI',
            'email_verified_at' => now(),
        ]);

        // Students
        $students = [
            ['name' => 'Andi Pratama', 'email' => 'andi.pratama@ui.ac.id', 'student_id' => '2106123456'],
            ['name' => 'Bella Sari', 'email' => 'bella.sari@ui.ac.id', 'student_id' => '2106123457'],
            ['name' => 'Citra Dewi', 'email' => 'citra.dewi@ui.ac.id', 'student_id' => '2106123458'],
            ['name' => 'Doni Wijaya', 'email' => 'doni.wijaya@ui.ac.id', 'student_id' => '2106123459'],
            ['name' => 'Eka Putri', 'email' => 'eka.putri@ui.ac.id', 'student_id' => '2106123460'],
            ['name' => 'Fajar Rahman', 'email' => 'fajar.rahman@ui.ac.id', 'student_id' => '2106123461'],
            ['name' => 'Gita Sari', 'email' => 'gita.sari@ui.ac.id', 'student_id' => '2106123462'],
            ['name' => 'Hadi Kusuma', 'email' => 'hadi.kusuma@ui.ac.id', 'student_id' => '2106123463'],
            ['name' => 'Indah Permata', 'email' => 'indah.permata@ui.ac.id', 'student_id' => '2106123464'],
            ['name' => 'Joko Susilo', 'email' => 'joko.susilo@ui.ac.id', 'student_id' => '2106123465'],
            ['name' => 'Kartika Sari', 'email' => 'kartika.sari@ui.ac.id', 'student_id' => '2107123456'],
            ['name' => 'Luis Alvarez', 'email' => 'luis.alvarez@ui.ac.id', 'student_id' => '2107123457'],
            ['name' => 'Maya Putri', 'email' => 'maya.putri@ui.ac.id', 'student_id' => '2107123458'],
            ['name' => 'Nanda Rahman', 'email' => 'nanda.rahman@ui.ac.id', 'student_id' => '2107123459'],
            ['name' => 'Oki Prastowo', 'email' => 'oki.prastowo@ui.ac.id', 'student_id' => '2107123460'],
        ];

        foreach ($students as $student) {
            User::create([
                'name' => $student['name'],
                'email' => $student['email'],
                'password' => Hash::make('password'),
                'role_id' => $mahasiswaRole->id,
                'status' => 'verified',
                'student_id' => $student['student_id'],
                'phone' => '+628' . random_int(1000000000, 9999999999),
                'address' => 'Student Housing, UI Campus',
                'email_verified_at' => now(),
            ]);
        }

        // Some pending student registrations
        $pendingStudents = [
            ['name' => 'Putri Anggraini', 'email' => 'putri.anggraini@ui.ac.id', 'student_id' => '2108123456'],
            ['name' => 'Rudi Hartono', 'email' => 'rudi.hartono@ui.ac.id', 'student_id' => '2108123457'],
        ];

        foreach ($pendingStudents as $student) {
            User::create([
                'name' => $student['name'],
                'email' => $student['email'],
                'password' => Hash::make('password'),
                'role_id' => $mahasiswaRole->id,
                'status' => 'pending',
                'student_id' => $student['student_id'],
                'phone' => '+628' . random_int(1000000000, 9999999999),
                'address' => 'Student Housing, UI Campus',
            ]);
        }
    }
}