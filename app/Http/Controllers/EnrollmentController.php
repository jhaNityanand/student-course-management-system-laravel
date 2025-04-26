<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use App\Models\Semester;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Enrollment::with(['student', 'course', 'semester']);

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('student', function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('student_id', 'like', "%{$search}%");
            });
        }

        // Filter by course
        if ($request->has('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        // Filter by semester
        if ($request->has('semester_id')) {
            $query->where('semester_id', $request->semester_id);
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $enrollments = $query->paginate(10);
        $courses = Course::all();
        $semesters = Semester::all();

        return view('enrollments.index', compact('enrollments', 'courses', 'semesters'));
    }

    public function create()
    {
        $students = Student::all();
        $courses = Course::all();
        $semesters = Semester::all();
        return view('enrollments.create', compact('students', 'courses', 'semesters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'semester_id' => 'required|exists:semesters,id',
            'enrollment_date' => 'required|date',
            'status' => 'required|in:active,completed,dropped',
            'grade' => 'nullable|numeric|min:0|max:100',
            'notes' => 'nullable|string',
        ]);

        // Check if student is already enrolled in the course
        $existingEnrollment = Enrollment::where('student_id', $request->student_id)
            ->where('course_id', $request->course_id)
            ->where('status', 'active')
            ->first();

        if ($existingEnrollment) {
            return back()->with('error', 'Student is already enrolled in this course.');
        }

        Enrollment::create($request->all());

        return redirect()->route('enrollments.index')
            ->with('success', 'Enrollment created successfully.');
    }

    public function show(Enrollment $enrollment)
    {
        $enrollment->load(['student', 'course', 'semester']);
        return view('enrollments.show', compact('enrollment'));
    }

    public function edit(Enrollment $enrollment)
    {
        $students = Student::all();
        $courses = Course::all();
        $semesters = Semester::all();
        return view('enrollments.edit', compact('enrollment', 'students', 'courses', 'semesters'));
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'semester_id' => 'required|exists:semesters,id',
            'enrollment_date' => 'required|date',
            'status' => 'required|in:active,completed,dropped',
            'grade' => 'nullable|numeric|min:0|max:100',
            'notes' => 'nullable|string',
        ]);

        $enrollment->update($request->all());

        return redirect()->route('enrollments.index')
            ->with('success', 'Enrollment updated successfully.');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return redirect()->route('enrollments.index')
            ->with('success', 'Enrollment deleted successfully.');
    }
} 