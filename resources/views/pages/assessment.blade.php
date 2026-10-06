@php
    $assessmentTitle = $globalSettings['seo_assessment_title'] ?? 'Free Skill & Aptitude Assessment | Sri Deekshaa International Academy';
    $assessmentDesc = $globalSettings['seo_assessment_description'] ?? 'Take our 90-second diagnostic assessment to discover the ideal cognitive, mathematics, creative arts, language, or fitness track for your child.';

    $categoriesData = ($categories ?? collect())->map(function ($cat) {
        return [
            'id' => $cat->id,
            'name' => $cat->name,
            'slug' => $cat->slug,
            'description' => $cat->description ?: 'Specialized certified programs engineered to build foundational mastery.',
            'icon' => $cat->display_icon,
            'courses' => $cat->activeCourses->map(function ($c) {
                return [
                    'id' => $c->id,
                    'title' => $c->title,
                    'slug' => $c->slug,
                    'short_description' => $c->short_description,
                    'image_url' => $c->image_url,
                    'age_range' => $c->age_range,
                    'age_min' => $c->age_min,
                    'age_max' => $c->age_max,
                    'duration' => $c->duration,
                    'mode' => $c->mode?->value ?? (string) $c->mode,
                ];
            })->values()->all(),
        ];
    })->values()->all();
@endphp

