<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Instructor;
use App\Helpers\DepartmentHelper;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::with('instructors');

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('course_code', 'like', "%{$search}%");
            });
        }

        // Filter by instructor
        if ($request->has('instructor_id')) {
            $query->whereHas('instructors', function($q) use ($request) {
                $q->where('instructors.id', $request->instructor_id);
            });
        }

        $courses = $query->paginate(10);
        $instructors = Instructor::all();
        $departments = DepartmentHelper::getDepartments();

        return view('courses.index', compact('courses', 'instructors', 'departments'));
    }

    public function create()
    {
        $instructors = Instructor::all();
        $departments = DepartmentHelper::getDepartments();
        return view('courses.create', compact('instructors', 'departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_code' => 'required|string|max:50|unique:courses',
            'duration_weeks' => 'required|integer|min:1',
            'credits' => 'required|integer|min:1',
            'fee' => 'required|numeric|min:0',
            'level' => 'required|string',
            'status' => 'required|string',
            'instructor_id' => 'required|exists:instructors,id',
            'department_id' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $course = Course::create($request->except('instructor_id'));
        
        // Attach the instructor as primary
        $course->instructors()->attach($request->instructor_id, ['role' => 'primary']);

        return redirect()->route('courses.index')
            ->with('success', 'Course created successfully.');
    }

    public function edit(Course $course)
    {
        $instructors = Instructor::all();
        $departments = DepartmentHelper::getDepartments();
        return view('courses.edit', compact('course', 'instructors', 'departments'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_code' => 'required|string|max:50|unique:courses,course_code,' . $course->id,
            'duration_weeks' => 'required|integer|min:1',
            'credits' => 'required|integer|min:1',
            'fee' => 'required|numeric|min:0',
            'level' => 'required|string',
            'status' => 'required|string',
            'instructor_id' => 'required|exists:instructors,id',
            'department_id' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $course->update($request->except('instructor_id'));
        
        // Update the primary instructor
        $course->instructors()->sync([$request->instructor_id => ['role' => 'primary']]);

        return redirect()->route('courses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')
            ->with('success', 'Course deleted successfully.');
    }

    public function show(Course $course)
    {
        $course->load(['instructors', 'enrollments.student']);
        return view('courses.show', compact('course'));
    }
} 