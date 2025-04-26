<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with(['student', 'course']);

        // Filter by course
        if ($request->has('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        // Filter by date
        if ($request->has('date')) {
            $query->whereDate('date', $request->date);
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $attendances = $query->paginate(10);
        $courses = Course::all();

        return view('attendances.index', compact('attendances', 'courses'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('attendances.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'date' => 'required|date',
            'attendance_data' => 'required|array',
            'attendance_data.*.student_id' => 'required|exists:students,id',
            'attendance_data.*.status' => 'required|in:present,absent,late',
            'attendance_data.*.remarks' => 'nullable|string|max:255',
        ]);

        foreach ($request->attendance_data as $data) {
            Attendance::create([
                'course_id' => $request->course_id,
                'student_id' => $data['student_id'],
                'date' => $request->date,
                'status' => $data['status'],
                'remarks' => $data['remarks'] ?? null,
            ]);
        }

        return redirect()->route('attendances.index')
            ->with('success', 'Attendance marked successfully.');
    }

    public function edit(Attendance $attendance)
    {
        return view('attendances.edit', compact('attendance'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'status' => 'required|in:present,absent,late',
            'remarks' => 'nullable|string|max:255',
        ]);

        $attendance->update($request->all());

        return redirect()->route('attendances.index')
            ->with('success', 'Attendance updated successfully.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('attendances.index')
            ->with('success', 'Attendance record deleted successfully.');
    }

    public function report(Request $request)
    {
        $query = Attendance::with(['student', 'course']);

        // Filter by course
        if ($request->has('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        // Filter by date range
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        // Filter by student
        if ($request->has('student_id')) {
            $query->where('student_id', $request->student_id);
        }

        $attendances = $query->get();
        $courses = Course::all();
        $students = Student::all();

        // Calculate attendance statistics
        $stats = [
            'total' => $attendances->count(),
            'present' => $attendances->where('status', 'present')->count(),
            'absent' => $attendances->where('status', 'absent')->count(),
            'late' => $attendances->where('status', 'late')->count(),
        ];

        return view('attendances.report', compact('attendances', 'courses', 'students', 'stats'));
    }

    public function getStudentsByCourse(Course $course)
    {
        $students = $course->enrollments()
            ->where('status', 'active')
            ->with('student')
            ->get()
            ->pluck('student');

        return response()->json($students);
    }
} 