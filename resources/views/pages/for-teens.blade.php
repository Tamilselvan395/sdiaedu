@php
    $teensTitle = $globalSettings['seo_teens_title'] ?? 'Skill Programs for Teens & High School (Ages 11-18)';
    $teensDesc = $globalSettings['seo_teens_description'] ?? 'Equip teens with high-leverage skills: Python, AI & Robotics, Advanced Vedic Mathematics, and Public Speaking.';
@endphp
<x-layouts.app :title="$teensTitle" :metaDescription="$teensDesc">
    <!-- Hero Banner -->
    <section class="bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-white pt-10 pb-14 sm:pt-14 sm:pb-18 relative overflow-hidden border-b border-slate-800/80">
        <!-- Background Ambient Glow & Grid -->
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:20px_20px]"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/3 w-80 h-80 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <!-- Centered Breadcrumbs -->
            <div class="flex justify-center mb-4 sm:mb-5">
                <x-breadcrumb :items="[['label' => 'Courses', 'url' => route('courses.index')], ['label' => 'Programs for Teens (Ages 11-18)']]" />
            </div>

            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight">
                Preparing Tomorrow's Leaders with Real-World Tech & Cognitive Edge
            </h1>

            <p class="mt-4 text-base sm:text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Move beyond memorization. Sri Deekshaa teen programs immerse students in algorithmic logic, hands-on robotics engineering, rapid competitive calculation, and persuasive rhetoric.
            </p>

            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <button 
                    type="button" 
                    @click="$dispatch('open-enquiry-modal', { notes: 'Inquiring about Programs for Teens (Ages 11-18)' })"
                    class="rounded-2xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold px-7 py-3.5 text-sm shadow-xl transition"
                >
                    Book Teen Career & Skill Trial
                </button>
                <x-whatsapp-btn label="WhatsApp Academic Counselor" />
            </div>
        </div>
    </section>

    <!-- 4 Future Pillars -->
    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-heading 
                eyebrow="Competitive Advantages"
                title="Equipping Teens with Skills School Curriculums Miss"
                subtitle="Practical, project-centric learning where students code functional apps, assemble microcontrollers, and master speed math."
            />

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="rounded-3xl bg-slate-50 p-6 border border-slate-200 text-center space-y-3">
                    <div class="w-12 h-12 mx-auto rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-robot"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Robotics & IoT</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Circuit design, sensors, Arduino programming, and automated hardware prototyping.</p>
                </div>
                <div class="rounded-3xl bg-slate-50 p-6 border border-slate-200 text-center space-y-3">
                    <div class="w-12 h-12 mx-auto rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-laptop-code"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Python & AI Literacy</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Fundamental computer science, algorithm design, and modern machine learning foundations.</p>
                </div>
                <div class="rounded-3xl bg-slate-50 p-6 border border-slate-200 text-center space-y-3">
                    <div class="w-12 h-12 mx-auto rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Speed Vedic Math</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Master rapid mental algebraic shortcuts essential for competitive entrance exams (JEE, SAT, Olympiads).</p>
                </div>
                <div class="rounded-3xl bg-slate-50 p-6 border border-slate-200 text-center space-y-3">
                    <div class="w-12 h-12 mx-auto rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-microphone-lines"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Public Speaking & Debate</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Body language, persuasive speech structure, impromptu speaking, and executive presence.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Teens Courses Catalog -->
    <section class="py-16 bg-slate-50 border-t border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center">
                <h2 class="text-3xl font-extrabold text-slate-900">Programs Recommended for Ages 11 - 18</h2>
                <p class="text-sm text-slate-600 mt-2">Structured into progressive certification levels with portfolio projects</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($teensCourses as $course)
                    <x-course-card :course="$course" />
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.app>