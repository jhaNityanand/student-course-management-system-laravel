<?php

namespace App\Helpers;

class DepartmentHelper
{
    public static function getDepartments()
    {
        return [
            '1' => 'Computer Science',
            '2' => 'Mathematics',
            '3' => 'Physics',
            '4' => 'Chemistry',
            '5' => 'Biology',
            '6' => 'Engineering',
            '7' => 'Business Administration',
            '8' => 'Economics',
            '9' => 'Psychology',
            '10' => 'English Literature'
        ];
    }

    public static function getDepartmentName($id)
    {
        $departments = self::getDepartments();
        return $departments[$id] ?? 'Not Assigned';
    }
} 