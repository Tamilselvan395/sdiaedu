{!! '<'.'?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Core Static URLs --}}
    @foreach($staticUrls as $item)
        <url>
            <loc>{{ $item['url'] }}</loc>
            <changefreq>{{ $item['changefreq'] }}</changefreq>
            <priority>{{ $item['priority'] }}</priority>
        </url>
    @endforeach

    {{-- Course Categories --}}
    @foreach($courseCategories as $category)
        <url>
            <loc>{{ route('courses.category', $category->slug) }}</loc>
            <lastmod>{{ $category->updated_at ? $category->updated_at->toAtomString() : now()->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    {{-- Individual Courses --}}
    @foreach($courses as $course)
        <url>
            <loc>{{ route('courses.show', $course->slug) }}</loc>
            <lastmod>{{ $course->updated_at ? $course->updated_at->toAtomString() : now()->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    {{-- Blog Categories --}}
    @foreach($blogCategories as $blogCategory)
        <url>
            <loc>{{ route('blog.category', $blogCategory->slug) }}</loc>
            <lastmod>{{ $blogCategory->updated_at ? $blogCategory->updated_at->toAtomString() : now()->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach

    {{-- Individual Blog Posts --}}
    @foreach($blogPosts as $post)
        <url>
            <loc>{{ route('blog.show', $post->slug) }}</loc>
            <lastmod>{{ ($post->updated_at ?? $post->published_at ?? now())->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach

    {{-- Individual Events --}}
    @foreach($events ?? [] as $event)
        <url>
            <loc>{{ route('events.show', $event->slug) }}</loc>
            <lastmod>{{ ($event->updated_at ?? now())->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>
