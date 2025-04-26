<?php

namespace Database\Seeders;

use App\Models\Instructor;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    public function run(): void
    {
        $instructors = [
            [
                'instructor_id' => 'INS001',
                'first_name' => 'Robert',
                'last_name' => 'Williams',
                'email' => 'robert.williams@example.com',
                'phone' => '1234567890',
                'qualification' => 'Ph.D. in Computer Science',
                'specialization' => 'Software Engineering',
                'years_of_experience' => 10,
                'status' => 'active',
                'bio' => 'Expert in software development and computer science education',
            ],
            [
                'instructor_id' => 'INS002',
                'first_name' => 'Sarah',
                'last_name' => 'Brown',
                'email' => 'sarah.brown@example.com',
                'phone' => '2345678901',
                'qualification' => 'Ph.D. in Mathematics',
                'specialization' => 'Applied Mathematics',
                'years_of_experience' => 8,
                'status' => 'active',
                'bio' => 'Specialized in mathematical modeling and analysis',
            ],
            [
                'instructor_id' => 'INS003',
                'first_name' => 'David',
                'last_name' => 'Miller',
                'email' => 'david.miller@example.com',
                'phone' => '3456789012',
                'qualification' => 'M.A. in English Literature',
                'specialization' => 'Creative Writing',
                'years_of_experience' => 12,
                'status' => 'active',
                'bio' => 'Experienced in teaching advanced writing and composition',
            ],
        ];

        foreach ($instructors as $instructor) {
            Instructor::create($instructor);
        }
    }
} 