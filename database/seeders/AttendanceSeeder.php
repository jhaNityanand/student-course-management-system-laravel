<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        $attendances = [
            // CS101 Attendance Records
            [
                'student_id' => 1, // John Doe
                'course_id' => 1, // CS101
                'date' => '2024-01-15',
                'status' => 'present',
                'remarks' => 'On time',
            ],
            [
                'student_id' => 2, // Jane Smith
                'course_id' => 1, // CS101
                'date' => '2024-01-15',
                'status' => 'present',
                'remarks' => 'On time',
            ],
            [
                'student_id' => 1, // John Doe
                'course_id' => 1, // CS101
                'date' => '2024-01-22',
                'status' => 'late',
                'remarks' => 'Arrived 15 minutes late',
            ],
            [
                'student_id' => 2, // Jane Smith
                'course_id' => 1, // CS101
                'date' => '2024-01-22',
                'status' => 'absent',
                'remarks' => 'Informed absence',
            ],

            // MATH201 Attendance Records
            [
                'student_id' => 1, // John Doe
                'course_id' => 2, // MATH201
                'date' => '2024-01-16',
                'status' => 'present',
                'remarks' => 'On time',
            ],
            [
                'student_id' => 3, // Michael Johnson
                'course_id' => 2, // MATH201
                'date' => '2024-01-16',
                'status' => 'present',
                'remarks' => 'On time',
            ],

            // ENG301 Attendance Records
            [
                'student_id' => 2, // Jane Smith
                'course_id' => 3, // ENG301
                'date' => '2024-01-17',
                'status' => 'present',
                'remarks' => 'On time',
            ],

            // PHY101 Attendance Records
            [
                'student_id' => 3, // Michael Johnson
                'course_id' => 4, // PHY101
                'date' => '2024-01-18',
                'status' => 'present',
                'remarks' => 'On time',
            ],
        ];

        foreach ($attendances as $attendance) {
            Attendance::create($attendance);
        }
    }
} 