<?php

namespace Database\Seeders;

use App\Models\SkillAssessment;
use App\Models\SkillAssessmentQuestion;
use Illuminate\Database\Seeder;

class SkillAssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assessment = SkillAssessment::updateOrCreate(
            ['slug' => 'child-course-recommender'],
            [
                'title' => 'Sri Deekshaa Learning Pathfinder',
                'description' => 'Take our 2-minute diagnostic skill assessment to find the tailored programs best suited to your learner’s unique age, curiosity, and growth goals.',
                'is_active' => true,
            ]
        );

        $questions = [
            [
                'step' => 1,
                'title' => 'What is the learner’s age group?',
                'subtitle' => 'Select the age category of the student',
                'question_type' => 'single_choice',
                'sort_order' => 1,
                'options' => [
                    ['label' => 'Early Years (4 to 6 Years)', 'value' => '4-6', 'description' => 'Preschool & Kindergarten stage'],
                    ['label' => 'Primary Explorer (7 to 9 Years)', 'value' => '7-9', 'description' => 'Foundation grade school years'],
                    ['label' => 'Middle School (10 to 13 Years)', 'value' => '10-13', 'description' => 'Critical cognitive expansion phase'],
                    ['label' => 'Teens & Youth (14 to 18 Years)', 'value' => '14-18', 'description' => 'High school & skill readiness'],
                    ['label' => 'College & Adults (18+ Years)', 'value' => '18+', 'description' => 'Career, teaching & professional skills'],
                ],
            ],
            [
                'step' => 2,
                'title' => 'Which learning area excites the learner the most?',
                'subtitle' => 'Choose primary interest focus',
                'question_type' => 'single_choice',
                'sort_order' => 2,
                'options' => [
                    ['label' => 'Mental Math, Logic & Puzzles', 'value' => 'math', 'description' => 'Numbers, brain teasers, speed calculations', 'tags' => ['abacus', 'vedic-maths', 'rubiks-cube', 'm3-analytical']],
                    ['label' => 'Reading, Speaking & Languages', 'value' => 'language', 'description' => 'English speaking, phonics, stage confidence', 'tags' => ['phonics', 'spoken-english', 'personality-development', 'spellbee', 'spoken-hindi']],
                    ['label' => 'Drawing, Crafting & Fine Arts', 'value' => 'arts', 'description' => 'Sketching, painting, calligraphy, DIY crafts', 'tags' => ['drawing', 'painting-and-colouring', 'handwriting', 'calligraphy', 'art-and-craft', 'pencil-art']],
                    ['label' => 'Dance, Movement & Fitness', 'value' => 'fitness', 'description' => 'Yoga, Zumba, Bollywood and folk dance', 'tags' => ['yoga', 'zumba', 'western-and-folk-dance']],
                    ['label' => 'Digital Tech & Career Skills', 'value' => 'career', 'description' => 'Web design, marketing, salon styling, teaching', 'tags' => ['web-designing', 'social-media-marketing', 'beautician', 'mba-plus-qsr', 'international-montessori']],
                ],
            ],
            [
                'step' => 3,
                'title' => 'What is the current learning comfort level?',
                'subtitle' => 'How does the learner currently feel in this domain?',
                'question_type' => 'single_choice',
                'sort_order' => 3,
                'options' => [
                    ['label' => 'Complete Beginner / Hesitant', 'value' => 'beginner', 'description' => 'Needs friendly foundational guidance from scratch'],
                    ['label' => 'Intermediate / Familiar', 'value' => 'intermediate', 'description' => 'Knows basics but wants deeper mastery & speed'],
                    ['label' => 'Advanced / Competitive', 'value' => 'advanced', 'description' => 'Aims for Olympiads, stage performances, or certifications'],
                ],
            ],
            [
                'step' => 4,
                'title' => 'What is your primary goal for this program?',
                'subtitle' => 'Select the most important desired transformation',
                'question_type' => 'single_choice',
                'sort_order' => 4,
                'options' => [
                    ['label' => 'Overcome Fear & Build Unshakeable Confidence', 'value' => 'confidence', 'description' => 'Speak clearly, present on stage, remove subject hesitation'],
                    ['label' => 'Academic Speed & Exam Performance', 'value' => 'academics', 'description' => 'Fast mental calculations, neat handwriting, better scores'],
                    ['label' => 'Creative Joy & Hands-On Exploration', 'value' => 'creativity', 'description' => 'Artistic expression, screen-free engagement, tactile building'],
                    ['label' => 'Certified Professional Career Capabilities', 'value' => 'career_growth', 'description' => 'Portfolio building, teacher training diploma, job readiness'],
                ],
            ],
            [
                'step' => 5,
                'title' => 'Preferred learning mode & center location',
                'subtitle' => 'How would the learner prefer to attend?',
                'question_type' => 'single_choice',
                'sort_order' => 5,
                'options' => [
                    ['label' => 'In-Person Learning Center (Chennai Campus)', 'value' => 'in_person', 'description' => 'Physical classroom studio with mentors and peer cohort'],
                    ['label' => 'Live Interactive Online Batches', 'value' => 'online', 'description' => 'From anywhere via high-quality interactive virtual classes'],
                    ['label' => 'Flexible Hybrid (In-Person + Online)', 'value' => 'hybrid', 'description' => 'Best of both worlds with weekend studio access'],
                ],
            ],
        ];

        foreach ($questions as $q) {
            SkillAssessmentQuestion::updateOrCreate(
                [
                    'skill_assessment_id' => $assessment->id,
                    'step' => $q['step'],
                ],
                $q
            );
        }
    }
}
