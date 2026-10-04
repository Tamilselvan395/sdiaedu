<?php

namespace Tests\Feature;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_blog_index_returns_ok_and_shows_published_posts(): void
    {
        $post = BlogPost::factory()->published()->create([
            'title' => 'The Benefits of Learning Carnatic Music Early',
        ]);

        $response = $this->get(route('blog.index'));

        $response->assertStatus(200);
        $response->assertSee('The Benefits of Learning Carnatic Music Early');
    }

    public function test_blog_index_does_not_show_draft_posts(): void
    {
        BlogPost::factory()->draft()->create([
            'title' => 'Secret Unpublished Article',
        ]);

        $response = $this->get(route('blog.index'));

        $response->assertStatus(200);
        $response->assertDontSee('Secret Unpublished Article');
    }

    public function test_blog_index_redirects_category_query_to_clean_seo_url(): void
    {
        $response = $this->get('/blog?category=cognitive-development');

        $response->assertStatus(301);
        $response->assertRedirect(route('blog.category', 'cognitive-development'));
    }

    public function test_blog_category_route_filters_by_category(): void
    {
        $cat1 = BlogCategory::factory()->create(['name' => 'Music Insights', 'slug' => 'music-insights', 'is_active' => true]);
        $cat2 = BlogCategory::factory()->create(['name' => 'Dance Culture', 'slug' => 'dance-culture', 'is_active' => true]);

        BlogPost::factory()->published()->create([
            'title' => 'Vocal Exercises for Classical Singers',
            'blog_category_id' => $cat1->id,
        ]);

        BlogPost::factory()->published()->create([
            'title' => 'Mudras and Expression in Bharatanatyam',
            'blog_category_id' => $cat2->id,
        ]);

        $response = $this->get(route('blog.category', 'music-insights'));

        $response->assertStatus(200);
        $response->assertSee('Vocal Exercises for Classical Singers');
        $response->assertDontSee('Mudras and Expression in Bharatanatyam');
    }

    public function test_blog_index_filters_by_search_term(): void
    {
        BlogPost::factory()->published()->create([
            'title' => 'How Yoga Improves Focus in Young Dancers',
        ]);
        BlogPost::factory()->published()->create([
            'title' => 'Understanding Western Scale Notation',
        ]);

        $response = $this->get(route('blog.index', ['search' => 'Yoga Improves']));

        $response->assertStatus(200);
        $response->assertSee('How Yoga Improves Focus in Young Dancers');
        $response->assertDontSee('Understanding Western Scale Notation');
    }

    public function test_blog_show_returns_ok_for_published_post(): void
    {
        $post = BlogPost::factory()->published()->create([
            'title' => '10 Tips for Daily Vocal Practice',
            'slug' => '10-tips-daily-vocal-practice',
        ]);

        $response = $this->get(route('blog.show', $post->slug));

        $response->assertStatus(200);
        $response->assertSee('10 Tips for Daily Vocal Practice');
    }

    public function test_blog_show_returns_404_for_draft_post(): void
    {
        $post = BlogPost::factory()->draft()->create([
            'title' => 'Draft Incomplete Article',
            'slug' => 'draft-incomplete-article',
        ]);

        $response = $this->get(route('blog.show', $post->slug));

        $response->assertStatus(404);
    }

    public function test_blog_show_returns_404_for_non_existent_post(): void
    {
        $response = $this->get(route('blog.show', 'unknown-post-slug'));

        $response->assertStatus(404);
    }
}
