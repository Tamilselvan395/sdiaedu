<?php

namespace Database\Seeders;

use App\Enums\BlogPostStatus;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Parenting', 'slug' => 'parenting', 'description' => 'Insights, advice, and tips for proactive parents.'],
            ['name' => 'Kids Education', 'slug' => 'kids-education', 'description' => 'Child-centered pedagogy, milestones, and development.'],
            ['name' => 'Abacus & Math', 'slug' => 'abacus-and-math', 'description' => 'Mental arithmetic, calculation agility, and numerical confidence.'],
            ['name' => 'English & Communication', 'slug' => 'english-and-communication', 'description' => 'Reading fluency, phonics, public speaking, and vocabulary.'],
            ['name' => 'Creative Learning', 'slug' => 'creative-learning', 'description' => 'Fine arts, crafts, calligraphy, and kinesthetic expression.'],
            ['name' => 'Personality Development', 'slug' => 'personality-development', 'description' => 'Stage presence, etiquette, emotional resilience, and leadership.'],
            ['name' => 'Digital Skills & Career', 'slug' => 'digital-skills-and-career', 'description' => 'Future-ready tech, web design, and professional competencies.'],
            ['name' => 'Learning Tips', 'slug' => 'learning-tips', 'description' => 'Study strategies, memory hacks, and cognitive habits.'],
        ];

        $catMap = [];
        foreach ($categories as $cat) {
            $created = BlogCategory::updateOrCreate(['slug' => $cat['slug']], $cat);
            $catMap[$cat['slug']] = $created->id;
        }

        $author = User::first();

        $posts = [
            [
                'blog_category_id' => $catMap['abacus-and-math'] ?? null,
                'author_id' => $author?->id,
                'title' => 'Benefits of Abacus for Kids: How Mental Math Builds Working Memory and Concentration',
                'slug' => 'benefits-of-abacus-for-kids',
                'excerpt' => 'Discover how physical bead manipulation and mental Anzan visualization stimulate both brain hemispheres, improving memory, focus, and overall academic confidence.',
                'content' => 'Many parents assume that learning the abacus is merely about becoming fast at simple addition and subtraction. In reality, modern cognitive neuroscience confirms that abacus training is an intensive workout for the developing brain.

### Dual-Brain Hemisphere Activation
Standard mathematical calculation predominantly utilizes the analytical left hemisphere of the brain. However, when a child visualizes the beads of a Soroban abacus in their mind’s eye (a practice known as *Anzan*), they activate the right hemisphere responsible for spatial reasoning, photographic memory, and holistic processing.

### Improved Focus and Working Memory
During a timed abacus drill, children must retain multi-digit numbers in their short-term working memory while performing simultaneous complementary operations. This high-focus mental gymnastics trains the attentional network, allowing children to focus for longer durations in school classrooms.

### Eliminating Math Anxiety Early
When children realize that they can calculate sums faster than adults with calculators, their self-perception fundamentally shifts. Math transforms from a dreaded chore into an exciting game where they consistently triumph.

At Sri Deekshaa International Academy, our multi-level abacus program is structured to ensure every learner advances at their natural developmental pace while receiving enthusiastic mentor support.',
                'meta_title' => 'Benefits of Abacus for Kids | Sri Deekshaa International Academy',
                'meta_description' => 'Explore the scientific cognitive benefits of Abacus learning for children aged 5-14 at Sri Deekshaa.',
                'status' => BlogPostStatus::Published,
                'published_at' => now()->subDays(5),
            ],
            [
                'blog_category_id' => $catMap['abacus-and-math'] ?? null,
                'author_id' => $author?->id,
                'title' => 'Abacus vs Vedic Maths: Which Mental Math Program Is Right for Your Child?',
                'slug' => 'abacus-vs-vedic-maths-which-is-right',
                'excerpt' => 'Confused between enrolling your learner in Abacus or Vedic Mathematics? We break down the age groups, methodologies, and academic objectives of both.',
                'content' => 'One of the most frequent questions parents ask our counsellors at Sri Deekshaa is: *"Should I enroll my child in Abacus or Vedic Maths?"* While both programs dramatically enhance numerical capability, they serve different developmental windows and learning objectives.

### Age Suitability
- **Abacus (Ages 5 to 13):** Best started early when brain plasticity and sensory-motor learning are at their peak. It relies heavily on tactile bead manipulation before progressing to mental visualization.
- **Vedic Maths (Ages 10 and Above):** Best suited for middle and high school students who already possess a baseline understanding of multiplication tables and arithmetic operations.

### Methodology & Scope
Abacus is an instrument-based cognitive tool that transforms into internal visual imagery. Vedic Maths, on the other hand, is a collection of 16 sutras (mental word formulas) derived from ancient Indian traditions that simplify complex algebraic, geometric, and arithmetic equations into one-line mental operations.

### Which One Should You Choose?
If your child is in primary school (Grades 1-5) and needs to build foundational concentration and speed, **Abacus** is the ideal choice. If your child is in middle school or high school preparing for Olympiads, NTSE, or competitive exams, **Vedic Maths** provides the exact shortcut formulas needed to ace time-pressured papers.',
                'meta_title' => 'Abacus vs Vedic Maths: Complete Parent Guide | Sri Deekshaa',
                'meta_description' => 'Compare Abacus and Vedic Maths by age, methodology, and benefits to pick the best math program for your child.',
                'status' => BlogPostStatus::Published,
                'published_at' => now()->subDays(3),
            ],
            [
                'blog_category_id' => $catMap['english-and-communication'] ?? null,
                'author_id' => $author?->id,
                'title' => 'Synthetic Phonics vs Rote Learning: Why Modern Reading Programs Accelerate Fluency',
                'slug' => 'synthetic-phonics-vs-rote-learning',
                'excerpt' => 'Learn why memorizing sight words is inferior to systematic synthetic phonics, and how learning the 42 letter sounds unlocks independent reading.',
                'content' => 'For generations, early reading instruction in many schools was driven by the "Look and Say" whole-word method: children were shown flashcards of entire words and expected to memorize their visual shapes. Today, linguistic research universally champions **Synthetic Phonics** as the gold standard for early literacy.

### What Is Synthetic Phonics?
Synthetic phonics breaks the English language down into 42 core phonemic sounds. Instead of teaching letters solely by their names (like "bee" or "see"), children learn the exact phonetic acoustic sound the letter produces (/b/, /k/, /s/). Children then "synthesize" (blend) these sounds together from left to right to pronounce unfamiliar words.

### The Problem with Whole-Word Memorization
When children rely purely on memory, they hit a cognitive ceiling around Grade 2 or 3 when the volume of words expands exponentially. A child trained in synthetic phonics, however, possesses a self-decoding superpower: any phonetic word they encounter can be methodically sounded out and read with confidence.

### The Multi-Sensory Advantage at Sri Deekshaa
Our Jolly Phonics curriculum incorporates action gestures, catchy songs, and tactile decodable readers, engaging visual, auditory, and kinesthetic learning channels simultaneously.',
                'meta_title' => 'Synthetic Phonics vs Rote Learning | Sri Deekshaa Academy',
                'meta_description' => 'Understand why synthetic phonics accelerates child reading fluency over traditional rote memorization.',
                'status' => BlogPostStatus::Published,
                'published_at' => now()->subDays(1),
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::updateOrCreate(['slug' => $post['slug']], $post);
        }
    }
}
