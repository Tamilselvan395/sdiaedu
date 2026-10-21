<?php

namespace App\Enums;

enum UserRole: string
{
    case Developer = 'developer';
    case SuperAdmin = 'super_admin';
    case Admin = 'admin';

    public function label(): string
    {
        return match ($this) {
            self::Developer => 'Developer',
            self::SuperAdmin => 'Super Admin',
            self::Admin => 'Admin (Enquiries Only)',
        };
    }

    public function hasFullAccess(): bool
    {
        return in_array($this, [self::Developer, self::SuperAdmin], true);
    }

    public function canAccessEnquiriesOnly(): bool
    {
        return $this === self::Admin;
    }
}
