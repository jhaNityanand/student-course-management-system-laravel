@extends('layouts.app')

@section('title', 'Add New Course')

@section('content')
<div class="card">
    <div class="card-header bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">Add New Course</h5>
                <p class="text-muted mb-0">Create a new course record</p>
            </div>
            <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i> Back to List
            </a>
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('courses.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-8">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="title" class="form-label">Course Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="course_code" class="form-label">Course Code</label>
                            <input type="text" class="form-control @error('course_code') is-invalid @enderror" 
                                id="course_code" name="course_code" value="{{ old('course_code') }}" required>
                            @error('course_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="duration_weeks" class="form-label">Duration (Weeks)</label>
                            <input type="number" class="form-control @error('duration_weeks') is-invalid @enderror" 
                                id="duration_weeks" name="duration_weeks" value="{{ old('duration_weeks') }}" min="1" required>
                            @error('duration_weeks')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="credits" class="form-label">Credits</label>
                            <input type="number" class="form-control @error('credits') is-invalid @enderror" 
                                id="credits" name="credits" value="{{ old('credits') }}" min="1" required>
                            @error('credits')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="fee" class="form-label">Course Fee</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control @error('fee') is-invalid @enderror" 
                                    id="fee" name="fee" value="{{ old('fee') }}" min="0" step="0.01" required>
                            </div>
                            @error('fee')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="level" class="form-label">Level</label>
                            <select class="form-select @error('level') is-invalid @enderror" 
                                id="level" name="level" required>
                                <option value="">Select Level</option>
                                <option value="beginner" {{ old('level') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                <option value="intermediate" {{ old('level') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="advanced" {{ old('level') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                            </select>
                            @error('level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                id="status" name="status" required>
                                <option value="">Select Status</option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                id="description" name="description" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title mb-3">Course Details</h6>
                            
                            <div class="mb-3">
                                <label for="instructor_id" class="form-label">Primary Instructor</label>
                                <select class="form-select @error('instructor_id') is-invalid @enderror" 
                                    id="instructor_id" name="instructor_id" required>
                                    <option value="">Select Instructor</option>
                                    @foreach($instructors as $instructor)
                                        <option value="{{ $instructor->id }}" {{ old('instructor_id') == $instructor->id ? 'selected' : '' }}>
                                            {{ $instructor->first_name }} {{ $instructor->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('instructor_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="syllabus" class="form-label">Syllabus</label>
                                <textarea class="form-control @error('syllabus') is-invalid @enderror" 
                                    id="syllabus" name="syllabus" rows="4">{{ old('syllabus') }}</textarea>
                                @error('syllabus')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i> Save Course
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 