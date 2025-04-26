@extends('layouts.app')

@section('title', 'Enrollment Details')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body text-center">
                <div class="mb-3">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-4 mx-auto" style="width: 100px; height: 100px;">
                        <i class="fas fa-user-graduate text-primary fa-3x"></i>
                    </div>
                </div>
                <h4 class="mb-1">{{ $enrollment->student->first_name }} {{ $enrollment->student->last_name }}</h4>
                <p class="text-muted mb-3">{{ $enrollment->student->student_id }}</p>
                <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('students.show', $enrollment->student) }}" class="btn btn-outline-primary">
                        <i class="fas fa-user me-2"></i> View Student
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
                    <label class="text-muted d-block">Course Title</label>
                    <span>{{ $enrollment->course->title }}</span>
                </div>
                <div class="mb-3">
                    <label class="text-muted d-block">Course Code</label>
                    <span>{{ $enrollment->course->course_code }}</span>
                </div>
                <div class="mb-3">
                    <label class="text-muted d-block">Credits</label>
                    <span>{{ $enrollment->course->credits }}</span>
                </div>
                <div>
                    <label class="text-muted d-block">Level</label>
                    <span class="text-capitalize">{{ $enrollment->course->level }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Enrollment Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted d-block">Enrollment Date</label>
                        <span>{{ $enrollment->enrollment_date->format('M d, Y') }}</span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted d-block">Semester</label>
                        <span>{{ $enrollment->semester->name }}</span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted d-block">Status</label>
                        <span class="badge bg-{{ $enrollment->status === 'active' ? 'success' : ($enrollment->status === 'completed' ? 'info' : 'danger') }}">
                            {{ ucfirst($enrollment->status) }}
                        </span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted d-block">Grade</label>
                        <span>{{ $enrollment->grade ? number_format($enrollment->grade, 2) : 'Not Graded' }}</span>
                    </div>
                </div>

                @if($enrollment->notes)
                    <div class="mt-4">
                        <label class="text-muted d-block mb-2">Notes</label>
                        <p class="mb-0">{{ $enrollment->notes }}</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-flex gap-2">
                    <a href="{{ route('enrollments.edit', $enrollment) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i> Edit Enrollment
                    </a>
                    <form action="{{ route('enrollments.destroy', $enrollment) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this enrollment?')">
                            <i class="fas fa-trash-alt me-2"></i> Delete Enrollment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 