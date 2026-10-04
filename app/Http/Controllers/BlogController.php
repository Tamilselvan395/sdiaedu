<?php

namespace App\Http\Controllers;

use App\Enums\BlogPostStatus;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display all published blog articles.
     * Automatically 301 redirects query-string categories to clean SEO category URLs.
     */
    public function index(Request $request): View|RedirectResponse
    {
        if ($request->filled('category')) {
            $catSlug = trim($request->query('category'));
            $otherParams = $request->except(['category', 'page']);

            return redirect()->route('blog.category', array_merge(['slug' => $catSlug], $otherParams), 301);
        }

        $query = BlogPost::where('status', BlogPostStatus::Published)
            ->with(['blogCategory', 'author']);

        if ($request->filled('search')) {
            $search = trim($request->query('search'));
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        $posts = $query->latest('published_at')->paginate(9)->withQueryString();
        $categories = BlogCategory::where('is_active', true)
            ->withCount(['posts' => fn ($q) => $q->where('status', BlogPostStatus::Published)])
            ->get();

        $selectedCategory = null;
        $seoTitle = 'Articles, Parenting Insights & Learning Tips | Sri Deekshaa Blog';
        $seoDescription = 'Read expert articles on early child development, Abacus vs Vedic math, phonics education, and creative skills from Sri Deekshaa educators.';
        $canonicalUrl = route('blog.index');

        return view('blog.index', compact('posts', 'categories', 'selectedCategory', 'seoTitle', 'seoDescription', 'canonicalUrl'));
    }

    /**
     * Dedicated SEO-friendly Blog Category page: /blog/category/{slug}
     */
    public function category(string $slug, Request $request): View
    {
        $selectedCategory = BlogCategory::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $query = BlogPost::where('status', BlogPostStatus::Published)
            ->where('blog_category_id', $selectedCategory->id)
            ->with(['blogCategory', 'author']);

        if ($request->filled('search')) {
            $search = trim($request->query('search'));
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        $posts = $query->latest('published_at')->paginate(9)->withQueryString();
        $categories = BlogCategory::where('is_active', true)
            ->withCount(['posts' => fn ($q) => $q->where('status', BlogPostStatus::Published)])
            ->get();

        $seoTitle = "{$selectedCategory->name} Articles & Tips | Sri Deekshaa Academy Blog";
        $seoDescription = "Browse educational guides and expert perspectives on {$selectedCategory->name} published by Sri Deekshaa International Academy.";
        $canonicalUrl = route('blog.category', $selectedCategory->slug);

        return view('blog.index', compact('posts', 'categories', 'selectedCategory', 'seoTitle', 'seoDescription', 'canonicalUrl'));
    }

    /**
     * Individual Blog Article page: /blog/{slug}
     */
    public function show(string $slug): View
    {
        $post = BlogPost::where('slug', $slug)
            ->where('status', BlogPostStatus::Published)
            ->with(['blogCategory', 'author'])
            ->firstOrFail();

        $relatedPosts = BlogPost::where('status', BlogPostStatus::Published)
            ->where('blog_category_id', $post->blog_category_id)
            ->where('id', '!=', $post->id)
            ->take(3)
            ->get();

        $seoTitle = "{$post->title} | Sri Deekshaa Academy";
        $seoDescription = $post->excerpt ?: 'Read our in-depth educational article on Sri Deekshaa International Academy blog.';
        $canonicalUrl = route('blog.show', $post->slug);

        return view('blog.show', compact('post', 'relatedPosts', 'seoTitle', 'seoDescription', 'canonicalUrl'));
    }
}
