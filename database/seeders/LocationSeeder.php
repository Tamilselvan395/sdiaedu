<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds for franchise centers and branches.
     */
    public function run(): void
    {
        $centers = [
            [
                'name' => 'JP ACADEMY',
                'slug' => 'jp-academy',
                'franchise_id' => 'SDIA-F-0013/2026',
                'partnership_year' => 2026,
                'city' => 'Chennai',
                'state' => 'Tamil Nadu',
                'address' => 'Plot No. 18, 3rd Cross Street, JP Academy Campus, Velachery Main Road',
                'pincode' => '600042',
                'phone' => '+91 93446 20346',
                'email' => 'jpacademy@srideekshaa.com',
                'description' => 'Authorized Franchise Partner center of Sri Deekshaa International Academy offering certified Abacus, Vedic Maths, Phonics, Calligraphy, and Cognitive development programs.',
                'map_embed_url' => 'https://maps.google.com/maps?q=Velachery+Chennai&t=&z=14&ie=UTF8&iwloc=&output=embed',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Chennai - Anna Nagar Master Campus',
                'slug' => 'chennai-anna-nagar',
                'franchise_id' => 'SDIA-F-0001/2026',
                'partnership_year' => 2026,
                'city' => 'Chennai',
                'state' => 'Tamil Nadu',
                'address' => 'Plot No. 42, 2nd Avenue, Anna Nagar Western Extension',
                'pincode' => '600040',
                'phone' => '+91 98765 43210',
                'email' => 'annanagar@srideekshaa.com',
                'description' => 'Flagship Academy Campus & Master Franchise Training Headquarters equipped with cognitive abacus labs, fine arts studios, and indoor martial arts arena.',
                'map_embed_url' => 'https://maps.google.com/maps?q=Anna+Nagar+Chennai&t=&z=14&ie=UTF8&iwloc=&output=embed',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Chennai - Velachery Center',
                'slug' => 'chennai-velachery',
                'franchise_id' => 'SDIA-F-0002/2026',
                'partnership_year' => 2026,
                'city' => 'Chennai',
                'state' => 'Tamil Nadu',
                'address' => 'No. 18, 100 Feet Bypass Road, Near Vijayanagar Bus Terminus, Velachery',
                'pincode' => '600042',
                'phone' => '+91 98765 43211',
                'email' => 'velachery@srideekshaa.com',
                'description' => 'Accredited South Chennai franchise branch offering weekend abacus batches, classical dance, keyboard, and spoken English clubs.',
                'map_embed_url' => 'https://maps.google.com/maps?q=Velachery+Chennai&t=&z=14&ie=UTF8&iwloc=&output=embed',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Coimbatore - RS Puram Center',
                'slug' => 'coimbatore-rs-puram',
                'franchise_id' => 'SDIA-F-0003/2026',
                'partnership_year' => 2026,
                'city' => 'Coimbatore',
                'state' => 'Tamil Nadu',
                'address' => '54, DB Road, Opposite Flower Market, RS Puram',
                'pincode' => '641002',
                'phone' => '+91 98765 43212',
                'email' => 'coimbatore@srideekshaa.com',
                'description' => 'Premier Western Tamil Nadu franchise branch specializing in Vedic Maths, speedcubing, robotics, and child psychology programs.',
                'map_embed_url' => 'https://maps.google.com/maps?q=RS+Puram+Coimbatore&t=&z=14&ie=UTF8&iwloc=&output=embed',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Madurai - KK Nagar Center',
                'slug' => 'madurai-kk-nagar',
                'franchise_id' => 'SDIA-F-0004/2026',
                'partnership_year' => 2026,
                'city' => 'Madurai',
                'state' => 'Tamil Nadu',
                'address' => 'Plot 12, 80 Feet Road, Near Mattuthavani Junction, KK Nagar',
                'pincode' => '625020',
                'phone' => '+91 98765 43213',
                'email' => 'madurai@srideekshaa.com',
                'description' => 'Dedicated Southern district center offering Traditional Silambam, Karate, Drawing, and certified Teacher Training courses.',
                'map_embed_url' => 'https://maps.google.com/maps?q=KK+Nagar+Madurai&t=&z=14&ie=UTF8&iwloc=&output=embed',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Bengaluru - HSR Layout Center',
                'slug' => 'bengaluru-hsr-layout',
                'franchise_id' => 'SDIA-F-0005/2026',
                'partnership_year' => 2026,
                'city' => 'Bengaluru',
                'state' => 'Karnataka',
                'address' => '27th Main Road, Sector 1, HSR Layout',
                'pincode' => '560102',
                'phone' => '+91 98765 43214',
                'email' => 'bengaluru@srideekshaa.com',
                'description' => 'Metropolitan franchise learning center with high-tech hybrid classroom infrastructure, Quantum Speed Reading, and chess coaching.',
                'map_embed_url' => 'https://maps.google.com/maps?q=HSR+Layout+Bengaluru&t=&z=14&ie=UTF8&iwloc=&output=embed',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Tiruchirappalli - Thillai Nagar Center',
                'slug' => 'trichy-thillai-nagar',
                'franchise_id' => 'SDIA-F-0006/2026',
                'partnership_year' => 2026,
                'city' => 'Tiruchirappalli',
                'state' => 'Tamil Nadu',
                'address' => '11th Cross West, Main Road, Thillai Nagar',
                'pincode' => '620018',
                'phone' => '+91 98765 43215',
                'email' => 'trichy@srideekshaa.com',
                'description' => 'Central Tamil Nadu franchise hub with comprehensive phonics reading library, handwriting lab, and Hindi Sabha exam batches.',
                'map_embed_url' => 'https://maps.google.com/maps?q=Thillai+Nagar+Trichy&t=&z=14&ie=UTF8&iwloc=&output=embed',
                'sort_order' => 7,
                'is_active' => true,
            ],
        ];

        foreach ($centers as $center) {
            Location::updateOrCreate(
                ['slug' => $center['slug']],
                $center
            );
        }
    }
}
