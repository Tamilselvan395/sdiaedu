<x-layouts.app :title="$course->title" :metaDescription="$course->short_description" :canonical="$canonicalUrl ?? route('courses.show', $course->slug)" :ogImage="$course->image_url">
    @push('head')
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "Course",
      "name": @json($course->title),
      "description": @json($course->short_description),
      "provider": {
        "@@type": "EducationalOrganization",
        "name": "Sri Deekshaa International Academy",
        "sameAs": "{{ url('/') }}"
      },
      "educationalCredentialAwarded": @json($course->certificate_name ?? 'Certificate of Completion'),
      "timeRequired": @json($course->duration ?? 'P3M'),
      "offers": {
        "@@type": "Offer",
        "category": @json($course->category->name ?? 'Skill Development'),
        "price": "0",
        "priceCurrency": "INR",
        "availability": "https://schema.org/InStock"
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
          "name": "Courses",
          "item": "{{ route('courses.index') }}"
        },
        @if($course->category)
        {
          "@@type": "ListItem",
          "position": 3,
          "name": @json($course->category->name),
          "item": "{{ route('courses.category', $course->category->slug) }}"
        },
        {
          "@@type": "ListItem",
          "position": 4,
          "name": @json($course->title),
          "item": "{{ route('courses.show', $course->slug) }}"
        }
        @else
        {
          "@@type": "ListItem",
          "position": 3,
          "name": @json($course->title),
          "item": "{{ route('courses.show', $course->slug) }}"
        }
        @endif
      ]
    }
    </script>
    @endpush

    <!-- Course Header Hero -->
    <section 
        data-course-id="{{ $course->id }}"
        data-course-title="{{ $course->title }}"
        data-course-category="{{ $course->category->name ?? 'Skill Development' }}"
        data-course-price="{{ $course->price ?? 0 }}"
        class="bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-white pt-8 pb-12 lg:pt-10 lg:pb-16 relative overflow-hidden border-b border-slate-800/80">
        <!-- Background Ambient Glow & Grid -->
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:20px_20px]"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/3 w-80 h-80 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Breadcrumbs -->
            @php
                $courseBreadcrumbs = [
                    ['label' => 'Courses', 'url' => route('courses.index')],
                ];
                if ($course->category) {
                    $courseBreadcrumbs[] = ['label' => $course->category->name, 'url' => route('courses.category', $course->category->slug)];
                }
                $courseBreadcrumbs[] = ['label' => $course->title];
            @endphp
            <div class="mb-4 sm:mb-6">
                <x-breadcrumb :items="$courseBreadcrumbs" />
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                <div class="lg:col-span-8 space-y-4">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="rounded-full bg-amber-500/20 px-3 py-1 text-xs font-semibold text-amber-400 border border-amber-500/30">
                            {{ $course->category->name ?? 'Skill Program' }}
                        </span>
                        <span class="rounded-full bg-slate-800 px-3 py-1 text-xs font-medium text-slate-300">
                            Mode: {{ $course->mode->value ?? 'Flexible' }}
                        </span>
                        <span class="rounded-full bg-emerald-500/20 px-3 py-1 text-xs font-medium text-emerald-300 border border-emerald-500/30">
                            Ages {{ $course->age_range }}
                        </span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight">
                        {{ $course->title }}
                    </h1>

                    <p class="text-base sm:text-lg text-slate-300 leading-relaxed max-w-3xl">
                        {{ $course->short_description }}
                    </p>

                    <div class="pt-4 flex flex-wrap items-center gap-6 text-sm text-slate-300 border-t border-slate-800">
                        <div>
                            <span class="block text-sm text-slate-400">Duration</span>
                            <span class="font-bold text-white">{{ $course->duration ?? 'Self-Paced / Milestone' }}</span>
                        </div>
                        <div>
                            <span class="block text-sm text-slate-400">Target Learners</span>
                            <span class="font-bold text-white">{{ $course->age_range }}</span>
                        </div>
                        <div>
                            <span class="block text-sm text-slate-400">Awarded Credential</span>
                            <span class="font-bold text-amber-400">{{ $course->certificate_name ?? 'Graduation Certificate' }}</span>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-4 hidden lg:flex items-center justify-center">
                    <img 
                        src="{{ $course->image_url }}" 
                        alt="{{ $course->title }}"
                        class="h-44 sm:h-52 w-auto object-contain drop-shadow-2xl transition hover:scale-105 duration-300"
                    >
                </div>
            </div>
        </div>
    </section>

    <!-- Main Course Content & Sticky Action Card -->
    <section class="py-12 sm:py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                
                <!-- Left Details (Comprehensive Course Sections) -->
                <div class="lg:col-span-8 space-y-12">
                    
                    <!-- 1. About Course -->
                    <div class="rounded-3xl bg-white p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-4">
                        <div class="inline-flex items-center gap-2 rounded-full bg-amber-100/80 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-amber-800 border border-amber-200/60">
                            <i class="fa-solid fa-book-open"></i>
                            <span>About Course</span>
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            About {{ $course->title }}
                        </h2>
                        @if($course->description)
                            <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed text-sm sm:text-base">
                                {!! Str::startsWith($course->description, '<') ? $course->description : nl2br(e($course->description)) !!}
                            </div>
                        @endif
                        @if($course->teaching_approach)
                            <div class="rounded-2xl bg-amber-50/60 border border-amber-200/80 p-5 flex items-start gap-3.5 mt-4">
                                <div class="h-9 w-9 rounded-xl bg-amber-500 text-slate-950 flex items-center justify-center shrink-0 text-sm">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold uppercase tracking-wider text-amber-900">Pedagogical Approach</h4>
                                    <p class="text-sm text-slate-700 mt-1 leading-relaxed">{{ $course->teaching_approach }}</p>
                                </div>
                            </div>
                        @endif

                        @if($course->eligibility)
                            <div class="rounded-2xl bg-slate-50 border border-slate-200/70 p-4 sm:p-5 flex items-start gap-3 mt-4">
                                <i class="fa-solid fa-clipboard-check text-emerald-600 text-base mt-0.5 shrink-0"></i>
                                <div>
                                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-500">Eligibility Criteria</h4>
                                    <p class="text-sm text-slate-700 mt-0.5 leading-relaxed">{{ $course->eligibility }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Quick Course Meta Matrix -->
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-4 border-t border-slate-100 text-sm">
                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                                <span class="block text-slate-400 font-medium">Mode</span>
                                <strong class="block text-slate-800 mt-0.5">{{ $course->mode->value ?? 'Flexible' }}</strong>
                            </div>
                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                                <span class="block text-slate-400 font-medium">Target Learners</span>
                                <strong class="block text-slate-800 mt-0.5">{{ $course->age_range }}</strong>
                            </div>
                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                                <span class="block text-slate-400 font-medium">Batch Ratio</span>
                                <strong class="block text-amber-600 mt-0.5">{{ $course->batch_ratio ?? 'Max 1 : 8 Mentorship' }}</strong>
                            </div>
                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                                <span class="block text-slate-400 font-medium">Credential</span>
                                <strong class="block text-emerald-600 mt-0.5">{{ $course->credential_info ?? 'ISO 9001 Certified' }}</strong>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Why Choose This Course -->
                    <div class="rounded-3xl bg-white p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
                        <div class="inline-flex items-center gap-2 rounded-full bg-emerald-100/80 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-emerald-800 border border-emerald-200/60">
                            <i class="fa-solid fa-star"></i>
                            <span>Course Benefits</span>
                        </div>
                        <div>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                                Why Choose {{ $course->title }}?
                            </h2>
                            <p class="text-sm text-slate-600 mt-1">
                                Engineered to bridge theoretical concepts with accelerated cognitive agility, lifelong discipline, and practical mastery.
                            </p>
                        </div>

                        @php
                            $whyChoosePoints = !empty($course->why_choose) && is_array($course->why_choose) ? $course->why_choose : [
                                'Structured progressive curriculum with continuous milestone checkpoints',
                                'Certified trainers with specialized pedagogical and neuro-cognitive training',
                                'Hands-on physical kits and interactive software tools provided for practice',
                                'Recognized ISO 9001:2015 certification upon milestone completion'
                            ];
                        @endphp

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($whyChoosePoints as $index => $point)
                                @php $pointText = is_array($point) ? ($point['point'] ?? reset($point)) : $point; @endphp
                                <div class="rounded-2xl bg-slate-50 border border-slate-200/70 p-5 flex items-start gap-3.5 hover:border-amber-300 hover:bg-white transition group">
                                    <div class="h-8 w-8 rounded-xl bg-amber-500/15 text-amber-600 flex items-center justify-center shrink-0 text-sm font-bold border border-amber-200/80 group-hover:bg-amber-500 group-hover:text-slate-950 transition">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                    <p class="text-sm text-slate-700 leading-relaxed font-medium">
                                        {{ $pointText }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- 3. Structured Curriculum Modules -->
                    <div class="rounded-3xl bg-white p-6 sm:p-8 border border-slate-200/80 shadow-xs">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h2 class="text-2xl font-bold text-slate-900">Curriculum & Learning Milestones</h2>
                                <p class="text-sm text-slate-500 mt-1">Structured sequential modules with hands-on practice</p>
                            </div>
                            <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-bold text-amber-800">
                                {{ $course->modules->count() }} Modules
                            </span>
                        </div>

                        <div class="space-y-4">
                            @forelse($course->modules as $index => $module)
                                <div class="rounded-2xl bg-slate-50 p-5 border border-slate-200/60 hover:border-amber-300 transition">
                                    <div class="flex items-start justify-between gap-4">
                                        <div class="flex items-start gap-3">
                                            <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-slate-900 text-white font-bold text-xs">
                                                {{ $index + 1 }}
                                            </span>
                                            <div>
                                                <h3 class="text-base font-bold text-slate-900">
                                                    {{ $module->title }}
                                                </h3>
                                                @if($module->description)
                                                    <p class="mt-1 text-sm text-slate-600 leading-relaxed">
                                                        {{ $module->description }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        @if($module->duration)
                                            <span class="shrink-0 text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-lg border border-slate-200">
                                                {{ $module->duration }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-slate-500 italic">
                                    Comprehensive syllabus available upon consultation.
                                </p>
                            @endforelse
                        </div>
                    </div>

                    <!-- 4. Learning Outcomes -->
                    <div class="rounded-3xl bg-white p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
                        <div class="inline-flex items-center gap-2 rounded-full bg-blue-100/80 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-blue-800 border border-blue-200/60">
                            <i class="fa-solid fa-bullseye"></i>
                            <span>Core Competencies</span>
                        </div>
                        <div>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                                Learning Outcomes
                            </h2>
                            <p class="text-sm text-slate-600 mt-1">
                                Measurable milestones and cognitive capabilities learners master through this program.
                            </p>
                        </div>

                        @php
                            $learningOutcomes = !empty($course->learning_outcomes) && is_array($course->learning_outcomes) ? $course->learning_outcomes : [
                                'Demonstrate rapid proficiency and independent execution without constant supervision',
                                'Develop laser focus, mental stamina, and disciplined daily practice routines',
                                'Gain authentic subject confidence that elevates regular school academic performance',
                                'Achieve verifiable level milestones and official graduation credentials'
                            ];
                        @endphp

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($learningOutcomes as $outcome)
                                @php
                                    $outcomeText = is_array($outcome) ? ($outcome['point'] ?? reset($outcome)) : $outcome;
                                @endphp
                                <div class="rounded-2xl bg-emerald-50/50 border border-emerald-100 p-4 sm:p-5 flex items-start gap-3.5">
                                    <div class="h-7 w-7 rounded-lg bg-emerald-500 text-white flex items-center justify-center shrink-0 text-xs shadow-xs mt-0.5">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </div>
                                    <span class="text-sm sm:text-base font-semibold text-slate-800 leading-relaxed">
                                        {{ $outcomeText }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- 5. Why Learn at SDIA (based on course name) -->
                    <div class="rounded-3xl bg-slate-900 text-white p-6 sm:p-8 shadow-xl border border-slate-800 space-y-6">
                        <div class="inline-flex items-center gap-2 rounded-full bg-amber-500/20 text-amber-400 px-3.5 py-1 text-xs font-bold uppercase tracking-wider border border-amber-500/30">
                            <i class="fa-solid fa-shield-halved"></i>
                            <span>Institutional Excellence</span>
                        </div>
                        <div>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                                Why Learn {{ $course->title }} at SDIA?
                            </h2>
                            <p class="text-sm sm:text-base text-slate-300 mt-1 leading-relaxed">
                                Sri Deekshaa International Academy (SDIA) delivers an ISO 9001:2015 accredited ecosystem engineered around individualized mentorship, proven pedagogy, and global verification standards.
                            </p>
                        </div>

                        @php
                            $institutionHighlights = !empty($course->institution_highlights) && is_array($course->institution_highlights) ? $course->institution_highlights : [
                                [
                                    'title' => 'Master Certified Mentors',
                                    'icon' => 'fa-solid fa-chalkboard-user',
                                    'description' => 'Certified trainers trained specifically in ' . $course->title . ' with ongoing neuro-cognitive developmental research.'
                                ],
                                [
                                    'title' => 'Strict 1:8 Student-Mentor Ratio',
                                    'icon' => 'fa-solid fa-users',
                                    'description' => 'Micro-batches guarantee personalized pace adjustments, real-time error corrections, and individual support.'
                                ],
                                [
                                    'title' => 'Physical Kits & Digital Drills',
                                    'icon' => 'fa-solid fa-toolbox',
                                    'description' => 'Every learner receives dedicated hands-on equipment, graded workbooks, and speed-test software tools.'
                                ],
                                [
                                    'title' => 'Hybrid Delivery',
                                    'icon' => 'fa-solid fa-laptop',
                                    'description' => 'Study in-person at our modern Chennai campus or join interactive 2-way live online classes worldwide.'
                                ],
                                [
                                    'title' => 'Zero Exam Stress',
                                    'icon' => 'fa-solid fa-heart-pulse',
                                    'description' => 'Continuous positive milestone evaluations that celebrate every small step and build an unbreakable growth mindset.'
                                ],
                                [
                                    'title' => 'QR-Verifiable Credentials',
                                    'icon' => 'fa-solid fa-qrcode',
                                    'description' => 'ISO 9001 certified credentials backed by our permanent instant public verification portal.'
                                ],
                            ];
                        @endphp

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 pt-2">
                            @foreach($institutionHighlights as $highlight)
                                @php
                                    $hTitle = is_array($highlight) ? ($highlight['title'] ?? '') : '';
                                    $hIcon = is_array($highlight) ? ($highlight['icon'] ?? 'fa-solid fa-shield-halved') : 'fa-solid fa-shield-halved';
                                    $hDesc = is_array($highlight) ? ($highlight['description'] ?? '') : '';
                                @endphp
                                <div class="rounded-2xl bg-slate-800/80 border border-slate-700 p-4 sm:p-5 space-y-2">
                                    <div class="h-9 w-9 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-sm">
                                        <i class="{{ $hIcon }}"></i>
                                    </div>
                                    <h3 class="text-base font-bold text-white">{{ $hTitle }}</h3>
                                    <p class="text-sm text-slate-300 leading-relaxed">{{ $hDesc }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- 6. Course for Students -->
                    <div class="rounded-3xl bg-white p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
                        <div class="inline-flex items-center gap-2 rounded-full bg-indigo-100/80 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-indigo-800 border border-indigo-200/60">
                            <i class="fa-solid fa-child"></i>
                            <span>Student Track</span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                                    {{ $course->title }} for Students
                                </h2>
                                <p class="text-sm text-slate-600 mt-1">
                                    Specifically paced for learners aged {{ $course->age_range }} to build academic stamina, focus span, and cognitive speed.
                                </p>
                            </div>
                            <button 
                                type="button" 
                                @click="$dispatch('open-enquiry-modal', { course_id: '{{ $course->id }}', course_title: '{{ addslashes($course->title) }} (Student Track)' })"
                                class="shrink-0 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm px-5 py-2.5 transition shadow-xs cursor-pointer"
                            >
                                Book Free Student Trial
                            </button>
                        </div>

                        @php
                            $whoIsForPoints = !empty($course->who_is_for) && is_array($course->who_is_for) ? $course->who_is_for : [
                                'School students seeking accelerated academic performance and exam confidence',
                                'Learners looking to eliminate subject fear and cultivate deep curiosity',
                                'Children looking to build sharp concentration and reduce screen-time passivity'
                            ];

                            $whatStudentsGain = !empty($course->what_students_gain) && is_array($course->what_students_gain) ? $course->what_students_gain : [
                                'Higher school test scores & faster homework turnaround',
                                'Stronger photographic memory & spatial visualization',
                                'Self-directed problem-solving and critical reasoning',
                                'Joyful classroom atmosphere with gamified milestones'
                            ];
                        @endphp

                        <div class="space-y-3">
                            <h4 class="text-sm font-bold uppercase tracking-wider text-slate-500">Ideal Student Profiles:</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                @foreach($whoIsForPoints as $profile)
                                    @php
                                        $profileText = is_array($profile) ? ($profile['point'] ?? reset($profile)) : $profile;
                                    @endphp
                                    <div class="rounded-2xl bg-indigo-50/40 border border-indigo-100 p-4 flex items-start gap-3">
                                        <i class="fa-solid fa-user-graduate text-indigo-600 text-base mt-0.5 shrink-0"></i>
                                        <span class="text-sm text-slate-700 font-medium leading-relaxed">{{ $profileText }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="rounded-2xl bg-slate-50 border border-slate-200/70 p-5 space-y-3">
                            <h4 class="text-sm font-bold uppercase tracking-wider text-slate-800">What Students Gain:</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm text-slate-700">
                                @foreach($whatStudentsGain as $gain)
                                    @php
                                        $gainText = is_array($gain) ? ($gain['point'] ?? reset($gain)) : $gain;
                                    @endphp
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-circle-check text-emerald-500"></i>
                                        <span>{{ $gainText }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- 7. Course for Teachers & Educators -->
                    @if($course->has_teacher_training ?? true)
                    <div class="rounded-3xl bg-gradient-to-br from-amber-500/10 via-amber-50/60 to-white p-6 sm:p-8 border-2 border-amber-300/80 shadow-md space-y-6">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <div class="inline-flex items-center gap-2 rounded-full bg-amber-500 text-slate-950 px-3.5 py-1 text-xs font-bold uppercase tracking-wider shadow-xs">
                                <i class="fa-solid fa-certificate"></i>
                                <span>Teacher Training Track (TTC)</span>
                            </div>
                            <span class="text-xs font-bold text-amber-800 bg-amber-100/80 px-3 py-1 rounded-full border border-amber-200">
                                Accredited Educator Program
                            </span>
                        </div>

                        <div>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                                {{ $course->teacher_training_title ?: ($course->title . ' for Teachers & Educators') }}
                            </h2>
                            <p class="text-sm text-slate-700 mt-1 leading-relaxed">
                                {{ $course->teacher_training_description ?: ('Are you a school educator, tuition teacher, or aspiring academic entrepreneur? Our specialized Teacher Training Certification equips you with global pedagogy, comprehensive lesson kits, and certification to teach ' . $course->title . ' professionally.') }}
                            </p>
                        </div>

                        @php
                            $ttcHighlights = !empty($course->teacher_training_highlights) && is_array($course->teacher_training_highlights) ? $course->teacher_training_highlights : [
                                [
                                    'title' => 'Authorized Trainer Certification',
                                    'description' => 'Earn recognized credentials from Sri Deekshaa to conduct certified classes in schools, learning centers, or private tutoring.'
                                ],
                                [
                                    'title' => 'Complete Lesson Plans & Kits',
                                    'description' => 'Receive full teacher guidebooks, student practice sheets, lesson-by-lesson agendas, and demonstration kits.'
                                ],
                                [
                                    'title' => 'Child Psychology & Class Management',
                                    'description' => 'Master student engagement techniques, micro-pacing, identifying developmental roadblocks, and parent communication.'
                                ],
                                [
                                    'title' => 'Academy Startup & Entrepreneurship',
                                    'description' => 'Guidance and marketing materials to start your own after-school academy, home center, or weekend batch.'
                                ]
                            ];
                        @endphp

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($ttcHighlights as $th)
                                @php
                                    $thTitle = is_array($th) ? ($th['title'] ?? '') : '';
                                    $thDesc = is_array($th) ? ($th['description'] ?? '') : '';
                                @endphp
                                <div class="rounded-2xl bg-white border border-amber-200 p-5 space-y-2 shadow-xs">
                                    <div class="h-9 w-9 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-sm font-bold">
                                        <i class="fa-solid fa-certificate"></i>
                                    </div>
                                    <h3 class="text-base font-bold text-slate-900">{{ $thTitle }}</h3>
                                    <p class="text-sm text-slate-600 leading-relaxed">{{ $thDesc }}</p>
                                </div>
                            @endforeach
                        </div>

                        <!-- Teacher Callout Action -->
                        <div class="rounded-2xl bg-slate-900 text-white p-5 sm:p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div>
                                <h4 class="text-base font-bold text-amber-400">Ready to Advance Your Teaching Career?</h4>
                                <p class="text-sm text-slate-300 mt-0.5">Flexible weekend batches & online options available for working educators.</p>
                            </div>
                            <button 
                                type="button" 
                                @click="$dispatch('open-enquiry-modal', { course_id: '{{ $course->id }}', course_title: '{{ addslashes($course->title) }} (Teacher Training Track)' })"
                                class="shrink-0 rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-sm px-5 py-3 transition shadow-md active:scale-95 cursor-pointer"
                            >
                                Inquire for Teacher Training Track
                            </button>
                        </div>
                    </div>
                    @endif

                    <!-- 8. Frequently Asked Questions -->
                    <div class="rounded-3xl bg-white p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
                        <div class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-slate-700 border border-slate-200">
                            <i class="fa-solid fa-circle-question"></i>
                            <span>Got Questions?</span>
                        </div>
                        <div>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                                Frequently Asked Questions
                            </h2>
                            <p class="text-sm text-slate-600 mt-1">
                                Clear answers about class schedules, batch formats, student tracks, teacher training, and certification.
                            </p>
                        </div>

                        @php
                            $faqs = $course->faqs->count() > 0 ? $course->faqs->toArray() : [
                                [
                                    'question' => 'What is the ideal age group for this course?',
                                    'answer' => 'This course is tailored for learners aged ' . ($course->age_range ?? '5 - 15 years') . '. Prior experience is not required; each student begins with foundational modules.'
                                ],
                                [
                                    'question' => 'Is this course offered in both Student and Teacher Training formats?',
                                    'answer' => 'Yes! We run separate batches: one for young students focused on cognitive mastery and school excellence, and another dedicated Teacher Training Track (TTC) for educators and tutors seeking certified trainer credentials.'
                                ],
                                [
                                    'question' => 'How are the classes scheduled?',
                                    'answer' => $course->class_schedule ?? 'Classes are scheduled flexibly with weekend options (2 hours/session) or weekday evening batches (1 hour, twice a week).'
                                ],
                                [
                                    'question' => 'Can learners switch between Campus (Chennai) and Online batches?',
                                    'answer' => 'Yes, our hybrid infrastructure allows seamless switching between in-person classroom sessions at our Chennai campus and live interactive online sessions.'
                                ],
                                [
                                    'question' => 'How is the graduation certificate verified?',
                                    'answer' => 'Every graduating student receives an official certificate with a tamper-proof QR code and unique credential ID verifiable 24/7 on our public verification portal.'
                                ]
                            ];
                        @endphp

                        <div class="space-y-3" x-data="{ activeFaq: null }">
                            @foreach($faqs as $faqIndex => $faq)
                                <div class="rounded-2xl border border-slate-200 overflow-hidden transition hover:border-amber-300">
                                    <button 
                                        type="button" 
                                        @click="activeFaq = (activeFaq === {{ $faqIndex }} ? null : {{ $faqIndex }})" 
                                        class="w-full flex items-center justify-between p-4 sm:p-5 text-left font-bold text-sm text-slate-900 hover:text-amber-600 transition"
                                    >
                                        <span class="pr-4">{{ is_array($faq) ? $faq['question'] : $faq->question }}</span>
                                        <i class="fa-solid fa-chevron-down text-slate-400 text-xs transition duration-200 shrink-0" :class="activeFaq === {{ $faqIndex }} ? 'rotate-180 text-amber-600' : ''"></i>
                                    </button>
                                    <div x-show="activeFaq === {{ $faqIndex }}" class="px-4 pb-4 sm:px-5 sm:pb-5 text-sm text-slate-600 border-t border-slate-100 pt-3 leading-relaxed" x-cloak>
                                        {{ is_array($faq) ? $faq['answer'] : $faq->answer }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <!-- Right Sticky Enrollment & Consultation Card -->
                <div class="lg:col-span-4">
                    <div class="sticky top-24 space-y-6">
                        
                        <div class="rounded-3xl bg-white p-6 sm:p-8 border border-slate-200 shadow-xl space-y-6">
                            
                            <div>
                                <span class="text-sm text-slate-500 uppercase tracking-wider font-semibold">Course Fee</span>
                                <div class="flex items-baseline gap-2 mt-1">
                                    @if($course->fee)
                                        <span class="text-3xl font-extrabold text-slate-900">₹{{ number_format($course->fee) }}</span>
                                        <span class="text-sm text-slate-500">per level</span>
                                    @else
                                        <span class="text-2xl font-extrabold text-emerald-600">Custom Milestone</span>
                                    @endif
                                </div>
                            </div>

                            @if($course->class_schedule)
                                <div class="rounded-2xl bg-amber-50/80 border border-amber-200/80 p-3.5 text-xs text-amber-950 flex items-start gap-3">
                                    <i class="fa-regular fa-clock text-amber-600 mt-0.5 shrink-0 text-sm"></i>
                                    <div>
                                        <span class="font-bold block uppercase tracking-wider text-[11px] text-amber-800">Class Schedule</span>
                                        <span class="font-medium text-slate-700 leading-snug">{{ $course->class_schedule }}</span>
                                    </div>
                                </div>
                            @endif

                            <!-- Actions -->
                            <div class="space-y-2.5">
                                <button 
                                    type="button"
                                    @click="$dispatch('open-enquiry-modal', { course_id: '{{ $course->id }}', course_title: '{{ addslashes($course->title) }} (Student Track)' })"
                                    class="w-full rounded-2xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold py-3.5 px-4 text-sm text-center shadow-md transition active:scale-95 cursor-pointer flex items-center justify-center gap-2"
                                >
                                    <i class="fa-solid fa-child text-sm"></i>
                                    <span>Book Free Student Trial</span>
                                </button>

                                @if($course->has_teacher_training ?? true)
                                <button 
                                    type="button"
                                    @click="$dispatch('open-enquiry-modal', { course_id: '{{ $course->id }}', course_title: '{{ addslashes($course->title) }} (Teacher Training Track)' })"
                                    class="w-full rounded-2xl border border-slate-300 hover:bg-slate-50 text-slate-800 font-bold py-2.5 px-4 text-sm text-center transition cursor-pointer flex items-center justify-center gap-2"
                                >
                                    <i class="fa-solid fa-certificate text-amber-600 text-sm"></i>
                                    <span>Teacher Training Track (TTC)</span>
                                </button>
                                @endif

                                <x-whatsapp-btn 
                                    :course="$course" 
                                    label="Chat with Course Counselor" 
                                    class="w-full text-center" 
                                />
                            </div>

                            <!-- Fast In-Page Enquiry Form -->
                            <div class="border-t border-slate-100 pt-5">
                                <h4 class="text-sm font-bold uppercase tracking-wider text-slate-500 mb-3">
                                    Quick Inquiry for This Course
                                </h4>
                                
                                <form action="{{ route('enquiries.store') }}" method="POST" class="space-y-3">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <input type="hidden" name="source" value="Course Detail Page ({{ $course->slug }})">

                                    <div class="space-y-1">
                                        <select 
                                            name="notes" 
                                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-amber-500"
                                        >
                                            <option value="Inquiry for Student Track: {{ $course->title }}">Student Track (Ages {{ $course->age_range }})</option>
                                            @if($course->has_teacher_training ?? true)
                                                <option value="Inquiry for Teacher Training Track (TTC): {{ $course->title }}">Teacher Training Track (TTC)</option>
                                            @endif
                                        </select>
                                    </div>

                                    <input 
                                        type="text" 
                                        name="parent_name" 
                                        required 
                                        placeholder="Your Name *" 
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-amber-500"
                                    >

                                    <input 
                                        type="tel" 
                                        name="phone" 
                                        required 
                                        placeholder="WhatsApp / Phone *" 
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-amber-500"
                                    >

                                    <button 
                                        type="submit" 
                                        class="w-full rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold py-3 text-sm transition cursor-pointer"
                                    >
                                        Request Callback
                                    </button>
                                </form>
                            </div>

                            <!-- Quick Guarantee Checklist -->
                            @php
                                $guarantees = !empty($course->guarantee_checklist) && is_array($course->guarantee_checklist) ? $course->guarantee_checklist : [
                                    'Personalized 1-on-1 trial session available',
                                    'Official certificate upon completion',
                                    'Weekend and weekday batch options'
                                ];
                            @endphp
                            <div class="border-t border-slate-100 pt-4 space-y-2.5 text-sm text-slate-600">
                                @foreach($guarantees as $guarantee)
                                    @php
                                        $guaranteeText = is_array($guarantee) ? ($guarantee['point'] ?? reset($guarantee)) : $guarantee;
                                    @endphp
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-circle-check text-emerald-500 text-sm shrink-0"></i>
                                        <span>{{ $guaranteeText }}</span>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Related Courses Section -->
    @if($relatedCourses->count() > 0)
        <section class="py-16 bg-white border-t border-slate-200/80">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h3 class="text-2xl font-bold text-slate-900 mb-8">Related Programs in {{ $course->category->name }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedCourses as $related)
                        <x-course-card :course="$related" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.app>