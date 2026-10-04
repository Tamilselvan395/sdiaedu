<?php

namespace Database\Factories;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Faq>
 */
class FaqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => fake()->sentence().'?',
            'answer' => fake()->paragraph(2),
            'category' => fake()->randomElement(['General', 'Admissions', 'Fees', 'Courses', 'Batches']),
            'is_featured' => fake()->boolean(30),
            'is_active' => true,
            'sort_order' => fake()->numberBetween(1, 100),
        ];
    }

    /** Featured FAQ state. */
    public function featured(): static
    {
        return $this->state(['is_featured' => true, 'is_active' => true]);
    }

    /** Inactive FAQ state. */
    public function inactive(): static
    {
        return $this->state(['is_active' => false]);
    }
}
