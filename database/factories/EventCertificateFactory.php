<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\EventCertificate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<EventCertificate>
 */
class EventCertificateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id' => Event::factory(),
            'participant_name' => fake()->name(),
            'registration_number' => 'REG-'.fake()->numberBetween(1000, 9999),
            'certificate_number' => 'SDIA-EVT-'.date('Y').'-'.strtoupper(fake()->bothify('##??')),
            'certificate_title' => fake()->randomElement([
                'Certificate of Participation',
                'Certificate of Merit',
                '1st Prize Excellence Award',
                'Special Commendation',
            ]),
            'certificate_file' => 'events/certificates/sample-certificate.pdf',
            'mobile' => fake()->numerify('9876######'),
            'email' => fake()->safeEmail(),
            'remarks' => fake()->sentence(),
            'issue_date' => now()->toDateString(),
            'is_published' => true,
            'sort_order' => 0,
        ];
    }
}
