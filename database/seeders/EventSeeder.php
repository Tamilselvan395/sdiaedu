<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Flagship Upcoming Event (With Popup Enabled)
        Event::updateOrCreate(
            ['slug' => 'all-india-abacus-vedic-maths-championship-2026'],
            [
                'title' => 'All-India Abacus & Speed Vedic Mathematics Championship 2026',
                'slug' => 'all-india-abacus-vedic-maths-championship-2026',
                'short_description' => 'Annual national mental arithmetic championship for young learners. Compete across 5 age categories, win trophies, merit certificates, and cash scholarships!',
                'description' => "Sri Deekshaa International Academy proudly announces the **All-India Abacus & Speed Vedic Mathematics Championship 2026**!\n\nThis prestigious annual olympiad brings together over 1,500+ student finalists from across Tamil Nadu, Karnataka, Andhra Pradesh, and global online cohorts.\n\n### Competition Categories:\n- **Sub-Junior (Ages 5-7):** Direct Soroban bead calculation drills\n- **Junior (Ages 8-10):** Complement addition, subtraction & Anzan mental visualization\n- **Senior (Ages 11-13):** Multi-digit speed arithmetic & mental multiplication\n- **Super-Senior (Ages 14-17):** Advanced Vedic mathematics formulas & algebra shortcuts\n\n### Participant Takeaways:\n- Government-recognized ISO 9001 certified participation & merit credentials\n- Trophy & medal presentations for top 3 rankers in each category\n- Educational kits, abacus scorecards & individual performance analysis for parents\n- Free counseling session on accelerated competitive test prep",
                'start_date' => now()->addDays(12)->setTime(9, 30),
                'end_date' => now()->addDays(12)->setTime(16, 30),
                'mode' => 'Hybrid',
                'location_name' => 'Main Campus Auditorium, Chennai & Live Zoom Webcast',
                'location_address' => 'Sri Deekshaa International Academy, Grand Southern Trunk Rd, Tambaram / Velachery, Chennai, Tamil Nadu',
                'registration_fee' => 0.00,
                'registration_url' => null,
                'cta_button_text' => 'Register for Championship',
                'is_active' => true,
                'show_popup' => true,
                'sort_order' => 1,
                'meta_title' => 'All-India Abacus & Speed Vedic Math Championship 2026 | Sri Deekshaa',
                'meta_description' => 'Join 1,500+ participants in Chennai & Online for the annual Abacus and Vedic Maths Championship. Register for free.',
            ]
        );

        // 2. Upcoming STEM & Robotics Boot Camp
        Event::updateOrCreate(
            ['slug' => 'hands-on-robotics-and-ai-weekend-hackathon'],
            [
                'title' => 'Hands-on Robotics & AI Explorer Bootcamp for Kids & Teens',
                'slug' => 'hands-on-robotics-and-ai-weekend-hackathon',
                'short_description' => 'A thrilling 2-day immersive workshop where students assemble microcontrollers, wire ultrasonic sensors, and program their first autonomous obstacle-avoiding bot.',
                'description' => "Introduce your child to the cutting edge of modern engineering through our weekend **Robotics & AI Explorer Bootcamp**.\n\nParticipants will receive their own Arduino/ESP32 hardware experimentation kit, working in small pairs under senior robotics engineers.\n\n### What Students Build:\n- Autonomous obstacle-detecting robot car\n- Smart room light sensor with IoT controls\n- Python algorithmic logic for robot pathfinding\n\nNo prior coding experience is required. All hardware components are provided for the workshop.",
                'start_date' => now()->addDays(20)->setTime(10, 0),
                'end_date' => now()->addDays(21)->setTime(14, 0),
                'mode' => 'In-Person',
                'location_name' => 'Sri Deekshaa STEM Lab, Chennai Campus',
                'location_address' => 'Sri Deekshaa International Academy, Chennai, Tamil Nadu',
                'registration_fee' => 499.00,
                'registration_url' => null,
                'cta_button_text' => 'Reserve Bootcamp Seat',
                'is_active' => true,
                'show_popup' => false,
                'sort_order' => 2,
                'meta_title' => 'Robotics & AI Bootcamp for Kids | Sri Deekshaa International Academy',
                'meta_description' => 'Hands-on hardware and Python robotics workshop for students ages 8-16 in Chennai. Register today.',
            ]
        );

        // 3. Past Completed Event (To showcase archive and verify popup exclusion)
        Event::updateOrCreate(
            ['slug' => 'state-level-calligraphy-and-drawing-expo-2025'],
            [
                'title' => 'State-Level Fine Arts, Calligraphy & Creative Drawing Expo',
                'slug' => 'state-level-calligraphy-and-drawing-expo-2025',
                'short_description' => 'Exhibition and masterclass honoring over 400+ student artists across Tamil Nadu with master painters and calligraphy artists.',
                'description' => 'Our annual winter art gala showcased extraordinary canvas paintings, pencil shading portraits, and English/Tamil calligraphy work created by students of Sri Deekshaa International Academy.',
                'start_date' => now()->subMonths(2)->setTime(10, 0),
                'end_date' => now()->subMonths(2)->setTime(18, 0),
                'mode' => 'In-Person',
                'location_name' => 'Kala Academy Hall, Chennai',
                'location_address' => 'Chennai, Tamil Nadu',
                'registration_fee' => 0.00,
                'registration_url' => null,
                'cta_button_text' => 'View Expo Highlights',
                'is_active' => true,
                'show_popup' => true, // Notice: show_popup is true, but event is in the past! So popup automatically hides!
                'sort_order' => 3,
                'meta_title' => 'State-Level Fine Arts Expo | Sri Deekshaa Archive',
                'meta_description' => 'Highlights and student showcase from the State-Level Fine Arts & Calligraphy Expo.',
            ]
        );
    }
}
