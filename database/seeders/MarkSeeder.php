<?php

namespace Database\Seeders;

use App\Models\Mark;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Database\Seeder;

class MarkSeeder extends Seeder
{
    public function run(): void
    {
        $marks = [
            // CS101 Marks
            [
                'student_id' => 1, // John Doe
                'course_id' => 1, // CS101
                'assessment_type' => 'quiz',
                'marks_obtained' => 85,
                'total_marks' => 100,
                'grade' => 'A',
                'remarks' => 'Good performance',
            ],
            [
                'student_id' => 1, // John Doe
                'course_id' => 1, // CS101
                'assessment_type' => 'assignment',
                'marks_obtained' => 90,
                'total_marks' => 100,
                'grade' => 'A+',
                'remarks' => 'Excellent work',
            ],
            [
                'student_id' => 2, // Jane Smith
                'course_id' => 1, // CS101
                'assessment_type' => 'quiz',
                'marks_obtained' => 78,
                'total_marks' => 100,
                'grade' => 'B+',
                'remarks' => 'Good effort',
            ],

            // MATH201 Marks
            [
                'student_id' => 1, // John Doe
                'course_id' => 2, // MATH201
                'assessment_type' => 'midterm',
                'marks_obtained' => 92,
                'total_marks' => 100,
                'grade' => 'A+',
                'remarks' => 'Outstanding performance',
            ],
            [
                'student_id' => 3, // Michael Johnson
                'course_id' => 2, // MATH201
                'assessment_type' => 'midterm',
                'marks_obtained' => 88,
                'total_marks' => 100,
                'grade' => 'A',
                'remarks' => 'Very good',
            ],

            // ENG301 Marks
            [
                'student_id' => 2, // Jane Smith
                'course_id' => 3, // ENG301
                'assessment_type' => 'essay',
                'marks_obtained' => 95,
                'total_marks' => 100,
                'grade' => 'A+',
                'remarks' => 'Excellent writing skills',
            ],

            // PHY101 Marks
            [
                'student_id' => 3, // Michael Johnson
                'course_id' => 4, // PHY101
                'assessment_type' => 'lab',
                'marks_obtained' => 85,
                'total_marks' => 100,
                'grade' => 'A',
                'remarks' => 'Good practical work',
            ],
        ];

        foreach ($marks as $mark) {
            Mark::create($mark);
        }
    }
} 