<x-layouts.app :title="$assessmentTitle" :metaDescription="$assessmentDesc">
    
    <!-- Hero Header -->
    <section class="bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-white pt-10 pb-16 sm:pt-14 sm:pb-20 relative overflow-hidden border-b border-slate-800/80">
        <!-- Ambient Background Glow & Dot Grid -->
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:24px_24px]"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/3 w-80 h-80 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <!-- Breadcrumb Navigation -->
            <div class="flex justify-center mb-5 sm:mb-6">
                <x-breadcrumb :items="[['label' => 'Skill Assessment']]" />
            </div>

            <!-- Trust Badges Strip -->
            <div class="inline-flex flex-wrap items-center justify-center gap-2 sm:gap-3 bg-white/5 border border-white/10 rounded-full px-4 py-1.5 text-xs text-amber-300 font-semibold mb-5 backdrop-blur-sm">
                <span class="flex items-center gap-1.5">
                    <i class="fa-solid fa-circle-check text-emerald-400"></i> Free Diagnostic
                </span>
                <span class="text-slate-600">•</span>
                <span class="flex items-center gap-1.5">
                    <i class="fa-solid fa-stopwatch text-amber-400"></i> Takes ~90 Seconds
                </span>
                <span class="text-slate-600">•</span>
                <span class="flex items-center gap-1.5">
                    <i class="fa-solid fa-award text-amber-400"></i> Tailored Curriculum
                </span>
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-tight">
                Discover the Perfect Course for <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-amber-300 to-yellow-500">Your Child</span>
            </h1>

            <p class="mt-4 text-base sm:text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Every child has innate genius. Answer 5 guided questions to receive a diagnostic skill analysis and personalized curriculum recommendations tailored to your child’s stage.
            </p>
        </div>
    </section>

    <!-- Main Wizard Card Section -->
    <section class="py-12 sm:py-16 bg-slate-50 relative -mt-8 z-20">
        <div class="max-w-3xl mx-auto px-4 sm:px-6" x-data="{
            step: 1,
            totalQuestions: 5,
            isSubmitting: false,
            submissionSuccess: false,
            categories: {{ Js::from($categoriesData) }},
            answers: {
                age: '',
                goal: '',
                category_name: '',
                category_slug: '',
                learning_style: '',
                mode: '',
                time_commitment: '',
                parent_name: '',
                student_name: '',
                phone: '',
                email: ''
            },
            recommendedTrack: 'Brain & Academic Excellence',
            recommendedCategory: null,
            recommendedDescription: '',
            recommendedCourses: [],
            
            selectCategory(cat) {
                this.answers.goal = cat.name;
                this.answers.category_name = cat.name;
                this.answers.category_slug = cat.slug;
                this.recommendedCategory = cat;
                this.step = 3;
            },

            async calculateResults() {
                this.isSubmitting = true;

                // Resolve selected category recommendations
                let cat = this.categories.find(c => c.slug === this.answers.category_slug) || this.categories[0];
                this.recommendedCategory = cat;
                this.recommendedTrack = cat ? cat.name : 'Brain & Academic Excellence';
                this.recommendedDescription = cat ? cat.description : 'A high-leverage cognitive starting point for your learner.';
                
                // Pick top courses for this category
                if (cat && cat.courses && cat.courses.length > 0) {
                    this.recommendedCourses = cat.courses;
                } else {
                    this.recommendedCourses = [];
                }

                // Auto-submit lead to enquiries pipeline in background
                try {
                    let fd = new FormData();
                    fd.append('_token', '{{ csrf_token() }}');
                    fd.append('parent_name', this.answers.parent_name);
                    fd.append('student_name', this.answers.student_name || this.answers.parent_name);
                    fd.append('phone', this.answers.phone);
                    if (this.answers.email) fd.append('email', this.answers.email);
                    if (this.answers.mode) fd.append('mode_preference', this.answers.mode);
                    fd.append('source', 'Skill Assessment Quiz');
                    fd.append('notes', 'Skill Diagnostic Result: ' + this.recommendedTrack + ' | Age: ' + this.answers.age + ' | Learning Style: ' + this.answers.learning_style + ' | Time: ' + this.answers.time_commitment);

                    await fetch('{{ route('enquiries.store') }}', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: fd
                    });
                    this.submissionSuccess = true;
                } catch (e) {
                    // Fallback
                }

                this.isSubmitting = false;
                this.step = 7;
                window.scrollTo({ top: 250, behavior: 'smooth' });
            }
        }">

            <!-- Progress & Navigation Header -->
            <div class="mb-6 sm:mb-8" x-show="step <= 6">
                <div class="flex items-center justify-between text-xs sm:text-sm font-bold text-slate-600 mb-2.5">
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-amber-500 text-slate-950 text-xs font-black" x-text="step <= 5 ? step : 5"></span>
                        <span x-text="step <= 5 ? 'Question ' + step + ' of 5' : 'Final Step: Your Report'"></span>
                    </div>
                    <span class="text-amber-600 font-extrabold" x-text="Math.min(100, Math.round(((step - 1) / 5) * 100)) + '% Completed'"></span>
                </div>
                <!-- Sleek Stepped Progress Bar -->
                <div class="h-2.5 w-full bg-slate-200/90 rounded-full overflow-hidden p-0.5 shadow-inner">
                    <div class="h-full bg-gradient-to-r from-amber-500 to-yellow-400 rounded-full transition-all duration-500 ease-out" 
                         :style="'width: ' + Math.min(100, Math.max(12, Math.round(((step - 1) / 5) * 100))) + '%'"></div>
                </div>
            </div>

            <!-- Quiz Main Card Container -->
            <div class="rounded-3xl bg-white p-6 sm:p-10 border border-slate-200/90 shadow-xl shadow-slate-200/50 relative overflow-hidden transition-all">
                
                <!-- QUESTION 1: LEARNER AGE GROUP -->
                <div x-show="step === 1" class="space-y-6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-3" x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase bg-amber-100 text-amber-800">
                            <i class="fa-solid fa-shapes text-amber-600"></i> Step 1 of 5
                        </span>
                    </div>

                    <div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            What is your child’s age group?
                        </h2>
                        <p class="text-sm text-slate-500 mt-1.5">
                            Age dictates cognitive development milestones, focus window, and teaching methodology.
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <!-- Age 4-6 -->
                        <button 
                            type="button" 
                            @click="answers.age = '4-6 Years'; step = 2"
                            class="group p-5 rounded-2xl border-2 text-left transition-all duration-200 hover:shadow-md hover:border-amber-400"
                            :class="answers.age === '4-6 Years' ? 'border-amber-500 bg-amber-50/70 ring-4 ring-amber-500/10' : 'border-slate-200 bg-white hover:bg-slate-50/60'"
                        >
                            <div class="flex items-start justify-between">
                                <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-xl mb-3 group-hover:scale-105 transition-transform">
                                    <i class="fa-solid fa-shapes"></i>
                                </div>
                                <i class="fa-solid fa-arrow-right text-xs text-slate-300 group-hover:text-amber-500 group-hover:translate-x-1 transition-all"></i>
                            </div>
                            <strong class="block text-slate-900 text-lg">Ages 4 - 6</strong>
                            <span class="text-xs font-semibold text-amber-700 uppercase tracking-wider block mb-1">Preschool & Kindergarten</span>
                            <p class="text-xs text-slate-500 leading-relaxed">Curiosity phase: sensory skills, handwriting grip, phonetic speech & basic numbers.</p>
                        </button>

                        <!-- Age 7-10 -->
                        <button 
                            type="button" 
                            @click="answers.age = '7-10 Years'; step = 2"
                            class="group p-5 rounded-2xl border-2 text-left transition-all duration-200 hover:shadow-md hover:border-amber-400"
                            :class="answers.age === '7-10 Years' ? 'border-amber-500 bg-amber-50/70 ring-4 ring-amber-500/10' : 'border-slate-200 bg-white hover:bg-slate-50/60'"
                        >
                            <div class="flex items-start justify-between">
                                <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-xl mb-3 group-hover:scale-105 transition-transform">
                                    <i class="fa-solid fa-rocket"></i>
                                </div>
                                <i class="fa-solid fa-arrow-right text-xs text-slate-300 group-hover:text-amber-500 group-hover:translate-x-1 transition-all"></i>
                            </div>
                            <strong class="block text-slate-900 text-lg">Ages 7 - 10</strong>
                            <span class="text-xs font-semibold text-blue-700 uppercase tracking-wider block mb-1">Primary School (Grades 2 - 5)</span>
                            <p class="text-xs text-slate-500 leading-relaxed">Golden cognitive acceleration: Abacus speed, mental math, arts & karate.</p>
                        </button>

                        <!-- Age 11-14 -->
                        <button 
                            type="button" 
                            @click="answers.age = '11-14 Years'; step = 2"
                            class="group p-5 rounded-2xl border-2 text-left transition-all duration-200 hover:shadow-md hover:border-amber-400"
                            :class="answers.age === '11-14 Years' ? 'border-amber-500 bg-amber-50/70 ring-4 ring-amber-500/10' : 'border-slate-200 bg-white hover:bg-slate-50/60'"
                        >
                            <div class="flex items-start justify-between">
                                <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-xl mb-3 group-hover:scale-105 transition-transform">
                                    <i class="fa-solid fa-brain"></i>
                                </div>
                                <i class="fa-solid fa-arrow-right text-xs text-slate-300 group-hover:text-amber-500 group-hover:translate-x-1 transition-all"></i>
                            </div>
                            <strong class="block text-slate-900 text-lg">Ages 11 - 14</strong>
                            <span class="text-xs font-semibold text-emerald-700 uppercase tracking-wider block mb-1">Middle School (Grades 6 - 8)</span>
                            <p class="text-xs text-slate-500 leading-relaxed">Analytical maturity: Vedic mathematics, robotics, speed chess & fluent communication.</p>
                        </button>

                        <!-- Age 15+ -->
                        <button 
                            type="button" 
                            @click="answers.age = '15+ Years'; step = 2"
                            class="group p-5 rounded-2xl border-2 text-left transition-all duration-200 hover:shadow-md hover:border-amber-400"
                            :class="answers.age === '15+ Years' ? 'border-amber-500 bg-amber-50/70 ring-4 ring-amber-500/10' : 'border-slate-200 bg-white hover:bg-slate-50/60'"
                        >
                            <div class="flex items-start justify-between">
                                <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center text-xl mb-3 group-hover:scale-105 transition-transform">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </div>
                                <i class="fa-solid fa-arrow-right text-xs text-slate-300 group-hover:text-amber-500 group-hover:translate-x-1 transition-all"></i>
                            </div>
                            <strong class="block text-slate-900 text-lg">Ages 15 & Above</strong>
                            <span class="text-xs font-semibold text-purple-700 uppercase tracking-wider block mb-1">High School & Teens</span>
                            <p class="text-xs text-slate-500 leading-relaxed">Competitive edge: speed math shortcuts, teacher certifications & public speaking.</p>
                        </button>
                    </div>
                </div>

                <!-- QUESTION 2: PRIMARY DEVELOPMENTAL GOAL (COURSE CATEGORIES) -->
                <div x-show="step === 2" class="space-y-6" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-3" x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase bg-amber-100 text-amber-800">
                            <i class="fa-solid fa-bullseye text-amber-600"></i> Step 2 of 5
                        </span>
                        <button type="button" @click="step = 1" class="text-xs font-semibold text-slate-500 hover:text-slate-800 flex items-center gap-1 transition">
                            <i class="fa-solid fa-arrow-left text-[10px]"></i> Back
                        </button>
                    </div>

                    <div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            What is your primary developmental goal?
                        </h2>
                        <p class="text-sm text-slate-500 mt-1.5">
                            Choose the core skill domain you want your child to master. Every option maps to accredited Sri Deekshaa programs.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <template x-for="category in categories" :key="category.slug">
                            <button 
                                type="button" 
                                @click="selectCategory(category)"
                                class="group relative p-5 rounded-2xl border-2 text-left transition-all duration-200 flex flex-col justify-between hover:shadow-md"
                                :class="answers.category_slug === category.slug 
                                    ? 'border-amber-500 bg-amber-50/70 ring-4 ring-amber-500/10 shadow-sm' 
                                    : 'border-slate-200 bg-white hover:border-amber-400 hover:bg-slate-50/60'"
                            >
                                <div>
                                    <div class="flex items-start justify-between gap-3 mb-3">
                                        <div 
                                            class="w-12 h-12 rounded-xl flex items-center justify-center text-xl transition-transform duration-200 group-hover:scale-105"
                                            :class="answers.category_slug === category.slug 
                                                ? 'bg-amber-500 text-slate-950 font-bold' 
                                                : 'bg-slate-100 text-slate-700 group-hover:bg-amber-100 group-hover:text-amber-800'"
                                        >
                                            <i :class="category.icon"></i>
                                        </div>
                                        <div 
                                            class="w-6 h-6 rounded-full border-2 flex items-center justify-center transition"
                                            :class="answers.category_slug === category.slug 
                                                ? 'border-amber-500 bg-amber-500 text-slate-950' 
                                                : 'border-slate-300 text-transparent'"
                                        >
                                            <i class="fa-solid fa-check text-[11px] font-bold"></i>
                                        </div>
                                    </div>

                                    <h3 class="text-base font-bold text-slate-900 group-hover:text-amber-700 transition" x-text="category.name"></h3>
                                    <p class="text-xs text-slate-500 mt-1.5 leading-relaxed line-clamp-2" x-text="category.description"></p>
                                </div>

                                <!-- Sample Course Tags from this Category -->
                                <div class="mt-4 pt-3 border-t border-slate-100/90 flex flex-wrap gap-1.5" x-show="category.courses && category.courses.length > 0">
                                    <template x-for="(crs, idx) in category.courses.slice(0, 3)" :key="crs.slug">
                                        <span class="inline-block text-[11px] font-medium px-2 py-0.5 rounded-md bg-slate-100 text-slate-600" x-text="crs.title"></span>
                                    </template>
                                    <span class="text-[10px] text-slate-400 self-center font-medium" x-show="category.courses.length > 3" x-text="'+' + (category.courses.length - 3) + ' more'"></span>
                                </div>
                            </button>
                        </template>
                    </div>
                </div>

                <!-- QUESTION 3: LEARNING STYLE & ENGAGEMENT -->
                <div x-show="step === 3" class="space-y-6" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-3" x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase bg-amber-100 text-amber-800">
                            <i class="fa-solid fa-puzzle-piece text-amber-600"></i> Step 3 of 5
                        </span>
                        <button type="button" @click="step = 2" class="text-xs font-semibold text-slate-500 hover:text-slate-800 flex items-center gap-1 transition">
                            <i class="fa-solid fa-arrow-left text-[10px]"></i> Back
                        </button>
                    </div>

                    <div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            How does your child engage and learn best?
                        </h2>
                        <p class="text-sm text-slate-500 mt-1.5">
                            Our coaches adapt instructional techniques to match your child's dominant learning channel.
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <!-- Kinesthetic / Hands-on -->
                        <button 
                            type="button" 
                            @click="answers.learning_style = 'Hands-on Kinesthetic'; step = 4"
                            class="group p-5 rounded-2xl border-2 text-left transition-all duration-200 hover:shadow-md hover:border-amber-400"
                            :class="answers.learning_style === 'Hands-on Kinesthetic' ? 'border-amber-500 bg-amber-50/70 ring-4 ring-amber-500/10' : 'border-slate-200 bg-white hover:bg-slate-50/60'"
                        >
                            <div class="flex items-start justify-between">
                                <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center text-xl mb-3 group-hover:scale-105 transition-transform">
                                    <i class="fa-solid fa-hand-sparkles"></i>
                                </div>
                                <i class="fa-solid fa-arrow-right text-xs text-slate-300 group-hover:text-amber-500 group-hover:translate-x-1 transition-all"></i>
                            </div>
                            <strong class="block text-slate-900 text-base">Kinesthetic / Hands-on</strong>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">Learns best through physical tools, abacus beads, instruments, art kits & movement.</p>
                        </button>

                        <!-- Visual & Analytical -->
                        <button 
                            type="button" 
                            @click="answers.learning_style = 'Visual & Analytical'; step = 4"
                            class="group p-5 rounded-2xl border-2 text-left transition-all duration-200 hover:shadow-md hover:border-amber-400"
                            :class="answers.learning_style === 'Visual & Analytical' ? 'border-amber-500 bg-amber-50/70 ring-4 ring-amber-500/10' : 'border-slate-200 bg-white hover:bg-slate-50/60'"
                        >
                            <div class="flex items-start justify-between">
                                <div class="w-12 h-12 rounded-xl bg-teal-100 text-teal-700 flex items-center justify-center text-xl mb-3 group-hover:scale-105 transition-transform">
                                    <i class="fa-solid fa-eye"></i>
                                </div>
                                <i class="fa-solid fa-arrow-right text-xs text-slate-300 group-hover:text-amber-500 group-hover:translate-x-1 transition-all"></i>
                            </div>
                            <strong class="block text-slate-900 text-base">Visual & Analytical</strong>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">Excels with mental pattern recognition, diagrams, mental calculation and chess boards.</p>
                        </button>

                        <!-- Social & Interactive -->
                        <button 
                            type="button" 
                            @click="answers.learning_style = 'Interactive & Expressive'; step = 4"
                            class="group p-5 rounded-2xl border-2 text-left transition-all duration-200 hover:shadow-md hover:border-amber-400"
                            :class="answers.learning_style === 'Interactive & Expressive' ? 'border-amber-500 bg-amber-50/70 ring-4 ring-amber-500/10' : 'border-slate-200 bg-white hover:bg-slate-50/60'"
                        >
                            <div class="flex items-start justify-between">
                                <div class="w-12 h-12 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center text-xl mb-3 group-hover:scale-105 transition-transform">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                                <i class="fa-solid fa-arrow-right text-xs text-slate-300 group-hover:text-amber-500 group-hover:translate-x-1 transition-all"></i>
                            </div>
                            <strong class="block text-slate-900 text-base">Interactive & Expressive</strong>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">Flourishes with live interaction, teacher encouragement, storytelling & friendly peer challenges.</p>
                        </button>

                        <!-- Disciplined & Step-by-Step -->
                        <button 
                            type="button" 
                            @click="answers.learning_style = 'Structured Milestone Pace'; step = 4"
                            class="group p-5 rounded-2xl border-2 text-left transition-all duration-200 hover:shadow-md hover:border-amber-400"
                            :class="answers.learning_style === 'Structured Milestone Pace' ? 'border-amber-500 bg-amber-50/70 ring-4 ring-amber-500/10' : 'border-slate-200 bg-white hover:bg-slate-50/60'"
                        >
                            <div class="flex items-start justify-between">
                                <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-xl mb-3 group-hover:scale-105 transition-transform">
                                    <i class="fa-solid fa-list-check"></i>
                                </div>
                                <i class="fa-solid fa-arrow-right text-xs text-slate-300 group-hover:text-amber-500 group-hover:translate-x-1 transition-all"></i>
                            </div>
                            <strong class="block text-slate-900 text-base">Structured & Goal-Oriented</strong>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">Loves clear graded levels, daily practice sheets, belt tests & certificate milestones.</p>
                        </button>
                    </div>
                </div>

                <!-- QUESTION 4: PREFERRED CLASS FORMAT -->
                <div x-show="step === 4" class="space-y-6" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-3" x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase bg-amber-100 text-amber-800">
                            <i class="fa-solid fa-chalkboard-user text-amber-600"></i> Step 4 of 5
                        </span>
                        <button type="button" @click="step = 3" class="text-xs font-semibold text-slate-500 hover:text-slate-800 flex items-center gap-1 transition">
                            <i class="fa-solid fa-arrow-left text-[10px]"></i> Back
                        </button>
                    </div>

                    <div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            Which learning format suits your family schedule?
                        </h2>
                        <p class="text-sm text-slate-500 mt-1.5">
                            We offer both physical academy classrooms in Chennai and live 1-on-1 / micro-group online batches.
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                        <!-- In-Person Campus -->
                        <button 
                            type="button" 
                            @click="answers.mode = 'In-Person Campus (Chennai)'; step = 5"
                            class="group p-5 rounded-2xl border-2 text-left transition-all duration-200 hover:shadow-md hover:border-amber-400"
                            :class="answers.mode === 'In-Person Campus (Chennai)' ? 'border-amber-500 bg-amber-50/70 ring-4 ring-amber-500/10' : 'border-slate-200 bg-white hover:bg-slate-50/60'"
                        >
                            <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-xl mb-3 group-hover:scale-105 transition-transform">
                                <i class="fa-solid fa-building-columns"></i>
                            </div>
                            <strong class="block text-slate-900 text-base">In-Person Campus</strong>
                            <span class="text-xs font-semibold text-blue-700 block mb-1">Chennai Academy</span>
                            <p class="text-xs text-slate-500 leading-relaxed">Direct mentorship in specialized audio-visual classrooms.</p>
                        </button>

                        <!-- Live Online -->
                        <button 
                            type="button" 
                            @click="answers.mode = 'Live Interactive Online'; step = 5"
                            class="group p-5 rounded-2xl border-2 text-left transition-all duration-200 hover:shadow-md hover:border-amber-400"
                            :class="answers.mode === 'Live Interactive Online' ? 'border-amber-500 bg-amber-50/70 ring-4 ring-amber-500/10' : 'border-slate-200 bg-white hover:bg-slate-50/60'"
                        >
                            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-xl mb-3 group-hover:scale-105 transition-transform">
                                <i class="fa-solid fa-laptop"></i>
                            </div>
                            <strong class="block text-slate-900 text-base">Live Online</strong>
                            <span class="text-xs font-semibold text-emerald-700 block mb-1">Interactive Video</span>
                            <p class="text-xs text-slate-500 leading-relaxed">Small 1:6 teacher-student batches with weekly personal check-ins.</p>
                        </button>

                        <!-- Hybrid Flexible -->
                        <button 
                            type="button" 
                            @click="answers.mode = 'Hybrid / Flexible'; step = 5"
                            class="group p-5 rounded-2xl border-2 text-left transition-all duration-200 hover:shadow-md hover:border-amber-400"
                            :class="answers.mode === 'Hybrid / Flexible' ? 'border-amber-500 bg-amber-50/70 ring-4 ring-amber-500/10' : 'border-slate-200 bg-white hover:bg-slate-50/60'"
                        >
                            <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center text-xl mb-3 group-hover:scale-105 transition-transform">
                                <i class="fa-solid fa-arrows-spin"></i>
                            </div>
                            <strong class="block text-slate-900 text-base">Hybrid / Flexible</strong>
                            <span class="text-xs font-semibold text-purple-700 block mb-1">Blended Track</span>
                            <p class="text-xs text-slate-500 leading-relaxed">Campus attendance with digital portal exercise materials.</p>
                        </button>
                    </div>
                </div>

                <!-- QUESTION 5: WEEKLY TIME COMMITMENT -->
                <div x-show="step === 5" class="space-y-6" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-3" x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase bg-amber-100 text-amber-800">
                            <i class="fa-solid fa-clock text-amber-600"></i> Step 5 of 5
                        </span>
                        <button type="button" @click="step = 4" class="text-xs font-semibold text-slate-500 hover:text-slate-800 flex items-center gap-1 transition">
                            <i class="fa-solid fa-arrow-left text-[10px]"></i> Back
                        </button>
                    </div>

                    <div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            How much time can the learner dedicate per week?
                        </h2>
                        <p class="text-sm text-slate-500 mt-1.5">
                            Consistent practice yields compounding results without overwhelming standard school studies.
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                        <!-- 1-2 Hours -->
                        <button 
                            type="button" 
                            @click="answers.time_commitment = '1 - 2 Hours / Week'; step = 6"
                            class="group p-5 rounded-2xl border-2 text-left transition-all duration-200 hover:shadow-md hover:border-amber-400"
                            :class="answers.time_commitment === '1 - 2 Hours / Week' ? 'border-amber-500 bg-amber-50/70 ring-4 ring-amber-500/10' : 'border-slate-200 bg-white hover:bg-slate-50/60'"
                        >
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Gentle Pace</span>
                            <strong class="block text-slate-900 text-lg">1 - 2 Hours</strong>
                            <p class="text-xs text-slate-500 mt-2 leading-relaxed">Weekend hobby pace. Perfect for busy school timetables.</p>
                        </button>

                        <!-- 3-4 Hours (Recommended) -->
                        <button 
                            type="button" 
                            @click="answers.time_commitment = '3 - 4 Hours / Week'; step = 6"
                            class="group relative p-5 rounded-2xl border-2 text-left transition-all duration-200 hover:shadow-md hover:border-amber-400"
                            :class="answers.time_commitment === '3 - 4 Hours / Week' ? 'border-amber-500 bg-amber-50/70 ring-4 ring-amber-500/10' : 'border-amber-300 bg-white hover:bg-amber-50/30'"
                        >
                            <span class="absolute -top-3 right-4 px-2.5 py-0.5 rounded-full bg-amber-500 text-slate-950 font-black text-[10px] uppercase tracking-wider shadow">
                                Recommended
                            </span>
                            <span class="text-xs font-bold uppercase tracking-wider text-amber-700 block mb-1">Optimal Growth</span>
                            <strong class="block text-slate-900 text-lg">3 - 4 Hours</strong>
                            <p class="text-xs text-slate-500 mt-2 leading-relaxed">2 weekly sessions + 10 mins daily warm-up. Ideal for rapid skill retention.</p>
                        </button>

                        <!-- 5+ Hours -->
                        <button 
                            type="button" 
                            @click="answers.time_commitment = '5+ Hours / Week'; step = 6"
                            class="group p-5 rounded-2xl border-2 text-left transition-all duration-200 hover:shadow-md hover:border-amber-400"
                            :class="answers.time_commitment === '5+ Hours / Week' ? 'border-amber-500 bg-amber-50/70 ring-4 ring-amber-500/10' : 'border-slate-200 bg-white hover:bg-slate-50/60'"
                        >
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Mastery Track</span>
                            <strong class="block text-slate-900 text-lg">5+ Hours</strong>
                            <p class="text-xs text-slate-500 mt-2 leading-relaxed">Championship preparation, advanced gradings & fast-track belts.</p>
                        </button>
                    </div>
                </div>

                <!-- STEP 6: CONTACT INFORMATION LEAD CAPTURE -->
                <div x-show="step === 6" class="space-y-6" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-3" x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase bg-emerald-100 text-emerald-800">
                            <i class="fa-solid fa-circle-check text-emerald-600"></i> Assessment Ready
                        </span>
                        <button type="button" @click="step = 5" class="text-xs font-semibold text-slate-500 hover:text-slate-800 flex items-center gap-1 transition">
                            <i class="fa-solid fa-arrow-left text-[10px]"></i> Back
                        </button>
                    </div>

                    <div class="text-center sm:text-left">
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            Your Child’s Skill Roadmap is Generated!
                        </h2>
                        <p class="text-sm text-slate-600 mt-1.5 leading-relaxed">
                            Enter where we should share your diagnostic summary and free trial counseling pass.
                        </p>
                    </div>

                    <form @submit.prevent="calculateResults()" class="space-y-4 pt-2">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                    Parent / Guardian Name <span class="text-rose-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    x-model="answers.parent_name" 
                                    required 
                                    placeholder="e.g. Meera Raman" 
                                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 focus:outline-none transition"
                                >
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                    Child’s Full Name <span class="text-rose-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    x-model="answers.student_name" 
                                    required 
                                    placeholder="e.g. Krrish Raman" 
                                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 focus:outline-none transition"
                                >
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                    WhatsApp / Mobile Number <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-xs font-bold text-slate-400 pointer-events-none">
                                        +91
                                    </span>
                                    <input 
                                        type="tel" 
                                        x-model="answers.phone" 
                                        required 
                                        placeholder="98765 43210" 
                                        class="w-full rounded-xl border border-slate-300 pl-12 pr-4 py-3 text-sm focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 focus:outline-none transition"
                                    >
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                    Email Address (Optional)
                                </label>
                                <input 
                                    type="email" 
                                    x-model="answers.email" 
                                    placeholder="meera@example.com" 
                                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 focus:outline-none transition"
                                >
                            </div>
                        </div>

                        <div class="pt-2">
                            <button 
                                type="submit" 
                                :disabled="isSubmitting"
                                class="w-full rounded-xl bg-amber-500 hover:bg-amber-600 active:scale-[0.99] text-slate-950 font-extrabold py-4 px-6 text-base shadow-lg shadow-amber-500/25 transition flex items-center justify-center gap-2"
                            >
                                <span x-show="!isSubmitting">View Personalized Curriculum Match</span>
                                <span x-show="isSubmitting" class="flex items-center gap-2">
                                    <i class="fa-solid fa-circle-notch fa-spin"></i> Analyzing Results...
                                </span>
                                <i x-show="!isSubmitting" class="fa-solid fa-arrow-right text-xs"></i>
                            </button>
                            <p class="text-center text-[11px] text-slate-400 mt-2.5">
                                <i class="fa-solid fa-lock text-[10px]"></i> We respect your privacy. No spam guaranteed.
                            </p>
                        </div>
                    </form>
                </div>

                <!-- STEP 7: COMPREHENSIVE RESULT SCORECARD -->
                <div x-show="step === 7" class="space-y-8" x-cloak x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                    
                    <!-- Result Badge & Celebration Header -->
                    <div class="text-center space-y-3">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-gradient-to-tr from-amber-500 to-yellow-400 text-slate-950 text-3xl font-black shadow-lg shadow-amber-500/30">
                            <i class="fa-solid fa-award"></i>
                        </div>
                        <div>
                            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-emerald-100 text-emerald-800">
                                <i class="fa-solid fa-circle-check"></i> 98% Compatibility Match
                            </span>
                            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-2" x-text="recommendedTrack"></h2>
                            <p class="text-sm sm:text-base text-slate-600 max-w-xl mx-auto mt-2 leading-relaxed" x-text="recommendedDescription"></p>
                        </div>
                    </div>

                    <!-- Summary Snapshot Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 p-4 rounded-2xl bg-slate-50 border border-slate-200/80 text-center">
                        <div class="p-2">
                            <span class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider">Age Group</span>
                            <span class="font-extrabold text-slate-900 text-sm mt-0.5 block" x-text="answers.age || 'Primary'"></span>
                        </div>
                        <div class="p-2 border-l border-slate-200">
                            <span class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider">Learning Style</span>
                            <span class="font-extrabold text-slate-900 text-sm mt-0.5 block truncate" x-text="answers.learning_style || 'Hands-on'"></span>
                        </div>
                        <div class="p-2 border-t sm:border-t-0 sm:border-l border-slate-200">
                            <span class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider">Class Format</span>
                            <span class="font-extrabold text-slate-900 text-sm mt-0.5 block truncate" x-text="answers.mode || 'In-Person'"></span>
                        </div>
                        <div class="p-2 border-t sm:border-t-0 sm:border-l border-slate-200">
                            <span class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider">Weekly Time</span>
                            <span class="font-extrabold text-slate-900 text-sm mt-0.5 block" x-text="answers.time_commitment || '3-4 Hours'"></span>
                        </div>
                    </div>

                    <!-- Recommended Courses Matching the Selected Category -->
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                                <i class="fa-solid fa-graduation-cap text-amber-500"></i> Recommended Courses in this Track:
                            </h3>
                            <span class="text-xs font-semibold text-slate-500" x-text="recommendedCourses.length + ' Available Programs'"></span>
                        </div>

                        <div class="space-y-3">
                            <template x-for="course in recommendedCourses" :key="course.slug">
                                <div class="rounded-2xl border border-slate-200/90 bg-white p-4 sm:p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 hover:border-amber-400 hover:shadow-md transition">
                                    <div class="flex items-start gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl shrink-0 border border-amber-100">
                                            <i class="fa-solid fa-book-open"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-slate-900 text-base" x-text="course.title"></h4>
                                            <p class="text-xs text-slate-500 mt-1 line-clamp-2 max-w-md" x-text="course.short_description"></p>
                                            <div class="flex flex-wrap items-center gap-2 mt-2">
                                                <span class="text-[11px] font-semibold px-2 py-0.5 rounded bg-blue-50 text-blue-700" x-show="course.age_range" x-text="course.age_range"></span>
                                                <span class="text-[11px] font-semibold px-2 py-0.5 rounded bg-emerald-50 text-emerald-700" x-show="course.duration" x-text="course.duration"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <a 
                                        :href="'/courses/' + course.slug" 
                                        class="shrink-0 w-full sm:w-auto text-center rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs px-4 py-2.5 transition"
                                    >
                                        View Full Syllabus <i class="fa-solid fa-arrow-right text-[10px] ml-1"></i>
                                    </a>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Call to Actions -->
                    <div class="p-6 rounded-3xl bg-gradient-to-br from-slate-900 to-slate-950 text-white text-center space-y-4 shadow-xl">
                        <span class="text-xs font-bold uppercase tracking-widest text-amber-400">Next Recommended Step</span>
                        <h4 class="text-xl sm:text-2xl font-bold">Experience Our Method with a Complimentary Free Trial</h4>
                        <p class="text-xs sm:text-sm text-slate-300 max-w-md mx-auto leading-relaxed">
                            Join us for a complimentary 1-on-1 counseling session and interactive demo class at our academy or live online.
                        </p>
                        
                        <div class="pt-2 flex flex-wrap items-center justify-center gap-3">
                            <button 
                                type="button" 
                                @click="$dispatch('open-enquiry-modal', { 
                                    parent_name: answers.parent_name,
                                    student_name: answers.student_name,
                                    phone: answers.phone,
                                    email: answers.email,
                                    notes: 'Assessment Result: ' + recommendedTrack + ' (' + answers.age + ', ' + answers.mode + ')'
                                })"
                                class="rounded-xl bg-amber-500 hover:bg-amber-600 active:scale-95 text-slate-950 font-bold px-6 py-3 text-sm shadow-md transition"
                            >
                                <i class="fa-solid fa-calendar-check mr-1.5"></i> Schedule Free Trial Class
                            </button>
                            <x-whatsapp-btn label="Ask Questions on WhatsApp" />
                        </div>

                        <div class="pt-2">
                            <button 
                                type="button" 
                                @click="step = 1; window.scrollTo({ top: 250, behavior: 'smooth' })" 
                                class="text-xs text-slate-400 hover:text-white underline underline-offset-4 transition"
                            >
                                <i class="fa-solid fa-rotate-left mr-1"></i> Retake Assessment
                            </button>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>

    <!-- Why Parents Trust Sri Deekshaa's Assessment Section -->
    <section class="py-16 sm:py-20 bg-white border-t border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-600 bg-amber-50 px-3 py-1 rounded-full border border-amber-200">
                    Scientifically Structured
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mt-3">
                    Why Take Sri Deekshaa’s Skill Assessment?
                </h2>
                <p class="text-base text-slate-600 mt-3 leading-relaxed">
                    Most children struggle with subjects not because of low aptitude, but because the teaching technique does not match their innate cognitive pace.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Pillar 1 -->
                <div class="rounded-2xl p-6 sm:p-8 bg-slate-50 border border-slate-200/80 hover:border-amber-400 hover:shadow-lg transition">
                    <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center text-2xl mb-5">
                        <i class="fa-solid fa-brain"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Dual-Hemisphere Activation</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        We balance left-brain analytical computation (abacus, Vedic maths) with right-brain creative expression (art, music, movement).
                    </p>
                </div>

                <!-- Pillar 2 -->
                <div class="rounded-2xl p-6 sm:p-8 bg-slate-50 border border-slate-200/80 hover:border-amber-400 hover:shadow-lg transition">
                    <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center text-2xl mb-5">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Milestone-Based Progress</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Clear graded levels ensure children experience continuous small wins, permanently dissolving exam anxiety and hesitation.
                    </p>
                </div>

                <!-- Pillar 3 -->
                <div class="rounded-2xl p-6 sm:p-8 bg-slate-50 border border-slate-200/80 hover:border-amber-400 hover:shadow-lg transition">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-2xl mb-5">
                        <i class="fa-solid fa-certificate"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">ISO & Level Certification</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Recognized credential badges authenticated with unique certificate IDs verifiable across schools and talent competitions.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Assessment FAQs Section -->
    <section class="py-16 sm:py-20 bg-slate-50 border-t border-slate-200/80">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-12">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-600 bg-amber-50 px-3 py-1 rounded-full border border-amber-200">
                    Got Questions?
                </span>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight mt-3">
                    Frequently Asked Questions
                </h2>
            </div>

            <div class="space-y-4" x-data="{ openFaq: null }">
                <!-- FAQ 1 -->
                <div class="rounded-2xl bg-white border border-slate-200/80 overflow-hidden shadow-sm">
                    <button 
                        type="button" 
                        @click="openFaq = (openFaq === 1 ? null : 1)"
                        class="w-full p-5 text-left font-bold text-slate-900 flex items-center justify-between hover:text-amber-600 transition"
                    >
                        <span>Is the skill assessment completely free?</span>
                        <i class="fa-solid fa-chevron-down text-xs transition-transform" :class="openFaq === 1 ? 'rotate-180 text-amber-500' : 'text-slate-400'"></i>
                    </button>
                    <div x-show="openFaq === 1" x-collapse class="px-5 pb-5 text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Yes! The assessment and initial 1-on-1 counseling session are 100% complimentary with zero enrollment obligations.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="rounded-2xl bg-white border border-slate-200/80 overflow-hidden shadow-sm">
                    <button 
                        type="button" 
                        @click="openFaq = (openFaq === 2 ? null : 2)"
                        class="w-full p-5 text-left font-bold text-slate-900 flex items-center justify-between hover:text-amber-600 transition"
                    >
                        <span>Can my child attend a trial session before committing?</span>
                        <i class="fa-solid fa-chevron-down text-xs transition-transform" :class="openFaq === 2 ? 'rotate-180 text-amber-500' : 'text-slate-400'"></i>
                    </button>
                    <div x-show="openFaq === 2" x-collapse class="px-5 pb-5 text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Absolutely. We actively encourage every parent to experience a free trial session so you can see how our faculty engages with your child.
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="rounded-2xl bg-white border border-slate-200/80 overflow-hidden shadow-sm">
                    <button 
                        type="button" 
                        @click="openFaq = (openFaq === 3 ? null : 3)"
                        class="w-full p-5 text-left font-bold text-slate-900 flex items-center justify-between hover:text-amber-600 transition"
                    >
                        <span>Can my child enroll in more than one skill program?</span>
                        <i class="fa-solid fa-chevron-down text-xs transition-transform" :class="openFaq === 3 ? 'rotate-180 text-amber-500' : 'text-slate-400'"></i>
                    </button>
                    <div x-show="openFaq === 3" x-collapse class="px-5 pb-5 text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Yes. Many students combine cognitive courses (like Abacus or Vedic Maths) with creative or physical tracks (such as Drawing, Karate, or Music) to maintain balanced weekend learning.
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="rounded-2xl bg-white border border-slate-200/80 overflow-hidden shadow-sm">
                    <button 
                        type="button" 
                        @click="openFaq = (openFaq === 4 ? null : 4)"
                        class="w-full p-5 text-left font-bold text-slate-900 flex items-center justify-between hover:text-amber-600 transition"
                    >
                        <span>Are online batches as effective as classroom batches?</span>
                        <i class="fa-solid fa-chevron-down text-xs transition-transform" :class="openFaq === 4 ? 'rotate-180 text-amber-500' : 'text-slate-400'"></i>
                    </button>
                    <div x-show="openFaq === 4" x-collapse class="px-5 pb-5 text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Yes! Our online batches maintain a micro-ratio of 1:6 students with high-definition digital whiteboards and two-way video interaction to ensure complete individual focus.
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts.app>