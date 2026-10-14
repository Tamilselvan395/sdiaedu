<?php

namespace Tests\Feature;

use App\Filament\Resources\CourseCategories\Pages\EditCourseCategory;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CourseCategoryEditTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_admin_can_view_category_edit_page_with_enhanced_ui(): void
    {
        $user = User::factory()->create();
        $category = CourseCategory::factory()->create([
            'name' => 'Music & Dance',
            'slug' => 'music-and-dance',
            'color' => 'amber',
            'icon' => 'fa-solid fa-music',
            'description' => 'Classical music, keyboard, and dance programs.',
        ]);

        $course1 = Course::factory()->create([
            'course_category_id' => $category->id,
            'title' => 'Carnatic Vocal & Music',
            'short_code' => 'CVM',
        ]);

        $response = $this->actingAs($user)->get("/admin/course-categories/{$category->slug}/edit");

        $response->assertStatus(200);
        $response->assertSee('Music &amp; Dance', false);
        $response->assertSee('View Public Page');
        $response->assertSee('Category Details');
        $response->assertSee('Media &amp; Banner', false);
        $response->assertSee('Branding &amp; Appearance', false);
        $response->assertSee('SEO &amp; Metadata', false);
        $response->assertSee('Courses in this Category');
        $response->assertSee('Carnatic Vocal &amp; Music', false);
        $response->assertSee('CVM');
    }

    public function test_authenticated_admin_can_update_course_category_with_seo_metadata(): void
    {
        $user = User::factory()->create();
        $category = CourseCategory::factory()->create([
            'name' => 'Music & Dance',
            'slug' => 'music-and-dance',
            'color' => 'amber',
            'icon' => 'fa-solid fa-music',
        ]);

        Livewire::actingAs($user)
            ->test(EditCourseCategory::class, [
                'record' => $category->slug,
            ])
            ->fillForm([
                'name' => 'Music & Dance Academy',
                'description' => 'Updated domain description for music and dance.',
                'color' => 'purple',
                'icon' => 'fa-solid fa-guitar',
                'meta_title' => 'Best Music & Dance Classes in Chennai | Sri Deekshaa',
                'meta_description' => 'Top rated keyboard, carnatic vocal, and classical dance academy.',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $category->refresh();
        $this->assertEquals('Music & Dance Academy', $category->name);
        $this->assertEquals('purple', $category->color);
        $this->assertEquals('fa-solid fa-guitar', $category->icon);
        $this->assertEquals('Best Music & Dance Classes in Chennai | Sri Deekshaa', $category->meta_title);
        $this->assertEquals('Top rated keyboard, carnatic vocal, and classical dance academy.', $category->meta_description);

        // Verify public category page renders custom SEO tags
        $publicResponse = $this->get("/courses/category/{$category->slug}");
        $publicResponse->assertStatus(200);
        $publicResponse->assertSee('Best Music &amp; Dance Classes in Chennai | Sri Deekshaa', false);
        $publicResponse->assertSee('Top rated keyboard, carnatic vocal, and classical dance academy.');
    }

    public function test_authenticated_admin_can_view_course_categories_index_table_with_audience_tabs_and_counts(): void
    {
        $user = User::factory()->create();

        $studentCategory = CourseCategory::factory()->create([
            'name' => 'Early Kids Skills',
            'target_audience' => 'student',
        ]);
        Course::factory()->create([
            'course_category_id' => $studentCategory->id,
            'title' => 'Little Phonics',
            'target_audience' => 'student',
            'is_active' => true,
        ]);

        $teacherCategory = CourseCategory::factory()->create([
            'name' => 'Montessori Teacher Academy',
            'target_audience' => 'teacher',
        ]);
        Course::factory()->create([
            'course_category_id' => $teacherCategory->id,
            'title' => 'International Montessori TTC',
            'target_audience' => 'teacher',
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->get('/admin/course-categories');

        $response->assertStatus(200);
        $response->assertSee('All Categories');
        $response->assertSee('Student Categories');
        $response->assertSee('Teacher Training (TTC)');
        $response->assertSee('Student Courses');
        $response->assertSee('Teacher TTC');
        $response->assertSee('Early Kids Skills');
        $response->assertSee('Montessori Teacher Academy');
    }

    public function test_authenticated_admin_can_view_courses_index_table_with_tabs(): void
    {
        $user = User::factory()->create();
        $category = CourseCategory::factory()->create();

        Course::factory()->create([
            'course_category_id' => $category->id,
            'title' => 'Student Abacus Program',
            'target_audience' => 'student',
        ]);

        Course::factory()->create([
            'course_category_id' => $category->id,
            'title' => 'Abacus Teacher Training Course',
            'target_audience' => 'teacher',
        ]);

        $response = $this->actingAs($user)->get('/admin/courses');

        $response->assertStatus(200);
        $response->assertSee('All Courses');
        $response->assertSee('Student Courses');
        $response->assertSee('Teacher Training (TTC)');
    }
}
