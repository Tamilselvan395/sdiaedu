<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->boolean(90) ? fake()->lastName() : null,
            'email' => fake()->boolean(80) ? fake()->unique()->safeEmail() : null,
            'phone' => fake()->boolean(70) ? fake()->numerify('9#########') : null,
            'bio' => fake()->boolean(60) ? fake()->paragraph(2) : null,
            'status' => 'Active',
        ];
    }

    /** Inactive teacher state. */
    public function inactive(): static
    {
        return $this->state(['status' => 'Inactive']);
    }
}
