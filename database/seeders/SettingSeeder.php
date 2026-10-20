<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General
            ['group' => 'general', 'key' => 'academy_name', 'value' => 'Sri Deekshaa International Academy', 'type' => 'text', 'description' => 'Official Academy Name'],
            ['group' => 'general', 'key' => 'tagline', 'value' => 'Learn Today. Grow Tomorrow.', 'type' => 'text', 'description' => 'Brand Tagline'],
            ['group' => 'general', 'key' => 'announcement_bar', 'value' => 'Admissions Open for New Term | Book a Free Counselling & Assessment Session', 'type' => 'text', 'description' => 'Top Bar Announcement'],
            ['group' => 'general', 'key' => 'email', 'value' => 'info@srideekshaa.com', 'type' => 'text', 'description' => 'Official Email'],
            ['group' => 'general', 'key' => 'phone', 'value' => '+91 98765 43210', 'type' => 'text', 'description' => 'Primary Contact Phone'],
            ['group' => 'general', 'key' => 'phone_secondary', 'value' => '+91 93446 20346', 'type' => 'text', 'description' => 'Secondary / Counseling Desk Phone'],
            ['group' => 'general', 'key' => 'whatsapp_number', 'value' => '919876543210', 'type' => 'text', 'description' => 'WhatsApp Number (with country code, no symbols)'],
            ['group' => 'general', 'key' => 'whatsapp_default_message', 'value' => 'Hello Sri Deekshaa International Academy, I would like to know more about your courses.', 'type' => 'text', 'description' => 'Default WhatsApp Greeting'],

            // Statistics (CMS-driven, as requested)
            ['group' => 'stats', 'key' => 'stat_students', 'value' => '2,500+', 'type' => 'text', 'description' => 'Learners Enrolled (Demo Value)'],
            ['group' => 'stats', 'key' => 'stat_courses', 'value' => '25+', 'type' => 'text', 'description' => 'Certified Courses Offered'],
            ['group' => 'stats', 'key' => 'stat_faculty', 'value' => '35+', 'type' => 'text', 'description' => 'Experienced Mentors'],
            ['group' => 'stats', 'key' => 'stat_years', 'value' => '8+', 'type' => 'text', 'description' => 'Years of Learning Excellence'],

            // Contact & Location
            ['group' => 'contact', 'key' => 'address', 'value' => 'Plot No. 42, 2nd Avenue, Sri Deekshaa Learning Campus', 'type' => 'text', 'description' => 'Campus Street Address'],
            ['group' => 'contact', 'key' => 'city', 'value' => 'Chennai', 'type' => 'text', 'description' => 'City'],
            ['group' => 'contact', 'key' => 'state', 'value' => 'Tamil Nadu', 'type' => 'text', 'description' => 'State'],
            ['group' => 'contact', 'key' => 'country', 'value' => 'India', 'type' => 'text', 'description' => 'Country'],
            ['group' => 'contact', 'key' => 'pincode', 'value' => '600040', 'type' => 'text', 'description' => 'Pincode'],
            ['group' => 'contact', 'key' => 'working_hours', 'value' => 'Monday - Saturday: 9:00 AM - 7:30 PM | Sunday: 9:00 AM - 1:30 PM', 'type' => 'text', 'description' => 'Academy Working Hours'],
            ['group' => 'contact', 'key' => 'map_embed_url', 'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3886.007604313204!2d80.20!3d13.08!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTPCsDA0JzQ4LjAiTiA4MMKwMTInMDAuMCJF!5e0!3m2!1sen!2sin!4v1600000000000', 'type' => 'text', 'description' => 'Google Map Embed URL'],

            // Social Media
            ['group' => 'social', 'key' => 'facebook_url', 'value' => 'https://facebook.com/srideekshaaacademy', 'type' => 'text', 'description' => 'Facebook Page'],
            ['group' => 'social', 'key' => 'instagram_url', 'value' => 'https://instagram.com/srideekshaa_academy', 'type' => 'text', 'description' => 'Instagram Handle'],
            ['group' => 'social', 'key' => 'youtube_url', 'value' => 'https://youtube.com/@srideekshaaacademy', 'type' => 'text', 'description' => 'YouTube Channel'],
            ['group' => 'social', 'key' => 'linkedin_url', 'value' => 'https://linkedin.com/company/srideekshaa-academy', 'type' => 'text', 'description' => 'LinkedIn Page'],

            // SEO Defaults
            ['group' => 'seo', 'key' => 'meta_title_default', 'value' => 'Sri Deekshaa International Academy | Skill-Based Learning & Holistic Education', 'type' => 'text', 'description' => 'Global Default Meta Title'],
            ['group' => 'seo', 'key' => 'meta_description_default', 'value' => 'Explore skill-based learning programs designed to build confidence, creativity, academic speed, communication, and future-ready capabilities for kids, students, and professionals.', 'type' => 'text', 'description' => 'Global Default Meta Description'],

            // Marketing & Analytics
            ['group' => 'marketing', 'key' => 'google_analytics_id', 'value' => 'G-DEMO12345', 'type' => 'text', 'description' => 'Google Analytics 4 Measurement ID'],
            ['group' => 'marketing', 'key' => 'google_tag_manager_id', 'value' => 'GTM-DEMO123', 'type' => 'text', 'description' => 'Google Tag Manager Container ID'],
            ['group' => 'marketing', 'key' => 'meta_pixel_id', 'value' => '123456789012345', 'type' => 'text', 'description' => 'Meta (Facebook) Pixel ID'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
