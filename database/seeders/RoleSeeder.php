<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Super Admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Instructor',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Student',
                'guard_name' => 'web',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
} 