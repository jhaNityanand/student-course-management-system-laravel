<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            [
                'student_id' => 'ST001',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john.doe@example.com',
                'phone' => '1234567890',
                'date_of_birth' => '2000-01-15',
                'gender' => 'male',
                'address' => '123 Main St',
                'city' => 'New York',
                'state' => 'NY',
                'country' => 'USA',
                'postal_code' => '10001',
                'emergency_contact_name' => 'Jane Doe',
                'emergency_contact_phone' => '0987654321',
                'blood_group' => 'A+',
                'is_active' => true,
            ],
            [
                'student_id' => 'ST002',
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'jane.smith@example.com',
                'phone' => '2345678901',
                'date_of_birth' => '2001-05-20',
                'gender' => 'female',
                'address' => '456 Oak Ave',
                'city' => 'Los Angeles',
                'state' => 'CA',
                'country' => 'USA',
                'postal_code' => '90001',
                'emergency_contact_name' => 'John Smith',
                'emergency_contact_phone' => '9876543210',
                'blood_group' => 'B+',
                'is_active' => true,
            ],
            [
                'student_id' => 'ST003',
                'first_name' => 'Michael',
                'last_name' => 'Johnson',
                'email' => 'michael.johnson@example.com',
                'phone' => '3456789012',
                'date_of_birth' => '1999-11-30',
                'gender' => 'male',
                'address' => '789 Pine St',
                'city' => 'Chicago',
                'state' => 'IL',
                'country' => 'USA',
                'postal_code' => '60601',
                'emergency_contact_name' => 'Sarah Johnson',
                'emergency_contact_phone' => '8765432109',
                'blood_group' => 'O+',
                'is_active' => true,
            ],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
} 