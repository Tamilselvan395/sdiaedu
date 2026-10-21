<?php

namespace App\Listeners;

use App\Models\User;
use App\Services\ActivityLogger;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

class LogAuthenticationActivity
{
    /**
     * Handle user login.
     */
    public function handleLogin(Login $event): void
    {
        $user = $event->user;

        if ($user instanceof User) {
            ActivityLogger::logAuth(
                action: 'login',
                description: "{$user->name} ({$user->email}) logged in",
                user: $user,
                properties: [
                    'guard' => $event->guard,
                    'role' => $user->role?->value,
                ]
            );
        }
    }

    /**
     * Handle user logout.
     */
    public function handleLogout(Logout $event): void
    {
        $user = $event->user;

        if ($user instanceof User) {
            ActivityLogger::logAuth(
                action: 'logout',
                description: "{$user->name} ({$user->email}) logged out",
                user: $user,
                properties: [
                    'guard' => $event->guard,
                    'role' => $user->role?->value,
                ]
            );
        }
    }

    /**
     * Handle failed login attempt.
     */
    public function handleFailed(Failed $event): void
    {
        $email = $event->credentials['email'] ?? 'Unknown email';
        $user = $event->user instanceof User ? $event->user : null;

        ActivityLogger::logAuth(
            action: 'failed_login',
            description: "Failed login attempt for {$email}",
            user: $user,
            properties: [
                'attempted_email' => $email,
                'guard' => $event->guard,
            ]
        );
    }

    /**
     * Register listeners for subscriber.
     *
     * @return array<string, string>
     */
    public function subscribe(): array
    {
        return [
            Login::class => 'handleLogin',
            Logout::class => 'handleLogout',
            Failed::class => 'handleFailed',
        ];
    }
}
