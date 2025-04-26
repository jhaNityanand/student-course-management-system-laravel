<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'description',
        'status',
    ];

    public function instructors()
    {
        return $this->hasMany(Instructor::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
} 