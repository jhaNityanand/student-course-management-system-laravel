@extends('layouts.app')

@section('title', 'Instructor Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-4 mx-auto" style="width: 100px; height: 100px;">
                            <i class="fas fa-chalkboard-teacher text-primary fa-3x"></i>
                        </div>
                    </div>
                    <h4 class="mb-1">{{ $instructor->first_name }} {{ $instructor->last_name }}</h4>
                    <p class="text-muted mb-3">{{ $instructor->title }}</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('instructors.edit', $instructor) }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit me-2"></i> Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Contact Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted d-block">Email</label>
                        <span>{{ $instructor->email }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted d-block">Phone</label>
                        <span>{{ $instructor->phone }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted d-block">Department</label>
                        <span>{{ \App\Helpers\DepartmentHelper::getDepartmentName($instructor->department_id) }}</span>
                    </div>
                    <div>
                        <label class="text-muted d-block">Employee ID</label>
                        <span>{{ $instructor->employee_id }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Courses</h5>
                    <a href="{{ route('instructors.courses', $instructor) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus me-2"></i> Assign Course
                    </a>
                </div>
                <div class="card-body">
                    @if($instructor->courses->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Course Code</th>
                                        <th>Title</th>
                                        <th>Credits</th>
                                        <th>Level</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($instructor->courses as $course)
                                        <tr>
                                            <td>{{ $course->course_code }}</td>
                                            <td>{{ $course->title }}</td>
                                            <td>{{ $course->credits }}</td>
                                            <td>{{ ucfirst($course->level) }}</td>
                                            <td>
                                                <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-outline-primary">
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
                            <div class="text-muted">No courses assigned</div>
                        </div>
                    @endif
                </div>
            </div>

            @if($instructor->bio)
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Biography</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ $instructor->bio }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 