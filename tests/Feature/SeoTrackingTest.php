<?php

namespace Tests\Feature;

use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class SeoTrackingTest extends TestCase
{
    use RefreshDatabase;

    public function test_sitemap_xml_contains_franchise_and_core_urls(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/xml; charset=UTF-8');
        $content = $response->getContent();

        $this->assertStringContainsString(route('home'), $content);
        $this->assertStringContainsString(route('courses.index'), $content);
        $this->assertStringContainsString(route('pages.franchise'), $content);
        $this->assertStringContainsString(route('pages.assessment'), $content);
    }

    public function test_custom_404_page_renders_with_tracking_script(): void
    {
        $response = $this->get('/non-existent-course-page-slug-404');

        $response->assertStatus(404);
        $response->assertSee('Page Not Found (404)');
        $response->assertSee('page_not_found');
        $response->assertSee('noindex, follow');
    }

    public function test_tracking_scripts_render_when_settings_configured(): void
    {
        Cache::forget('global_settings');
        Setting::updateOrCreate(['key' => 'google_analytics_id'], ['value' => 'G-TEST12345']);
        Setting::updateOrCreate(['key' => 'google_tag_manager_id'], ['value' => 'GTM-TEST999']);
        Setting::updateOrCreate(['key' => 'meta_pixel_id'], ['value' => '1234567890']);
        Setting::updateOrCreate(['key' => 'microsoft_clarity_id'], ['value' => 'claritytest123']);
        Setting::updateOrCreate(['key' => 'google_search_console_token'], ['value' => 'gsc_token_xyz']);
        Setting::updateOrCreate(['key' => 'bing_webmaster_token'], ['value' => 'bing_token_abc']);
        Setting::updateOrCreate(['key' => 'enable_consent_mode'], ['value' => '1']);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('G-TEST12345');
        $response->assertSee('GTM-TEST999');
        $response->assertSee('1234567890');
        $response->assertSee('claritytest123');
        $response->assertSee('gsc_token_xyz');
        $response->assertSee('bing_token_abc');
        $response->assertSee('sdiaConsentDefaults');
        $response->assertSee('Your Privacy & Cookie Choices', false);
    }

    public function test_page_specific_seo_meta_tags_rendered_from_admin_settings(): void
    {
        Cache::forget('global_settings');
        Setting::updateOrCreate(['key' => 'seo_home_title'], ['value' => 'Custom Home Title | Sri Deekshaa']);
        Setting::updateOrCreate(['key' => 'seo_home_description'], ['value' => 'Custom Home Meta Description for testing.']);
        Setting::updateOrCreate(['key' => 'seo_about_title'], ['value' => 'Custom About Title | Sri Deekshaa']);
        Setting::updateOrCreate(['key' => 'seo_about_description'], ['value' => 'Custom About Meta Description for testing.']);
        Setting::updateOrCreate(['key' => 'seo_contact_title'], ['value' => 'Custom Contact Title | Sri Deekshaa']);
        Setting::updateOrCreate(['key' => 'seo_contact_description'], ['value' => 'Custom Contact Meta Description for testing.']);
        Setting::updateOrCreate(['key' => 'seo_courses_title'], ['value' => 'Custom Courses Title | Sri Deekshaa']);
        Setting::updateOrCreate(['key' => 'seo_courses_description'], ['value' => 'Custom Courses Meta Description for testing.']);
        Setting::updateOrCreate(['key' => 'seo_events_title'], ['value' => 'Custom Events Title | Sri Deekshaa']);
        Setting::updateOrCreate(['key' => 'seo_events_description'], ['value' => 'Custom Events Meta Description for testing.']);
        Setting::updateOrCreate(['key' => 'seo_blog_title'], ['value' => 'Custom Blog Title | Sri Deekshaa']);
        Setting::updateOrCreate(['key' => 'seo_blog_description'], ['value' => 'Custom Blog Meta Description for testing.']);
        Setting::updateOrCreate(['key' => 'seo_franchise_title'], ['value' => 'Custom Franchise Title | Sri Deekshaa']);
        Setting::updateOrCreate(['key' => 'seo_franchise_description'], ['value' => 'Custom Franchise Meta Description for testing.']);

        // Home
        $res = $this->get(route('home'));
        $res->assertOk();
        $res->assertSee('Custom Home Title | Sri Deekshaa');
        $res->assertSee('Custom Home Meta Description for testing.');

        // About
        $res = $this->get(route('pages.about'));
        $res->assertOk();
        $res->assertSee('Custom About Title | Sri Deekshaa');
        $res->assertSee('Custom About Meta Description for testing.');

        // Contact
        $res = $this->get(route('pages.contact'));
        $res->assertOk();
        $res->assertSee('Custom Contact Title | Sri Deekshaa');
        $res->assertSee('Custom Contact Meta Description for testing.');

        // Courses
        $res = $this->get(route('courses.index'));
        $res->assertOk();
        $res->assertSee('Custom Courses Title | Sri Deekshaa');
        $res->assertSee('Custom Courses Meta Description for testing.');

        // Events
        $res = $this->get(route('events.index'));
        $res->assertOk();
        $res->assertSee('Custom Events Title | Sri Deekshaa');
        $res->assertSee('Custom Events Meta Description for testing.');

        // Blog
        $res = $this->get(route('blog.index'));
        $res->assertOk();
        $res->assertSee('Custom Blog Title | Sri Deekshaa');
        $res->assertSee('Custom Blog Meta Description for testing.');

        // Franchise
        $res = $this->get(route('pages.franchise'));
        $res->assertOk();
        $res->assertSee('Custom Franchise Title | Sri Deekshaa');
        $res->assertSee('Custom Franchise Meta Description for testing.');
    }
}
