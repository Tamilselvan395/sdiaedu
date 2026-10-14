<x-layouts.app 
    :title="$selectedCategory ? ($selectedCategory->meta_title ?: $selectedCategory->name . ' Courses') : ($globalSettings['seo_courses_title'] ?? ($seoTitle ?? 'All Courses & Programs'))"
    :metaDescription="$selectedCategory ? ($selectedCategory->meta_description ?: ($selectedCategory->description ?? $seoDescription)) : ($globalSettings['seo_courses_description'] ?? ($seoDescription ?? null))"
    :canonical="$canonicalUrl ?? null"
    :ogImage="$selectedCategory ? $selectedCategory->image_url : null"
>
    <!-- Header Banner -->
    <section class="bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-white pt-10 pb-12 sm:pt-14 sm:pb-16 relative overflow-hidden border-b border-slate-800/80">
        <!-- Background Ambient Glow & Grid -->
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:20px_20px]"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/3 w-80 h-80 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                
                <!-- Left: Title, SEO Breadcrumbs, Subtitle & Highlights -->
                <div class="lg:col-span-7">
                    <!-- SEO Breadcrumbs -->
                    @php
                        $isTeacher = $isTeacherTrack ?? false;
                        $courseIndexBreadcrumbs = [
                            ['label' => $isTeacher ? 'Teacher Training' : 'Courses', 'url' => $selectedCategory ? ($isTeacher ? route('teacher-training.index') : route('courses.index')) : null],
                        ];
                        if ($selectedCategory) {
                            $courseIndexBreadcrumbs[] = ['label' => $selectedCategory->name];
                        }
                    @endphp
                    <div class="mb-4 sm:mb-6">
                        <x-breadcrumb :items="$courseIndexBreadcrumbs" />
                    </div>

                    <div class="flex items-center gap-2 mb-3">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-500/15 px-3 py-1 text-xs font-bold text-amber-400 uppercase tracking-wider border border-amber-500/30">
                            <span class="h-1.5 w-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                            {{ $isTeacher ? 'Teacher Training Track (TTC)' : ($selectedCategory ? 'Specialized Domain' : 'Academic Catalog') }}
                        </span>
                        @if($selectedCategory)
                            <span class="text-sm text-slate-300 font-medium">
                                {{ $selectedCategory->active_courses_count ?? $courses->total() }} Programs
                            </span>
                        @endif
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight">
                        @if($isTeacher)
                            @if($selectedCategory)
                                <span class="bg-gradient-to-r from-amber-400 via-amber-300 to-yellow-200 bg-clip-text text-transparent">{{ $selectedCategory->name }}</span> Teacher Training (TTC)
                            @else
                                Explore <span class="bg-gradient-to-r from-amber-400 via-amber-300 to-yellow-200 bg-clip-text text-transparent">Teacher Training (TTC)</span> Programs
                            @endif
                        @else
                            @if($selectedCategory)
                                <span class="bg-gradient-to-r from-amber-400 via-amber-300 to-yellow-200 bg-clip-text text-transparent">{{ $selectedCategory->name }}</span> Programs
                            @else
                                Explore All <span class="bg-gradient-to-r from-amber-400 via-amber-300 to-yellow-200 bg-clip-text text-transparent">Skill Programs</span>
                            @endif
                        @endif
                    </h1>

                    <p class="mt-4 text-sm sm:text-base text-slate-300 leading-relaxed max-w-2xl">
                        @if($isTeacher)
                            {{ $selectedCategory ? "Accredited educator certification and teacher training programs in {$selectedCategory->name}. Master global pedagogy, hands-on demonstration kits, and start your own academy." : 'Empowering passionate educators, school teachers, and career seekers with ISO 9001 accredited pedagogical certifications, complete lesson kits, and zero-royalty coaching models.' }}
                        @else
                            {{ $selectedCategory ? $selectedCategory->description : 'Discover structured, accredited programs designed to cultivate mental agility, computational confidence, creative excellence, and future-ready capabilities for all ages.' }}
                        @endif
                    </p>

                    <!-- Trust Points / Highlights Strip -->
                    <div class="mt-6 pt-5 border-t border-slate-800/80 flex flex-wrap items-center gap-x-6 gap-y-2 text-sm text-slate-300">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-award text-amber-400 text-sm shrink-0"></i>
                            <span class="font-medium">Govt. Recognized Certification</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-users text-amber-400 text-sm shrink-0"></i>
                            <span class="font-medium">1:8 Focused Batches</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-chalkboard-user text-amber-400 text-sm shrink-0"></i>
                            <span class="font-medium">Online, Offline & Hybrid</span>
                        </div>
                    </div>
                </div>

                <!-- Right: Visual Showcase (Category Image or Bento Stats) -->
                <div class="lg:col-span-5">
                    @if($selectedCategory)
                        <!-- Active Category Visual Card -->
                        <div class="relative group">
                            <div class="absolute -inset-1 rounded-3xl bg-gradient-to-r from-amber-500/20 to-yellow-400/20 blur-xl opacity-75 group-hover:opacity-100 transition duration-500"></div>
                            <div class="relative overflow-hidden rounded-2xl border border-white/15 bg-slate-800/80 shadow-2xl backdrop-blur-sm">
                                <div class="aspect-16/10 w-full overflow-hidden relative">
                                    <img 
                                        src="{{ $selectedCategory->image_url }}" 
                                        alt="{{ $selectedCategory->name }}" 
                                        class="h-full w-full object-cover group-hover:scale-105 transition duration-500"
                                    />
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-950/20 to-transparent"></div>
                                    <div class="absolute top-3 left-3">
                                        <span class="inline-flex items-center gap-2 rounded-xl bg-slate-900/80 backdrop-blur-md px-3 py-1.5 text-xs font-semibold text-white border border-white/10 shadow-sm">
                                            <i class="{{ $selectedCategory->display_icon }} text-amber-400"></i>
                                            <span>{{ $selectedCategory->name }}</span>
                                        </span>
                                    </div>
                                    <div class="absolute bottom-3 left-3 right-3 flex items-center justify-between text-xs text-slate-200">
                                        <span class="inline-flex items-center gap-1 bg-amber-500 text-slate-950 font-bold px-2.5 py-1 rounded-lg text-xs shadow-xs">
                                            {{ $selectedCategory->active_courses_count ?? $courses->total() }} Active Courses
                                        </span>
                                        <span class="bg-black/60 backdrop-blur-md px-2.5 py-1 rounded-lg text-[11px] text-slate-300 border border-white/10">
                                            All Ages & Modes
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- All Categories Bento Overview Grid -->
                        <div class="grid grid-cols-2 gap-3 sm:gap-3.5">
                            <div class="p-4 rounded-2xl bg-white/[0.05] border border-white/10 backdrop-blur-sm hover:bg-white/[0.08] transition">
                                <div class="text-2xl sm:text-3xl font-black text-amber-400 mb-0.5">25+</div>
                                <div class="text-xs font-bold text-white uppercase tracking-wider">Certified Courses</div>
                                <div class="text-[11px] text-slate-400 mt-0.5">International Standard</div>
                            </div>
                            <div class="p-4 rounded-2xl bg-white/[0.05] border border-white/10 backdrop-blur-sm hover:bg-white/[0.08] transition">
                                <div class="text-2xl sm:text-3xl font-black text-amber-400 mb-0.5">5</div>
                                <div class="text-xs font-bold text-white uppercase tracking-wider">Skill Domains</div>
                                <div class="text-[11px] text-slate-400 mt-0.5">Holistic Development</div>
                            </div>
                            <div class="p-4 rounded-2xl bg-white/[0.05] border border-white/10 backdrop-blur-sm hover:bg-white/[0.08] transition">
                                <div class="text-2xl sm:text-3xl font-black text-amber-400 mb-0.5">100%</div>
                                <div class="text-xs font-bold text-white uppercase tracking-wider">Practical Training</div>
                                <div class="text-[11px] text-slate-400 mt-0.5">Hands-on Assessment</div>
                            </div>
                            <div class="p-4 rounded-2xl bg-white/[0.05] border border-white/10 backdrop-blur-sm hover:bg-white/[0.08] transition">
                                <div class="text-2xl sm:text-3xl font-black text-amber-400 mb-0.5">4 - 18+</div>
                                <div class="text-xs font-bold text-white uppercase tracking-wider">Age Groups</div>
                                <div class="text-[11px] text-slate-400 mt-0.5">Kids to Adults</div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </section>

    <!-- Sticky Filter & Search Controls Bar -->
    <section class="bg-white/95 backdrop-blur-md border-b border-slate-200/90 sticky top-20 z-30 shadow-xs transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if(!$selectedCategory)
                <!-- Tier 1: Category Navigation Tabs (Dedicated Horizontal Scroll Strip - Catalog Only) -->
                <div class="border-b border-slate-100/90 py-2.5">
                    <div class="flex items-center gap-2 overflow-x-auto pb-1 scrollbar-none -mx-4 px-4 sm:mx-0 sm:px-0">
                        <!-- All Categories Pill -->
                        <a 
                            href="{{ ($isTeacherTrack ?? false) ? route('teacher-training.index', request()->except(['page'])) : route('courses.index', request()->except(['page'])) }}" 
                            class="shrink-0 inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold transition-all {{ !$selectedCategory ? 'bg-slate-900 text-white shadow-sm ring-2 ring-slate-900/20' : 'bg-slate-100 text-slate-700 hover:bg-slate-200/80 hover:text-slate-900' }}"
                        >
                            <i class="fa-solid fa-layer-group text-sm"></i>
                            <span>All Categories</span>
                            <span class="rounded-full px-2 py-0.5 text-xs font-semibold {{ !$selectedCategory ? 'bg-white/20 text-white' : 'bg-slate-200/90 text-slate-600' }}">
                                {{ $categories->sum('active_courses_count') }}
                            </span>
                        </a>

                        @foreach($categories as $category)
                            @php
                                $isActive = $selectedCategory && $selectedCategory->id === $category->id;
                                $categoryRoute = ($isTeacherTrack ?? false)
                                    ? route('teacher-training.category', array_merge(['slug' => $category->slug], request()->except(['page'])))
                                    : route('courses.category', array_merge(['slug' => $category->slug], request()->except(['page'])));
                            @endphp
                            <a 
                                href="{{ $categoryRoute }}" 
                                class="shrink-0 inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold transition-all {{ $isActive ? 'bg-gradient-to-r from-amber-500 to-amber-400 text-slate-950 shadow-sm shadow-amber-500/25 ring-2 ring-amber-400/50' : 'bg-slate-100 text-slate-700 hover:bg-slate-200/80 hover:text-slate-900' }}"
                            >
                                <i class="{{ $category->display_icon }} text-sm"></i>
                                <span>{{ $category->name }}</span>
                                <span class="rounded-full px-2 py-0.5 text-xs font-semibold {{ $isActive ? 'bg-slate-950/15 text-slate-950' : 'bg-slate-200/90 text-slate-600' }}">
                                    {{ $category->active_courses_count }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Tier 2: Search, Filters & Quick Metrics Bar -->
            @php
                $filterFormAction = ($isTeacherTrack ?? false)
                    ? ($selectedCategory ? route('teacher-training.category', $selectedCategory->slug) : route('teacher-training.index'))
                    : ($selectedCategory ? route('courses.category', $selectedCategory->slug) : route('courses.index'));
            @endphp
            <form action="{{ $filterFormAction }}" method="GET" class="py-2.5 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                
                <!-- Left: Results Count & Active Filter Tags -->
                <div class="flex items-center gap-2 text-xs text-slate-600 flex-wrap">
                    <span class="font-medium text-slate-700">
                        Showing <span class="font-bold text-slate-950">{{ $courses->total() }}</span> {{ Str::plural('program', $courses->total()) }}
                    </span>

                    @if(request('mode'))
                        <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-900 border border-amber-200 px-2.5 py-0.5 rounded-full text-[11px] font-semibold">
                            <span>Mode: {{ request('mode') }}</span>
                            <a href="{{ $filterFormAction . '?' . http_build_query(request()->except(['mode', 'page'])) }}" class="hover:text-amber-950 ml-0.5">
                                <i class="fa-solid fa-xmark text-[10px]"></i>
                            </a>
                        </span>
                    @endif

                    @if(request('age'))
                        <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-900 border border-amber-200 px-2.5 py-0.5 rounded-full text-[11px] font-semibold">
                            <span>
                                @if(request('age') == 5) Ages 4-6 @elseif(request('age') == 9) Ages 7-12 @else Ages 13+ @endif
                            </span>
                            <a href="{{ $filterFormAction . '?' . http_build_query(request()->except(['age', 'page'])) }}" class="hover:text-amber-950 ml-0.5">
                                <i class="fa-solid fa-xmark text-[10px]"></i>
                            </a>
                        </span>
                    @endif

                    @if(request('search'))
                        <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-900 border border-amber-200 px-2.5 py-0.5 rounded-full text-[11px] font-semibold">
                            <span>"{{ request('search') }}"</span>
                            <a href="{{ $filterFormAction . '?' . http_build_query(request()->except(['search', 'page'])) }}" class="hover:text-amber-950 ml-0.5">
                                <i class="fa-solid fa-xmark text-[10px]"></i>
                            </a>
                        </span>
                    @endif
                </div>

                <!-- Right: Dropdowns + Search Input + Reset -->
                <div class="flex flex-wrap sm:flex-nowrap items-center gap-2">
                    <!-- Target Audience Switcher -->
                    <div class="relative w-full sm:w-auto">
                        <select 
                            name="audience" 
                            onchange="this.form.submit()" 
                            class="w-full sm:w-auto appearance-none rounded-xl border border-slate-200 bg-slate-50 pl-8.5 pr-8 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-100/70 focus:outline-none focus:border-amber-500 focus:bg-white focus:ring-2 focus:ring-amber-500/20 transition cursor-pointer"
                        >
                            <option value="student" {{ ($selectedAudience ?? 'student') === 'student' ? 'selected' : '' }}>Students Programs</option>
                            <option value="teacher" {{ ($selectedAudience ?? 'student') === 'teacher' ? 'selected' : '' }}>Teachers Programs (TTC)</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-2.5 text-slate-400">
                            <i class="{{ ($isTeacherTrack ?? false) ? 'fa-solid fa-chalkboard-user text-amber-600' : 'fa-solid fa-graduation-cap' }} text-sm"></i>
                        </div>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2.5 text-slate-400">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </div>
                    </div>

                    <!-- Learning Mode -->
                    <div class="relative w-full sm:w-auto">
                        <select 
                            name="mode" 
                            onchange="this.form.submit()" 
                            class="w-full sm:w-auto appearance-none rounded-xl border border-slate-200 bg-slate-50 pl-8.5 pr-8 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-100/70 focus:outline-none focus:border-amber-500 focus:bg-white focus:ring-2 focus:ring-amber-500/20 transition cursor-pointer"
                        >
                            <option value="">All Modes</option>
                            <option value="In-Person" {{ request('mode') === 'In-Person' ? 'selected' : '' }}>In-Person</option>
                            <option value="Online" {{ request('mode') === 'Online' ? 'selected' : '' }}>Online</option>
                            <option value="Hybrid" {{ request('mode') === 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-2.5 text-slate-400">
                            <i class="fa-solid fa-chalkboard-user text-sm"></i>
                        </div>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2.5 text-slate-400">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </div>
                    </div>

                    <!-- Target Age -->
                    <div class="relative w-full sm:w-auto">
                        <select 
                            name="age" 
                            onchange="this.form.submit()" 
                            class="w-full sm:w-auto appearance-none rounded-xl border border-slate-200 bg-slate-50 pl-8.5 pr-8 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-100/70 focus:outline-none focus:border-amber-500 focus:bg-white focus:ring-2 focus:ring-amber-500/20 transition cursor-pointer"
                        >
                            <option value="">All Ages</option>
                            <option value="5" {{ request('age') == '5' ? 'selected' : '' }}>Ages 4 - 6 (Early)</option>
                            <option value="9" {{ request('age') == '9' ? 'selected' : '' }}>Ages 7 - 12 (Junior)</option>
                            <option value="14" {{ request('age') == '14' ? 'selected' : '' }}>Ages 13+ (Teens & Adults)</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-2.5 text-slate-400">
                            <i class="fa-solid fa-user-group text-sm"></i>
                        </div>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2.5 text-slate-400">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </div>
                    </div>

                    <!-- Search Input -->
                    <div class="relative w-full sm:w-64">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Search by course name..." 
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 pl-8.5 pr-8 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 focus:outline-none focus:border-amber-500 focus:bg-white focus:ring-2 focus:ring-amber-500/20 transition"
                        >
                        <i class="fa-solid fa-magnifying-glass text-slate-400 absolute left-2.5 top-3 text-sm pointer-events-none"></i>
                        @if(request('search'))
                            <a 
                                href="{{ $selectedCategory ? route('courses.category', array_merge(['slug' => $selectedCategory->slug], request()->except(['search', 'page']))) : route('courses.index', request()->except(['search', 'page'])) }}" 
                                class="absolute right-2.5 top-2.5 text-slate-400 hover:text-slate-600 text-sm"
                                title="Clear search"
                            >
                                <i class="fa-solid fa-xmark"></i>
                            </a>
                        @endif
                    </div>

                    @if(request()->hasAny(['mode', 'age', 'search']) || $selectedCategory)
                        <a 
                            href="{{ route('courses.index') }}" 
                            class="inline-flex items-center gap-1.5 rounded-xl bg-slate-100 hover:bg-rose-50 text-slate-600 hover:text-rose-600 border border-slate-200 hover:border-rose-200 px-3.5 py-2.5 text-sm font-semibold transition shadow-2xs shrink-0"
                            title="Reset all filters and categories"
                        >
                            <i class="fa-solid fa-rotate-left text-sm"></i>
                            <span>Reset</span>
                        </a>
                    @endif
                </div>

            </form>
        </div>
    </section>

    <!-- Course Grid Section -->
    <section class="py-12 sm:py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if($courses->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($courses as $course)
                        <x-course-card :course="$course" />
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $courses->links() }}
                </div>
            @else
                <!-- No Results State -->
                <div class="rounded-3xl bg-white p-12 text-center border border-slate-200 shadow-xs max-w-lg mx-auto">
                    <div class="h-16 w-16 bg-amber-50 rounded-2xl flex items-center justify-center mx-auto mb-4 text-amber-500">
                        <i class="fa-solid fa-magnifying-glass text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">No Courses Matched</h3>
                    <p class="text-sm text-slate-500 mb-6">
                        We couldn't find any courses matching your selected criteria. Try resetting filters or exploring other categories.
                    </p>
                    <a 
                        href="{{ route('courses.index') }}" 
                        class="inline-flex rounded-xl bg-amber-500 hover:bg-amber-600 px-6 py-2.5 text-sm font-bold text-slate-950 shadow-sm transition"
                    >
                        View All Programs
                    </a>
                </div>
            @endif

        </div>
    </section>

    <!-- Comprehensive Program Duration & Age Limit Guide -->
    <section class="py-16 sm:py-20 bg-white border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-12">
                <span class="inline-flex items-center gap-2 rounded-full bg-amber-100 text-amber-800 px-4 py-1.5 text-xs font-bold uppercase tracking-wider mb-3 border border-amber-200">
                    <i class="fa-solid fa-table-list"></i>
                    <span>Curriculum Matrix</span>
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    Program Duration &amp; Age Limit Guide
                </h2>
                <p class="mt-3 text-sm sm:text-base text-slate-600 leading-relaxed">
                    Quickly reference recommended age groups, curriculum durations, and learning milestones across all cognitive, academic, arts, music, and sports courses.
                </p>
            </div>

            <!-- Responsive Styled Table -->
            <div class="overflow-hidden rounded-3xl border border-slate-200/90 shadow-xs bg-white">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead>
                            <tr class="bg-slate-900 text-white text-xs uppercase tracking-wider border-b border-slate-800">
                                <th class="py-4 px-6 font-bold">
                                    <span class="flex items-center gap-2">
                                        <i class="fa-solid fa-graduation-cap text-amber-400"></i>
                                        <span>Classes</span>
                                    </span>
                                </th>
                                <th class="py-4 px-6 font-bold">
                                    <span class="flex items-center gap-2">
                                        <i class="fa-regular fa-clock text-amber-400"></i>
                                        <span>Duration</span>
                                    </span>
                                </th>
                                <th class="py-4 px-6 font-bold">
                                    <span class="flex items-center gap-2">
                                        <i class="fa-solid fa-child text-amber-400"></i>
                                        <span>Age Limit</span>
                                    </span>
                                </th>
                                <th class="py-4 px-6 font-bold text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @php
                                $programGuide = [
                                    ['name' => 'Abacus', 'slug' => 'abacus', 'duration' => '8 months', 'age' => '4 to 18 yrs', 'icon' => 'fa-solid fa-calculator', 'domain' => 'Brain & Academic Excellence'],
                                    ['name' => 'Vedic Maths', 'slug' => 'vedic-maths', 'duration' => '3 months', 'age' => '8 to 18 yrs', 'icon' => 'fa-solid fa-square-root-variable', 'domain' => 'Brain & Academic Excellence'],
                                    ['name' => 'Phonics', 'slug' => 'phonics', 'duration' => '6 months', 'age' => '3 to 10 yrs', 'icon' => 'fa-solid fa-spell-check', 'domain' => 'Brain & Academic Excellence'],
                                    ['name' => 'MBA (Mid Brain Activation)', 'slug' => 'mid-brain-activation', 'duration' => '1 yr', 'age' => '5 to 18 yrs', 'icon' => 'fa-solid fa-brain', 'domain' => 'Brain & Academic Excellence'],
                                    ['name' => 'QSR (Quantum Speed Reading)', 'slug' => 'quantum-speed-reading', 'duration' => '1 yr', 'age' => '5 to 18 yrs', 'icon' => 'fa-solid fa-bolt', 'domain' => 'Brain & Academic Excellence'],
                                    ['name' => 'Spell Bee', 'slug' => 'spellbee', 'duration' => '5 months', 'age' => '7 to 18 yrs', 'icon' => 'fa-solid fa-book-open-reader', 'domain' => 'Brain & Academic Excellence'],
                                    ['name' => 'Rubik\'s', 'slug' => 'rubiks-cube', 'duration' => '6 months', 'age' => '3 to 10 yrs', 'icon' => 'fa-solid fa-cube', 'domain' => 'Brain & Academic Excellence'],
                                    ['name' => 'Chess', 'slug' => 'chess', 'duration' => '—', 'age' => '5 to 18 yrs', 'icon' => 'fa-solid fa-chess-knight', 'domain' => 'Brain & Academic Excellence'],
                                    ['name' => 'Drawing & Colouring', 'slug' => 'drawing-and-coloring', 'duration' => '10 months', 'age' => '2 yrs to 18 yrs', 'icon' => 'fa-solid fa-palette', 'domain' => 'Arts & Creativity'],
                                    ['name' => 'Art & Craft', 'slug' => 'art-and-craft', 'duration' => '5 months', 'age' => '4 yrs to 10 yrs', 'icon' => 'fa-solid fa-scissors', 'domain' => 'Arts & Creativity'],
                                    ['name' => 'Calligraphy', 'slug' => 'calligraphy', 'duration' => '6 months', 'age' => '7 yrs to 18 yrs', 'icon' => 'fa-solid fa-feather-pointed', 'domain' => 'Arts & Creativity'],
                                    ['name' => 'Handwriting', 'slug' => 'handwriting', 'duration' => '3 months', 'age' => '3 yrs to 18 yrs', 'icon' => 'fa-solid fa-pen-nib', 'domain' => 'Arts & Creativity'],
                                    ['name' => 'Carnatic Music', 'slug' => 'carnatic-music', 'duration' => '—', 'age' => '4 yrs to 18 yrs', 'icon' => 'fa-solid fa-microphone-lines', 'domain' => 'Music & Dance'],
                                    ['name' => 'Keyboard', 'slug' => 'keyboard', 'duration' => '—', 'age' => '4 yrs to 18 yrs', 'icon' => 'fa-solid fa-keyboard', 'domain' => 'Music & Dance'],
                                    ['name' => 'Classical Dance', 'slug' => 'classical-dance', 'duration' => '—', 'age' => '4 yrs to 18 yrs', 'icon' => 'fa-solid fa-person-walking', 'domain' => 'Music & Dance'],
                                    ['name' => 'Western / Folk Dance', 'slug' => 'western-and-folk-dance', 'duration' => '—', 'age' => '4 yrs to 18 yrs', 'icon' => 'fa-solid fa-music', 'domain' => 'Music & Dance'],
                                    ['name' => 'Karate', 'slug' => 'karate', 'duration' => '—', 'age' => '2 yrs to 18 yrs', 'icon' => 'fa-solid fa-hand-fist', 'domain' => 'Sports & Fitness'],
                                    ['name' => 'Silambam', 'slug' => 'silambam', 'duration' => '—', 'age' => '5 yrs to 18 yrs', 'icon' => 'fa-solid fa-shield-halved', 'domain' => 'Sports & Fitness'],
                                    ['name' => 'Yoga', 'slug' => 'yoga', 'duration' => '3 months', 'age' => '3 yrs to 18 yrs', 'icon' => 'fa-solid fa-spa', 'domain' => 'Sports & Fitness'],
                                    ['name' => 'Zumba', 'slug' => 'zumba-and-fitness', 'duration' => '—', 'age' => '3 yrs to 18 yrs', 'icon' => 'fa-solid fa-heart-pulse', 'domain' => 'Sports & Fitness'],
                                    ['name' => 'Gymnastics', 'slug' => 'gymnastics', 'duration' => '—', 'age' => '3 yrs to 18 yrs', 'icon' => 'fa-solid fa-person-running', 'domain' => 'Sports & Fitness'],
                                ];
                            @endphp

                            @foreach($programGuide as $item)
                                <tr class="hover:bg-amber-50/40 transition">
                                    <td class="py-3.5 px-6 font-semibold text-slate-900">
                                        <div class="flex items-center gap-3">
                                            <div class="h-8 w-8 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center shrink-0 text-xs">
                                                <i class="{{ $item['icon'] }}"></i>
                                            </div>
                                            <div>
                                                <a href="{{ route('courses.show', $item['slug']) }}" class="hover:text-amber-600 transition block font-bold text-slate-900">
                                                    {{ $item['name'] }}
                                                </a>
                                                <span class="text-[11px] text-slate-400 block font-normal">{{ $item['domain'] }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3.5 px-6 font-medium text-slate-700">
                                        @if($item['duration'] === '—')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-100 text-xs font-semibold text-slate-600">
                                                <i class="fa-solid fa-infinity text-amber-500 text-[11px]"></i>
                                                <span>Ongoing / Graded</span>
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-100 text-xs font-semibold text-slate-800">
                                                <i class="fa-regular fa-clock text-amber-500 text-[11px]"></i>
                                                <span>{{ $item['duration'] }}</span>
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-6 font-medium text-slate-700">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-800 border border-emerald-100 text-xs font-semibold">
                                            <i class="fa-solid fa-child text-emerald-600 text-[11px]"></i>
                                            <span>{{ $item['age'] }}</span>
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-6 text-right">
                                        <a href="{{ route('courses.show', $item['slug']) }}" class="inline-flex items-center gap-1 text-xs font-bold text-amber-600 hover:text-amber-700 hover:underline">
                                            <span>View Details</span>
                                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>