<?php

namespace App\Filament\Concerns;

use App\Models\User;

trait RequiresFullAccess
{
    /**
     * Determine if the user can access this resource or page.
     * Only users with Developer or Super Admin roles can access.
     */
    public static function canAccess(): bool
    {
        /** @var User|null $user */
        $user = auth()->user();

        return $user instanceof User && $user->hasFullAccess();
    }

    /**
     * Determine if the user can view any records for this resource.
     */
    public static function canViewAny(): bool
    {
        return static::canAccess();
    }
}
