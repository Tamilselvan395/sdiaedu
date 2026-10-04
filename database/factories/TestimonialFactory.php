<?php

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Testimonial>
 */
class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'role' => fake()->optional(0.8)->randomElement(['Parent', 'Student', 'Alumni']),
            'course' => fake()->optional(0.7)->randomElement([
                'Bharatanatyam',
                'Carnatic Vocal',
                'Keyboard & Piano',
                'Hip-Hop Dance',
            ]),
            'content' => fake()->paragraph(3),
            'rating' => fake()->numberBetween(3, 5),
            'is_featured' => fake()->boolean(30),
            'is_published' => true,
            'sort_order' => fake()->numberBetween(1, 100),
        ];
    }

    /** Featured testimonial state. */
    public function featured(): static
    {
        return $this->state(['is_featured' => true]);
    }

    /** Unpublished testimonial state. */
    public function unpublished(): static
    {
        return $this->state(['is_published' => false]);
    }
}
