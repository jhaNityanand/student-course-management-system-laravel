@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Instructor Courses</h1>
            <p class="text-gray-600 mt-1">{{ $instructor->name }}'s Assigned Courses</p>
        </div>
        <a href="{{ route('instructors.index') }}" class="text-gray-600 hover:text-gray-900">
            Back to Instructors
        </a>
    </div>

    <!-- Courses List -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Credits</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enrolled Students</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($courses as $course)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $course->code }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $course->title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $course->duration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $course->credits }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('courses.show', $course) }}" class="text-blue-600 hover:text-blue-900">
                            {{ $course->enrollments_count ?? 0 }} Students
                        </a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('courses.edit', $course) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                        <a href="{{ route('courses.show', $course) }}" class="text-blue-600 hover:text-blue-900">View Details</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $courses->links() }}
    </div>
</div>
@endsection 