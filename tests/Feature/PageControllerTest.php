<?php

namespace Tests\Feature;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\Location;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_about_page_returns_ok_and_shows_active_teachers(): void
    {
        Teacher::factory()->create([
            'first_name' => 'Kalaivani',
            'last_name' => 'S',
            'status' => 'Active',
        ]);

        $response = $this->get(route('pages.about'));

        $response->assertStatus(200);
        $response->assertSee('Kalaivani');
    }

    public function test_contact_page_returns_ok_and_shows_locations(): void
    {
        Location::factory()->create([
            'name' => 'Sri Deekshaa Coimbatore Main',
            'is_active' => true,
        ]);

        $response = $this->get(route('pages.contact'));

        $response->assertStatus(200);
        $response->assertSee('Sri Deekshaa Coimbatore Main');
    }

    public function test_for_kids_page_returns_ok_and_shows_kids_courses(): void
    {
        Course::factory()->create([
            'title' => 'Little Maestros Music Foundation',
            'age_min' => 5,
            'age_max' => 8,
            'is_active' => true,
        ]);

        $response = $this->get(route('pages.for-kids'));

        $response->assertStatus(200);
        $response->assertSee('Little Maestros Music Foundation');
    }

    public function test_for_teens_page_returns_ok_and_shows_teens_courses(): void
    {
        Course::factory()->create([
            'title' => 'Teens Acoustic Guitar & Bass',
            'age_min' => 12,
            'age_max' => 17,
            'is_active' => true,
        ]);

        $response = $this->get(route('pages.for-teens'));

        $response->assertStatus(200);
        $response->assertSee('Teens Acoustic Guitar & Bass');
    }

    public function test_skill_assessment_page_returns_ok(): void
    {
        $response = $this->get(route('pages.assessment'));

        $response->assertStatus(200);
    }

    public function test_verify_certificate_page_renders_cleanly_without_query(): void
    {
        $response = $this->get(route('pages.verify-certificate'));

        $response->assertStatus(200);
        $response->assertSee('Verify Certificate');
    }

    public function test_verify_certificate_finds_valid_certificate(): void
    {
        $certificate = Certificate::factory()->create([
            'certificate_number' => 'SDIA-2026-98765',
        ]);

        $response = $this->get(route('pages.verify-certificate', [
            'certificate_number' => 'SDIA-2026-98765',
        ]));

        $response->assertRedirect(route('pages.verify-certificate.result', [
            'certificate_number' => 'SDIA-2026-98765',
        ]));

        $followed = $this->followingRedirects()->get(route('pages.verify-certificate', [
            'certificate_number' => 'SDIA-2026-98765',
        ]));

        $followed->assertStatus(200);
        $followed->assertSee('SDIA-2026-98765');
        $followed->assertSee($certificate->student->first_name);
        $followed->assertSee($certificate->static_course_title);
    }

    public function test_verify_certificate_shows_not_found_for_invalid_number(): void
    {
        $response = $this->followingRedirects()->get(route('pages.verify-certificate', [
            'certificate_number' => 'NON-EXISTENT-CODE',
        ]));

        $response->assertStatus(200);
        $response->assertSee('Certificate Not Found');
    }

    public function test_verify_certificate_result_route_renders_expected_marksheet(): void
    {
        $certificate = Certificate::factory()->create([
            'certificate_number' => 'SMTCERCD26737',
            'exam_session' => 'JULY 2026',
            'total_marks' => '627 / 700',
            'percentage' => '90%',
            'division' => 'Distinction',
            'result_status' => 'PASSED',
        ]);

        $response = $this->get(route('pages.verify-certificate.result', [
            'certificate_number' => 'SMTCERCD26737',
        ]));

        $response->assertStatus(200);
        $response->assertSee('Certificate Verification Results');
        $response->assertSee('Enrollment Number:');
        $response->assertSee('SMTCERCD26737');
        $response->assertSee('EXAMINATION RESULT');
        $response->assertSee('JULY 2026');
        $response->assertSee('627 / 700');
        $response->assertSee('90%');
        $response->assertSee('PASSED');
        $response->assertSee('Back to Search');
        $response->assertSee('Print Certificate');
    }

    public function test_verify_certificate_query_param_renders_abacus_marksheet(): void
    {
        $certificate = Certificate::factory()->create([
            'certificate_number' => 'SDIA-2024-ABACUS-001',
            'exam_session' => 'NOVEMBER 2024',
            'total_marks' => '482 / 500',
            'percentage' => '96%',
            'division' => 'Distinction',
            'result_status' => 'PASSED',
        ]);

        $response = $this->followingRedirects()->get('/verify-certificate?certificate_number=SDIA-2024-ABACUS-001');

        $response->assertStatus(200);
        $response->assertSee('Certificate Verification Results');
        $response->assertSee('SDIA-2024-ABACUS-001');
        $response->assertSee('EXAMINATION RESULT');
        $response->assertSee('NOVEMBER 2024');
        $response->assertSee('482 / 500');
        $response->assertSee('96%');
        $response->assertSee('PASSED');
        $response->assertSee('Print Certificate');
    }

    public function test_verify_certificate_print_route_renders_printable_document(): void
    {
        $certificate = Certificate::factory()->create([
            'certificate_number' => 'SDIA-2024-ABACUS-001',
            'exam_session' => 'NOVEMBER 2024',
            'total_marks' => '482 / 500',
            'percentage' => '96%',
        ]);

        $response = $this->get(route('pages.verify-certificate.print', [
            'certificate_number' => 'SDIA-2024-ABACUS-001',
        ]));

        $response->assertStatus(200);
        $response->assertSee('SDIA-2024-ABACUS-001');
        $response->assertSee('EXAMINATION RESULT');
        $response->assertSee('Verified');
    }

    public function test_franchise_page_returns_ok_and_shows_address_map_and_form(): void
    {
        $location = Location::factory()->create([
            'name' => 'Sri Deekshaa Coimbatore Center',
            'franchise_id' => 'SDIA-F-0003/2026',
            'city' => 'Coimbatore',
            'state' => 'Tamil Nadu',
            'address' => '54, DB Road, RS Puram',
            'pincode' => '641002',
            'phone' => '+91 98765 43212',
            'email' => 'coimbatore@srideekshaa.com',
            'map_embed_url' => 'https://maps.google.com/maps?q=RS+Puram+Coimbatore&t=&z=14&ie=UTF8&iwloc=&output=embed',
            'is_active' => true,
        ]);

        // Default view: shows verification form only (no cards)
        $response = $this->get(route('pages.franchise'));
        $response->assertStatus(200);
        $response->assertSee('Verify Franchise Partner');
        $response->assertSee('Enter Franchise Identification Number');
        $response->assertDontSee('54, DB Road, RS Puram');

        // Submitting Franchise ID: shows certificate and contact/address details below
        $searchResponse = $this->get(route('pages.franchise', ['franchise_id' => 'SDIA-F-0003/2026']));
        $searchResponse->assertStatus(200);
        $searchResponse->assertSee('Franchise Partner Verification Results');
        $searchResponse->assertSee('Sri Deekshaa Coimbatore Center');
        $searchResponse->assertSee('SDIA-F-0003/2026');
        $searchResponse->assertSee('54, DB Road, RS Puram');
        $searchResponse->assertSee('641002');
        $searchResponse->assertSee('+91 98765 43212');
        $searchResponse->assertSee('coimbatore@srideekshaa.com');
        $searchResponse->assertSee('https://maps.google.com/maps?q=RS+Puram+Coimbatore');
    }

    public function test_franchise_enquiry_submission_stores_enquiry(): void
    {
        $payload = [
            'parent_name' => 'Dr. R. Vignesh',
            'student_name' => 'Franchise Applicant',
            'phone' => '+91 9988776655',
            'email' => 'vignesh@example.com',
            'mode_preference' => 'Tiruchirappalli',
            'notes' => 'Have 1,500 sq ft space ready for academy center.',
            'source' => 'Franchise Enquiry Page',
        ];

        $response = $this->post(route('enquiries.store'), $payload);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('enquiries', [
            'parent_name' => 'Dr. R. Vignesh',
            'phone' => '+91 9988776655',
            'email' => 'vignesh@example.com',
            'source' => 'Franchise Enquiry Page',
        ]);
    }
}
