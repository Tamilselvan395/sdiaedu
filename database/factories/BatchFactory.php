<?php

namespace Database\Factories;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Batch>
 */
class BatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'teacher_id' => Teacher::factory(),
            'name' => 'Batch '.fake()->unique()->numerify('###'),
            'start_date' => now()->addDays(7)->format('Y-m-d'),
            'end_date' => now()->addMonths(3)->format('Y-m-d'),
            'start_time' => '10:00:00',
            'end_time' => '11:30:00',
            'days' => ['Mon', 'Wed', 'Fri'],
            'capacity' => 20,
            'mode' => 'In-Person',
            'location' => 'Main Campus',
            'status' => 'Upcoming',
        ];
    }
}
