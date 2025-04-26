@extends('layouts.app')

@section('title', 'Student Details')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                @if($student->profile_photo)
                    <img src="{{ Storage::url($student->profile_photo) }}" alt="Profile Photo" 
                        class="rounded-circle img-thumbnail mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                @else
                    <div class="bg-primary bg-opacity-10 rounded-circle p-4 mx-auto mb-3" style="width: 150px; height: 150px;">
                        <i class="fas fa-user-graduate text-primary fa-4x"></i>
                    </div>
                @endif
                <h4 class="mb-1">{{ $student->first_name }} {{ $student->last_name }}</h4>
                <p class="text-muted mb-3">{{ $student->student_id }}</p>
                <div class="d-grid gap-2">
                    <a href="{{ route('students.edit', $student) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i> Edit Profile
                    </a>
                    <a href="{{ route('students.enrollments', $student) }}" class="btn btn-outline-primary">
                        <i class="fas fa-book me-2"></i> View Enrollments
                    </a>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h6 class="card-title mb-3">Contact Information</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="fas fa-envelope text-muted me-2"></i>
                        {{ $student->email }}
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-phone text-muted me-2"></i>
                        {{ $student->phone ?? 'Not provided' }}
                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt text-muted me-2"></i>
                        {{ $student->address ?? 'Not provided' }}
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Student Information</h5>
                    <span class="badge {{ $student->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                        {{ ucfirst($student->status) }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">Personal Information</h6>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <tr>
                                        <th class="text-muted">Date of Birth</th>
                                        <td>{{ $student->date_of_birth->format('M d, Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Gender</th>
                                        <td>{{ ucfirst($student->gender) }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Age</th>
                                        <td>{{ $student->date_of_birth->age }} years</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">Academic Information</h6>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <tr>
                                        <th class="text-muted">Student ID</th>
                                        <td>{{ $student->student_id }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Enrollment Date</th>
                                        <td>{{ $student->created_at->format('M d, Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Last Updated</th>
                                        <td>{{ $student->updated_at->format('M d, Y') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <h6 class="text-muted mb-3">Current Enrollments</h6>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Instructor</th>
                                    <th>Enrollment Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($student->enrollments as $enrollment)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="bg-info bg-opacity-10 rounded-circle p-2">
                                                    <i class="fas fa-book text-info"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-0">{{ $enrollment->course->title }}</h6>
                                                <small class="text-muted">{{ $enrollment->course->course_code }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="bg-success bg-opacity-10 rounded-circle p-2">
                                                    <i class="fas fa-chalkboard-teacher text-success"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-0">{{ $enrollment->course->primary_instructor->first_name }} {{ $enrollment->course->primary_instructor->last_name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $enrollment->enrollment_date->format('M d, Y') }}</td>
                                    <td>
                                        <span class="badge {{ $enrollment->status === 'active' ? 'bg-success' : ($enrollment->status === 'completed' ? 'bg-info' : 'bg-danger') }}">
                                            {{ ucfirst($enrollment->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No active enrollments</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 