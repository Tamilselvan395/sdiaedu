<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminRoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_developer_can_access_full_admin_panel(): void
    {
        $developer = User::factory()->developer()->create();

        $this->actingAs($developer)->get('/admin')->assertStatus(200);
        $this->actingAs($developer)->get('/admin/enquiries')->assertStatus(200);
        $this->actingAs($developer)->get('/admin/courses')->assertStatus(200);
        $this->actingAs($developer)->get('/admin/students')->assertStatus(200);
        $this->actingAs($developer)->get('/admin/users')->assertStatus(200);
        $this->actingAs($developer)->get('/admin/manage-academy-settings')->assertStatus(200);
    }

    public function test_super_admin_can_access_full_admin_panel(): void
    {
        $superAdmin = User::factory()->superAdmin()->create();

        $this->actingAs($superAdmin)->get('/admin')->assertStatus(200);
        $this->actingAs($superAdmin)->get('/admin/enquiries')->assertStatus(200);
        $this->actingAs($superAdmin)->get('/admin/courses')->assertStatus(200);
        $this->actingAs($superAdmin)->get('/admin/students')->assertStatus(200);
        $this->actingAs($superAdmin)->get('/admin/users')->assertStatus(200);
        $this->actingAs($superAdmin)->get('/admin/manage-academy-settings')->assertStatus(200);
    }

    public function test_admin_role_can_only_access_enquiries_and_is_forbidden_from_other_resources(): void
    {
        $admin = User::factory()->admin()->create();

        // Allowed
        $this->actingAs($admin)->get('/admin')->assertStatus(200);
        $this->actingAs($admin)->get('/admin/enquiries')->assertStatus(200);

        // Forbidden
        $this->actingAs($admin)->get('/admin/courses')->assertStatus(403);
        $this->actingAs($admin)->get('/admin/students')->assertStatus(403);
        $this->actingAs($admin)->get('/admin/users')->assertStatus(403);
        $this->actingAs($admin)->get('/admin/events')->assertStatus(403);
        $this->actingAs($admin)->get('/admin/certificates')->assertStatus(403);
        $this->actingAs($admin)->get('/admin/settings')->assertStatus(403);
        $this->actingAs($admin)->get('/admin/manage-academy-settings')->assertStatus(403);
        $this->actingAs($admin)->get('/admin/manage-page-seo-settings')->assertStatus(403);
    }

    public function test_user_seeder_creates_all_three_required_roles(): void
    {
        $this->seed(UserSeeder::class);

        $developer = User::where('email', 'developer@sdiaedu.com')->first();
        $this->assertNotNull($developer);
        $this->assertSame(UserRole::Developer, $developer->role);
        $this->assertTrue(Hash::check('sdia@8580', $developer->password));

        $superAdmin = User::where('email', 'superadmin@sdiaedu.com')->first();
        $this->assertNotNull($superAdmin);
        $this->assertSame(UserRole::SuperAdmin, $superAdmin->role);
        $this->assertTrue(Hash::check('sdia@8580', $superAdmin->password));

        $admin = User::where('email', 'admin@sdiaedu.com')->first();
        $this->assertNotNull($admin);
        $this->assertSame(UserRole::Admin, $admin->role);
        $this->assertTrue(Hash::check('sdia@8580', $admin->password));
    }
}
