<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // User Management
            ['name' => 'view users', 'guard_name' => 'web'],
            ['name' => 'create users', 'guard_name' => 'web'],
            ['name' => 'edit users', 'guard_name' => 'web'],
            ['name' => 'delete users', 'guard_name' => 'web'],

            // Student Management
            ['name' => 'view students', 'guard_name' => 'web'],
            ['name' => 'create students', 'guard_name' => 'web'],
            ['name' => 'edit students', 'guard_name' => 'web'],
            ['name' => 'delete students', 'guard_name' => 'web'],

            // Course Management
            ['name' => 'view courses', 'guard_name' => 'web'],
            ['name' => 'create courses', 'guard_name' => 'web'],
            ['name' => 'edit courses', 'guard_name' => 'web'],
            ['name' => 'delete courses', 'guard_name' => 'web'],

            // Enrollment Management
            ['name' => 'view enrollments', 'guard_name' => 'web'],
            ['name' => 'create enrollments', 'guard_name' => 'web'],
            ['name' => 'edit enrollments', 'guard_name' => 'web'],
            ['name' => 'delete enrollments', 'guard_name' => 'web'],

            // Attendance Management
            ['name' => 'view attendance', 'guard_name' => 'web'],
            ['name' => 'create attendance', 'guard_name' => 'web'],
            ['name' => 'edit attendance', 'guard_name' => 'web'],
            ['name' => 'delete attendance', 'guard_name' => 'web'],

            // Marks Management
            ['name' => 'view marks', 'guard_name' => 'web'],
            ['name' => 'create marks', 'guard_name' => 'web'],
            ['name' => 'edit marks', 'guard_name' => 'web'],
            ['name' => 'delete marks', 'guard_name' => 'web'],

            // Semester Management
            ['name' => 'view semesters', 'guard_name' => 'web'],
            ['name' => 'create semesters', 'guard_name' => 'web'],
            ['name' => 'edit semesters', 'guard_name' => 'web'],
            ['name' => 'delete semesters', 'guard_name' => 'web'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
} 