<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\ActivityLog;
use App\Models\CourseCategory;
use App\Models\User;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserActivityLogTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_developer_can_access_activity_logs_page(): void
    {
        $developer = User::factory()->developer()->create();
        $superAdmin = User::factory()->superAdmin()->create();
        $admin = User::factory()->admin()->create();

        // Developer has access
        $this->actingAs($developer)
            ->get('/admin/activity-logs')
            ->assertStatus(200);

        // Super Admin is forbidden
        $this->actingAs($superAdmin)
            ->get('/admin/activity-logs')
            ->assertStatus(403);

        // Admin is forbidden
        $this->actingAs($admin)
            ->get('/admin/activity-logs')
            ->assertStatus(403);

        // Guest is redirected
        auth()->logout();
        $this->get('/admin/activity-logs')
            ->assertRedirect('/admin/login');
    }

    public function test_login_and_logout_events_are_logged(): void
    {
        $user = User::factory()->superAdmin()->create([
            'name' => 'John Doe',
            'email' => 'john@sdiaedu.com',
        ]);

        event(new Login('web', $user, false));

        $loginLog = ActivityLog::where('action', 'login')->first();
        $this->assertNotNull($loginLog);
        $this->assertSame($user->id, $loginLog->user_id);
        $this->assertSame('John Doe', $loginLog->user_name);
        $this->assertSame('john@sdiaedu.com', $loginLog->user_email);
        $this->assertSame(UserRole::SuperAdmin->value, $loginLog->user_role);

        event(new Logout('web', $user));

        $logoutLog = ActivityLog::where('action', 'logout')->first();
        $this->assertNotNull($logoutLog);
        $this->assertSame($user->id, $logoutLog->user_id);
        $this->assertStringContainsString('logged out', $logoutLog->description);
    }

    public function test_failed_login_event_is_logged(): void
    {
        event(new Failed('web', null, ['email' => 'intruder@example.com', 'password' => 'wrong']));

        $failedLog = ActivityLog::where('action', 'failed_login')->first();
        $this->assertNotNull($failedLog);
        $this->assertStringContainsString('intruder@example.com', $failedLog->description);
        $this->assertSame('intruder@example.com', $failedLog->properties['attempted_email']);
    }

    public function test_model_mutations_by_authenticated_user_are_audited(): void
    {
        $user = User::factory()->superAdmin()->create([
            'name' => 'Admin User',
            'email' => 'admin@sdiaedu.com',
        ]);

        $this->actingAs($user);

        $category = CourseCategory::create([
            'name' => 'Vedic Mathematics',
            'slug' => 'vedic-mathematics',
            'is_active' => true,
        ]);

        $createLog = ActivityLog::where('action', 'created')
            ->where('subject_type', CourseCategory::class)
            ->where('subject_id', $category->id)
            ->first();

        $this->assertNotNull($createLog);
        $this->assertSame($user->id, $createLog->user_id);
        $this->assertStringContainsString('Vedic Mathematics', $createLog->description);

        $category->update(['name' => 'Advanced Vedic Mathematics']);

        $updateLog = ActivityLog::where('action', 'updated')
            ->where('subject_type', CourseCategory::class)
            ->where('subject_id', $category->id)
            ->first();

        $this->assertNotNull($updateLog);
        $this->assertSame('Advanced Vedic Mathematics', $updateLog->properties['changes']['name'] ?? null);
    }

    public function test_developer_can_render_view_form_with_string_or_carbon_timestamp(): void
    {
        $developer = User::factory()->developer()->create();

        $log = ActivityLog::create([
            'user_id' => $developer->id,
            'user_name' => $developer->name,
            'user_email' => $developer->email,
            'user_role' => $developer->role->value,
            'action' => 'login',
            'description' => 'Test log description',
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0',
            'properties' => ['foo' => 'bar'],
        ]);

        $this->actingAs($developer)
            ->get('/admin/activity-logs')
            ->assertStatus(200)
            ->assertSee('Test log description');
    }
}
