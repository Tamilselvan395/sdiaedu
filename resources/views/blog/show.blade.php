<x-layouts.app :title="$post->title" :metaDescription="$post->excerpt" :canonical="$canonicalUrl ?? route('blog.show', $post->slug)" :ogImage="$post->image_url">
    @push('head')
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "BlogPosting",
      "headline": @json($post->title),
      "description": @json($post->excerpt),
      "author": {
        "@@type": "Organization",
        "name": @json($post->author->name ?? 'Sri Deekshaa International Academy')
      },
      "publisher": {
        "@@type": "EducationalOrganization",
        "name": "Sri Deekshaa International Academy",
        "url": "{{ url('/') }}"
      },
      "datePublished": "{{ $post->published_at ? $post->published_at->toIso8601String() : $post->created_at->toIso8601String() }}",
      "dateModified": "{{ $post->updated_at->toIso8601String() }}",
      "mainEntityOfPage": {
        "@@type": "WebPage",
        "@id": "{{ route('blog.show', $post->slug) }}"
      }
    }
    </script>
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "BreadcrumbList",
      "itemListElement": [
        {
          "@@type": "ListItem",
          "position": 1,
          "name": "Home",
          "item": "{{ route('home') }}"
        },
        {
          "@@type": "ListItem",
          "position": 2,
          "name": "Blog",
          "item": "{{ route('blog.index') }}"
        },
        @if($post->blogCategory)
        {
          "@@type": "ListItem",
          "position": 3,
          "name": @json($post->blogCategory->name),
          "item": "{{ route('blog.category', $post->blogCategory->slug) }}"
        },
        {
          "@@type": "ListItem",
          "position": 4,
          "name": @json($post->title),
          "item": "{{ route('blog.show', $post->slug) }}"
        }
        @else
        {
          "@@type": "ListItem",
          "position": 3,
          "name": @json($post->title),
          "item": "{{ route('blog.show', $post->slug) }}"
        }
        @endif
      ]
    }
    </script>
    @endpush

    <!-- Article Hero Banner with Ambient Glow & Breadcrumbs -->
    <section class="bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-white pt-8 pb-12 sm:pt-10 sm:pb-16 relative overflow-hidden border-b border-slate-800/80">
        <!-- Background Ambient Glow & Grid -->
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:20px_20px]"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/3 w-80 h-80 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10">
            @php
                $articleBreadcrumbs = [
                    ['label' => 'Articles', 'url' => route('blog.index')],
                ];
                if ($post->blogCategory) {
                    $articleBreadcrumbs[] = ['label' => $post->blogCategory->name, 'url' => route('blog.category', $post->blogCategory->slug)];
                }
                $articleBreadcrumbs[] = ['label' => $post->title];
            @endphp
            <div class="mb-4 sm:mb-6">
                <x-breadcrumb :items="$articleBreadcrumbs" />
            </div>

            <div class="space-y-4">
                @if($post->blogCategory)
                    <a href="{{ route('blog.category', $post->blogCategory->slug) }}" class="inline-block rounded-full bg-amber-500/20 text-amber-400 border border-amber-500/30 hover:bg-amber-500/30 transition px-3.5 py-1 text-xs font-bold uppercase tracking-wider">
                        {{ $post->blogCategory->name }}
                    </a>
                @else
                    <span class="inline-block rounded-full bg-amber-500/20 text-amber-400 border border-amber-500/30 px-3.5 py-1 text-xs font-bold uppercase tracking-wider">
                        Article
                    </span>
                @endif

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
                    {{ $post->title }}
                </h1>

                <div class="flex flex-wrap items-center gap-4 text-sm text-slate-400 pt-3 border-t border-slate-800">
                    <span>By <strong class="text-slate-200">{{ $post->author->name ?? 'Academic Editorial Team' }}</strong></span>
                    <i class="fa-solid fa-circle text-[3px] text-slate-500"></i>
                    <span>Published {{ $post->published_at ? $post->published_at->format('F d, Y') : $post->created_at->format('F d, Y') }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <article class="py-12 sm:py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">

            @if($post->excerpt)
                <div class="bg-amber-50/60 border-l-4 border-amber-500 p-5 rounded-r-2xl mb-8 text-base text-slate-700 italic leading-relaxed">
                    {{ $post->excerpt }}
                </div>
            @endif

            <div class="prose prose-slate lg:prose-lg max-w-none text-slate-800 leading-relaxed space-y-6">
                {!! nl2br(e($post->content)) !!}
            </div>

            <!-- In-Article Lead Capture Banner -->
            <div class="mt-12 rounded-3xl bg-slate-900 text-white p-8 text-center space-y-4">
                <span class="text-sm font-bold uppercase tracking-wider text-amber-400">Put Knowledge into Practice</span>
                <h3 class="text-2xl font-bold">Start Your Child's Skill Journey Today</h3>
                <p class="text-sm text-slate-300 max-w-md mx-auto">
                    Experience our interactive teaching methodology with a complimentary 1-on-1 assessment and counseling session.
                </p>
                <div class="pt-2 flex flex-wrap items-center justify-center gap-3">
                    <button 
                        type="button" 
                        @click="$dispatch('open-enquiry-modal', {})"
                        class="rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold px-6 py-2.5 text-sm shadow"
                    >
                        Book Free Trial Class
                    </button>
                    <x-whatsapp-btn label="WhatsApp Academic Advisor" />
                </div>
            </div>

        </div>
    </article>

    <!-- Related Articles -->
    @if($relatedPosts->count() > 0)
        <section class="py-12 bg-slate-50 border-t border-slate-200/80">
            <div class="max-w-4xl mx-auto px-4 sm:px-6">
                <h3 class="text-xl font-bold text-slate-900 mb-6">Related Articles</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach($relatedPosts as $rel)
                        <div class="rounded-2xl bg-white p-5 border border-slate-200/80 hover:shadow transition">
                            <span class="text-[11px] font-bold text-amber-600 uppercase">{{ $rel->blogCategory->name ?? '' }}</span>
                            <h4 class="font-bold text-slate-900 text-sm mt-1 line-clamp-2">
                                <a href="{{ route('blog.show', $rel->slug) }}" class="hover:text-amber-600">
                                    {{ $rel->title }}
                                </a>
                            </h4>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.app>