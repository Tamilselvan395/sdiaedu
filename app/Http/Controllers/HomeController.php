<?php

namespace App\Http\Controllers;

use App\Enums\BlogPostStatus;
use App\Models\BlogPost;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Faq;
use App\Models\Testimonial;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = CourseCategory::where('is_active', true)
            ->withCount('activeCourses')
            ->orderBy('sort_order')
            ->get();

        $featuredCourses = Course::where('is_active', true)
            ->where('is_featured', true)
            ->with('category')
            ->orderBy('sort_order')
            ->take(8)
            ->get();

        $allCourses = Course::where('is_active', true)
            ->with('category')
            ->orderBy('sort_order')
            ->get();

        $testimonials = Testimonial::where('is_published', true)
            ->where('is_featured', true)
            ->orderByDesc('rating')
            ->take(12)
            ->get();

        $faqs = Faq::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $latestPosts = BlogPost::where('status', BlogPostStatus::Published)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('home', compact(
            'categories',
            'featuredCourses',
            'allCourses',
            'testimonials',
            'faqs',
            'latestPosts'
        ));
    }
}
