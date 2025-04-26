@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Attendance Management</h1>
        <div class="flex gap-4">
            <a href="{{ route('attendances.report') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                View Reports
            </a>
            <a href="{{ route('attendances.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Mark Attendance
            </a>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <form action="{{ route('attendances.index') }}" method="GET" class="flex flex-wrap gap-4">
            <div class="w-48">
                <select name="course_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Courses</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                            {{ $course->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="w-48">
                <input type="date" name="date" value="{{ request('date') }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="w-48">
                <select name="status" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Status</option>
                    <option value="present" {{ request('status') == 'present' ? 'selected' : '' }}>Present</option>
                    <option value="absent" {{ request('status') == 'absent' ? 'selected' : '' }}>Absent</option>
                    <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>Late</option>
                </select>
            </div>
            <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Search
            </button>
        </form>
    </div>

    <!-- Attendance List -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Remarks</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($attendances as $attendance)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $attendance->date->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($attendance->student->profile_photo)
                                <img src="{{ Storage::url($attendance->student->profile_photo) }}" alt="{{ $attendance->student->name }}" 
                                    class="h-10 w-10 rounded-full object-cover mr-3">
                            @else
                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                    <span class="text-gray-500 text-sm">{{ substr($attendance->student->name, 0, 1) }}</span>
                                </div>
                            @endif
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $attendance->student->name }}</div>
                                <div class="text-sm text-gray-500">{{ $attendance->student->student_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $attendance->course->title }}</div>
                        <div class="text-sm text-gray-500">{{ $attendance->course->code }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $attendance->status == 'present' ? 'bg-green-100 text-green-800' : 
                               ($attendance->status == 'late' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                            {{ ucfirst($attendance->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $attendance->remarks ?? '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('attendances.edit', $attendance) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                        <form action="{{ route('attendances.destroy', $attendance) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" 
                                onclick="return confirm('Are you sure you want to delete this attendance record?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $attendances->links() }}
    </div>
</div>
@endsection 