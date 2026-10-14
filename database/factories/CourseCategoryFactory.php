<?php

namespace Database\Factories;

use App\Models\CourseCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<CourseCategory>
 */
class CourseCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->randomElement([
            'Classical Music',
            'Dance & Movement',
            'Visual Arts',
            'Drama & Theatre',
            'Vocal Training',
            'Instrumental',
            'Creative Writing',
            'Digital Arts',
        ]).' '.fake()->unique()->numberBetween(1, 999999);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'target_audience' => 'both',
            'is_active' => true,
            'sort_order' => fake()->numberBetween(1, 100),
        ];
    }

    /** Inactive category state. */
    public function inactive(): static
    {
        return $this->state(['is_active' => false]);
    }
}
