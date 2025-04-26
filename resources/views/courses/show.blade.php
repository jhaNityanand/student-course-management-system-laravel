@extends('layouts.app')

@section('title', 'Course Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-4 mx-auto" style="width: 100px; height: 100px;">
                            <i class="fas fa-book text-primary fa-3x"></i>
                        </div>
                    </div>
                    <h4 class="mb-1">{{ $course->title }}</h4>
                    <p class="text-muted mb-3">{{ $course->course_code }}</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('courses.edit', $course) }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit me-2"></i> Edit Course
                        </a>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Course Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted d-block">Department</label>
                        <span>{{ \App\Helpers\DepartmentHelper::getDepartmentName($course->department_id) }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted d-block">Instructor</label>
                        <span>
                            @if($course->instructors->isNotEmpty())
                                {{ $course->instructors->first()->first_name }} {{ $course->instructors->first()->last_name }}
                            @else
                                Not Assigned
                            @endif
                        </span>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted d-block">Credits</label>
                        <span>{{ $course->credits }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted d-block">Duration</label>
                        <span>{{ $course->duration_weeks }} weeks</span>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted d-block">Fee</label>
                        <span>${{ number_format($course->fee, 2) }}</span>
                    </div>
                    <div>
                        <label class="text-muted d-block">Level</label>
                        <span class="text-capitalize">{{ $course->level }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Enrolled Students</h5>
                    <a href="{{ route('enrollments.create', ['course_id' => $course->id]) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus me-2"></i> Enroll Student
                    </a>
                </div>
                <div class="card-body">
                    @if($course->enrollments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>Student ID</th>
                                        <th>Enrollment Date</th>
                                        <th>Status</th>
                                        <th>Grade</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($course->enrollments as $enrollment)
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
                                            <td>{{ $enrollment->student->student_id }}</td>
                                            <td>{{ $enrollment->enrollment_date->format('M d, Y') }}</td>
                                            <td>
                                                <span class="badge bg-{{ $enrollment->status === 'active' ? 'success' : ($enrollment->status === 'completed' ? 'info' : 'danger') }}">
                                                    {{ ucfirst($enrollment->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $enrollment->grade ? number_format($enrollment->grade, 2) : 'Not Graded' }}</td>
                                            <td>
                                                <a href="{{ route('enrollments.show', $enrollment) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <div class="text-muted">No students enrolled</div>
                        </div>
                    @endif
                </div>
            </div>

            @if($course->description)
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Course Description</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ $course->description }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 