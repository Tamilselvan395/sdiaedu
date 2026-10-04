<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Event;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $staticUrls = [
            ['url' => route('home'), 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['url' => route('courses.index'), 'priority' => '0.9', 'changefreq' => 'daily'],
            ['url' => route('pages.for-kids'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('pages.for-teens'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('blog.index'), 'priority' => '0.8', 'changefreq' => 'daily'],
            ['url' => route('events.index'), 'priority' => '0.8', 'changefreq' => 'daily'],
            ['url' => route('pages.assessment'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('pages.verify-certificate'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('pages.about'), 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => route('pages.contact'), 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => route('pages.franchise'), 'priority' => '0.8', 'changefreq' => 'monthly'],
        ];

        $courseCategories = CourseCategory::where('is_active', true)
            ->whereNotNull('slug')
            ->select('slug', 'updated_at')
            ->get();

        $courses = Course::where('is_active', true)
            ->whereNotNull('slug')
            ->select('slug', 'updated_at')
            ->get();

        $blogCategories = BlogCategory::where('is_active', true)
            ->whereNotNull('slug')
            ->select('slug', 'updated_at')
            ->get();

        $blogPosts = BlogPost::published()
            ->whereNotNull('slug')
            ->select('slug', 'updated_at', 'published_at')
            ->get();

        $events = Event::where('is_active', true)
            ->whereNotNull('slug')
            ->select('slug', 'updated_at')
            ->get();

        $xml = view('sitemap.xml', compact('staticUrls', 'courseCategories', 'courses', 'blogCategories', 'blogPosts', 'events'))->render();

        return response($xml, 200, [
            'Content-Type' => 'text/xml; charset=UTF-8',
        ]);
    }
}
