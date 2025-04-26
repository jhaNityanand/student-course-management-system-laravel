<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Course;
use App\Helpers\DepartmentHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class InstructorController extends Controller
{
    public function index(Request $request)
    {
        $query = Instructor::withCount('courses');

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by department
        if ($request->has('department')) {
            $query->where('department_id', $request->department);
        }

        $instructors = $query->paginate(10);
        $departments = DepartmentHelper::getDepartments();
        return view('instructors.index', compact('instructors', 'departments'));
    }

    public function create()
    {
        $departments = DepartmentHelper::getDepartments();
        return view('instructors.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:instructors',
            'phone' => 'nullable|string|max:20',
            'title' => 'required|string|max:255',
            'department_id' => 'required|string',
            'specialization' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('instructor-photos', 'public');
            $data['profile_photo'] = $path;
        }

        Instructor::create($data);

        return redirect()->route('instructors.index')
            ->with('success', 'Instructor created successfully.');
    }

    public function edit(Instructor $instructor)
    {
        $departments = DepartmentHelper::getDepartments();
        return view('instructors.edit', compact('instructor', 'departments'));
    }

    public function update(Request $request, Instructor $instructor)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:instructors,email,' . $instructor->id,
            'phone' => 'nullable|string|max:20',
            'title' => 'required|string|max:255',
            'department_id' => 'required|string',
            'specialization' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($instructor->profile_photo) {
                Storage::disk('public')->delete($instructor->profile_photo);
            }
            $path = $request->file('profile_photo')->store('instructor-photos', 'public');
            $data['profile_photo'] = $path;
        }

        $instructor->update($data);

        return redirect()->route('instructors.index')
            ->with('success', 'Instructor updated successfully.');
    }

    public function destroy(Instructor $instructor)
    {
        if ($instructor->profile_photo) {
            Storage::disk('public')->delete($instructor->profile_photo);
        }
        
        $instructor->delete();

        return redirect()->route('instructors.index')
            ->with('success', 'Instructor deleted successfully.');
    }

    public function courses(Instructor $instructor)
    {
        $courses = $instructor->courses()->paginate(10);
        return view('instructors.courses', compact('instructor', 'courses'));
    }

    public function show(Instructor $instructor)
    {
        $instructor->load(['courses']);
        return view('instructors.show', compact('instructor'));
    }
} 