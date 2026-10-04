<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'K. Priya (Parent)',
                'role' => 'Mother of 8yo Learner [Demo Content]',
                'course' => 'Abacus Mental Arithmetic',
                'content' => 'My son was hesitant with numbers in school. After 4 months at Sri Deekshaa Abacus, he calculates faster than we do on a smartphone! His confidence in regular school tests has grown remarkably.',
                'rating' => 5,
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Dr. R. Anand',
                'role' => 'Parent of 5yo Student [Demo Content]',
                'course' => 'Jolly Phonics & Reading Mastery',
                'content' => 'The multi-sensory phonics approach made reading an absolute joy for my daughter. She now picks up storybooks on her own and sounds out new words with natural ease. Commendable mentors!',
                'rating' => 5,
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'S. Meenakshi',
                'role' => 'Diploma Student [Demo Content]',
                'course' => 'International Montessori Teacher Training',
                'content' => 'The Montessori teacher training provided me both theoretical depth and extensive apparatus handling practice. The trainers guided me through every album submission with meticulous care.',
                'rating' => 5,
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'V. Karthik (Parent)',
                'role' => 'Father of 12yo Student [Demo Content]',
                'course' => 'Vedic Mathematics',
                'content' => 'Vedic Maths simplified large calculations for my son preparing for scholarship tests. He saves immense time and verifies answers in seconds.',
                'rating' => 5,
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'A. Divya',
                'role' => 'College Graduate [Demo Content]',
                'course' => 'Web Designing & Frontend Foundations',
                'content' => 'The practical, project-based curriculum helped me build my own live portfolio with Tailwind and HTML5. The faculty reviews and debugging support were outstanding.',
                'rating' => 5,
                'is_featured' => false,
                'is_published' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(['name' => $t['name']], $t);
        }
    }
}
