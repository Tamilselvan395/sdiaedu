<?php

namespace Database\Factories;

use App\Enums\EnquiryStatus;
use App\Models\Enquiry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Enquiry>
 */
class EnquiryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_name' => fake()->name(),
            'student_name' => fake()->firstName(),
            'phone' => fake()->numerify('9#########'),
            'email' => fake()->optional(0.7)->safeEmail(),
            'student_age' => fake()->optional(0.8)->numberBetween(4, 18),
            'course_id' => null,
            'mode_preference' => fake()->optional(0.5)->randomElement(['In-Person', 'Online', 'Hybrid']),
            'notes' => fake()->optional(0.4)->sentence(),
            'source' => fake()->optional(0.6)->randomElement(['Website Form', 'Google Ad', 'Facebook', 'Referral', 'Walk-in']),
            'status' => EnquiryStatus::New,
            'utm_source' => null,
            'utm_medium' => null,
            'utm_campaign' => null,
        ];
    }

    /** Contacted enquiry state. */
    public function contacted(): static
    {
        return $this->state(['status' => EnquiryStatus::Contacted]);
    }

    /** Admitted enquiry state. */
    public function admitted(): static
    {
        return $this->state(['status' => EnquiryStatus::Admitted]);
    }
}
