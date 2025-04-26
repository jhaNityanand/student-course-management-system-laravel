@extends('layouts.app')

@section('title', 'Instructor Management')

@section('content')
<div class="card">
    <div class="card-header bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">Instructors</h5>
                <p class="text-muted mb-0">Manage instructor information and assignments</p>
            </div>
            <a href="{{ route('instructors.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> Add New Instructor
            </a>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="card-body border-bottom">
        <form action="{{ route('instructors.index') }}" method="GET" class="row g-3">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-light">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" 
                        class="form-control"
                        placeholder="Search by name or email">
                </div>
            </div>
            <div class="col-md-4">
                <select name="department" class="form-select">
                    <option value="">All Departments</option>
                    @foreach($departments as $id => $name)
                        <option value="{{ $id }}" {{ request('department') == $id ? 'selected' : '' }}>
                            {{ $name }}
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

    <!-- Instructors Table -->
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Instructor</th>
                    <th>Department</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Courses</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($instructors as $instructor)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                                    <i class="fas fa-chalkboard-teacher text-primary"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">{{ $instructor->first_name }} {{ $instructor->last_name }}</h6>
                                <small class="text-muted">{{ $instructor->title }}</small>
                            </div>
                        </div>
                    </td>
                    <td>{{ \App\Helpers\DepartmentHelper::getDepartmentName($instructor->department_id) }}</td>
                    <td>{{ $instructor->email }}</td>
                    <td>{{ $instructor->phone }}</td>
                    <td>
                        <span class="badge bg-info">{{ $instructor->courses_count }} Courses</span>
                    </td>
                    <td class="text-end">
                        <div class="btn-group">
                            <a href="{{ route('instructors.show', $instructor) }}" 
                                class="btn btn-sm btn-outline-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            &nbsp;
                            <a href="{{ route('instructors.edit', $instructor) }}" 
                                class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            &nbsp;
                            <form action="{{ route('instructors.destroy', $instructor) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Are you sure you want to delete this instructor?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <div class="text-muted">No instructors found</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="card-footer bg-white">
        {{ $instructors->links() }}
    </div>
</div>
@endsection 