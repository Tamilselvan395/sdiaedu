<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_code' => 'STU-'.fake()->unique()->numerify('######'),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->optional(0.8)->lastName(),
            'date_of_birth' => fake()->date('Y-m-d', '-4 years'),
            'gender' => fake()->optional(0.8)->randomElement(['Male', 'Female', 'Other']),
            'phone' => fake()->optional(0.6)->numerify('9#########'),
            'email' => fake()->optional(0.5)->safeEmail(),
            'address' => fake()->optional(0.6)->address(),
            'city' => fake()->optional(0.7)->city(),
            'state' => fake()->optional(0.7)->state(),
            'country' => 'India',
            'profile_photo' => null,
            'status' => 'Active',
        ];
    }

    /** Inactive student state. */
    public function inactive(): static
    {
        return $this->state(['status' => 'Inactive']);
    }
}
