<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    public function run(): void
    {
        $semesters = [
            [
                'name' => 'Spring 2024',
                'start_date' => '2024-01-15',
                'end_date' => '2024-05-15',
                'status' => 'active',
            ],
            [
                'name' => 'Summer 2024',
                'start_date' => '2024-06-01',
                'end_date' => '2024-08-15',
                'status' => 'upcoming',
            ],
            [
                'name' => 'Fall 2024',
                'start_date' => '2024-09-01',
                'end_date' => '2024-12-15',
                'status' => 'upcoming',
            ],
        ];

        foreach ($semesters as $semester) {
            Semester::create($semester);
        }
    }
} 