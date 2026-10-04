<?php

namespace Database\Seeders;

use App\Models\CourseCategory;
use Illuminate\Database\Seeder;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Brain & Academic Excellence',
                'slug' => 'brain-and-academic-excellence',
                'description' => 'Supercharge cognitive speed, mental arithmetic calculation, photographic memory, and competitive analytical problem-solving skills.',
                'icon' => 'fa-solid fa-brain',
                'color' => 'purple',
                'sort_order' => 1,
                'is_active' => true,
                'meta_title' => 'Brain & Academic Excellence Programs | Sri Deekshaa International Academy',
                'meta_description' => 'Explore Abacus, Vedic Maths, Phonics, Mid Brain Activation, Quantum Speed Reading, Spell Bee, Rubik’s Cube, and Chess.',
            ],
            [
                'name' => 'Arts & Creativity',
                'slug' => 'arts-and-creativity',
                'description' => 'Nurture boundless imagination, neat penmanship, aesthetic appreciation, and fine-motor dexterity through studio art & craft.',
                'icon' => 'fa-solid fa-palette',
                'color' => 'pink',
                'sort_order' => 2,
                'is_active' => true,
                'meta_title' => 'Arts & Creativity Courses | Sri Deekshaa International Academy',
                'meta_description' => 'Foster creativity with Drawing & Coloring, Art & Craft, Calligraphy, and Handwriting Improvement programs.',
            ],
            [
                'name' => 'Music & Dance',
                'slug' => 'music-and-dance',
                'description' => 'Experience the rich harmony of classical vocal sangeetham, electronic keyboard mastery, traditional Bharatanatyam, and western choreography.',
                'icon' => 'fa-solid fa-music',
                'color' => 'amber',
                'sort_order' => 3,
                'is_active' => true,
                'meta_title' => 'Music & Dance Training Academy | Sri Deekshaa International Academy',
                'meta_description' => 'Learn Carnatic Music, Electronic Keyboard, Classical Bharatanatyam, and Western / Folk Dance from expert mentors.',
            ],
            [
                'name' => 'Sports & Fitness',
                'slug' => 'sports-and-fitness',
                'description' => 'Build athletic stamina, martial arts defense, disciplined focus, bodily flexibility, and strategic sportsmanship for all ages.',
                'icon' => 'fa-solid fa-person-running',
                'color' => 'emerald',
                'sort_order' => 4,
                'is_active' => true,
                'meta_title' => 'Sports & Physical Fitness Academy | Sri Deekshaa International Academy',
                'meta_description' => 'Train in Karate, Silambam, Yoga, Zumba & Fitness, Gymnastics, Carrom, and Precision Dart at Sri Deekshaa.',
            ],
            [
                'name' => 'Language Development',
                'slug' => 'language-development',
                'description' => 'Empower fluent verbal expression, global pronunciation, confident public presentation, and certified Hindi Sabha exam qualifications.',
                'icon' => 'fa-solid fa-language',
                'color' => 'blue',
                'sort_order' => 5,
                'is_active' => true,
                'meta_title' => 'Language Development & Fluency | Sri Deekshaa International Academy',
                'meta_description' => 'Master Spoken English fluency and prepare for certified Hindi Saba Examinations with expert language coaches.',
            ],
        ];

        $validSlugs = collect($categories)->pluck('slug')->all();

        // Remove any old legacy categories not part of the active domains
        CourseCategory::whereNotIn('slug', $validSlugs)->delete();

        foreach ($categories as $cat) {
            CourseCategory::updateOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
