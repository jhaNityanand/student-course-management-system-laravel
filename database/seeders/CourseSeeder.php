<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'course_code' => 'CS101',
                'title' => 'Introduction to Computer Science',
                'description' => 'Basic concepts of computer science and programming',
                'credits' => 3,
                'duration_weeks' => 15,
                'fee' => 500.00,
                'level' => 'beginner',
                'status' => 'active',
            ],
            [
                'course_code' => 'MATH201',
                'title' => 'Advanced Mathematics',
                'description' => 'Advanced mathematical concepts and applications',
                'credits' => 4,
                'duration_weeks' => 15,
                'fee' => 600.00,
                'level' => 'intermediate',
                'status' => 'active',
            ],
            [
                'course_code' => 'ENG301',
                'title' => 'Advanced English Composition',
                'description' => 'Advanced writing and composition skills',
                'credits' => 3,
                'duration_weeks' => 15,
                'fee' => 550.00,
                'level' => 'advanced',
                'status' => 'active',
            ],
            [
                'course_code' => 'PHY101',
                'title' => 'Physics Fundamentals',
                'description' => 'Basic principles of physics',
                'credits' => 4,
                'duration_weeks' => 15,
                'fee' => 600.00,
                'level' => 'beginner',
                'status' => 'active',
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
} 