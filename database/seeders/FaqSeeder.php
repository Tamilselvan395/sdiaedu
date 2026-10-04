<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'How do I choose the right course for my child at Sri Deekshaa?',
                'answer' => 'We offer a free diagnostic Skill Assessment and a 1-on-1 counseling session with our academic mentors. Based on your child’s age, learning interests, current school challenges, and developmental goals, we recommend the most impactful courses.',
                'category' => 'Admissions',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'question' => 'Are classes conducted online, in-person, or in hybrid mode?',
                'answer' => 'Sri Deekshaa provides both state-of-the-art in-person learning centers and live interactive online classrooms. Programs like Abacus, Drawing, and Handwriting thrive in physical workshops, while courses like Vedic Maths, Spoken English, and Digital Marketing are seamlessly offered in hybrid formats.',
                'category' => 'Courses',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'question' => 'What is the student-to-teacher ratio in your batches?',
                'answer' => 'We maintain strictly limited batch sizes (typically 8 to 15 students per cohort). This ensures each learner receives individual attention, customized feedback, and regular pacing adjustments from the mentor.',
                'category' => 'General',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'question' => 'Do learners receive an official certificate upon course completion?',
                'answer' => 'Yes. Students successfully finishing their course levels and assessments receive an official Sri Deekshaa International Academy Certificate. Certificates feature a unique verification ID that can be authenticated 24/7 on our public verification portal.',
                'category' => 'Certification',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'question' => 'Can parents book a trial class or counselling before enrolling?',
                'answer' => 'Absolutely! We encourage parents and students to experience our teaching methodology firsthand. You can book a free counselling session or trial class through our website enquiry form or via WhatsApp.',
                'category' => 'Admissions',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'question' => 'What happens if my child misses a scheduled session?',
                'answer' => 'We offer makeup sessions and revision slots on designated weekdays so learners never fall behind in their progression milestone curriculum.',
                'category' => 'General',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(['question' => $faq['question']], $faq);
        }
    }
}
