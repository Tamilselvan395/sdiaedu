<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->randomElement([
            'Sri Deekshaa – Coimbatore Main',
            'Sri Deekshaa – Saravanampatti',
            'Sri Deekshaa – RS Puram',
            'Sri Deekshaa – Peelamedu',
            'Sri Deekshaa – Gandhipuram',
            'Sri Deekshaa – Singanallur',
        ]).' '.fake()->unique()->numberBetween(1, 999999);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'city' => 'Coimbatore',
            'state' => 'Tamil Nadu',
            'description' => fake()->optional(0.7)->paragraph(),
            'meta_title' => fake()->optional(0.5)->sentence(6),
            'meta_description' => fake()->optional(0.5)->sentence(15),
            'is_active' => true,
        ];
    }

    /** Inactive location state. */
    public function inactive(): static
    {
        return $this->state(['is_active' => false]);
    }
}
