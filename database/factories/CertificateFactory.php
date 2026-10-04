<?php

namespace Database\Factories;

use App\Enums\CertificateStatus;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Certificate>
 */
class CertificateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'certificate_number' => 'CERT-'.fake()->unique()->numerify('########'),
            'student_id' => Student::factory(),
            'course_id' => Course::factory(),
            'issue_date' => fake()->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
            'grade' => fake()->optional(0.7)->randomElement(['A+', 'A', 'B+', 'B', 'C']),
            'status' => CertificateStatus::Valid,
        ];
    }

    /** Revoked certificate state. */
    public function revoked(): static
    {
        return $this->state(['status' => CertificateStatus::Revoked]);
    }

    /** Expired certificate state. */
    public function expired(): static
    {
        return $this->state(['status' => CertificateStatus::Expired]);
    }
}
