<x-layouts.app :title="$selectedCategory ? $selectedCategory->name . ' Articles' : ($globalSettings['seo_blog_title'] ?? ($seoTitle ?? 'Insights, Parenting & Skill Guides | Sri Deekshaa Academy Blog'))" :metaDescription="$selectedCategory ? ($selectedCategory->description ?? $seoDescription) : ($globalSettings['seo_blog_description'] ?? ($seoDescription ?? 'Read articles on cognitive development, abacus benefits, Vedic mathematics techniques, STEM education, and child psychology.'))" :canonical="$canonicalUrl ?? route('blog.index')">
    <!-- Header -->
    <section class="bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-white pt-10 pb-12 sm:pt-14 sm:pb-16 relative overflow-hidden border-b border-slate-800/80">
        <!-- Background Ambient Glow & Grid -->
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:20px_20px]"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/3 w-80 h-80 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <!-- Centered Breadcrumbs -->
            <div class="flex justify-center mb-4 sm:mb-5">
                @php
                    $blogIndexBreadcrumbs = [
                        ['label' => 'Articles', 'url' => isset($currentCategory) ? route('blog.index') : null],
                    ];
                    if (isset($currentCategory)) {
                        $blogIndexBreadcrumbs[] = ['label' => $currentCategory->name];
                    }
                @endphp
                <x-breadcrumb :items="$blogIndexBreadcrumbs" />
            </div>

            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight">
                {{ isset($currentCategory) ? $currentCategory->name . ' - Sri Deekshaa Blog' : 'Academic & Parenting Blog' }}
            </h1>

            <p class="mt-4 text-base sm:text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed">
                {{ isset($currentCategory) ? ($currentCategory->description ?? "Explore insightful articles and tips related to {$currentCategory->name}.") : 'Actionable perspectives on cognitive acceleration, speed calculation, STEM skills, and student motivation.' }}
            </p>
        </div>
    </section>

    <!-- Filter & Post Grid -->
    <section class="py-12 sm:py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Category Pills -->
            <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-8">
                <a 
                    href="{{ route('blog.index') }}" 
                    class="shrink-0 rounded-xl px-4 py-2 text-sm font-semibold transition {{ !isset($currentCategory) && !request('category') ? 'bg-slate-900 text-white' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-100' }}"
                >
                    All Articles
                </a>
                @foreach($categories as $cat)
                    <a 
                        href="{{ route('blog.category', $cat->slug) }}" 
                        class="shrink-0 rounded-xl px-4 py-2 text-sm font-semibold transition {{ (isset($currentCategory) && $currentCategory->id === $cat->id) || request('category') === $cat->slug ? 'bg-amber-500 text-slate-950 font-extrabold shadow-sm' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-100' }}"
                    >
                        {{ $cat->name }} ({{ $cat->posts_count }})
                    </a>
                @endforeach
            </div>

            <!-- Posts Grid -->
            @if($posts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($posts as $post)
                        <article class="rounded-3xl bg-white border border-slate-200/80 overflow-hidden shadow-xs hover:shadow-lg transition flex flex-col justify-between group">
                            <div>
                                <div class="h-48 w-full bg-slate-900 overflow-hidden relative">
                                    @if($post->featured_image)
                                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-tr from-slate-900 via-slate-800 to-amber-950 flex items-center justify-center p-6 text-center">
                                            <span class="text-amber-400 font-bold text-lg leading-tight">{{ $post->title }}</span>
                                        </div>
                                    @endif
                                    @if($post->blogCategory)
                                        <a href="{{ route('blog.category', $post->blogCategory->slug) }}" class="absolute top-3 left-3 rounded-full bg-amber-500 text-slate-950 px-2.5 py-0.5 text-xs font-bold hover:bg-amber-400 transition z-10">
                                            {{ $post->blogCategory->name }}
                                        </a>
                                    @else
                                        <span class="absolute top-3 left-3 rounded-full bg-amber-500 text-slate-950 px-2.5 py-0.5 text-xs font-bold">
                                            Article
                                        </span>
                                    @endif
                                </div>

                                <div class="p-6">
                                    <span class="text-sm text-slate-400 block mb-2">
                                        {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}
                                    </span>
                                    <h2 class="text-xl font-bold text-slate-900 group-hover:text-amber-600 transition leading-snug">
                                        <a href="{{ route('blog.show', $post->slug) }}">
                                            {{ $post->title }}
                                        </a>
                                    </h2>
                                    <p class="mt-2 text-sm text-slate-600 line-clamp-3 leading-relaxed">
                                        {{ $post->excerpt }}
                                    </p>
                                </div>
                            </div>

                            <div class="p-6 pt-0 border-t border-slate-100 flex items-center justify-between text-sm mt-4">
                                <span class="font-medium text-slate-500">{{ $post->author->name ?? 'Sri Deekshaa Academic Team' }}</span>
                                <a href="{{ route('blog.show', $post->slug) }}" class="font-bold text-amber-600 hover:text-amber-700 flex items-center gap-1.5">
                                    <span>Read Guide</span>
                                    <i class="fa-solid fa-arrow-right text-xs"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="rounded-3xl bg-white p-12 text-center border border-slate-200 max-w-md mx-auto">
                    <p class="text-slate-600 text-sm">No articles published in this category yet.</p>
                </div>
            @endif

        </div>
    </section>
</x-layouts.app>