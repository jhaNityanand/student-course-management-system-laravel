@extends('layouts.app')

@section('title', 'Enrollment Management')

@section('content')
<div class="card">
    <div class="card-header bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">Enrollments</h5>
                <p class="text-muted mb-0">Manage student course enrollments</p>
            </div>
            <a href="{{ route('enrollments.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> New Enrollment
            </a>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="card-body border-bottom">
        <form action="{{ route('enrollments.index') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-light">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" 
                        class="form-control"
                        placeholder="Search by student or course">
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="dropped" {{ request('status') == 'dropped' ? 'selected' : '' }}>Dropped</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="semester" class="form-select">
                    <option value="">All Semesters</option>
                    @foreach($semesters as $semester)
                        <option value="{{ $semester->id }}" {{ request('semester') == $semester->id ? 'selected' : '' }}>
                            {{ $semester->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary w-100">
                    <i class="fas fa-filter me-2"></i> Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Enrollments Table -->
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Course</th>
                    <th>Instructor</th>
                    <th>Enrollment Date</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($enrollments as $enrollment)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                                    <i class="fas fa-user-graduate text-primary"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">{{ $enrollment->student->first_name }} {{ $enrollment->student->last_name }}</h6>
                                <small class="text-muted">{{ $enrollment->student->student_id }}</small>
                            </div>
                        </div>
                    </td>
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
                    <td class="text-end">
                        <div class="btn-group">
                            <a href="{{ route('enrollments.show', $enrollment) }}" 
                                class="btn btn-sm btn-outline-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            &nbsp;
                            <a href="{{ route('enrollments.edit', $enrollment) }}" 
                                class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            &nbsp;
                            <form action="{{ route('enrollments.destroy', $enrollment) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Are you sure you want to delete this enrollment?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="card-footer bg-white">
        {{ $enrollments->links() }}
    </div>
</div>
@endsection 