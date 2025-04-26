<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalStudents' => Student::count(),
            'totalCourses' => Course::count(),
            'totalInstructors' => Instructor::count(),
            'activeEnrollments' => Enrollment::where('status', 'active')->count(),
            'recentEnrollments' => Enrollment::with(['student', 'course'])
                ->latest()
                ->take(5)
                ->get()
        ];

        return view('dashboard', $data);
    }
} 