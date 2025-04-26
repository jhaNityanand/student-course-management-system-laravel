<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\InstructorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Student Management Routes
    Route::resource('students', StudentController::class);
    Route::get('students/{student}/enrollments', [StudentController::class, 'enrollments'])->name('students.enrollments');

    // Course Management Routes
    Route::resource('courses', CourseController::class);

    // Enrollment Management Routes
    Route::resource('enrollments', EnrollmentController::class);

    // Instructor Management Routes
    Route::resource('instructors', InstructorController::class);
    Route::get('instructors/{instructor}/courses', [InstructorController::class, 'courses'])->name('instructors.courses');

    // Course Enrollment Routes
    Route::get('/courses/{course}/enrollments/create', [App\Http\Controllers\EnrollmentController::class, 'create'])->name('courses.enrollments.create');
    Route::post('/courses/{course}/enrollments', [App\Http\Controllers\EnrollmentController::class, 'store'])->name('courses.enrollments.store');
});

require __DIR__.'/auth.php';
