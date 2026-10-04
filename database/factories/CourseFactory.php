<?php

namespace Database\Factories;

use App\Enums\CourseMode;
use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->randomElement([
            'Bharatanatyam for Beginners',
            'Carnatic Vocal – Foundation',
            'Keyboard & Piano',
            'Western Dance Fusion',
            'Drawing & Sketching',
            'Classical Guitar',
            'Hip-Hop & Street Dance',
            'Watercolour Painting',
            'Tabla Rhythms',
            'Creative Drama Workshop',
        ]).' '.fake()->unique()->numberBetween(1, 999999);

        $ageMin = fake()->optional(0.7)->numberBetween(4, 10);
        $ageMax = $ageMin ? fake()->numberBetween($ageMin + 2, 18) : null;

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'course_category_id' => CourseCategory::factory(),
            'short_description' => fake()->sentence(12),
            'is_active' => true,
            'is_featured' => fake()->boolean(30),
            'sort_order' => fake()->numberBetween(1, 100),
            'mode' => fake()->randomElement(array_column(CourseMode::cases(), 'value')),
            'age_min' => $ageMin,
            'age_max' => $ageMax,
            'duration' => fake()->optional(0.8)->randomElement(['3 months', '6 months', '1 year', '45 days']),
        ];
    }

    /** Active course state (default is already active, but explicit state for clarity). */
    public function active(): static
    {
        return $this->state(['is_active' => true]);
    }

    /** Inactive course state. */
    public function inactive(): static
    {
        return $this->state(['is_active' => false]);
    }

    /** Featured course state. */
    public function featured(): static
    {
        return $this->state(['is_featured' => true]);
    }
}
