<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Display the full course catalog.
     * If a category query parameter is provided, automatically 301 redirect to the clean SEO URL.
     */
    public function index(Request $request): View|RedirectResponse
    {
        // 301 Redirect query-string category to clean, SEO-friendly /courses/category/{slug} URL
        if ($request->filled('category')) {
            $catSlug = trim($request->query('category'));
            $otherParams = $request->except(['category', 'page']);

            return redirect()->route('courses.category', array_merge(['slug' => $catSlug], $otherParams), 301);
        }

        $query = Course::where('is_active', true)->with('category');

        // Filter by Learning Mode
        if ($request->filled('mode')) {
            $query->where('mode', $request->query('mode'));
        }

        // Filter by Target Age
        if ($request->filled('age')) {
            $age = (int) $request->query('age');
            $query->where(function ($q) use ($age) {
                $q->where('age_min', '<=', $age)
                    ->where(function ($sub) use ($age) {
                        $sub->where('age_max', '>=', $age)
                            ->orWhereNull('age_max');
                    });
            });
        }

        // Search Term
        if ($request->filled('search')) {
            $search = trim($request->query('search'));
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $courses = $query->orderBy('sort_order')->paginate(12)->withQueryString();

        $categories = CourseCategory::where('is_active', true)
            ->withCount('activeCourses')
            ->orderBy('sort_order')
            ->get();

        $selectedCategory = null;
        $seoTitle = 'All Courses & Programs | Sri Deekshaa International Academy';
        $seoDescription = 'Explore skill-based certified courses in Abacus, Vedic Maths, Robotics, Coding, Montessori, and Arts at Sri Deekshaa.';
        $canonicalUrl = route('courses.index');

        return view('courses.index', compact('courses', 'categories', 'selectedCategory', 'seoTitle', 'seoDescription', 'canonicalUrl'));
    }

    /**
     * Dedicated SEO-friendly Category page: /courses/category/{slug}
     */
    public function category(string $slug, Request $request): View
    {
        $selectedCategory = CourseCategory::where('slug', $slug)
            ->where('is_active', true)
            ->withCount('activeCourses')
            ->firstOrFail();

        $query = Course::where('course_category_id', $selectedCategory->id)
            ->where('is_active', true)
            ->with('category');

        // Filter by Mode
        if ($request->filled('mode')) {
            $query->where('mode', $request->query('mode'));
        }

        // Filter by Target Age
        if ($request->filled('age')) {
            $age = (int) $request->query('age');
            $query->where(function ($q) use ($age) {
                $q->where('age_min', '<=', $age)
                    ->where(function ($sub) use ($age) {
                        $sub->where('age_max', '>=', $age)
                            ->orWhereNull('age_max');
                    });
            });
        }

        // Search Term
        if ($request->filled('search')) {
            $search = trim($request->query('search'));
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $courses = $query->orderBy('sort_order')->paginate(12)->withQueryString();

        $categories = CourseCategory::where('is_active', true)
            ->withCount('activeCourses')
            ->orderBy('sort_order')
            ->get();

        $seoTitle = $selectedCategory->meta_title ?: "{$selectedCategory->name} Courses in Chennai | Sri Deekshaa International Academy";
        $seoDescription = $selectedCategory->meta_description ?: ($selectedCategory->description ?: "Explore accredited {$selectedCategory->name} courses at Sri Deekshaa International Academy. Small batches, certified instructors, online & classroom batches.");
        $canonicalUrl = route('courses.category', $selectedCategory->slug);

        return view('courses.index', compact('courses', 'categories', 'selectedCategory', 'seoTitle', 'seoDescription', 'canonicalUrl'));
    }

    /**
     * Individual Course details page: /courses/{slug}
     */
    public function show(string $slug): View
    {
        $course = Course::where('slug', $slug)
            ->where('is_active', true)
            ->with(['category', 'modules' => fn ($q) => $q->orderBy('sort_order'), 'faqs'])
            ->firstOrFail();

        $relatedCourses = Course::where('course_category_id', $course->course_category_id)
            ->where('id', '!=', $course->id)
            ->where('is_active', true)
            ->with('category')
            ->take(3)
            ->get();

        $seoTitle = "{$course->title} Course | Sri Deekshaa International Academy";
        $seoDescription = $course->short_description ?: "Join {$course->title} at Sri Deekshaa. Expert guidance, hands-on syllabus, and recognized certificate.";
        $canonicalUrl = route('courses.show', $course->slug);

        return view('courses.show', compact('course', 'relatedCourses', 'seoTitle', 'seoDescription', 'canonicalUrl'));
    }
}
