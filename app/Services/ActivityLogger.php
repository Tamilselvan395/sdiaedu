<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLogger
{
    /**
     * Log a general or model action.
     */
    public static function log(
        string $action,
        string $description,
        ?Model $subject = null,
        ?array $properties = null,
        ?User $user = null
    ): ?ActivityLog {
        try {
            $user = $user ?? Auth::user();

            return ActivityLog::create([
                'user_id' => $user?->id,
                'user_name' => $user?->name,
                'user_email' => $user?->email,
                'user_role' => $user?->role?->value ?? ($user?->role ? (string) $user->role : null),
                'action' => $action,
                'description' => $description,
                'subject_type' => $subject ? get_class($subject) : null,
                'subject_id' => $subject?->getKey(),
                'ip_address' => Request::ip(),
                'user_agent' => Request::userAgent(),
                'properties' => $properties,
            ]);
        } catch (\Throwable $e) {
            report($e);

            return null;
        }
    }

    /**
     * Log an authentication event (login, logout, failed).
     */
    public static function logAuth(
        string $action,
        string $description,
        ?User $user = null,
        ?array $properties = null
    ): ?ActivityLog {
        return self::log($action, $description, $user, $properties, $user);
    }
}
