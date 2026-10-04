<?php

namespace App\Enums;

enum CourseMode: string
{
    case InPerson = 'In-Person';
    case Online = 'Online';
    case Hybrid = 'Hybrid';

    public function label(): string
    {
        return match ($this) {
            self::InPerson => 'In-Person Academy',
            self::Online => 'Live Interactive Online',
            self::Hybrid => 'Hybrid (Online + In-Person)',
        };
    }
}
