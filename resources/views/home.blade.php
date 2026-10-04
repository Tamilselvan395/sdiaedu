<x-layouts.app>
    @push('head')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        <style>
            .why-choose-swiper-pagination,
            .testimonials-swiper-pagination {
                position: static !important;
                display: flex !important;
                align-items: center;
                justify-content: center;
                margin-top: 2.25rem !important;
                width: 100% !important;
            }
            .why-choose-swiper-pagination .swiper-pagination-bullet,
            .testimonials-swiper-pagination .swiper-pagination-bullet {
                width: 10px;
                height: 10px;
                margin: 0 4px !important;
                background: #cbd5e1;
                opacity: 1;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                cursor: pointer;
            }
            .why-choose-swiper-pagination .swiper-pagination-bullet-active,
            .testimonials-swiper-pagination .swiper-pagination-bullet-active {
                width: 32px;
                border-radius: 9999px;
                background: #f59e0b;
            }
            .why-choose-swiper .swiper-slide,
            .testimonials-swiper .swiper-slide {
                height: auto;
                display: flex;
            }
            /* Hero 3D Deck Coverflow Swiper */
            .hero-courses-swiper {
                width: 100%;
                padding-top: 15px;
                padding-bottom: 20px;
                overflow: hidden !important;
            }
            .hero-courses-swiper .swiper-slide {
                width: 270px;
                height: auto;
                transition: opacity 0.35s ease, filter 0.35s ease, transform 0.35s ease, visibility 0.35s ease;
                opacity: 0 !important;
                visibility: hidden !important;
                pointer-events: none !important;
            }
            @media (min-width: 640px) {
                .hero-courses-swiper .swiper-slide {
                    width: 290px;
                }
            }
            @media (min-width: 1024px) {
                .hero-courses-swiper .swiper-slide {
                    width: 300px;
                }
            }
            /* EXACTLY 3 CARDS VISIBLE: Previous, Active, Next. All other cards hidden. */
            .hero-courses-swiper .swiper-slide-active,
            .hero-courses-swiper .swiper-slide-prev,
            .hero-courses-swiper .swiper-slide-next {
                opacity: 0.65 !important;
                visibility: visible !important;
                pointer-events: auto !important;
                filter: brightness(0.85);
            }
            .hero-courses-swiper .swiper-slide-active {
                opacity: 1 !important;
                filter: brightness(1) !important;
                z-index: 30 !important;
            }
            .hero-courses-swiper .swiper-slide-active > div {
                border-color: rgba(245, 158, 11, 0.55) !important;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6), 0 0 30px rgba(245, 158, 11, 0.15) !important;
            }
            .hero-courses-swiper-pagination {
                position: static !important;
                display: flex !important;
                align-items: center;
                justify-content: center;
                margin-top: 1.25rem !important;
                width: 100% !important;
            }
            .hero-courses-swiper-pagination .swiper-pagination-bullet {
                width: 8px;
                height: 8px;
                margin: 0 4px !important;
                background: #64748b;
                opacity: 0.7;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                cursor: pointer;
            }
            .hero-courses-swiper-pagination .swiper-pagination-bullet-active {
                width: 28px;
                border-radius: 9999px;
                background: #f59e0b;
                opacity: 1;
            }
        </style>
    @endpush

    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-b from-slate-900 via-slate-900 to-slate-950 text-white pt-8 pb-12 lg:pt-14 lg:pb-16">
        <!-- Background Ambient Glow -->
        <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[750px] h-[350px] bg-gradient-to-tr from-amber-500/25 via-emerald-500/20 to-transparent blur-3xl pointer-events-none rounded-full"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left Hero Copy -->
                <div class="lg:col-span-6 space-y-6 text-center lg:text-left">
                    
                    <div class="inline-flex items-center gap-2 rounded-full bg-amber-400/10 px-4 py-1.5 text-xs font-semibold text-amber-300 border border-amber-400/30">
                        <span class="inline-block h-2 w-2 rounded-full bg-amber-400 animate-pulse"></span>
                        <span>Premier International Academy for Holistic Skill Mastery</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-[1.12]">
                        Create the Best <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-yellow-300 to-amber-200">Future</span> for Your Children
                    </h1>

                    <p class="text-base sm:text-lg text-slate-300 max-w-2xl leading-relaxed mx-auto lg:mx-0">
                        From: Abacus, Phonics, Chess, Keyboard, Classical Dance, etc. — Sri Deekshaa delivers progressive, structured programs for ages 4 to 18.
                    </p>

                    <!-- Hero CTAs -->
                    <div class="pt-2 flex flex-wrap items-center justify-center lg:justify-start gap-4">
                        <button 
                            type="button" 
                            @click="$dispatch('open-enquiry-modal', {})"
                            class="rounded-2xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-bold px-7 py-3.5 text-sm shadow-xl shadow-amber-500/25 transition active:scale-95"
                        >
                            Book Free Trial Session
                        </button>
                        
                        <a 
                            href="{{ route('pages.assessment') }}" 
                            class="rounded-2xl bg-white/10 hover:bg-white/15 text-white font-semibold px-6 py-3.5 text-sm border border-white/15 backdrop-blur-sm transition flex items-center gap-2"
                        >
                            <span>Take Free Skill Quiz</span>
                            <i class="fa-solid fa-arrow-right text-amber-400 text-xs"></i>
                        </a>

                        <x-whatsapp-btn 
                            label="WhatsApp Counselor" 
                            class="bg-emerald-600 hover:bg-emerald-700" 
                        />
                    </div>

                    <!-- Trust Micro-Badges -->
                    <div class="pt-6 border-t border-slate-800/80 flex flex-wrap items-center justify-center lg:justify-start gap-6 text-sm text-slate-300">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-check text-emerald-400 text-sm"></i>
                            <span>Certified Instructors</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-check text-emerald-400 text-sm"></i>
                            <span>Small Batch Size (1:8)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-check text-emerald-400 text-sm"></i>
                            <span>Global Curriculum</span>
                        </div>
                    </div>

                </div>

                <!-- Right Hero Course Cards 3D Deck Slider -->
                <div class="lg:col-span-6 relative w-full overflow-hidden">
                    
                    <!-- Header with Title & Arrows -->
                    <div class="flex items-center justify-between mb-3 px-2 sm:px-4">
                        <div class="flex items-center gap-2">
                            <span class="inline-flex items-center justify-center w-7 h-7 rounded-xl bg-amber-400/20 text-amber-400 text-xs shadow-inner">
                                <i class="fa-solid fa-layer-group"></i>
                            </span>
                            <span class="text-xs font-bold uppercase tracking-wider text-amber-300">
                                Featured Skill Programs
                            </span>
                        </div>

                        <!-- Prev / Next Navigation Arrows -->
                        <div class="flex items-center gap-2">
                            <button 
                                type="button" 
                                class="hero-courses-prev w-8 h-8 rounded-full bg-white/10 hover:bg-amber-500 hover:text-slate-950 border border-white/20 text-white flex items-center justify-center transition shadow cursor-pointer text-xs active:scale-95"
                                aria-label="Previous Course"
                            >
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>
                            <button 
                                type="button" 
                                class="hero-courses-next w-8 h-8 rounded-full bg-white/10 hover:bg-amber-500 hover:text-slate-950 border border-white/20 text-white flex items-center justify-center transition shadow cursor-pointer text-xs active:scale-95"
                                aria-label="Next Course"
                            >
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- 3D Coverflow Swiper Container -->
                    <div class="swiper hero-courses-swiper">
                        <div class="swiper-wrapper">
                            @php
                                $heroSliderCourses = ($featuredCourses && $featuredCourses->count() >= 4) ? $featuredCourses : $allCourses;
                            @endphp

                            @foreach($heroSliderCourses as $course)
                                <div class="swiper-slide">
                                    <div class="rounded-3xl bg-white p-5 sm:p-6 shadow-2xl border border-slate-200/90 flex flex-col justify-between h-[410px] sm:h-[430px] text-left transition-all duration-300">
                                        <div>
                                            <!-- Top Category & Mode Row -->
                                            <!-- Top Category Row -->
                                            <div class="flex items-center justify-between gap-2 mb-3">
                                                @if($course->category)
                                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-800 border border-amber-200/80 whitespace-nowrap truncate max-w-[220px]">
                                                        @if(!empty($course->category->display_icon))
                                                            <i class="{{ $course->category->display_icon }} text-[11px] text-amber-600 shrink-0"></i>
                                                        @else
                                                            <i class="fa-solid fa-graduation-cap text-[11px] text-amber-600 shrink-0"></i>
                                                        @endif
                                                        <span class="truncate">{{ $course->category->name }}</span>
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-800 border border-amber-200/80 whitespace-nowrap">
                                                        <i class="fa-solid fa-graduation-cap text-[11px] text-amber-600"></i>
                                                        <span>Skill Program</span>
                                                    </span>
                                                @endif
                                            </div>

                                            <!-- Course Image Container -->
                                            <a href="{{ route('courses.show', $course->slug) }}" class="relative flex items-center justify-center w-full h-32 sm:h-36 mb-3 bg-slate-50 hover:bg-slate-100/80 rounded-2xl p-3 border border-slate-100 overflow-hidden transition group/thumb block">
                                                <img 
                                                    src="{{ $course->image_url }}" 
                                                    alt="{{ $course->title }}"
                                                    class="max-h-24 sm:max-h-28 w-auto object-contain transition-transform duration-300 group-hover/thumb:scale-105"
                                                    loading="lazy"
                                                >
                                            </a>

                                            <!-- Course Title -->
                                            <h3 class="text-base sm:text-lg font-bold text-slate-900 hover:text-amber-600 transition line-clamp-1">
                                                <a href="{{ route('courses.show', $course->slug) }}">
                                                    {{ $course->title }}
                                                </a>
                                            </h3>

                                            <!-- Short Description -->
                                            <p class="mt-1.5 text-xs text-slate-600 line-clamp-2 leading-relaxed">
                                                {{ $course->short_description }}
                                            </p>

                                            <!-- Duration & Age Meta -->
                                            <div class="mt-3 flex items-center justify-between text-xs text-slate-500 pt-2.5 border-t border-slate-100">
                                                @if(!empty($course->duration))
                                                    <span class="inline-flex items-center gap-1 font-medium">
                                                        <i class="fa-regular fa-clock text-amber-500"></i>
                                                        <span>{{ $course->duration }}</span>
                                                    </span>
                                                @else
                                                    <span></span>
                                                @endif
                                                <span class="inline-flex items-center gap-1 font-medium text-emerald-700">
                                                    <i class="fa-solid fa-users text-emerald-500"></i>
                                                    <span>{{ $course->age_range }}</span>
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="pt-3 border-t border-slate-100 flex items-center gap-2">
                                            <button 
                                                type="button" 
                                                @click="$dispatch('open-enquiry-modal', { course_id: '{{ $course->id }}', course_title: '{{ addslashes($course->title) }}' })" 
                                                class="flex-1 rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold py-2.5 px-3 text-xs transition shadow-sm text-center active:scale-95"
                                            >
                                                Enroll Now
                                            </button>
                                            <a 
                                                href="{{ route('courses.show', $course->slug) }}" 
                                                class="rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-semibold py-2.5 px-3.5 text-xs transition text-center whitespace-nowrap flex items-center gap-1.5 active:scale-95"
                                            >
                                                <span>Syllabus</span>
                                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Swiper Pagination Dots -->
                    <div class="hero-courses-swiper-pagination"></div>
                </div>

            </div>
        </div>
    </section>

    <!-- Stat Counter Strip -->
    <section class="bg-white border-b border-slate-200/80 py-5 sm:py-6 relative shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center divide-y md:divide-y-0 md:divide-x divide-slate-100">
                <div class="pt-4 md:pt-0">
                    <span class="block text-3xl sm:text-4xl font-extrabold text-slate-900">{{ $globalSettings['stat_students'] ?? '2,500+' }}</span>
                    <span class="mt-1 block text-sm font-medium text-slate-500">Students Trained</span>
                </div>
                <div class="pt-4 md:pt-0">
                    <span class="block text-3xl sm:text-4xl font-extrabold text-amber-600">{{ $globalSettings['stat_courses'] ?? '25+' }}</span>
                    <span class="mt-1 block text-sm font-medium text-slate-500">Curated Skill Courses</span>
                </div>
                <div class="pt-4 md:pt-0">
                    <span class="block text-3xl sm:text-4xl font-extrabold text-slate-900">{{ $globalSettings['stat_faculty'] ?? '35+' }}</span>
                    <span class="mt-1 block text-sm font-medium text-slate-500">Expert Mentors</span>
                </div>
                <div class="pt-4 md:pt-0">
                    <span class="block text-3xl sm:text-4xl font-extrabold text-emerald-600">{{ $globalSettings['stat_years'] ?? '8+' }}</span>
                    <span class="mt-1 block text-sm font-medium text-slate-500">Years of Academic Excellence</span>
                </div>
            </div>
        </div>
    </section>

    <!-- 5 Core Program Pillars -->
    <section class="py-10 sm:py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-heading 
                eyebrow="Specialized Learning Tracks" 
                title="Structured Domains Designed for Holistic Brain Development" 
                subtitle="Each vertical has been scientifically structured with step-by-step milestones, continuous skill assessments, and certified international graduation levels."
            />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($categories as $category)
                    <div class="group relative flex flex-col justify-between overflow-hidden rounded-3xl bg-white shadow-sm border border-slate-200/80 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:border-amber-400">
                        
                        <!-- Category Card Image with Floating Badges -->
                        <div class="relative aspect-16/10 w-full overflow-hidden bg-slate-900">
                            <img 
                                src="{{ $category->image_url }}" 
                                alt="{{ $category->name }} Programs - Sri Deekshaa Academy" 
                                class="h-full w-full object-cover transition-transform duration-500 ease-out group-hover:scale-105"
                                loading="lazy"
                            >
                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/25 to-transparent"></div>

                            <!-- Floating Badges Strip -->
                            <div class="absolute top-4 inset-x-4 flex items-center justify-between">
                                <span class="inline-flex items-center gap-2 rounded-full bg-slate-950/80 backdrop-blur-md px-3 py-1 text-xs font-bold text-amber-300 border border-white/10 shadow-sm">
                                    <i class="{{ $category->display_icon }} text-xs"></i>
                                    <span>{{ $category->name }}</span>
                                </span>
                                <span class="rounded-full bg-amber-500 text-slate-950 px-2.5 py-0.5 text-[11px] font-extrabold shadow-sm">
                                    {{ $category->active_courses_count }} {{ Str::plural('Course', $category->active_courses_count) }}
                                </span>
                            </div>
                        </div>

                        <!-- Card Body Content -->
                        <div class="p-6 sm:p-7 flex flex-col justify-between flex-1">
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 group-hover:text-amber-600 transition mb-2.5">
                                    <a href="{{ route('courses.category', $category->slug) }}">
                                        {{ $category->name }}
                                    </a>
                                </h3>

                                <p class="text-sm text-slate-600 leading-relaxed mb-6 line-clamp-3">
                                    {{ $category->description ?? 'Specialized curricula designed to cultivate mastery and cognitive agility.' }}
                                </p>
                            </div>

                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                <a 
                                    href="{{ route('courses.category', $category->slug) }}" 
                                    class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-600 group-hover:text-amber-700 uppercase tracking-wider"
                                >
                                    <span>Explore Category Courses</span>
                                    <i class="fa-solid fa-arrow-right text-xs transition-transform duration-200 group-hover:translate-x-1"></i>
                                </a>

                                <span class="text-[11px] font-semibold text-slate-400 bg-slate-100 px-2.5 py-1 rounded-full">
                                    Ages 4 - 18
                                </span>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Courses Grid -->
    <section class="py-10 sm:py-16 bg-white border-t border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
                <div>
                    <span class="inline-flex items-center gap-2 rounded-full bg-amber-100/80 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-amber-800 mb-2 border border-amber-200/60">
                        High-Demand Programs
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                        Flagship Skill Courses
                    </h2>
                </div>

                <a 
                    href="{{ route('courses.index') }}" 
                    class="inline-flex items-center gap-2 text-sm font-bold text-amber-600 hover:text-amber-700 transition"
                >
                    <span>View all 23+ programs</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($featuredCourses as $course)
                    <x-course-card :course="$course" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Interactive Skill Assessment Banner -->
    <section class="py-10 sm:py-12 bg-gradient-to-r from-amber-500 via-amber-600 to-yellow-500 text-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-8 space-y-3">
                    <span class="inline-block rounded-full bg-slate-950 text-amber-400 px-3 py-1 text-xs font-bold uppercase tracking-wider">
                        2-Minute Smart Advisor
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-950">
                        Not sure which skill track matches your child's innate aptitude?
                    </h2>
                    <p class="text-slate-900 font-medium text-base leading-relaxed max-w-2xl">
                        Our algorithm evaluates learner age, current cognitive preferences, and interest profile to recommend the exact starting stage.
                    </p>
                </div>
                <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-3 justify-center lg:items-end">
                    <a 
                        href="{{ route('pages.assessment') }}" 
                        class="rounded-2xl bg-slate-950 hover:bg-slate-900 text-white font-bold px-7 py-3.5 text-center text-sm shadow-xl transition active:scale-95 inline-flex items-center justify-center gap-2"
                    >
                        <span>Start Free Skill Assessment</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                    <button 
                        type="button" 
                        @click="$dispatch('open-enquiry-modal', {})" 
                        class="rounded-2xl bg-white/90 hover:bg-white text-slate-950 font-bold px-7 py-3.5 text-center text-sm transition"
                    >
                        Talk to Counselor Instead
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Pedagogy & Why Choose Sri Deekshaa (Swiper Slider) -->
    <section class="py-10 sm:py-16 bg-slate-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-6 sm:mb-8 gap-6">
                <div class="max-w-2xl">
                    <div class="inline-flex items-center gap-2 rounded-full bg-amber-100/80 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-amber-800 mb-3 border border-amber-200/60">
                        <span class="inline-block h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                        The Sri Deekshaa Edge
                    </div>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-slate-900 leading-tight">
                        Why Parents &amp; Learners Choose Sri Deekshaa
                    </h2>
                    <p class="mt-4 text-base sm:text-lg text-slate-600 leading-relaxed">
                        We don't just teach rote subjects. We build neurological confidence, rapid calculation agility, critical logic, and lifelong self-expression.
                    </p>
                </div>

                <!-- Swiper Navigation Arrows -->
                <div class="flex items-center gap-3 shrink-0">
                    <button 
                        type="button" 
                        class="why-choose-prev w-12 h-12 rounded-2xl bg-white border border-slate-200 text-slate-700 hover:text-amber-600 hover:border-amber-400 hover:shadow-md active:scale-95 transition flex items-center justify-center cursor-pointer shadow-xs"
                        aria-label="Previous slide"
                    >
                        <i class="fa-solid fa-arrow-left text-sm"></i>
                    </button>
                    <button 
                        type="button" 
                        class="why-choose-next w-12 h-12 rounded-2xl bg-white border border-slate-200 text-slate-700 hover:text-amber-600 hover:border-amber-400 hover:shadow-md active:scale-95 transition flex items-center justify-center cursor-pointer shadow-xs"
                        aria-label="Next slide"
                    >
                        <i class="fa-solid fa-arrow-right text-sm"></i>
                    </button>
                </div>
            </div>

            <!-- Swiper Slider Container -->
            <div class="swiper why-choose-swiper p-2">
                <div class="swiper-wrapper">
                    
                    <!-- Slide 1 -->
                    <div class="swiper-slide">
                        <div class="rounded-3xl bg-white p-8 border border-slate-200 shadow-xs hover:shadow-lg hover:border-amber-300 transition-all duration-300 flex flex-col justify-between w-full h-full group">
                            <div>
                                <div class="flex items-center justify-between mb-6">
                                    <div class="h-14 w-14 rounded-2xl bg-amber-100/90 text-amber-600 flex items-center justify-center text-xl font-extrabold group-hover:bg-amber-500 group-hover:text-white transition-colors duration-300">
                                        01
                                    </div>
                                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg">
                                        <i class="fa-solid fa-brain"></i>
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900 group-hover:text-amber-600 transition-colors">
                                    Scientifically Validated Stages
                                </h3>
                                <p class="text-sm text-slate-600 leading-relaxed mt-3">
                                    Every course progresses from basic sensory understanding to abstract mental execution, preventing cognitive burnout while accelerating long-term retention.
                                </p>
                            </div>
                            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-2 text-xs font-semibold text-amber-600">
                                <i class="fa-solid fa-circle-check text-amber-500"></i>
                                <span>Progressive Cognitive Milestones</span>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="swiper-slide">
                        <div class="rounded-3xl bg-white p-8 border border-slate-200 shadow-xs hover:shadow-lg hover:border-emerald-300 transition-all duration-300 flex flex-col justify-between w-full h-full group">
                            <div>
                                <div class="flex items-center justify-between mb-6">
                                    <div class="h-14 w-14 rounded-2xl bg-emerald-100/90 text-emerald-600 flex items-center justify-center text-xl font-extrabold group-hover:bg-emerald-500 group-hover:text-white transition-colors duration-300">
                                        02
                                    </div>
                                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg">
                                        <i class="fa-solid fa-chalkboard-user"></i>
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900 group-hover:text-emerald-600 transition-colors">
                                    Certified International Mentors
                                </h3>
                                <p class="text-sm text-slate-600 leading-relaxed mt-3">
                                    Our teachers undergo rigorous methodology assessments and child psychology training to ensure every student receives patient, tailored, and encouraging guidance.
                                </p>
                            </div>
                            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-2 text-xs font-semibold text-emerald-600">
                                <i class="fa-solid fa-circle-check text-emerald-500"></i>
                                <span>Child-Centric Pedagogy Audits</span>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="swiper-slide">
                        <div class="rounded-3xl bg-white p-8 border border-slate-200 shadow-xs hover:shadow-lg hover:border-blue-300 transition-all duration-300 flex flex-col justify-between w-full h-full group">
                            <div>
                                <div class="flex items-center justify-between mb-6">
                                    <div class="h-14 w-14 rounded-2xl bg-blue-100/90 text-blue-600 flex items-center justify-center text-xl font-extrabold group-hover:bg-blue-500 group-hover:text-white transition-colors duration-300">
                                        03
                                    </div>
                                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg">
                                        <i class="fa-solid fa-certificate"></i>
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900 group-hover:text-blue-600 transition-colors">
                                    Recognized Certification
                                </h3>
                                <p class="text-sm text-slate-600 leading-relaxed mt-3">
                                    Students earn graded, ISO 9001 accredited certificates upon level completion, verified securely online via our instant portal for academic and global portfolios.
                                </p>
                            </div>
                            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-2 text-xs font-semibold text-blue-600">
                                <i class="fa-solid fa-circle-check text-blue-500"></i>
                                <span>QR-Verified Digital Credentials</span>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 4 -->
                    <div class="swiper-slide">
                        <div class="rounded-3xl bg-white p-8 border border-slate-200 shadow-xs hover:shadow-lg hover:border-purple-300 transition-all duration-300 flex flex-col justify-between w-full h-full group">
                            <div>
                                <div class="flex items-center justify-between mb-6">
                                    <div class="h-14 w-14 rounded-2xl bg-purple-100/90 text-purple-600 flex items-center justify-center text-xl font-extrabold group-hover:bg-purple-500 group-hover:text-white transition-colors duration-300">
                                        04
                                    </div>
                                    <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-lg">
                                        <i class="fa-solid fa-laptop-code"></i>
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900 group-hover:text-purple-600 transition-colors">
                                    Flexible Hybrid Learning
                                </h3>
                                <p class="text-sm text-slate-600 leading-relaxed mt-3">
                                    Choose between immersive classroom training at our accredited physical campuses or live interactive online batches with recorded sessions and kits.
                                </p>
                            </div>
                            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-2 text-xs font-semibold text-purple-600">
                                <i class="fa-solid fa-circle-check text-purple-500"></i>
                                <span>Online Live &amp; Physical Campus</span>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 5 -->
                    <div class="swiper-slide">
                        <div class="rounded-3xl bg-white p-8 border border-slate-200 shadow-xs hover:shadow-lg hover:border-rose-300 transition-all duration-300 flex flex-col justify-between w-full h-full group">
                            <div>
                                <div class="flex items-center justify-between mb-6">
                                    <div class="h-14 w-14 rounded-2xl bg-rose-100/90 text-rose-600 flex items-center justify-center text-xl font-extrabold group-hover:bg-rose-500 group-hover:text-white transition-colors duration-300">
                                        05
                                    </div>
                                    <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-lg">
                                        <i class="fa-solid fa-users-viewfinder"></i>
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900 group-hover:text-rose-600 transition-colors">
                                    Personalized Attention
                                </h3>
                                <p class="text-sm text-slate-600 leading-relaxed mt-3">
                                    We maintain low mentor-to-student ratios to ensure each child receives customized pacing, tailored speed drills, and proactive monthly growth feedback.
                                </p>
                            </div>
                            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-2 text-xs font-semibold text-rose-600">
                                <i class="fa-solid fa-circle-check text-rose-500"></i>
                                <span>Low Student-Teacher Ratio</span>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 6 -->
                    <div class="swiper-slide">
                        <div class="rounded-3xl bg-white p-8 border border-slate-200 shadow-xs hover:shadow-lg hover:border-cyan-300 transition-all duration-300 flex flex-col justify-between w-full h-full group">
                            <div>
                                <div class="flex items-center justify-between mb-6">
                                    <div class="h-14 w-14 rounded-2xl bg-cyan-100/90 text-cyan-600 flex items-center justify-center text-xl font-extrabold group-hover:bg-cyan-500 group-hover:text-white transition-colors duration-300">
                                        06
                                    </div>
                                    <div class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center text-lg">
                                        <i class="fa-solid fa-trophy"></i>
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900 group-hover:text-cyan-600 transition-colors">
                                    Tournament &amp; Olympiad Training
                                </h3>
                                <p class="text-sm text-slate-600 leading-relaxed mt-3">
                                    Regular academy tournaments, regional speed math championships, and global Olympiad exposure instill emotional resilience and peak performance confidence.
                                </p>
                            </div>
                            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-2 text-xs font-semibold text-cyan-600">
                                <i class="fa-solid fa-circle-check text-cyan-500"></i>
                                <span>State &amp; National Competitions</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Swiper Pagination Bullets (Positioned cleanly below cards) -->
            <div class="swiper-pagination why-choose-swiper-pagination"></div>
        </div>
    </section>

    <!-- Testimonials Showcase (Swiper Slider) -->
    <section class="py-10 sm:py-16 bg-white border-t border-slate-200/80 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-6 sm:mb-8 gap-6">
                <div class="max-w-2xl">
                    <div class="inline-flex items-center gap-2 rounded-full bg-amber-100/80 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-amber-800 mb-3 border border-amber-200/60">
                        <span class="inline-block h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                        Parent &amp; Student Feedback
                    </div>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-slate-900 leading-tight">
                        Transforming Potential into Tangible Confidence
                    </h2>
                    <p class="mt-4 text-base sm:text-lg text-slate-600 leading-relaxed">
                        Hear from families who have observed academic acceleration, newfound enthusiasm, and self-belief in their children.
                    </p>
                </div>

                <!-- Swiper Navigation Arrows -->
                <div class="flex items-center gap-3 shrink-0">
                    <button 
                        type="button" 
                        class="testimonials-prev w-12 h-12 rounded-2xl bg-white border border-slate-200 text-slate-700 hover:text-amber-600 hover:border-amber-400 hover:shadow-md active:scale-95 transition flex items-center justify-center cursor-pointer shadow-xs"
                        aria-label="Previous testimonial"
                    >
                        <i class="fa-solid fa-arrow-left text-sm"></i>
                    </button>
                    <button 
                        type="button" 
                        class="testimonials-next w-12 h-12 rounded-2xl bg-white border border-slate-200 text-slate-700 hover:text-amber-600 hover:border-amber-400 hover:shadow-md active:scale-95 transition flex items-center justify-center cursor-pointer shadow-xs"
                        aria-label="Next testimonial"
                    >
                        <i class="fa-solid fa-arrow-right text-sm"></i>
                    </button>
                </div>
            </div>

            <!-- Swiper Slider Container -->
            <div class="swiper testimonials-swiper p-2">
                <div class="swiper-wrapper">
                    @foreach($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <div class="rounded-3xl bg-slate-50/90 p-8 border border-slate-200/80 shadow-xs hover:shadow-lg hover:border-amber-300 transition-all duration-300 flex flex-col justify-between w-full h-full group">
                                <div>
                                    <div class="flex items-center justify-between mb-4">
                                        <!-- Star Rating -->
                                        <div class="flex items-center gap-1 text-amber-400">
                                            @for($i = 0; $i < ($testimonial->rating ?? 5); $i++)
                                                <i class="fa-solid fa-star text-sm"></i>
                                            @endfor
                                        </div>
                                        <div class="h-8 w-8 rounded-full bg-amber-100/70 text-amber-600 flex items-center justify-center text-xs">
                                            <i class="fa-solid fa-quote-right"></i>
                                        </div>
                                    </div>

                                    <p class="text-slate-700 text-sm leading-relaxed italic">
                                        "{{ $testimonial->content ?? $testimonial->testimonial }}"
                                    </p>
                                </div>

                                <div class="mt-6 pt-4 border-t border-slate-200/60 flex items-center justify-between">
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-sm group-hover:text-amber-600 transition-colors">{{ $testimonial->name }}</h4>
                                        <p class="text-xs text-slate-500 flex items-center gap-1.5 mt-0.5">
                                            <span>{{ $testimonial->role }}</span>
                                            @if($testimonial->course)
                                                <i class="fa-solid fa-circle text-[3px] text-slate-400"></i>
                                                <span>{{ $testimonial->course }}</span>
                                            @endif
                                        </p>
                                    </div>
                                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200/60 px-2 py-0.5 rounded-full">
                                        <i class="fa-solid fa-circle-check text-[10px]"></i>
                                        <span>Verified</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Swiper Pagination Bullets (Positioned cleanly below cards) -->
            <div class="swiper-pagination testimonials-swiper-pagination"></div>
        </div>
    </section>

    <!-- Dedicated Course Enrollment & Free Trial Form Section -->
    <section id="enquiry-section" class="py-10 sm:py-16 bg-gradient-to-b from-slate-900 via-slate-900 to-slate-950 text-white relative overflow-hidden">
        <!-- Ambient background lights -->
        <div class="absolute -top-24 left-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 right-1/4 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left Column: Trust Value Proposition & Counselor Details -->
                <div class="lg:col-span-5 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 rounded-full bg-amber-400/10 px-4 py-1.5 text-xs font-semibold text-amber-300 border border-amber-400/30">
                        <span class="inline-block h-2 w-2 rounded-full bg-amber-400 animate-pulse"></span>
                        <span>Free Academic Counseling &amp; Trial Batch</span>
                    </div>

                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight">
                        Begin Your Child's Journey to <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-yellow-200">Holistic Mastery</span>
                    </h2>

                    <p class="text-base text-slate-300 leading-relaxed">
                        Speak with our certified curriculum advisors to determine the ideal starting milestone, explore flexible batches, and experience a complimentary 1-on-1 trial session.
                    </p>

                    <!-- Key Benefits Checklist -->
                    <div class="space-y-4 pt-2 text-left">
                        <div class="flex items-start gap-3.5">
                            <div class="w-9 h-9 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center shrink-0 mt-0.5 border border-amber-500/30">
                                <i class="fa-solid fa-calendar-check text-sm"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-white">Complimentary 45-Min Trial Session</h4>
                                <p class="text-xs text-slate-400 mt-0.5">Experience live pedagogy, interactive math tools, and customized teacher attention.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3.5">
                            <div class="w-9 h-9 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0 mt-0.5 border border-emerald-500/30">
                                <i class="fa-solid fa-users text-sm"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-white">Small Focused Batches (1:8 Ratio)</h4>
                                <p class="text-xs text-slate-400 mt-0.5">Tailored learning pace suited to your child's innate cognitive speed.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3.5">
                            <div class="w-9 h-9 rounded-xl bg-sky-500/20 text-sky-400 flex items-center justify-center shrink-0 mt-0.5 border border-sky-500/30">
                                <i class="fa-solid fa-certificate text-sm"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-white">Global Accreditation &amp; Graded Levels</h4>
                                <p class="text-xs text-slate-400 mt-0.5">ISO 9001 certified credentials with online instant verification.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Direct Counselor Contact Strip -->
                    <div class="pt-6 border-t border-slate-800 flex flex-wrap items-center justify-center lg:justify-start gap-4">
                        <x-whatsapp-btn label="WhatsApp Desk" size="sm" />
                        <a 
                            href="tel:{{ preg_replace('/[^0-9+]/', '', $globalSettings['phone'] ?? '+91 98765 43210') }}" 
                            class="inline-flex items-center gap-2 rounded-xl bg-white/10 hover:bg-white/15 px-4 py-2 text-xs font-semibold text-white border border-white/15 transition"
                        >
                            <i class="fa-solid fa-phone text-amber-400"></i>
                            <span>{{ $globalSettings['phone'] ?? '+91 98765 43210' }}</span>
                        </a>
                    </div>
                </div>

                <!-- Right Column: Dedicated High-Converting Form Card -->
                <div class="lg:col-span-7">
                    <div class="rounded-3xl bg-white p-6 sm:p-8 md:p-10 shadow-2xl border border-slate-100 text-slate-900 relative">
                        
                        <div class="flex items-center justify-between pb-4 mb-6 border-b border-slate-100">
                            <div>
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 text-amber-800 px-3 py-0.5 text-xs font-bold border border-amber-200">
                                    <i class="fa-solid fa-sparkles text-[10px] text-amber-600"></i>
                                    <span>Immediate Response</span>
                                </span>
                                <h3 class="text-xl sm:text-2xl font-bold text-slate-900 mt-1">
                                    Request Course Catalog &amp; Callback
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                                    Fill in the details below. Our academic advisor will reach out within 2 business hours.
                                </p>
                            </div>
                        </div>

                        <!-- Feedback notification if submitted -->
                        @if(session('success'))
                            <div class="mb-6 rounded-2xl bg-emerald-50 border border-emerald-200 p-4 flex items-start gap-3">
                                <i class="fa-solid fa-circle-check text-emerald-600 text-lg mt-0.5"></i>
                                <div class="text-sm text-emerald-800">
                                    <strong class="font-bold">Request Received!</strong>
                                    <p class="mt-0.5">{{ session('success') }}</p>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('enquiries.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="source" value="Home Page Dedicated Form Section">

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                        Parent / Guardian Name <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="parent_name" 
                                        required 
                                        placeholder="e.g. Ramesh Kumar" 
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm text-slate-900 placeholder-slate-400 focus:border-amber-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-200 transition"
                                    >
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                        Student Name <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="student_name" 
                                        required 
                                        placeholder="e.g. Aarav Kumar" 
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm text-slate-900 placeholder-slate-400 focus:border-amber-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-200 transition"
                                    >
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                        WhatsApp / Phone Number <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="tel" 
                                        name="phone" 
                                        required 
                                        placeholder="+91 98765 43210" 
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm text-slate-900 placeholder-slate-400 focus:border-amber-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-200 transition"
                                    >
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                        Email Address
                                    </label>
                                    <input 
                                        type="email" 
                                        name="email" 
                                        placeholder="parent@example.com" 
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm text-slate-900 placeholder-slate-400 focus:border-amber-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-200 transition"
                                    >
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                        Child Age
                                    </label>
                                    <input 
                                        type="number" 
                                        name="student_age" 
                                        min="3" 
                                        max="80" 
                                        placeholder="Age (Yrs)" 
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm text-slate-900 placeholder-slate-400 focus:border-amber-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-200 transition"
                                    >
                                </div>

                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                        Select Interested Program
                                    </label>
                                    <select 
                                        name="course_id" 
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm text-slate-900 focus:border-amber-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-200 transition"
                                    >
                                        <option value="">Choose a Program / Course</option>
                                        @foreach($allCourses as $cItem)
                                            <option value="{{ $cItem->id }}">
                                                {{ $cItem->title }} ({{ $cItem->category->name ?? 'Skill' }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                        Preferred Learning Mode
                                    </label>
                                    <select 
                                        name="mode_preference" 
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm text-slate-900 focus:border-amber-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-200 transition"
                                    >
                                        <option value="In-Person">In-Person Classroom (Chennai)</option>
                                        <option value="Online">Live Interactive Online</option>
                                        <option value="Hybrid">Hybrid (Classroom + Online)</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                        Special Note / Goals
                                    </label>
                                    <input 
                                        type="text" 
                                        name="notes" 
                                        placeholder="e.g. Weekend batch preference..." 
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm text-slate-900 placeholder-slate-400 focus:border-amber-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-200 transition"
                                    >
                                </div>
                            </div>

                            <div class="pt-2">
                                <button 
                                    type="submit" 
                                    class="w-full rounded-2xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-extrabold py-3.5 px-6 text-sm shadow-xl shadow-amber-500/25 transition active:scale-95 cursor-pointer flex items-center justify-center gap-2"
                                >
                                    <span>Get Instant Callback &amp; Course Syllabus</span>
                                    <i class="fa-solid fa-arrow-right text-xs"></i>
                                </button>
                            </div>

                            <div class="pt-2 flex items-center justify-center gap-6 text-[11px] text-slate-500 text-center">
                                <span class="flex items-center gap-1.5">
                                    <i class="fa-solid fa-lock text-slate-400 text-xs"></i>
                                    <span>Strict Privacy Guaranteed</span>
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <i class="fa-solid fa-ban text-slate-400 text-xs"></i>
                                    <span>Zero Spam Policy</span>
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <i class="fa-solid fa-clock text-slate-400 text-xs"></i>
                                    <span>Fast 2-Hr Response</span>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Academy FAQs -->
    <section class="py-10 sm:py-16 bg-slate-50 border-t border-slate-200/80">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-heading 
                eyebrow="Frequently Asked Questions" 
                title="Common Queries from Parents & Students" 
                subtitle="Everything you need to know regarding admissions, class modes, fee structure, and trial sessions."
            />

            <div class="space-y-4" x-data="{ activeAccordion: null }">
                @foreach($faqs as $index => $faq)
                    <div class="rounded-2xl bg-white border border-slate-200/80 shadow-xs overflow-hidden">
                        <button 
                            type="button" 
                            @click="activeAccordion = (activeAccordion === {{ $index }} ? null : {{ $index }})"
                            class="w-full flex items-center justify-between p-5 text-left font-bold text-slate-900 hover:text-amber-600 transition"
                        >
                            <span class="text-base">{{ $faq->question }}</span>
                            <i 
                                class="fa-solid fa-chevron-down text-slate-400 text-xs transform transition-transform duration-200" 
                                :class="activeAccordion === {{ $index }} ? 'rotate-180 text-amber-600' : ''"
                            ></i>
                        </button>
                        
                        <div 
                            x-show="activeAccordion === {{ $index }}" 
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="px-5 pb-5 text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3"
                            x-cloak
                        >
                            {{ $faq->answer }}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-10">
                <p class="text-sm text-slate-600">
                    Have more specific questions?
                </p>
                <div class="mt-3 flex items-center justify-center gap-4">
                    <x-whatsapp-btn label="Ask on WhatsApp" size="sm" />
                    <a href="{{ route('pages.contact') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-slate-900 hover:text-amber-600">
                        <span>Visit Contact Page</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            function initWhyChooseSwiper() {
                if (typeof Swiper === 'undefined') return;
                const swiperEl = document.querySelector('.why-choose-swiper');
                if (!swiperEl || swiperEl.swiper) return;

                new Swiper(swiperEl, {
                    slidesPerView: 1.15,
                    spaceBetween: 16,
                    loop: true,
                    grabCursor: true,
                    speed: 600,
                    autoplay: {
                        delay: 3500,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },
                    navigation: {
                        prevEl: '.why-choose-prev',
                        nextEl: '.why-choose-next',
                    },
                    pagination: {
                        el: '.why-choose-swiper-pagination',
                        clickable: true,
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 1.5,
                            spaceBetween: 20,
                        },
                        768: {
                            slidesPerView: 2.2,
                            spaceBetween: 24,
                        },
                        1024: {
                            slidesPerView: 3,
                            spaceBetween: 30,
                        },
                    },
                });
            }

            function initTestimonialsSwiper() {
                if (typeof Swiper === 'undefined') return;
                const swiperEl = document.querySelector('.testimonials-swiper');
                if (!swiperEl || swiperEl.swiper) return;

                new Swiper(swiperEl, {
                    slidesPerView: 1.15,
                    spaceBetween: 16,
                    loop: true,
                    grabCursor: true,
                    speed: 600,
                    autoplay: {
                        delay: 4000,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },
                    navigation: {
                        prevEl: '.testimonials-prev',
                        nextEl: '.testimonials-next',
                    },
                    pagination: {
                        el: '.testimonials-swiper-pagination',
                        clickable: true,
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 1.5,
                            spaceBetween: 20,
                        },
                        768: {
                            slidesPerView: 2.2,
                            spaceBetween: 24,
                        },
                        1024: {
                            slidesPerView: 3,
                            spaceBetween: 30,
                        },
                    },
                });
            }

            function initHeroCoursesSwiper() {
                if (typeof Swiper === 'undefined') return;
                const swiperEl = document.querySelector('.hero-courses-swiper');
                if (!swiperEl || swiperEl.swiper) return;

                new Swiper(swiperEl, {
                    effect: 'coverflow',
                    grabCursor: true,
                    centeredSlides: true,
                    slidesPerView: 'auto',
                    slideToClickedSlide: true,
                    loop: true,
                    loopedSlides: 4,
                    loopAdditionalSlides: 3,
                    speed: 550,
                    autoplay: {
                        delay: 3500,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },
                    coverflowEffect: {
                        rotate: 0,
                        stretch: 135,
                        depth: 80,
                        modifier: 1,
                        slideShadows: false,
                        scale: 0.86,
                    },
                    navigation: {
                        prevEl: '.hero-courses-prev',
                        nextEl: '.hero-courses-next',
                    },
                    pagination: {
                        el: '.hero-courses-swiper-pagination',
                        clickable: true,
                    },
                    breakpoints: {
                        640: {
                            coverflowEffect: {
                                rotate: 0,
                                stretch: 150,
                                depth: 90,
                                modifier: 1,
                                slideShadows: false,
                                scale: 0.86,
                            },
                        },
                        1024: {
                            coverflowEffect: {
                                rotate: 0,
                                stretch: 165,
                                depth: 100,
                                modifier: 1,
                                slideShadows: false,
                                scale: 0.86,
                            },
                        },
                    },
                    on: {
                        setTranslate(swiper) {
                            swiper.slides.forEach((slide) => {
                                const progress = Math.abs(slide.progress);
                                if (progress > 1.25) {
                                    slide.style.opacity = '0';
                                    slide.style.visibility = 'hidden';
                                    slide.style.pointerEvents = 'none';
                                } else if (progress > 0.25) {
                                    slide.style.opacity = '0.65';
                                    slide.style.visibility = 'visible';
                                    slide.style.pointerEvents = 'auto';
                                } else {
                                    slide.style.opacity = '1';
                                    slide.style.visibility = 'visible';
                                    slide.style.pointerEvents = 'auto';
                                }
                            });
                        },
                        setTransition(swiper, duration) {
                            swiper.slides.forEach((slide) => {
                                slide.style.transitionDuration = `${duration}ms`;
                            });
                        },
                    },
                });
            }

            function initAllHomeSwipers() {
                initHeroCoursesSwiper();
                initWhyChooseSwiper();
                initTestimonialsSwiper();
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initAllHomeSwipers);
            } else {
                initAllHomeSwipers();
            }
            document.addEventListener('livewire:navigated', initAllHomeSwipers);
        </script>
    @endpush

</x-layouts.app>