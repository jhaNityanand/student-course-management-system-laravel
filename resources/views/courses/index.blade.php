@extends('layouts.app')

@section('title', 'Course Management')

@section('content')
<div class="card">
    <div class="card-header bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">Courses</h5>
                <p class="text-muted mb-0">Manage and organize your courses efficiently</p>
            </div>
            <a href="{{ route('courses.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> Add New Course
            </a>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="card-body border-bottom">
        <form action="{{ route('courses.index') }}" method="GET" class="row g-3">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-light">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" 
                        class="form-control"
                        placeholder="Search by title or code">
                </div>
            </div>
            <div class="col-md-4">
                <select name="instructor_id" class="form-select">
                    <option value="">All Instructors</option>
                    @foreach($instructors as $instructor)
                        <option value="{{ $instructor->id }}" {{ request('instructor_id') == $instructor->id ? 'selected' : '' }}>
                            {{ $instructor->first_name }} {{ $instructor->last_name }}
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

    <!-- Courses Table -->
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Instructor</th>
                    <th>Duration</th>
                    <th>Credits</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-primary bg-opacity-10 rounded p-2">
                                    <i class="fas fa-book text-primary"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">{{ $course->title }}</h6>
                                <small class="text-muted">{{ $course->course_code }}</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-secondary bg-opacity-10 rounded-circle p-2">
                                    <i class="fas fa-user-tie text-secondary"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                @if($course->primary_instructor)
                                    {{ $course->primary_instructor->first_name }} {{ $course->primary_instructor->last_name }}
                                @else
                                    <span class="text-muted">Not Assigned</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td>{{ $course->duration_weeks }} weeks</td>
                    <td>{{ $course->credits }}</td>
                    <td>
                        <span class="badge {{ $course->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($course->status) }}
                        </span>
                    </td>
                    <td class="text-end">
                        <div class="btn-group">
                            <a href="{{ route('courses.edit', $course) }}" 
                                class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            &nbsp;
                            <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Are you sure you want to delete this course?')">
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
        {{ $courses->links() }}
    </div>
</div>
@endsection 