@php
    $aboutTitle = $globalSettings['seo_about_title'] ?? 'About Us | Sri Deekshaa International Academy';
    $aboutDesc = $globalSettings['seo_about_description'] ?? 'Learn about Sri Deekshaa International Academy, our founder vision, research-backed cognitive pedagogy, and certified mentors.';
@endphp
<x-layouts.app :title="$aboutTitle" :metaDescription="$aboutDesc">
    <!-- Hero Banner -->
    <section class="bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-white pt-10 pb-12 sm:pt-14 sm:pb-16 relative overflow-hidden border-b border-slate-800/80">
        <!-- Background Ambient Glow & Grid -->
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:20px_20px]"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/3 w-80 h-80 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <!-- Centered Breadcrumbs -->
            <div class="flex justify-center mb-4 sm:mb-5">
                <x-breadcrumb :items="[['label' => 'About Us']]" />
            </div>

            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight">
                Nurturing Capability, Confidence, & Character
            </h1>

            <p class="mt-4 text-base sm:text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Sri Deekshaa International Academy was established on a simple conviction: every student possesses extraordinary cognitive potential when provided structured, encouraging, and milestone-based guidance.
            </p>
        </div>
    </section>

    <!-- Vision & Philosophy Grid -->
    <section class="py-16 sm:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <span class="text-sm font-bold uppercase tracking-wider text-amber-600">The Philosophy</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 leading-tight">
                        Beyond Classroom Rote Learning: Skills that Endure for Life
                    </h2>
                    <p class="text-slate-600 text-base leading-relaxed">
                        Traditional schooling often emphasizes memorization for exams over genuine cognitive mastery. At Sri Deekshaa, our curriculum is engineered around neuro-cognitive agility — training the brain to calculate rapidly, visualize spatially, articulate with clarity, and solve problems creatively.
                    </p>
                    <p class="text-slate-600 text-base leading-relaxed">
                        Whether a student is learning mental arithmetic on an Abacus or coding a computer program in Python, the underlying principles remain the same: patience, disciplined iterative practice, and celebrated achievement.
                    </p>
                    <div class="grid grid-cols-2 gap-4 pt-4 border-t border-slate-100">
                        <div>
                            <span class="block text-2xl font-bold text-amber-600">1 : 8</span>
                            <span class="text-sm text-slate-500">Maximum Student to Teacher Ratio</span>
                        </div>
                        <div>
                            <span class="block text-2xl font-bold text-emerald-600">100%</span>
                            <span class="text-sm text-slate-500">Milestone-Verified Certification</span>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl bg-slate-900 p-8 text-white space-y-6 shadow-xl border border-slate-800">
                    <h3 class="text-xl font-bold text-amber-400">Our Core Educational Commitments</h3>
                    <ul class="space-y-4 text-sm text-slate-300">
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-circle-check text-emerald-400 mt-1"></i>
                            <span><strong>Positive Reinforcement:</strong> We celebrate every small improvement to build an unbreakable growth mindset.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-circle-check text-emerald-400 mt-1"></i>
                            <span><strong>No High-Stress Exams:</strong> Continuous milestone evaluations ensure mastery without pressure.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-circle-check text-emerald-400 mt-1"></i>
                            <span><strong>Parent Partnership:</strong> Regular developmental progress reports keep parents informed of developmental milestones.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-circle-check text-emerald-400 mt-1"></i>
                            <span><strong>Dual Delivery Options:</strong> Attend in our modern campus in Chennai or via live, interactive online sessions globally.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Faculty & Mentors -->
    <section class="py-16 sm:py-20 bg-slate-50 border-t border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-heading 
                eyebrow="Academic Leadership"
                title="Passionate Mentors Dedicated to Child Growth"
                subtitle="Our instructors are seasoned subject matter practitioners with specialized pedagogical training in early and adolescent brain development."
            />

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($teachers as $teacher)
                    <div class="rounded-3xl bg-white p-6 border border-slate-200/80 shadow-xs space-y-4">
                        <div class="flex items-center gap-4">
                            <div class="h-14 w-14 rounded-2xl bg-amber-500/20 text-amber-700 flex items-center justify-center font-bold text-lg border border-amber-300">
                                {{ substr($teacher->first_name, 0, 1) }}{{ substr($teacher->last_name ?? '', 0, 1) }}
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">{{ $teacher->full_name }}</h3>
                                <p class="text-sm text-amber-600 font-medium">{{ $teacher->designation ?? 'Senior Mentor' }}</p>
                            </div>
                        </div>
                        @if($teacher->bio)
                            <p class="text-sm text-slate-600 leading-relaxed">{{ $teacher->bio }}</p>
                        @endif
                    </div>
                @empty
                    <div class="col-span-full text-center text-sm text-slate-500">
                        Dedicated team of 35+ certified educators and master trainers.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Bottom CTA -->
    <section class="py-16 bg-slate-900 text-white text-center">
        <div class="max-w-3xl mx-auto px-4 space-y-4">
            <h2 class="text-3xl font-extrabold">Ready to explore a transformative learning journey?</h2>
            <p class="text-sm text-slate-300">Join over 2,500+ students who have accelerated their focus and academic capabilities with Sri Deekshaa.</p>
            <div class="pt-4 flex flex-wrap items-center justify-center gap-4">
                <button 
                    type="button" 
                    @click="$dispatch('open-enquiry-modal', {})"
                    class="rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold px-6 py-3 text-sm shadow-md transition"
                >
                    Book Free Counseling Session
                </button>
                <x-whatsapp-btn label="WhatsApp Us Directly" />
            </div>
        </div>
    </section>
</x-layouts.app>