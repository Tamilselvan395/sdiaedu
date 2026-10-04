<?php

namespace Tests\Feature;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeoUrlTest extends TestCase
{
    use RefreshDatabase;

    public function test_course_category_clean_url_returns_ok_and_shows_courses(): void
    {
        $category = CourseCategory::factory()->create([
            'name' => 'Academic Enrichment',
            'slug' => 'academic-enrichment',
            'is_active' => true,
        ]);

        $course = Course::factory()->create([
            'course_category_id' => $category->id,
            'title' => 'Abacus Mental Arithmetic',
            'slug' => 'abacus-mental-arithmetic',
            'is_active' => true,
        ]);

        $response = $this->get('/courses/category/academic-enrichment');

        $response->assertStatus(200);
        $response->assertSee('Abacus Mental Arithmetic');
        $response->assertSee(url('/courses/category/academic-enrichment'));
    }

    public function test_courses_query_parameter_redirects_301_to_clean_category_url(): void
    {
        $category = CourseCategory::factory()->create([
            'name' => 'Academic Enrichment',
            'slug' => 'academic-enrichment',
            'is_active' => true,
        ]);

        $response = $this->get('/courses?category=academic-enrichment');

        $response->assertStatus(301);
        $response->assertRedirect('/courses/category/academic-enrichment');
    }

    public function test_blog_category_clean_url_returns_ok_and_shows_posts(): void
    {
        $category = BlogCategory::factory()->create([
            'name' => 'Brain Development',
            'slug' => 'brain-development',
            'is_active' => true,
        ]);

        $post = BlogPost::factory()->published()->create([
            'blog_category_id' => $category->id,
            'title' => 'Cognitive Milestones in Early Childhood',
            'slug' => 'cognitive-milestones-in-early-childhood',
        ]);

        $response = $this->get('/blog/category/brain-development');

        $response->assertStatus(200);
        $response->assertSee('Cognitive Milestones in Early Childhood');
        $response->assertSee(url('/blog/category/brain-development'));
    }

    public function test_blog_query_parameter_redirects_301_to_clean_category_url(): void
    {
        $category = BlogCategory::factory()->create([
            'name' => 'Brain Development',
            'slug' => 'brain-development',
            'is_active' => true,
        ]);

        $response = $this->get('/blog?category=brain-development');

        $response->assertStatus(301);
        $response->assertRedirect('/blog/category/brain-development');
    }

    public function test_sitemap_xml_returns_valid_xml_with_all_resources(): void
    {
        $category = CourseCategory::factory()->create([
            'slug' => 'stem-robotics',
            'is_active' => true,
        ]);

        $course = Course::factory()->create([
            'course_category_id' => $category->id,
            'slug' => 'junior-robotics-foundations',
            'is_active' => true,
        ]);

        $blogCategory = BlogCategory::factory()->create([
            'slug' => 'robotics-and-ai',
            'is_active' => true,
        ]);

        $post = BlogPost::factory()->published()->create([
            'blog_category_id' => $blogCategory->id,
            'slug' => 'why-kids-should-learn-robotics',
        ]);

        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/xml; charset=UTF-8');
        $response->assertSee('<urlset', false);
        $response->assertSee('/courses/junior-robotics-foundations', false);
        $response->assertSee('/courses/category/stem-robotics', false);
        $response->assertSee('/blog/why-kids-should-learn-robotics', false);
        $response->assertSee('/blog/category/robotics-and-ai', false);
        $response->assertSee('/verify-certificate', false);
    }

    public function test_model_slugs_are_automatically_generated(): void
    {
        $cat = CourseCategory::create([
            'name' => 'Speed Math & Abacus',
            'is_active' => true,
        ]);
        $this->assertEquals('speed-math-abacus', $cat->slug);

        $course = Course::create([
            'course_category_id' => $cat->id,
            'title' => 'Mastering Abacus Level 1',
            'short_description' => 'Test course description',
            'mode' => 'In-Person',
            'is_active' => true,
        ]);
        $this->assertEquals('mastering-abacus-level-1', $course->slug);
    }
}
