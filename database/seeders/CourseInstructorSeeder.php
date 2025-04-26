<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseInstructorSeeder extends Seeder
{
    public function run(): void
    {
        $courseInstructors = [
            [
                'course_id' => 1, // CS101
                'instructor_id' => 1, // Robert Williams
                'role' => 'primary',
            ],
            [
                'course_id' => 2, // MATH201
                'instructor_id' => 2, // Sarah Brown
                'role' => 'primary',
            ],
            [
                'course_id' => 3, // ENG301
                'instructor_id' => 3, // David Miller
                'role' => 'primary',
            ],
            [
                'course_id' => 4, // PHY101
                'instructor_id' => 1, // Robert Williams
                'role' => 'primary',
            ],
            [
                'course_id' => 1, // CS101
                'instructor_id' => 2, // Sarah Brown
                'role' => 'secondary',
            ],
        ];

        foreach ($courseInstructors as $courseInstructor) {
            DB::table('course_instructor')->insert($courseInstructor);
        }
    }
} 