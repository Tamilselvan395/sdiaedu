<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $siteName = $globalSettings['academy_name'] ?? 'Sri Deekshaa International Academy';
        if (isset($title) && !empty($title)) {
            $pageTitle = str_contains($title, $siteName) ? $title : "{$title} | {$siteName}";
        } else {
            $pageTitle = $globalSettings['seo_home_title'] ?? ($globalSettings['meta_title_default'] ?? "{$siteName} | Skill-Based Learning & Holistic Education");
        }
        $pageDescription = $metaDescription ?? (
            request()->routeIs('home')
                ? ($globalSettings['seo_home_description'] ?? ($globalSettings['meta_description_default'] ?? 'Premier international academy offering skill-based courses in Abacus, Vedic Maths, Robotics, Coding, Creative Arts, and Spoken English.'))
                : ($globalSettings['meta_description_default'] ?? 'Premier international academy offering skill-based courses in Abacus, Vedic Maths, Robotics, Coding, Creative Arts, and Spoken English.')
        );
        $whatsappNumber = $globalSettings['whatsapp_number'] ?? '919876543210';
        $phone = $globalSettings['phone'] ?? '+91 98765 43210';
        $phoneSecondary = $globalSettings['phone_secondary'] ?? ($globalSettings['phone_counseling'] ?? '+91 93446 20346');

        // Resolve active phone numbers (supports two separate settings or delimiter-separated phone strings)
        $phoneNumbers = [];
        if (!empty($phone)) {
            if (str_contains($phone, '/') || str_contains($phone, ',')) {
                foreach (preg_split('/[\/,]+/', $phone) as $p) {
                    $p = trim($p);
                    if (!empty($p) && !in_array($p, $phoneNumbers)) {
                        $phoneNumbers[] = $p;
                    }
                }
            } else {
                $phoneNumbers[] = trim($phone);
            }
        }
        if (!empty($phoneSecondary) && !in_array(trim($phoneSecondary), $phoneNumbers)) {
            $phoneNumbers[] = trim($phoneSecondary);
        }
        if (count($phoneNumbers) < 2) {
            $phoneNumbers[] = '+91 93446 20346';
        }

        $email = $globalSettings['email'] ?? 'info@srideekshaa.com';
        $canonicalUrl = $canonical ?? $canonicalUrl ?? url()->current();
        $logoUrl = !empty($globalSettings['logo_path']) ? asset('storage/' . $globalSettings['logo_path']) : asset('images/sdia.png');
        $faviconUrl = !empty($globalSettings['favicon_path']) ? asset('storage/' . $globalSettings['favicon_path']) : asset('images/sdia.png');

        // Resolve Open Graph & Twitter Social Share Image
        $defaultSocialImage = !empty($globalSettings['og_image_default']) ? asset('storage/' . $globalSettings['og_image_default']) : $logoUrl;
        $pageImage = $ogImage ?? $metaImage ?? $image ?? $defaultSocialImage;
        if (!empty($pageImage) && !str_starts_with($pageImage, 'http://') && !str_starts_with($pageImage, 'https://')) {
            $pageImage = asset($pageImage);
        }
    @endphp

    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    <link rel="canonical" href="{{ $canonicalUrl }}">
    <link rel="icon" type="image/png" href="{{ $faviconUrl }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:site_name" content="{{ $siteName }}">
    @if(!empty($pageImage))
    <meta property="og:image" content="{{ $pageImage }}">
    <meta property="og:image:secure_url" content="{{ $pageImage }}">
    <meta property="og:image:alt" content="{{ $pageTitle }}">
    @endif

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    @if(!empty($pageImage))
    <meta name="twitter:image" content="{{ $pageImage }}">
    <meta name="twitter:image:alt" content="{{ $pageTitle }}">
    @endif

    <!-- Tracking, Analytics, Webmaster Verification & SEO Schema -->
    @include('partials.tracking-head')

    <!-- Vite Assets & Fonts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Font Awesome 6 (Free) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @livewireStyles
    @stack('head')

    @if(!empty($globalSettings['header_scripts']))
        {!! $globalSettings['header_scripts'] !!}
    @endif
