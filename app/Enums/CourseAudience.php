<?php

namespace App\Enums;

enum CourseAudience: string
{
    case Student = 'student';
    case Teacher = 'teacher';
    case Both = 'both';

    public function label(): string
    {
        return match ($this) {
            self::Student => 'Students',
            self::Teacher => 'Teachers (Teacher Training)',
            self::Both => 'Both (Students & Teachers)',
        };
    }
}
