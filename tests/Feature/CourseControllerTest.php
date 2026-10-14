<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_courses_index_returns_ok_and_displays_courses(): void
    {
        $category = CourseCategory::factory()->create(['name' => 'Music Academy', 'is_active' => true]);
        $course = Course::factory()->create([
            'course_category_id' => $category->id,
            'title' => 'Carnatic Vocal Music',
            'is_active' => true,
        ]);

        $response = $this->get(route('courses.index'));

        $response->assertStatus(200);
        $response->assertSee('Carnatic Vocal Music');
        $response->assertSee('All Categories');
    }

    public function test_courses_index_redirects_category_query_to_clean_seo_url(): void
    {
        $response = $this->get('/courses?category=academic-enrichment');

        $response->assertStatus(301);
        $response->assertRedirect(route('courses.category', 'academic-enrichment'));
    }

    public function test_courses_category_route_filters_by_category(): void
    {
        $danceCat = CourseCategory::factory()->create(['name' => 'Dance', 'slug' => 'dance', 'is_active' => true]);
        $musicCat = CourseCategory::factory()->create(['name' => 'Music', 'slug' => 'music', 'is_active' => true]);

        Course::factory()->create([
            'course_category_id' => $danceCat->id,
            'title' => 'Bharatanatyam Arangetram',
            'is_active' => true,
        ]);

        Course::factory()->create([
            'course_category_id' => $musicCat->id,
            'title' => 'Western Piano Mastery',
            'is_active' => true,
        ]);

        $response = $this->get(route('courses.category', 'dance'));

        $response->assertStatus(200);
        $response->assertSee('Bharatanatyam Arangetram');
        $response->assertDontSee('All Categories');
        $this->assertFalse($response->viewData('courses')->contains('title', 'Western Piano Mastery'));
    }

    public function test_courses_index_filters_by_search_term(): void
    {
        Course::factory()->create([
            'title' => 'Advanced Oil Painting Workshop',
            'is_active' => true,
        ]);
        Course::factory()->create([
            'title' => 'Vedic Mathematics',
            'is_active' => true,
        ]);

        $response = $this->get(route('courses.index', ['search' => 'Oil Painting']));

        $response->assertStatus(200);
        $response->assertSee('Advanced Oil Painting Workshop');
        $this->assertFalse($response->viewData('courses')->contains('title', 'Vedic Mathematics'));
    }

    public function test_courses_index_filters_by_age(): void
    {
        Course::factory()->create([
            'title' => 'Toddlers Movement',
            'age_min' => 4,
            'age_max' => 6,
            'is_active' => true,
        ]);
        Course::factory()->create([
            'title' => 'Teens Rock Guitar',
            'age_min' => 13,
            'age_max' => 17,
            'is_active' => true,
        ]);

        $response = $this->get(route('courses.index', ['age' => 5]));

        $response->assertStatus(200);
        $response->assertSee('Toddlers Movement');
        $this->assertFalse($response->viewData('courses')->contains('title', 'Teens Rock Guitar'));
    }

    public function test_course_show_returns_ok_for_active_course(): void
    {
        $course = Course::factory()->create([
            'title' => 'Violin Masterclass',
            'slug' => 'violin-masterclass',
            'is_active' => true,
        ]);

        $response = $this->get(route('courses.show', $course->slug));

        $response->assertStatus(200);
        $response->assertSee('Violin Masterclass');
    }

    public function test_course_show_returns_404_for_inactive_course(): void
    {
        $course = Course::factory()->create([
            'title' => 'Archived Course',
            'slug' => 'archived-course',
            'is_active' => false,
        ]);

        $response = $this->get(route('courses.show', $course->slug));

        $response->assertStatus(404);
    }

    public function test_course_show_returns_404_for_non_existent_course(): void
    {
        $response = $this->get(route('courses.show', 'non-existent-course-slug'));

        $response->assertStatus(404);
    }

    public function test_admin_courses_list_renders_thumbnail_correctly(): void
    {
        $user = User::factory()->create();
        $category = CourseCategory::factory()->create(['name' => 'Brain Academy']);
        Course::factory()->create([
            'course_category_id' => $category->id,
            'title' => 'Abacus Mental Arithmetic',
            'thumbnail' => 'courses/thumbnails/cheerful-child-learning-with-abacus.webp',
        ]);

        $response = $this->actingAs($user)->get('/admin/courses');
        $response->assertStatus(200);
        $response->assertSee('cheerful-child-learning-with-abacus.webp');
    }

    public function test_courses_index_redirects_audience_teacher_query_to_clean_seo_url(): void
    {
        $response = $this->get('/courses?audience=teacher');

        $response->assertStatus(301);
        $response->assertRedirect(route('teacher-training.index'));
    }

    public function test_courses_category_redirects_audience_teacher_query_to_clean_seo_url(): void
    {
        $response = $this->get('/courses/category/brain-and-academic-excellence?audience=teacher');

        $response->assertStatus(301);
        $response->assertRedirect(route('teacher-training.category', 'brain-and-academic-excellence'));
    }

    public function test_teacher_training_category_renders_teacher_courses(): void
    {
        $category = CourseCategory::factory()->create([
            'name' => 'Brain & Academic Excellence',
            'slug' => 'brain-and-academic-excellence',
            'is_active' => true,
        ]);
        Course::factory()->create([
            'course_category_id' => $category->id,
            'title' => 'Student Abacus Learning',
            'target_audience' => 'student',
            'is_active' => true,
        ]);
        Course::factory()->create([
            'course_category_id' => $category->id,
            'title' => 'Abacus Teacher Training TTC',
            'slug' => 'abacus-teacher-training',
            'target_audience' => 'teacher',
            'is_active' => true,
        ]);

        $response = $this->get(route('teacher-training.category', 'brain-and-academic-excellence'));

        $response->assertStatus(200);
        $response->assertSee('Abacus Teacher Training TTC');
        $response->assertSee('Teacher Training (TTC)');
        $this->assertFalse($response->viewData('courses')->contains('title', 'Student Abacus Learning'));
    }

    public function test_teacher_training_index_renders_teacher_courses(): void
    {
        $category = CourseCategory::factory()->create(['name' => 'Brain Academy', 'is_active' => true]);
        Course::factory()->create([
            'course_category_id' => $category->id,
            'title' => 'Student Course Exclusive',
            'target_audience' => 'student',
            'is_active' => true,
        ]);
        Course::factory()->create([
            'course_category_id' => $category->id,
            'title' => 'Phonics Teacher Training Course',
            'target_audience' => 'teacher',
            'is_active' => true,
        ]);

        $response = $this->get(route('teacher-training.index'));

        $response->assertStatus(200);
        $response->assertSee('Phonics Teacher Training Course');
        $this->assertFalse($response->viewData('courses')->contains('title', 'Student Course Exclusive'));
    }

    public function test_header_renders_students_and_teachers_navigation(): void
    {
        $category = CourseCategory::factory()->create(['name' => 'Brain Academy', 'is_active' => true]);
        Course::factory()->create([
            'course_category_id' => $category->id,
            'title' => 'Student Abacus Fun',
            'target_audience' => 'student',
            'is_active' => true,
        ]);
        Course::factory()->create([
            'course_category_id' => $category->id,
            'title' => 'Vedic Maths Teacher TTC',
            'slug' => 'vedic-maths-teacher-training',
            'target_audience' => 'teacher',
            'is_active' => true,
        ]);

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('Students');
        $response->assertSee('Teachers');
        $response->assertSee('5 Specialized TTC Domains');
        $response->assertSee('Vedic Maths Teacher TTC');
        $response->assertDontSee('All Programs');
    }

    public function test_course_show_for_student_displays_student_track_and_hides_teacher_track(): void
    {
        $category = CourseCategory::factory()->create(['name' => 'Skill Academy', 'is_active' => true]);
        $course = Course::factory()->create([
            'course_category_id' => $category->id,
            'title' => 'Student Abacus Learning',
            'slug' => 'student-abacus-learning',
            'target_audience' => 'student',
            'is_active' => true,
        ]);

        $response = $this->get(route('courses.show', $course->slug));

        $response->assertStatus(200);
        $response->assertSee('Student Track');
        $response->assertSee('Book Free Student Trial');
        $response->assertDontSee('Teacher Training Track (TTC)');
        $response->assertDontSee('Inquire for Teacher Training');
    }

    public function test_course_show_for_teacher_displays_teacher_track_and_hides_student_track(): void
    {
        $category = CourseCategory::factory()->create(['name' => 'Skill Academy', 'is_active' => true]);
        $course = Course::factory()->create([
            'course_category_id' => $category->id,
            'title' => 'Abacus Teacher Training Course',
            'slug' => 'abacus-teacher-training-ttc',
            'target_audience' => 'teacher',
            'is_active' => true,
        ]);

        $response = $this->get(route('courses.show', $course->slug));

        $response->assertStatus(200);
        $response->assertSee('Teacher Training Track (TTC)');
        $response->assertSee('Inquire for Teacher Training');
        $response->assertDontSee('Student Track');
        $response->assertDontSee('Book Free Student Trial');
    }
}
