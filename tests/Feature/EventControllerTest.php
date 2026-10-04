<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class EventControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_events_index_returns_200_and_displays_upcoming_and_past_events(): void
    {
        $upcoming = Event::create([
            'title' => 'National Vedic Math Championship 2026',
            'slug' => 'national-vedic-math-championship-2026',
            'short_description' => 'Fastest calculation competition.',
            'mode' => 'In-Person',
            'start_date' => now()->addDays(10),
            'end_date' => now()->addDays(10)->addHours(4),
            'registration_fee' => 250,
            'is_active' => true,
            'show_popup' => true,
        ]);

        $past = Event::create([
            'title' => 'Annual Robotics Exhibition 2025',
            'slug' => 'annual-robotics-exhibition-2025',
            'short_description' => 'Showcase of STEM robots.',
            'mode' => 'In-Person',
            'start_date' => now()->subMonths(2),
            'end_date' => now()->subMonths(2)->addHours(3),
            'registration_fee' => 0,
            'is_active' => true,
            'show_popup' => false,
        ]);

        $response = $this->get(route('events.index'));

        $response->assertStatus(200);
        $response->assertSee('National Vedic Math Championship 2026');
        $response->assertSee('Annual Robotics Exhibition 2025');
    }

    public function test_events_show_returns_200_and_structured_data_for_active_event(): void
    {
        $event = Event::create([
            'title' => 'Kids State Abacus Speed Championship',
            'slug' => 'kids-state-abacus-speed-championship',
            'short_description' => 'State level speed contest for mental math students.',
            'description' => 'Full event agenda with stages and rounds.',
            'mode' => 'In-Person',
            'location_name' => 'Koyambedu Campus Auditorium',
            'start_date' => now()->addDays(5),
            'end_date' => now()->addDays(5)->addHours(3),
            'registration_fee' => 350,
            'is_active' => true,
        ]);

        $response = $this->get(route('events.show', $event->slug));

        $response->assertStatus(200);
        $response->assertSee('Kids State Abacus Speed Championship');
        $response->assertSee('Koyambedu Campus Auditorium');
        $response->assertSee('https://schema.org', false);
    }

    public function test_events_show_returns_404_for_inactive_event(): void
    {
        $event = Event::create([
            'title' => 'Draft Secret Seminar',
            'slug' => 'draft-secret-seminar',
            'short_description' => 'Unpublished seminar.',
            'mode' => 'In-Person',
            'start_date' => now()->addDays(3),
            'is_active' => false,
        ]);

        $response = $this->get(route('events.show', $event->slug));

        $response->assertStatus(404);
    }

    public function test_popup_active_scope_excludes_past_or_disabled_events(): void
    {
        // Event 1: Active, popup enabled, but expired
        Event::create([
            'title' => 'Expired Yesterday Event',
            'slug' => 'expired-yesterday-event',
            'short_description' => 'Past event.',
            'mode' => 'In-Person',
            'start_date' => now()->subDays(2),
            'end_date' => now()->subDay(),
            'is_active' => true,
            'show_popup' => true,
        ]);

        // Event 2: Active, upcoming, but popup disabled
        Event::create([
            'title' => 'Upcoming Event Without Popup',
            'slug' => 'upcoming-event-without-popup',
            'short_description' => 'Upcoming event without popup.',
            'mode' => 'Live Online',
            'start_date' => now()->addDays(7),
            'end_date' => now()->addDays(7)->addHours(2),
            'is_active' => true,
            'show_popup' => false,
        ]);

        // Event 3: Upcoming, popup enabled, active
        $validPopupEvent = Event::create([
            'title' => 'Active Upcoming Popup Event',
            'slug' => 'active-upcoming-popup-event',
            'short_description' => 'This one must show in popup.',
            'mode' => 'Hybrid',
            'start_date' => now()->addDays(3),
            'end_date' => now()->addDays(3)->addHours(2),
            'is_active' => true,
            'show_popup' => true,
        ]);

        $activePopup = Event::popupActive()->first();

        $this->assertNotNull($activePopup);
        $this->assertEquals($validPopupEvent->id, $activePopup->id);
    }

    public function test_event_popup_renders_on_homepage_when_active_upcoming_event_exists(): void
    {
        Event::create([
            'title' => 'Mega STEM Robotics Challenge',
            'slug' => 'mega-stem-robotics-challenge',
            'short_description' => 'Build and race real robots.',
            'mode' => 'In-Person',
            'start_date' => now()->addDays(4),
            'end_date' => now()->addDays(4)->addHours(3),
            'is_active' => true,
            'show_popup' => true,
        ]);

        // Clear cache so View composer fetches newly created event
        Cache::flush();

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('Mega STEM Robotics Challenge');
        $response->assertSee('Upcoming Event');
    }

    public function test_event_popup_does_not_render_after_event_completes(): void
    {
        Event::create([
            'title' => 'Concluded Science Expo',
            'slug' => 'concluded-science-expo',
            'short_description' => 'Already finished event.',
            'mode' => 'In-Person',
            'start_date' => now()->subHours(5),
            'end_date' => now()->subHour(),
            'is_active' => true,
            'show_popup' => true,
        ]);

        Cache::flush();

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertDontSee('Concluded Science Expo');
    }
}
