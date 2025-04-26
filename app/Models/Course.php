<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'course_code',
        'title',
        'description',
        'credits',
        'duration_weeks',
        'fee',
        'level',
        'status',
    ];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments')
            ->withPivot('enrollment_date', 'completion_date', 'status', 'grade')
            ->withTimestamps();
    }

    public function instructors()
    {
        return $this->belongsToMany(Instructor::class, 'course_instructor')
            ->withPivot('role')
            ->withTimestamps();
    }

    // Helper method to get the primary instructor
    public function getPrimaryInstructorAttribute()
    {
        return $this->instructors()->wherePivot('role', 'primary')->first();
    }
}
