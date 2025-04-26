@extends('layouts.app')

@section('title', 'Student Management')

@section('content')
<div class="card">
    <div class="card-header bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">Students</h5>
                <p class="text-muted mb-0">Manage student information and records</p>
            </div>
            <a href="{{ route('students.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> Add New Student
            </a>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="card-body border-bottom">
        <form action="{{ route('students.index') }}" method="GET" class="row g-3">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-light">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" 
                        class="form-control"
                        placeholder="Search by name, email or ID">
                </div>
            </div>
            <div class="col-md-4">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary w-100">
                    <i class="fas fa-filter me-2"></i> Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Students Table -->
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                                    <i class="fas fa-user-graduate text-primary"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">{{ $student->first_name }} {{ $student->last_name }}</h6>
                                <small class="text-muted">{{ $student->date_of_birth->format('M d, Y') }}</small>
                            </div>
                        </div>
                    </td>
                    <td>{{ $student->student_id }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>
                        <span class="badge {{ $student->is_active == '1' ? 'bg-success' : 'bg-secondary' }}">
                            {{ $student->is_active == '1' ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="text-end">
                        <div class="btn-group">
                            <a href="{{ route('students.show', $student) }}" 
                                class="btn btn-sm btn-outline-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            &nbsp;
                            <a href="{{ route('students.edit', $student) }}" 
                                class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            &nbsp;
                            <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Are you sure you want to delete this student?')">
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
        {{ $students->links() }}
    </div>
</div>
@endsection 