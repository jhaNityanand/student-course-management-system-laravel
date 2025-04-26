<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use App\Models\Semester;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    public function run(): void
    {
        // Get the active semester
        $semester = Semester::where('status', 'active')->first();

        if (!$semester) {
            $semester = Semester::create([
                'name' => 'Spring 2024',
                'start_date' => '2024-01-15',
                'end_date' => '2024-05-15',
                'status' => 'active',
            ]);
        }

        $enrollments = [
            [
                'student_id' => 1, // John Doe
                'course_id' => 1, // CS101
                'semester_id' => $semester->id,
                'enrollment_date' => '2024-01-15',
                'status' => 'active',
            ],
            [
                'student_id' => 1, // John Doe
                'course_id' => 2, // MATH201
                'semester_id' => $semester->id,
                'enrollment_date' => '2024-01-15',
                'status' => 'active',
            ],
            [
                'student_id' => 2, // Jane Smith
                'course_id' => 1, // CS101
                'semester_id' => $semester->id,
                'enrollment_date' => '2024-01-15',
                'status' => 'active',
            ],
            [
                'student_id' => 2, // Jane Smith
                'course_id' => 3, // ENG301
                'semester_id' => $semester->id,
                'enrollment_date' => '2024-01-15',
                'status' => 'active',
            ],
            [
                'student_id' => 3, // Michael Johnson
                'course_id' => 2, // MATH201
                'semester_id' => $semester->id,
                'enrollment_date' => '2024-01-15',
                'status' => 'active',
            ],
            [
                'student_id' => 3, // Michael Johnson
                'course_id' => 4, // PHY101
                'semester_id' => $semester->id,
                'enrollment_date' => '2024-01-15',
                'status' => 'active',
            ],
        ];

        foreach ($enrollments as $enrollment) {
            Enrollment::create($enrollment);
        }
    }
} 