</head>
<body class="bg-slate-50 font-sans text-slate-800 antialiased selection:bg-amber-500 selection:text-white" x-data="{ mobileMenuOpen: false }" x-effect="document.body.classList.toggle('overflow-hidden', mobileMenuOpen)">
    @include('partials.tracking-body')

    <!-- Top Announcement Bar -->
    <div class="bg-slate-900 text-slate-300 text-xs sm:text-sm py-2 px-4 border-b border-slate-800">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center rounded-full bg-amber-500/20 px-2.5 py-0.5 text-xs font-bold text-amber-400 uppercase tracking-wider border border-amber-500/30">
                    ADMISSIONS OPEN
                </span>
                <span class="hidden sm:inline text-slate-300">
                    {{ $globalSettings['announcement_bar'] ?? 'New Batches Starting Every Month | Book a Free Assessment' }}
                </span>
            </div>
            <div class="flex items-center gap-4 text-xs sm:text-sm">
                <div class="flex items-center gap-2">
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phoneNumbers[0]) }}" class="hover:text-amber-400 transition flex items-center gap-1.5 font-medium">
                        <i class="fa-solid fa-phone text-amber-400 text-xs"></i>
                        <span>{{ $phoneNumbers[0] }}</span>
                    </a>
                    @if(isset($phoneNumbers[1]))
                        <span class="text-slate-700 hidden md:inline">|</span>
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phoneNumbers[1]) }}" class="hidden md:flex hover:text-amber-400 transition items-center gap-1.5 font-medium" title="Counseling Desk">
                            <i class="fa-solid fa-headset text-amber-400 text-xs"></i>
                            <span>{{ $phoneNumbers[1] }}</span>
                        </a>
                    @endif
                </div>
                <span class="text-slate-700 hidden sm:inline">|</span>
                <a href="mailto:{{ $email }}" class="hidden sm:flex hover:text-amber-400 transition items-center gap-1.5">
                    <i class="fa-solid fa-envelope text-amber-400 text-xs"></i>
                    <span>{{ $email }}</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Sticky Main Navigation -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md shadow-xs border-b border-slate-200/80 transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Logo & Brand -->
                <a href="{{ route('home') }}" class="flex items-center group py-1.5 focus:outline-none" aria-label="{{ $siteName }}">
                    <img 
                        src="{{ $logoUrl }}" 
                        alt="{{ $siteName }}" 
                        class="h-14 sm:h-16 w-auto object-contain transition-transform duration-300 group-hover:scale-105"
                    >
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden lg:flex items-center gap-7 text-sm font-semibold text-slate-700">
                    <a href="{{ route('home') }}" class="hover:text-amber-600 transition {{ request()->routeIs('home') ? 'text-amber-600' : '' }}">
                        Home
                    </a>

                    <!-- Students Dropdown / Mega Menu -->
                    <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <a href="{{ route('courses.index', ['audience' => 'student']) }}" class="inline-flex items-center gap-1.5 hover:text-amber-600 transition py-2 {{ request()->routeIs('courses.*') && request()->query('audience') !== 'teacher' ? 'text-amber-600' : '' }}">
                            <span>Students</span>
                            <i class="fa-solid fa-chevron-down text-[11px] transition group-hover:rotate-180"></i>
                        </a>

                        <!-- Mega Dropdown Menu for Students -->
                        <div 
                            x-show="open" 
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-2"
                            class="absolute top-full rounded-3xl bg-white p-6 shadow-2xl border border-slate-100 ring-1 ring-slate-900/5 z-50"
                            style="left: -110px; width: min(940px, calc(100vw - 2rem)); max-width: calc(100vw - 2rem);"
                            x-cloak
                        >
                            <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-100">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-lg bg-amber-100 text-amber-700 text-xs">
                                        <i class="fa-solid fa-shapes"></i>
                                    </span>
                                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-2">
                                        <span>5 Core Academic &amp; Skill Domains</span>
                                        <i class="fa-solid fa-circle text-[4px] text-slate-400"></i>
                                        <span>25 Student Courses</span>
                                    </span>
                                </div>
                                <a href="{{ route('courses.index', ['audience' => 'student']) }}" class="text-xs font-bold text-amber-600 hover:text-amber-700 flex items-center gap-1">
                                    <span>Full Directory</span>
                                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>

                            <!-- 5 Columns Grid -->
                            <div class="grid grid-cols-5 gap-4">
                                @foreach($navStudentCategories ?? ($navCategories ?? []) as $category)
                                    @php
                                        $catSlug = data_get($category, 'slug');
                                        $catName = data_get($category, 'name');
                                        $catIcon = data_get($category, 'icon', 'fa-solid fa-graduation-cap');
                                        $catCourses = data_get($category, 'courses', []);
                                    @endphp
                                    @continue(empty($catSlug))
                                    <div class="space-y-2.5">
                                        <a 
                                            href="{{ route('courses.category', $catSlug) }}" 
                                            class="group/cat block p-2 rounded-xl hover:bg-slate-50 transition border border-transparent hover:border-slate-100"
                                        >
                                            <div class="flex items-center gap-1.5 text-xs font-bold text-slate-900 group-hover/cat:text-amber-600 transition">
                                                <i class="{{ $catIcon }} text-[11px] text-amber-500"></i>
                                                <span class="truncate leading-tight">{{ $catName }}</span>
                                            </div>
                                            <div class="text-[10px] text-slate-400 font-medium mt-0.5 flex items-center gap-1">
                                                <span>{{ count($catCourses) }} Courses</span>
                                                <i class="fa-solid fa-arrow-right text-[9px] text-amber-500"></i>
                                            </div>
                                        </a>

                                        <ul class="space-y-1 pl-1">
                                            @foreach($catCourses as $course)
                                                <li>
                                                    <a 
                                                        href="{{ route('courses.show', $course['slug']) }}" 
                                                        class="flex items-center gap-1.5 text-xs text-slate-600 hover:text-amber-600 hover:font-semibold py-1 px-1.5 rounded-lg hover:bg-amber-50/60 transition group/link"
                                                        title="{{ $course['title'] }}"
                                                    >
                                                        <i class="fa-solid fa-circle text-[4px] text-slate-300 group-hover/link:text-amber-500"></i>
                                                        <span class="truncate leading-snug">{{ $course['title'] }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Bottom Quick-Access Bar -->
                            <div class="border-t border-slate-100 mt-5 pt-3.5 flex items-center justify-between bg-slate-50 -mx-6 -mb-6 p-4 rounded-b-3xl text-xs">
                                <div class="flex items-center gap-4 text-slate-600">
                                    <span class="inline-flex items-center gap-1.5 font-medium">
                                        <i class="fa-solid fa-certificate text-amber-500"></i>
                                        Government &amp; Academy Certified
                                    </span>
                                    <span class="inline-flex items-center gap-1.5 font-medium">
                                        <i class="fa-solid fa-user-check text-emerald-600"></i>
                                        Small Batch Sizes (1:8)
                                    </span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('pages.assessment') }}" class="font-bold text-emerald-700 hover:text-emerald-800 flex items-center gap-1">
                                        <span>Free Skill Quiz</span>
                                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                    </a>
                                    <a href="{{ route('courses.index', ['audience' => 'student']) }}" class="font-bold text-amber-600 hover:text-amber-700 bg-white px-3 py-1.5 rounded-xl border border-slate-200 shadow-xs hover:border-amber-300 transition flex items-center gap-1.5">
                                        <span>Browse All Student Courses</span>
                                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Teachers Dropdown / Mega Menu -->
                    <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <a href="{{ route('teacher-training.index') }}" class="inline-flex items-center gap-1.5 hover:text-amber-600 transition py-2 {{ request()->routeIs('teacher-training.*') ? 'text-amber-600' : '' }}">
                            <span>Teachers</span>
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800 border border-amber-200">TTC</span>
                            <i class="fa-solid fa-chevron-down text-[11px] transition group-hover:rotate-180"></i>
                        </a>

                        <!-- Mega Dropdown Menu for Teachers -->
                        <div 
                            x-show="open" 
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-2"
                            class="absolute top-full rounded-3xl bg-white p-6 shadow-2xl border border-slate-100 ring-1 ring-slate-900/5 z-50 max-h-[85vh] overflow-y-auto"
                            style="left: -260px; width: min(940px, calc(100vw - 2rem)); max-width: calc(100vw - 2rem);"
                            x-cloak
                        >
                            <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-100">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-lg bg-emerald-100 text-emerald-700 text-xs">
                                        <i class="fa-solid fa-chalkboard-user"></i>
                                    </span>
                                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-2">
                                        <span>5 Specialized TTC Domains</span>
                                        <i class="fa-solid fa-circle text-[4px] text-slate-400"></i>
                                        <span>23 Teacher Training Programs</span>
                                    </span>
                                </div>
                                <a href="{{ route('teacher-training.index') }}" class="text-xs font-bold text-amber-600 hover:text-amber-700 flex items-center gap-1">
                                    <span>Full Directory</span>
                                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>

                            <!-- 5 Columns Grid for Teacher Categories -->
                            <div class="grid grid-cols-5 gap-4">
                                @foreach($navTeacherCategories ?? [] as $category)
                                    @php
                                        $catSlug = data_get($category, 'slug');
                                        $catName = data_get($category, 'name');
                                        $catIcon = data_get($category, 'icon', 'fa-solid fa-chalkboard-user');
                                        $catCourses = data_get($category, 'courses', []);
                                    @endphp
                                    @continue(empty($catSlug))
                                    <div class="space-y-2.5">
                                        <a 
                                            href="{{ route('teacher-training.category', $catSlug) }}" 
                                            class="group/cat block p-2 rounded-xl hover:bg-slate-50 transition border border-transparent hover:border-slate-100"
                                        >
                                            <div class="flex items-center gap-1.5 text-xs font-bold text-slate-900 group-hover/cat:text-amber-600 transition">
                                                <i class="{{ $catIcon }} text-[11px] text-amber-500"></i>
                                                <span class="truncate leading-tight">{{ $catName }}</span>
                                            </div>
                                            <div class="text-[10px] text-slate-400 font-medium mt-0.5 flex items-center gap-1">
                                                <span>{{ count($catCourses) }} Programs</span>
                                                <i class="fa-solid fa-arrow-right text-[9px] text-amber-500"></i>
                                            </div>
                                        </a>

                                        <ul class="space-y-1 pl-1">
                                            @foreach($catCourses as $course)
                                                <li>
                                                    <a 
                                                        href="{{ route('courses.show', $course['slug']) }}" 
                                                        class="flex items-center gap-1.5 text-xs text-slate-600 hover:text-amber-600 hover:font-semibold py-1 px-1.5 rounded-lg hover:bg-amber-50/60 transition group/link"
                                                        title="{{ $course['title'] }}"
                                                    >
                                                        <i class="fa-solid fa-circle text-[4px] text-slate-300 group-hover/link:text-amber-500"></i>
                                                        <span class="truncate leading-snug">{{ $course['title'] }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Bottom Quick-Access Bar for Teachers -->
                            <div class="border-t border-slate-100 mt-5 pt-3.5 flex items-center justify-between bg-slate-50 -mx-6 -mb-6 p-4 rounded-b-3xl text-xs">
                                <div class="flex items-center gap-4 text-slate-600">
                                    <span class="inline-flex items-center gap-1.5 font-medium">
                                        <i class="fa-solid fa-award text-amber-500"></i>
                                        ISO 9001 Accredited TTC
                                    </span>
                                    <span class="inline-flex items-center gap-1.5 font-medium">
                                        <i class="fa-solid fa-hand-holding-dollar text-emerald-600"></i>
                                        Zero Royalty Model
                                    </span>
                                    <span class="inline-flex items-center gap-1.5 font-medium">
                                        <i class="fa-solid fa-toolbox text-blue-600"></i>
                                        Complete Teaching Kits
                                    </span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('pages.franchise') }}" class="font-bold text-amber-700 hover:text-amber-800 flex items-center gap-1">
                                        <span>Start Academy</span>
                                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                    </a>
                                    <a href="{{ route('teacher-training.index') }}" class="font-bold text-amber-600 hover:text-amber-700 bg-white px-3 py-1.5 rounded-xl border border-slate-200 shadow-xs hover:border-amber-300 transition flex items-center gap-1.5">
                                        <span>Browse All 23 Teacher Courses</span>
                                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('pages.assessment') }}" class="inline-flex items-center gap-1.5 text-emerald-700 hover:text-emerald-800 transition font-bold {{ request()->routeIs('pages.assessment') ? 'text-emerald-800 underline' : '' }}">
                        <span class="inline-block h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Skill Quiz
                    </a>

                    <a href="{{ route('events.index') }}" class="hover:text-amber-600 transition {{ request()->routeIs('events.*') ? 'text-amber-600' : '' }}">
                        Events
                    </a>

                    <a href="{{ route('pages.verify-certificate') }}" class="hover:text-amber-600 transition {{ request()->routeIs('pages.verify-certificate') ? 'text-amber-600' : '' }}">
                        Verify Certificate
                    </a>

                    <a href="{{ route('pages.contact') }}" class="hover:text-amber-600 transition {{ request()->routeIs('pages.contact') ? 'text-amber-600' : '' }}">
                        Contact
                    </a>

                    <a href="{{ route('pages.franchise') }}" class="hover:text-amber-600 transition {{ request()->routeIs('pages.franchise') ? 'text-amber-600 font-bold' : '' }}">
                        Franchise
                    </a>
                </nav>

                <!-- Desktop Header Action CTAs -->
                <div class="hidden sm:flex items-center gap-3">
                    <x-whatsapp-btn 
                        label="WhatsApp" 
                        size="sm" 
                        class="hidden xl:inline-flex" 
                    />
                    
                    <button 
                        type="button" 
                        @click="$dispatch('open-enquiry-modal', {})"
                        class="rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-sm font-bold px-4 py-2.5 transition shadow-sm hover:shadow active:scale-95"
                    >
                        Book Free Trial
                    </button>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center gap-2 lg:hidden">
                    <button 
                        @click="mobileMenuOpen = true" 
                        type="button" 
                        class="rounded-xl p-2.5 text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition focus:outline-none"
                        aria-label="Open Navigation Menu"
                    >
                        <i class="fa-solid fa-bars text-xl leading-none"></i>
                    </button>
                </div>

            </div>
        </div>
    </header>

    <!-- Mobile Off-Canvas Drawer (Slide-Over) -->
    <div 
        x-show="mobileMenuOpen" 
        class="fixed inset-0 z-50 lg:hidden"
        x-cloak
        @keydown.window.escape="mobileMenuOpen = false"
    >
        <!-- Dimmed Backdrop Overlay -->
        <div 
            x-show="mobileMenuOpen" 
            x-transition:enter="transition-opacity ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="mobileMenuOpen = false"
            class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs"
            aria-hidden="true"
        ></div>

        <!-- Slide-Over Drawer Container -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute inset-0 overflow-hidden">
                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                    <div 
                        x-show="mobileMenuOpen" 
                        x-transition:enter="transform transition ease-out duration-300"
                        x-transition:enter-start="translate-x-full"
                        x-transition:enter-end="translate-x-0"
                        x-transition:leave="transform transition ease-in duration-200"
                        x-transition:leave-start="translate-x-0"
                        x-transition:leave-end="translate-x-full"
                        class="pointer-events-auto w-screen max-w-xs sm:max-w-sm bg-white shadow-2xl flex flex-col justify-between overflow-y-auto"
                    >
                        <!-- Drawer Header -->
                        <div class="p-4 sm:p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                            <a href="{{ route('home') }}" @click="mobileMenuOpen = false" class="flex items-center">
                                <img 
                                    src="{{ $logoUrl }}" 
                                    alt="{{ $siteName }}" 
                                    class="h-11 sm:h-12 w-auto object-contain"
                                >
                            </a>
                            <button 
                                @click="mobileMenuOpen = false" 
                                type="button" 
                                class="rounded-xl p-2 text-slate-500 hover:text-slate-900 hover:bg-slate-200/60 transition focus:outline-none cursor-pointer"
                                aria-label="Close Navigation"
                            >
                                <i class="fa-solid fa-xmark text-xl leading-none"></i>
                            </button>
                        </div>

                        <!-- Drawer Navigation Links -->
                        <div class="p-4 sm:p-5 space-y-1.5 flex-1 overflow-y-auto">
                            <div class="text-xs font-bold text-slate-400 uppercase tracking-wider px-3 mb-2">
                                Menu
                            </div>

                            <a 
                                href="{{ route('home') }}" 
                                @click="mobileMenuOpen = false"
                                class="flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-base font-semibold text-slate-800 hover:bg-amber-50 hover:text-amber-700 transition {{ request()->routeIs('home') ? 'bg-amber-50 text-amber-600 font-bold' : '' }}"
                            >
                                <i class="fa-solid fa-house w-5 text-center text-slate-400"></i>
                                <span>Home</span>
                            </a>

                            <!-- Students Accordion -->
                            <div x-data="{ expanded: {{ request()->routeIs('courses.*') && request()->query('audience') !== 'teacher' ? 'true' : 'false' }} }" class="space-y-1">
                                <div 
                                    class="flex items-center justify-between rounded-xl px-3.5 py-2.5 text-base font-semibold text-slate-800 hover:bg-amber-50 hover:text-amber-700 transition cursor-pointer {{ request()->routeIs('courses.*') && request()->query('audience') !== 'teacher' ? 'bg-amber-50/70 text-amber-700' : '' }}" 
                                    @click="expanded = !expanded"
                                >
                                    <div class="flex items-center gap-3">
                                        <i class="fa-solid fa-graduation-cap w-5 text-center text-slate-400"></i>
                                        <span>Students Programs</span>
                                    </div>
                                    <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" :class="{ 'rotate-180': expanded }"></i>
                                </div>

                                <div x-show="expanded" x-cloak class="pl-3 pr-1 py-1 space-y-2 border-l-2 border-amber-300 ml-4">
                                    <a 
                                        href="{{ route('courses.index', ['audience' => 'student']) }}" 
                                        @click="mobileMenuOpen = false"
                                        class="flex items-center justify-between rounded-lg px-3 py-1.5 text-xs font-bold text-amber-600 hover:bg-amber-50 transition"
                                    >
                                        <span>Browse All 25 Student Courses</span>
                                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                    </a>
                                    
                                    @foreach($navStudentCategories ?? ($navCategories ?? []) as $category)
                                        @php
                                            $catSlug = data_get($category, 'slug');
                                            $catName = data_get($category, 'name');
                                            $catIcon = data_get($category, 'icon', 'fa-solid fa-folder');
                                            $catCourses = data_get($category, 'courses', []);
                                            $catCount = data_get($category, 'active_courses_count', count($catCourses));
                                        @endphp
                                        @continue(empty($catSlug))
                                        <div x-data="{ openCat: false }" class="rounded-xl border border-slate-100 bg-slate-50/70 overflow-hidden">
                                            <button 
                                                type="button" 
                                                @click="openCat = !openCat"
                                                class="w-full flex items-center justify-between p-2.5 text-left text-xs font-bold text-slate-800 hover:bg-amber-50/50 transition cursor-pointer"
                                            >
                                                <div class="flex items-center gap-2 truncate pr-2">
                                                    <i class="{{ $catIcon }} text-[11px] text-amber-500 w-4 text-center"></i>
                                                    <span class="truncate">{{ $catName }}</span>
                                                </div>
                                                <div class="flex items-center gap-1.5 flex-shrink-0">
                                                    <span class="text-[10px] text-slate-500 bg-white border border-slate-200 px-1.5 py-0.5 rounded-full font-semibold">{{ $catCount }}</span>
                                                    <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 transition-transform duration-200" :class="{ 'rotate-180': openCat }"></i>
                                                </div>
                                            </button>

                                            <div x-show="openCat" x-cloak class="p-2 pt-0 space-y-1 bg-white border-t border-slate-100">
                                                <a 
                                                    href="{{ route('courses.category', $catSlug) }}" 
                                                    @click="mobileMenuOpen = false"
                                                    class="flex items-center justify-between text-[11px] font-bold text-amber-600 hover:underline px-2 py-1"
                                                >
                                                    <span>View {{ $catName }} Overview</span>
                                                    <i class="fa-solid fa-arrow-right text-[9px]"></i>
                                                </a>
                                                @foreach($catCourses as $course)
                                                    <a 
                                                        href="{{ route('courses.show', $course['slug']) }}" 
                                                        @click="mobileMenuOpen = false"
                                                        class="flex items-center gap-2 rounded-lg px-2 py-1 text-xs text-slate-700 hover:bg-amber-50 hover:text-amber-700 transition"
                                                    >
                                                        <i class="fa-solid fa-circle text-[4px] text-slate-300"></i>
                                                        <span class="truncate">{{ $course['title'] }}</span>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Teachers Accordion -->
                            <div x-data="{ expanded: {{ request()->routeIs('teacher-training.*') ? 'true' : 'false' }} }" class="space-y-1">
                                <div 
                                    class="flex items-center justify-between rounded-xl px-3.5 py-2.5 text-base font-semibold text-slate-800 hover:bg-amber-50 hover:text-amber-700 transition cursor-pointer {{ request()->routeIs('teacher-training.*') ? 'bg-amber-50/70 text-amber-700' : '' }}" 
                                    @click="expanded = !expanded"
                                >
                                    <div class="flex items-center gap-3">
                                        <i class="fa-solid fa-chalkboard-user w-5 text-center text-slate-400"></i>
                                        <span>Teachers Programs</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-[10px] font-bold px-1.5 py-0.5 rounded-full bg-amber-100 text-amber-800 border border-amber-200">23 TTC</span>
                                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" :class="{ 'rotate-180': expanded }"></i>
                                    </div>
                                </div>

                                <div x-show="expanded" x-cloak class="pl-3 pr-1 py-1 space-y-2 border-l-2 border-emerald-400 ml-4">
                                    <a 
                                        href="{{ route('teacher-training.index') }}" 
                                        @click="mobileMenuOpen = false"
                                        class="flex items-center justify-between rounded-lg px-3 py-1.5 text-xs font-bold text-emerald-700 hover:bg-emerald-50 transition"
                                    >
                                        <span>Browse All 23 Teacher TTC Courses</span>
                                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                    </a>

                                    @foreach($navTeacherCategories ?? [] as $category)
                                        @php
                                            $catSlug = data_get($category, 'slug');
                                            $catName = data_get($category, 'name');
                                            $catIcon = data_get($category, 'icon', 'fa-solid fa-chalkboard-user');
                                            $catCourses = data_get($category, 'courses', []);
                                            $catCount = count($catCourses);
                                        @endphp
                                        @continue(empty($catSlug))
                                        <div x-data="{ openCat: false }" class="rounded-xl border border-slate-100 overflow-hidden bg-slate-50/50">
                                            <button 
                                                type="button" 
                                                @click="openCat = !openCat"
                                                class="w-full flex items-center justify-between p-2.5 text-left text-xs font-bold text-slate-800 hover:bg-amber-50/50 transition cursor-pointer"
                                            >
                                                <div class="flex items-center gap-2 truncate pr-2">
                                                    <i class="{{ $catIcon }} text-[11px] text-amber-500 w-4 text-center"></i>
                                                    <span class="truncate">{{ $catName }}</span>
                                                </div>
                                                <div class="flex items-center gap-1.5 flex-shrink-0">
                                                    <span class="text-[10px] text-slate-500 bg-white border border-slate-200 px-1.5 py-0.5 rounded-full font-semibold">{{ $catCount }}</span>
                                                    <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 transition-transform duration-200" :class="{ 'rotate-180': openCat }"></i>
                                                </div>
                                            </button>

                                            <div x-show="openCat" x-cloak class="p-2 pt-0 space-y-1 bg-white border-t border-slate-100">
                                                <a 
                                                    href="{{ route('teacher-training.category', $catSlug) }}" 
                                                    @click="mobileMenuOpen = false"
                                                    class="flex items-center justify-between text-[11px] font-bold text-amber-600 hover:underline px-2 py-1"
                                                >
                                                    <span>View {{ $catName }} TTC</span>
                                                    <i class="fa-solid fa-arrow-right text-[9px]"></i>
                                                </a>
                                                @foreach($catCourses as $course)
                                                    <a 
                                                        href="{{ route('courses.show', $course['slug']) }}" 
                                                        @click="mobileMenuOpen = false"
                                                        class="flex items-center gap-2 rounded-lg px-2 py-1 text-xs text-slate-700 hover:bg-amber-50 hover:text-amber-700 transition"
                                                    >
                                                        <i class="fa-solid fa-circle text-[4px] text-slate-300"></i>
                                                        <span class="truncate">{{ $course['title'] }}</span>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <a 
                                href="{{ route('pages.assessment') }}" 
                                @click="mobileMenuOpen = false"
                                class="flex items-center justify-between rounded-xl px-3.5 py-2.5 text-base font-semibold text-emerald-800 bg-emerald-50 hover:bg-emerald-100/70 transition"
                            >
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-clipboard-question w-5 text-center text-emerald-600"></i>
                                    <span>Skill Assessment Quiz</span>
                                </div>
                                <span class="inline-flex items-center rounded-full bg-emerald-200/80 px-2 py-0.5 text-xs font-bold text-emerald-800">
                                    2 Mins
                                </span>
                            </a>

                            <a 
                                href="{{ route('events.index') }}" 
                                @click="mobileMenuOpen = false"
                                class="flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-base font-semibold text-slate-800 hover:bg-amber-50 hover:text-amber-700 transition {{ request()->routeIs('events.*') ? 'bg-amber-50 text-amber-600 font-bold' : '' }}"
                            >
                                <i class="fa-solid fa-calendar-days w-5 text-center text-slate-400"></i>
                                <span>Events & Workshops</span>
                            </a>

                            <a 
                                href="{{ route('pages.about') }}" 
                                @click="mobileMenuOpen = false"
                                class="flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-base font-semibold text-slate-800 hover:bg-amber-50 hover:text-amber-700 transition {{ request()->routeIs('pages.about') ? 'bg-amber-50 text-amber-600 font-bold' : '' }}"
                            >
                                <i class="fa-solid fa-landmark w-5 text-center text-slate-400"></i>
                                <span>About Academy</span>
                            </a>

                            <a 
                                href="{{ route('pages.verify-certificate') }}" 
                                @click="mobileMenuOpen = false"
                                class="flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-base font-semibold text-slate-800 hover:bg-amber-50 hover:text-amber-700 transition {{ request()->routeIs('pages.verify-certificate') ? 'bg-amber-50 text-amber-600 font-bold' : '' }}"
                            >
                                <i class="fa-solid fa-certificate w-5 text-center text-slate-400"></i>
                                <span>Verify Certificate</span>
                            </a>

                            <a 
                                href="{{ route('pages.contact') }}" 
                                @click="mobileMenuOpen = false"
                                class="flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-base font-semibold text-slate-800 hover:bg-amber-50 hover:text-amber-700 transition {{ request()->routeIs('pages.contact') ? 'bg-amber-50 text-amber-600 font-bold' : '' }}"
                            >
                                <i class="fa-solid fa-location-dot w-5 text-center text-slate-400"></i>
                                <span>Contact & Campus</span>
                            </a>

                            <a 
                                href="{{ route('pages.franchise') }}" 
                                @click="mobileMenuOpen = false"
                                class="flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-base font-semibold text-slate-800 hover:bg-amber-50 hover:text-amber-700 transition {{ request()->routeIs('pages.franchise') ? 'bg-amber-50 text-amber-600 font-bold' : '' }}"
                            >
                                <i class="fa-solid fa-handshake w-5 text-center text-amber-500"></i>
                                <span>Franchise Enquiry</span>
                            </a>

                            <!-- Direct Contact Info in Drawer -->
                            <div class="pt-4 border-t border-slate-100 mt-4 space-y-1">
                                <div class="text-xs font-bold text-slate-400 uppercase tracking-wider px-3 mb-1">
                                    Direct Contact
                                </div>
                                @foreach($phoneNumbers as $idx => $phoneItem)
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phoneItem) }}" class="flex items-center gap-3 rounded-xl px-3.5 py-2 text-sm text-slate-700 hover:bg-slate-50 transition">
                                        <i class="fa-solid {{ $idx === 0 ? 'fa-phone' : 'fa-headset' }} w-5 text-center text-amber-600"></i>
                                        <span>{{ $phoneItem }}</span>
                                        @if($idx === 1)
                                            <span class="ml-auto text-[10px] font-semibold text-amber-700 bg-amber-50 px-2 py-0.5 rounded-full">Counseling</span>
                                        @endif
                                    </a>
                                @endforeach
                                <a href="mailto:{{ $email }}" class="flex items-center gap-3 rounded-xl px-3.5 py-2 text-sm text-slate-700 hover:bg-slate-50 transition">
                                    <i class="fa-solid fa-envelope w-5 text-center text-amber-600"></i>
                                    <span class="truncate">{{ $email }}</span>
                                </a>
                            </div>
                        </div>

                        <!-- Drawer Footer Actions -->
                        <div class="p-4 sm:p-5 border-t border-slate-100 bg-slate-50 space-y-2.5">
                            <button 
                                type="button" 
                                @click="mobileMenuOpen = false; $dispatch('open-enquiry-modal', {})"
                                class="w-full rounded-xl bg-slate-900 hover:bg-slate-800 text-white py-3 text-center text-sm font-bold shadow-sm transition active:scale-95 flex items-center justify-center gap-2 cursor-pointer"
                            >
                                <i class="fa-solid fa-calendar-check text-amber-400"></i>
                                <span>Book Free Counseling Session</span>
                            </button>
                            
                            <a 
                                href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsappNumber) }}?text={{ rawurlencode($globalSettings['whatsapp_default_message'] ?? 'Hello Sri Deekshaa Academy, I would like to inquire about courses.') }}" 
                                target="_blank" 
                                rel="noopener noreferrer"
                                class="w-full rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 text-center text-sm font-semibold shadow-sm transition flex items-center justify-center gap-2 active:scale-95"
                            >
                                <i class="fa-brands fa-whatsapp text-lg"></i>
                                <span>Chat on WhatsApp</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Alerts -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-4" x-data="{ show: true }" x-show="show">
            <div class="rounded-2xl bg-emerald-50 border border-emerald-200 p-4 flex items-center justify-between text-emerald-800 text-sm">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-emerald-600 hover:text-emerald-900 text-xs font-bold">Dismiss</button>
            </div>
        </div>
    @endif

    <!-- Page Content Slot -->
    <main>
        {{ $slot }}
    </main>

    <!-- Academy Footer -->
    <footer class="bg-slate-950 text-slate-400 text-sm pt-14 pb-20 sm:pb-6 border-t border-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-slate-800">
                
                <!-- Col 1 & 2: Brand & Mission -->
                <div class="lg:col-span-2 space-y-4">
                    <a href="{{ route('home') }}" class="inline-block rounded-2xl bg-white p-2.5 shadow-md hover:bg-slate-50 transition group" aria-label="{{ $siteName }}">
                        <img 
                            src="{{ $logoUrl }}" 
                            alt="{{ $siteName }}" 
                            class="h-12 sm:h-14 w-auto object-contain transition-transform duration-300 group-hover:scale-105"
                        >
                    </a>
                    
                    <p class="text-sm text-slate-400 leading-relaxed max-w-sm">
                        {{ $globalSettings['tagline'] ?? 'Learn Today. Grow Tomorrow.' }} Empowering young minds with scientifically proven, progressive skill training including Abacus, Vedic Maths, Robotics, AI, Creative Arts, and Leadership.
                    </p>

                    <!-- Trust Stats Counter Strip -->
                    <div class="grid grid-cols-3 gap-3 pt-2 max-w-xs text-center">
                        <div class="rounded-xl bg-slate-900 p-2.5 border border-slate-800">
                            <span class="block text-base font-bold text-amber-400">{{ $globalSettings['stat_students'] ?? '2,500+' }}</span>
                            <span class="text-xs text-slate-400 font-medium">Students</span>
                        </div>
                        <div class="rounded-xl bg-slate-900 p-2.5 border border-slate-800">
                            <span class="block text-base font-bold text-amber-400">{{ $globalSettings['stat_courses'] ?? '25+' }}</span>
                            <span class="text-xs text-slate-400 font-medium">Courses</span>
                        </div>
                        <div class="rounded-xl bg-slate-900 p-2.5 border border-slate-800">
                            <span class="block text-base font-bold text-amber-400">{{ $globalSettings['stat_years'] ?? '8+' }}</span>
                            <span class="text-xs text-slate-400 font-medium">Years</span>
                        </div>
                    </div>
                </div>

                <!-- Col 3: Programs & Age Tracks -->
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-slate-200 mb-4">
                        Skill Tracks
                    </h4>
                    <ul class="space-y-2.5 text-sm">
                        @foreach($navCategories ?? [] as $category)
                            @php
                                $catSlug = data_get($category, 'slug');
                                $catName = data_get($category, 'name');
                            @endphp
                            @continue(empty($catSlug))
                            <li>
                                <a href="{{ route('courses.category', $catSlug) }}" class="hover:text-amber-400 transition">
                                    {{ $catName }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <h4 class="text-sm font-bold uppercase tracking-wider text-slate-200 mt-6 mb-3 pt-4 border-t border-slate-900">
                        Age-Based Programs
                    </h4>
                    <ul class="space-y-2.5 text-sm">
                        <li>
                            <a href="{{ route('pages.for-kids') }}" class="hover:text-amber-400 transition flex items-center gap-2 text-slate-300 group">
                                <i class="fa-solid fa-child text-amber-500 text-sm group-hover:scale-110 transition-transform"></i>
                                <span class="font-medium">Kids Track (Ages 4-10)</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pages.for-teens') }}" class="hover:text-amber-400 transition flex items-center gap-2 text-slate-300 group">
                                <i class="fa-solid fa-user-graduate text-amber-500 text-sm group-hover:scale-110 transition-transform"></i>
                                <span class="font-medium">Teens Track (Ages 11-18)</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Col 4: Quick Links -->
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-slate-200 mb-4">
                        Navigation
                    </h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('pages.about') }}" class="hover:text-amber-400 transition">About Sri Deekshaa</a></li>
                        <li><a href="{{ route('pages.assessment') }}" class="hover:text-amber-400 transition">Free Skill Assessment</a></li>
                        <li><a href="{{ route('pages.verify-certificate') }}" class="hover:text-amber-400 transition">Verify Certificate</a></li>
                        <li><a href="{{ route('events.index') }}" class="hover:text-amber-400 transition">Upcoming Events & Workshops</a></li>
                        <li><a href="{{ route('blog.index') }}" class="hover:text-amber-400 transition">Parenting & Skill Blog</a></li>
                        <li><a href="{{ route('pages.contact') }}" class="hover:text-amber-400 transition">Contact & Branches</a></li>
                        <li><a href="{{ route('pages.franchise') }}" class="hover:text-amber-400 transition">Franchise Opportunities</a></li>
                    </ul>
                </div>

                <!-- Col 5: Contact & Hours -->
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-slate-200 mb-4">
                        Contact Campus
                    </h4>
                    <div class="space-y-2.5 text-sm leading-relaxed text-slate-400">
                        <p class="text-slate-300">{{ $globalSettings['address'] ?? 'Plot No. 42, 2nd Avenue' }}, {{ $globalSettings['city'] ?? 'Chennai' }} - {{ $globalSettings['pincode'] ?? '600040' }}</p>
                        <div class="flex items-start gap-1.5">
                            <strong class="text-slate-200 shrink-0">Phone:</strong>
                            <div class="flex flex-wrap items-center gap-x-2 gap-y-1">
                                @foreach($phoneNumbers as $idx => $phoneItem)
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phoneItem) }}" class="text-slate-300 hover:text-amber-400 transition">
                                        {{ $phoneItem }}
                                    </a>
                                    @if(!$loop->last)
                                        <span class="text-slate-600">/</span>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <p><strong class="text-slate-200">Email:</strong> {{ $email }}</p>
                        <p><strong class="text-slate-200">Hours:</strong> {{ $globalSettings['working_hours'] ?? 'Mon - Sat: 9am - 7:30pm' }}</p>
                    </div>

                    <div class="mt-4 pt-3 border-t border-slate-900">
                        <x-whatsapp-btn label="WhatsApp Us" size="sm" class="w-full text-center" />
                    </div>
                </div>

            </div>

            <!-- Bottom Copyright & Legal -->
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs sm:text-sm text-slate-400">
                <p>© {{ date('Y') }} {{ $siteName }}. All rights reserved. Built for progressive education.</p>
                <div class="flex items-center gap-3 text-xs">
                    <a href="{{ route('pages.contact') }}" class="hover:text-slate-300 transition">Privacy Policy</a>
                    <i class="fa-solid fa-circle text-[4px] text-slate-600"></i>
                    <a href="{{ route('pages.contact') }}" class="hover:text-slate-300 transition">Terms of Enrollment</a>
                    <i class="fa-solid fa-circle text-[4px] text-slate-600"></i>
                    <a href="{{ route('pages.verify-certificate') }}" class="hover:text-slate-300 transition">Certificate Lookup</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Sticky Bottom Action Bar (visible on mobile only) -->
    <div class="fixed bottom-0 inset-x-0 z-40 bg-white border-t border-slate-200 sm:hidden shadow-lg print:hidden">
        <div class="grid grid-cols-4 text-center py-2">
            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="flex flex-col items-center justify-center text-[10px] font-semibold text-slate-700 hover:text-amber-600">
                <i class="fa-solid fa-phone text-base mb-1 text-slate-700"></i>
                <span>Call Now</span>
            </a>
            
            @php
                $waMobileUrl = "https://wa.me/" . preg_replace('/[^0-9]/', '', $whatsappNumber) . "?text=" . rawurlencode($globalSettings['whatsapp_default_message'] ?? 'Hello Sri Deekshaa Academy, I would like to inquire about courses.');
            @endphp
            <a href="{{ $waMobileUrl }}" target="_blank" class="flex flex-col items-center justify-center text-[10px] font-semibold text-emerald-600">
                <i class="fa-brands fa-whatsapp text-lg mb-1 text-emerald-600"></i>
                <span>WhatsApp</span>
            </a>

            <a href="{{ route('pages.assessment') }}" class="flex flex-col items-center justify-center text-[10px] font-semibold text-amber-600">
                <i class="fa-solid fa-clipboard-question text-base mb-1 text-amber-600"></i>
                <span>Skill Quiz</span>
            </a>

            <button type="button" @click="$dispatch('open-enquiry-modal', {})" class="flex flex-col items-center justify-center text-[10px] font-bold text-amber-600 bg-amber-50">
                <i class="fa-solid fa-calendar-check text-base mb-1 text-amber-600"></i>
                <span>Book Trial</span>
            </button>
        </div>
    </div>

    <!-- Entrance Popup for Upcoming Event -->
    <x-event-popup :event="$upcomingPopupEvent ?? null" />

    <!-- Reusable Quick Enquiry Modal -->
    <x-enquiry-modal />

    <!-- Floating Action Group (WhatsApp, Phone, Enquiry Form) -->
    <x-floating-actions />

    <!-- Cookie & Consent Management Banner -->
    <x-consent-banner />

    @if(!empty($globalSettings['footer_scripts']))
        {!! $globalSettings['footer_scripts'] !!}
    @endif

    @stack('scripts')
    @livewireScripts
</body>
</html>