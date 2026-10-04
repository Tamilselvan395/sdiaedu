<?php

namespace Database\Factories;

use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<BlogCategory>
 */
class BlogCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->randomElement([
            'Student Stories',
            'Teaching Tips',
            'Academy News',
            'Arts & Culture',
            'Parenting',
            'Events',
            'Music Theory',
            'Dance Fundamentals',
        ]).' '.fake()->unique()->numberBetween(1, 999999);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'is_active' => true,
        ];
    }

    /** Inactive blog category state. */
    public function inactive(): static
    {
        return $this->state(['is_active' => false]);
    }
}
