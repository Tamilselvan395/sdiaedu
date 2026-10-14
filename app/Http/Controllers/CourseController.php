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
     * Display the full course catalog (defaults to student programs).
     * Automatically 301 redirects query-string audience=teacher to /teacher-training.
     * Automatically 301 redirects query-string category=slug to /courses/category/{slug}.
     */
    public function index(Request $request): View|RedirectResponse
    {
        // 301 Redirect audience=teacher to clean SEO-friendly /teacher-training
        if ($request->query('audience') === 'teacher') {
            $otherParams = $request->except(['audience', 'page']);

            return redirect()->route('teacher-training.index', $otherParams, 301);
        }

        // 301 Redirect redundant audience=student to clean canonical /courses
        if ($request->query('audience') === 'student') {
            $otherParams = $request->except(['audience', 'page']);

            return redirect()->route('courses.index', $otherParams, 301);
        }

        // 301 Redirect query-string category to clean, SEO-friendly /courses/category/{slug} URL
        if ($request->filled('category')) {
            $catSlug = trim($request->query('category'));
            $otherParams = $request->except(['category', 'page']);

            return redirect()->route('courses.category', array_merge(['slug' => $catSlug], $otherParams), 301);
        }

        $query = Course::where('is_active', true)->forStudents()->with('category');

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
            ->whereIn('target_audience', ['student', 'both'])
            ->withCount(['activeCourses as active_courses_count' => fn ($q) => $q->forStudents()])
            ->orderBy('sort_order')
            ->get();

        $selectedCategory = null;
        $isTeacherTrack = false;
        $selectedAudience = 'student';
        $seoTitle = 'Student Courses & Academic Programs | Sri Deekshaa International Academy';
        $seoDescription = 'Explore skill-based certified student courses in Abacus, Vedic Maths, Robotics, Phonics, Handwriting, and Arts at Sri Deekshaa.';
        $canonicalUrl = route('courses.index');

        return view('courses.index', compact('courses', 'categories', 'selectedCategory', 'isTeacherTrack', 'selectedAudience', 'seoTitle', 'seoDescription', 'canonicalUrl'));
    }

    /**
     * Dedicated SEO-friendly Category page for students: /courses/category/{slug}
     * Automatically 301 redirects audience=teacher to /teacher-training/category/{slug}
     */
    public function category(string $slug, Request $request): View|RedirectResponse
    {
        // 301 Redirect audience=teacher to clean SEO-friendly /teacher-training/category/{slug}
        if ($request->query('audience') === 'teacher') {
            $otherParams = $request->except(['audience', 'page']);

            return redirect()->route('teacher-training.category', array_merge(['slug' => $slug], $otherParams), 301);
        }

        // 301 Redirect redundant audience=student to clean canonical /courses/category/{slug}
        if ($request->query('audience') === 'student') {
            $otherParams = $request->except(['audience', 'page']);

            return redirect()->route('courses.category', array_merge(['slug' => $slug], $otherParams), 301);
        }

        $selectedCategory = CourseCategory::where('slug', $slug)
            ->where('is_active', true)
            ->withCount(['activeCourses as active_courses_count' => fn ($q) => $q->forStudents()])
            ->firstOrFail();

        $query = Course::where('course_category_id', $selectedCategory->id)
            ->where('is_active', true)
            ->forStudents()
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
            ->whereIn('target_audience', ['student', 'both'])
            ->withCount(['activeCourses as active_courses_count' => fn ($q) => $q->forStudents()])
            ->orderBy('sort_order')
            ->get();

        $isTeacherTrack = false;
        $selectedAudience = 'student';
        $seoTitle = $selectedCategory->meta_title ?: "{$selectedCategory->name} Courses in Chennai | Sri Deekshaa International Academy";
        $seoDescription = $selectedCategory->meta_description ?: ($selectedCategory->description ?: "Explore accredited {$selectedCategory->name} courses at Sri Deekshaa International Academy. Small batches, certified instructors, online & classroom batches.");
        $canonicalUrl = route('courses.category', $selectedCategory->slug);

        return view('courses.index', compact('courses', 'categories', 'selectedCategory', 'isTeacherTrack', 'selectedAudience', 'seoTitle', 'seoDescription', 'canonicalUrl'));
    }

    /**
     * Dedicated SEO-friendly Teacher Training catalog: /teacher-training
     */
    public function teacherIndex(Request $request): View|RedirectResponse
    {
        // 301 Redirect redundant audience=teacher to clean canonical /teacher-training
        if ($request->query('audience') === 'teacher') {
            $otherParams = $request->except(['audience', 'page']);

            return redirect()->route('teacher-training.index', $otherParams, 301);
        }

        // If audience=student is selected, redirect to clean /courses
        if ($request->query('audience') === 'student') {
            $otherParams = $request->except(['audience', 'page']);

            return redirect()->route('courses.index', $otherParams, 301);
        }

        $query = Course::where('is_active', true)->forTeachers()->with('category');

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
            ->whereIn('target_audience', ['teacher', 'both'])
            ->withCount(['activeCourses as active_courses_count' => fn ($q) => $q->forTeachers()])
            ->orderBy('sort_order')
            ->get();

        $selectedCategory = null;
        $isTeacherTrack = true;
        $selectedAudience = 'teacher';
        $seoTitle = 'Teacher Training Courses (TTC) & Certifications in Chennai | Sri Deekshaa International Academy';
        $seoDescription = 'Explore 23 accredited Teacher Training Courses (TTC) in Abacus, Vedic Maths, Phonics, Montessori, Yoga, and Arts. ISO 9001 certification, master teaching kits, and academy setup guidance.';
        $canonicalUrl = route('teacher-training.index');

        return view('courses.index', compact('courses', 'categories', 'selectedCategory', 'isTeacherTrack', 'selectedAudience', 'seoTitle', 'seoDescription', 'canonicalUrl'));
    }

    /**
     * Dedicated SEO-friendly Teacher Training Category page: /teacher-training/category/{slug}
     */
    public function teacherCategory(string $slug, Request $request): View|RedirectResponse
    {
        // 301 Redirect redundant audience=teacher to clean canonical URL
        if ($request->query('audience') === 'teacher') {
            $otherParams = $request->except(['audience', 'page']);

            return redirect()->route('teacher-training.category', array_merge(['slug' => $slug], $otherParams), 301);
        }

        // If audience=student is selected, redirect to clean /courses/category/{slug}
        if ($request->query('audience') === 'student') {
            $otherParams = $request->except(['audience', 'page']);

            return redirect()->route('courses.category', array_merge(['slug' => $slug], $otherParams), 301);
        }

        $selectedCategory = CourseCategory::where('slug', $slug)
            ->where('is_active', true)
            ->withCount(['activeCourses as active_courses_count' => fn ($q) => $q->forTeachers()])
            ->firstOrFail();

        $query = Course::where('course_category_id', $selectedCategory->id)
            ->where('is_active', true)
            ->forTeachers()
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
            ->whereIn('target_audience', ['teacher', 'both'])
            ->withCount(['activeCourses as active_courses_count' => fn ($q) => $q->forTeachers()])
            ->orderBy('sort_order')
            ->get();

        $isTeacherTrack = true;
        $selectedAudience = 'teacher';
        $seoTitle = "{$selectedCategory->name} Teacher Training Courses (TTC) in Chennai | Sri Deekshaa International Academy";
        $seoDescription = "Accredited {$selectedCategory->name} Teacher Training Programs (TTC) at Sri Deekshaa. Master teaching pedagogy, hands-on demonstration kits, ISO 9001 credential, and coaching business support.";
        $canonicalUrl = route('teacher-training.category', $selectedCategory->slug);

        return view('courses.index', compact('courses', 'categories', 'selectedCategory', 'isTeacherTrack', 'selectedAudience', 'seoTitle', 'seoDescription', 'canonicalUrl'));
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
