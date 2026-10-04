<?php

namespace Tests\Feature;

use App\Enums\EnquiryStatus;
use App\Models\Course;
use App\Models\Enquiry;
use App\Services\Tracking\GoogleAdsOfflineConversionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnquiryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_enquiry_store_creates_enquiry_and_redirects_back(): void
    {
        $course = Course::factory()->create();

        $data = [
            'parent_name' => 'Lakshmi Narayanan',
            'student_name' => 'Aarav Narayanan',
            'phone' => '9876543210',
            'email' => 'lakshmi@example.com',
            'student_age' => 8,
            'course_id' => $course->id,
            'mode_preference' => 'In-Person',
            'notes' => 'Looking for weekend batch.',
            'source' => 'Website Form',
        ];

        $response = $this->from(route('home'))->post(route('enquiries.store'), $data);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('enquiries', [
            'parent_name' => 'Lakshmi Narayanan',
            'student_name' => 'Aarav Narayanan',
            'phone' => '9876543210',
            'email' => 'lakshmi@example.com',
            'course_id' => $course->id,
            'status' => EnquiryStatus::New->value,
        ]);
    }

    public function test_enquiry_store_returns_json_response_when_json_requested(): void
    {
        $data = [
            'parent_name' => 'Suresh Kumar',
            'student_name' => 'Diya Suresh',
            'phone' => '9123456780',
            'email' => 'suresh@example.com',
        ];

        $response = $this->postJson(route('enquiries.store'), $data);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);
        $response->assertJsonPath('data.parent_name', 'Suresh Kumar');
    }

    public function test_enquiry_store_validates_required_fields(): void
    {
        $response = $this->postJson(route('enquiries.store'), []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['parent_name', 'student_name', 'phone']);
    }

    public function test_enquiry_store_validates_course_existence(): void
    {
        $data = [
            'parent_name' => 'Ramesh',
            'student_name' => 'Ananya',
            'phone' => '9876500000',
            'course_id' => 999999,
        ];

        $response = $this->postJson(route('enquiries.store'), $data);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['course_id']);
    }

    public function test_enquiry_store_saves_utm_parameters(): void
    {
        $data = [
            'parent_name' => 'Kavitha',
            'student_name' => 'Meera',
            'phone' => '9845012345',
        ];

        $response = $this->post(route('enquiries.store', [
            'utm_source' => 'google_ads',
            'utm_medium' => 'cpc',
            'utm_campaign' => 'summer_camp_2026',
        ]), $data);

        $this->assertDatabaseHas('enquiries', [
            'parent_name' => 'Kavitha',
            'utm_source' => 'google_ads',
            'utm_medium' => 'cpc',
            'utm_campaign' => 'summer_camp_2026',
        ]);
    }

    public function test_attribution_middleware_captures_and_passes_to_enquiry(): void
    {
        // 1. Visitor arrives on website with UTMs and Click IDs
        $this->get(route('home', [
            'utm_source' => 'instagram_ads',
            'utm_medium' => 'paid_social',
            'utm_campaign' => 'abacus_champion_2026',
            'gclid' => 'gclid_xyz_789',
            'fbclid' => 'fbclid_abc_123',
            'msclkid' => 'msclkid_bing_456',
        ]))->assertOk();

        // 2. Later, visitor submits enquiry without repeating UTMs in form
        $data = [
            'parent_name' => 'Priya Raman',
            'student_name' => 'Anand Raman',
            'phone' => '9840112233',
            'email' => 'priya.raman@example.com',
        ];

        $response = $this->post(route('enquiries.store'), $data);
        $response->assertSessionHas('tracking_lead');

        $this->assertDatabaseHas('enquiries', [
            'parent_name' => 'Priya Raman',
            'phone' => '9840112233',
            'utm_source' => 'instagram_ads',
            'utm_medium' => 'paid_social',
            'utm_campaign' => 'abacus_champion_2026',
            'gclid' => 'gclid_xyz_789',
            'fbclid' => 'fbclid_abc_123',
            'msclkid' => 'msclkid_bing_456',
        ]);
    }

    public function test_google_ads_offline_conversion_csv_export(): void
    {
        Enquiry::create([
            'parent_name' => 'Karthik',
            'student_name' => 'Aditya',
            'phone' => '9884012345',
            'status' => EnquiryStatus::Admitted->value,
            'gclid' => 'test_gclid_offline_conversion',
        ]);

        $csv = GoogleAdsOfflineConversionService::generateCsv();

        $this->assertStringContainsString('Google Click ID', $csv);
        $this->assertStringContainsString('Conversion Name', $csv);
        $this->assertStringContainsString('test_gclid_offline_conversion', $csv);
    }
}
