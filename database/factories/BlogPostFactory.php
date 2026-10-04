<?php

namespace Database\Factories;

use App\Enums\BlogPostStatus;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<BlogPost>
 */
class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence(6);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'blog_category_id' => BlogCategory::factory(),
            'author_id' => null,
            'content' => fake()->paragraphs(4, true),
            'excerpt' => fake()->optional(0.7)->sentence(20),
            'status' => BlogPostStatus::Draft,
            'published_at' => null,
        ];
    }

    /** Published post state. */
    public function published(): static
    {
        return $this->state([
            'status' => BlogPostStatus::Published,
            'published_at' => now(),
        ]);
    }

    /** Draft post state (already the default, but explicit for test clarity). */
    public function draft(): static
    {
        return $this->state([
            'status' => BlogPostStatus::Draft,
            'published_at' => null,
        ]);
    }
}
