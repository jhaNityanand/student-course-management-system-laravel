@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Total Students</h6>
                            <h2 class="mt-2 mb-0">{{ $totalStudents ?? 0 }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="fas fa-user-graduate fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Total Courses</h6>
                            <h2 class="mt-2 mb-0">{{ $totalCourses ?? 0 }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="fas fa-book fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Total Instructors</h6>
                            <h2 class="mt-2 mb-0">{{ $totalInstructors ?? 0 }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="fas fa-chalkboard-teacher fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Active Enrollments</h6>
                            <h2 class="mt-2 mb-0">{{ $activeEnrollments ?? 0 }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="fas fa-graduation-cap fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities and Quick Actions -->
    <div class="row">
        <!-- Recent Enrollments -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Recent Enrollments</h5>
                    <a href="{{ route('enrollments.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body">
                    @if(isset($recentEnrollments) && $recentEnrollments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>Course</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentEnrollments as $enrollment)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                                        <i class="fas fa-user text-primary"></i>
                                                    </div>
                                                    <div>
                                                        {{ $enrollment->student->first_name }} {{ $enrollment->student->last_name }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $enrollment->course->title }}</td>
                                            <td>{{ $enrollment->enrollment_date->format('M d, Y') }}</td>
                                            <td>
                                                <span class="badge bg-{{ $enrollment->status === 'active' ? 'success' : ($enrollment->status === 'completed' ? 'info' : 'danger') }}">
                                                    {{ ucfirst($enrollment->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <div class="text-muted">No recent enrollments</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('students.create') }}" class="btn btn-outline-primary">
                            <i class="fas fa-user-plus me-2"></i> Add New Student
                        </a>
                        <a href="{{ route('courses.create') }}" class="btn btn-outline-success">
                            <i class="fas fa-plus-circle me-2"></i> Create New Course
                        </a>
                        <a href="{{ route('instructors.create') }}" class="btn btn-outline-info">
                            <i class="fas fa-user-tie me-2"></i> Add New Instructor
                        </a>
                        <a href="{{ route('enrollments.create') }}" class="btn btn-outline-warning">
                            <i class="fas fa-graduation-cap me-2"></i> New Enrollment
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
