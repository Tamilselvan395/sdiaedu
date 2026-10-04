@php
    $kidsTitle = $globalSettings['seo_kids_title'] ?? 'Skill Programs for Kids (Ages 4-10)';
    $kidsDesc = $globalSettings['seo_kids_description'] ?? 'Discover brain-boosting courses for early learners: Abacus Mental Math, Phonics, Creative Arts, and Handwriting.';
@endphp
<x-layouts.app :title="$kidsTitle" :metaDescription="$kidsDesc">
    <!-- Hero Banner -->
    <section class="bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-white pt-10 pb-14 sm:pt-14 sm:pb-18 relative overflow-hidden border-b border-slate-800/80">
        <!-- Background Ambient Glow & Grid -->
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:20px_20px]"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/3 w-80 h-80 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <!-- Centered Breadcrumbs -->
            <div class="flex justify-center mb-4 sm:mb-5">
                <x-breadcrumb :items="[['label' => 'Courses', 'url' => route('courses.index')], ['label' => 'Programs for Kids (Ages 4-10)']]" />
            </div>

            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight">
                Sparking Curiosity & Cognitive Speed During the Critical Brain Window
            </h1>

            <p class="mt-4 text-base sm:text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Between ages 4 and 10, a child's neural connections form at the highest velocity. Our specialized foundational programs develop laser focus, calculation agility, and expressive joy.
            </p>

            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <button 
                    type="button" 
                    @click="$dispatch('open-enquiry-modal', { notes: 'Inquiring about Programs for Kids (Ages 4-10)' })"
                    class="rounded-2xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold px-7 py-3.5 text-sm shadow-xl transition"
                >
                    Book Free Kids Trial Class
                </button>
                <x-whatsapp-btn label="Chat with Counselor" />
            </div>
        </div>
    </section>

    <!-- Why Early Skill Training Matters -->
    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-heading 
                eyebrow="Developmental Focus"
                title="Building the Four Core Cognitive Pillars"
                subtitle="We do not subject children to stressful rote learning. Our game-based, multisensory method turns learning into play."
            />

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="rounded-3xl bg-amber-50 p-6 border border-amber-100 text-center space-y-3">
                    <div class="w-12 h-12 mx-auto rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-calculator"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Mental Arithmetic</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Children visualize beads in their mind, computing multi-digit addition and subtraction faster than a calculator.</p>
                </div>
                <div class="rounded-3xl bg-blue-50 p-6 border border-blue-100 text-center space-y-3">
                    <div class="w-12 h-12 mx-auto rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-pen-nib"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Motor & Handwriting</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Pencil grip ergonomics, stroke consistency, and calligraphic alignment boost written exam presentation.</p>
                </div>
                <div class="rounded-3xl bg-emerald-50 p-6 border border-emerald-100 text-center space-y-3">
                    <div class="w-12 h-12 mx-auto rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Phonics & Articulation</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Systematic phonetic decoding transforms reluctant readers into confident, fluent speakers.</p>
                </div>
                <div class="rounded-3xl bg-purple-50 p-6 border border-purple-100 text-center space-y-3">
                    <div class="w-12 h-12 mx-auto rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-palette"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Creative Fine Arts</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Color theory, drawing techniques, and spatial expression build patience and sustained concentration.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Kids Courses Catalog -->
    <section class="py-16 bg-slate-50 border-t border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center">
                <h2 class="text-3xl font-extrabold text-slate-900">Curated Courses for Ages 4 - 10</h2>
                <p class="text-sm text-slate-600 mt-2">Specially paced curriculum with interactive games and positive reinforcement</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($kidsCourses as $course)
                    <x-course-card :course="$course" />
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.app>