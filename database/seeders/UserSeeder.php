<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Super Admin user
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        // Assign Super Admin role
        $superAdminRole = Role::where('name', 'Super Admin')->first();
        $superAdmin->assignRole($superAdminRole);

        // Create Admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin2@example.com',
            'password' => Hash::make('password'),
        ]);

        // Assign Admin role
        $adminRole = Role::where('name', 'Admin')->first();
        $admin->assignRole($adminRole);

        // Create Instructor user
        $instructor = User::create([
            'name' => 'Instructor',
            'email' => 'instructor@example.com',
            'password' => Hash::make('password'),
        ]);

        // Assign Instructor role
        $instructorRole = Role::where('name', 'Instructor')->first();
        $instructor->assignRole($instructorRole);

        // Create Student user
        $student = User::create([
            'name' => 'Student',
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
        ]);

        // Assign Student role
        $studentRole = Role::where('name', 'Student')->first();
        $student->assignRole($studentRole);
    }
}
