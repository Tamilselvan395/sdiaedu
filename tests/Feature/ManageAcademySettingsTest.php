<?php

namespace Tests\Feature;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\Setting;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class ManageAcademySettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_admin_can_access_general_settings_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/manage-academy-settings');

        $response->assertStatus(200);
        $response->assertSee('Academy Settings');
    }

    public function test_settings_can_be_saved_and_reflected_globally(): void
    {
        Setting::updateOrCreate(['key' => 'academy_name'], ['value' => 'Old Academy Name']);

        Setting::updateOrCreate(['key' => 'academy_name'], ['value' => 'Sri Deekshaa International Academy']);
        Setting::updateOrCreate(['key' => 'phone'], ['value' => '+91 99999 88888']);
        Cache::forget('global_settings');

        $homepage = $this->get(route('home'));

        $homepage->assertStatus(200);
        $homepage->assertSee('+91 99999 88888');
    }

    public function test_authenticated_admin_can_access_certificate_edit_page(): void
    {
        $user = User::factory()->create();
        $student = Student::factory()->create();
        $course = Course::factory()->create();

        $certificate = Certificate::create([
            'certificate_number' => 'SDIA-2026-TEST-001',
            'student_id' => $student->id,
            'course_id' => $course->id,
            'issue_date' => now(),
            'subject_marks' => [
                ['subject' => 'Vedic Mathematics Level 1', 'obtained' => 95, 'maximum' => 100],
            ],
        ]);

        $response = $this->actingAs($user)->get("/admin/certificates/{$certificate->id}/edit");

        $response->assertStatus(200);
        $response->assertSee('Subject-Wise Marksheet');
        $response->assertSee('Vedic Mathematics Level 1');
    }

    public function test_certificate_number_is_auto_generated_when_left_empty(): void
    {
        $student = Student::factory()->create();
        $course = Course::factory()->create();

        $certificate = Certificate::create([
            'student_id' => $student->id,
            'course_id' => $course->id,
            'issue_date' => now(),
        ]);

        $this->assertNotEmpty($certificate->certificate_number);
        $this->assertMatchesRegularExpression('/^SDIA-\d{4}-[A-Z0-9]+-\d+$/', $certificate->certificate_number);

        $currentYear = date('Y');
        $abacusCourse = Course::factory()->create(['title' => 'Abacus Mental Arithmetic', 'slug' => 'abacus-maths']);
        $abacusCert = Certificate::create([
            'student_id' => $student->id,
            'course_id' => $abacusCourse->id,
            'issue_date' => now(),
        ]);
        $this->assertStringStartsWith("SDIA-{$currentYear}-", $abacusCert->certificate_number);
    }

    public function test_authenticated_admin_can_access_page_seo_settings_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/manage-page-seo-settings');

        $response->assertStatus(200);
        $response->assertSee('Page-Specific SEO Meta Tags');
    }
}
