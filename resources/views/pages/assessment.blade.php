@php
    $assessmentTitle = $globalSettings['seo_assessment_title'] ?? 'Free Skill & Aptitude Assessment | Sri Deekshaa International Academy';
    $assessmentDesc = $globalSettings['seo_assessment_description'] ?? 'Take our 2-minute interactive assessment to discover the ideal cognitive, math, coding, or arts skill track for your child.';
@endphp
<x-layouts.app :title="$assessmentTitle" :metaDescription="$assessmentDesc">
    <!-- Header Banner -->
    <section class="bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-white pt-10 pb-12 sm:pt-14 sm:pb-16 relative overflow-hidden border-b border-slate-800/80">
        <!-- Background Ambient Glow & Grid -->
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:20px_20px]"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/3 w-80 h-80 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <!-- Centered Breadcrumbs -->
            <div class="flex justify-center mb-4 sm:mb-5">
                <x-breadcrumb :items="[['label' => 'Skill Assessment']]" />
            </div>

            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight">
                Discover the Perfect Course for Your Child
            </h1>

            <p class="mt-4 text-base sm:text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Answer 5 simple questions to get tailored course recommendations aligned with your child's age, innate strengths, and academic goals.
            </p>
        </div>
    </section>

    <!-- Interactive Assessment Wizard -->
    <section class="py-12 sm:py-16 bg-slate-50 min-h-[600px]">
        <div class="max-w-3xl mx-auto px-4 sm:px-6" x-data="{
            step: 1,
            totalSteps: 6,
            answers: {
                age: '',
                goal: '',
                learning_style: '',
                time_commitment: '',
                mode: '',
                parent_name: '',
                student_name: '',
                phone: '',
                email: ''
            },
            recommendedTrack: 'Abacus & Vedic Mathematics',
            recommendedDescription: 'Based on your preferences, a mental arithmetic and concentration-building track is the highest-leverage starting point.',
            recommendedCourses: [
                { title: 'Junior Abacus & Mental Math', slug: 'junior-abacus-mental-math', category: 'Abacus & Mental Arithmetic' },
                { title: 'Speed Vedic Mathematics', slug: 'speed-vedic-mathematics', category: 'Vedic Mathematics' }
            ],
            calculateResults() {
                if (this.answers.goal === 'Tech & Coding Skills' || this.answers.age === '11-14 Years' || this.answers.age === '15+ Years') {
                    this.recommendedTrack = 'Robotics, Coding & AI';
                    this.recommendedDescription = 'Your learner is primed for computational thinking, algorithmic problem solving, and hands-on electronics.';
                    this.recommendedCourses = [
                        { title: 'Python Programming for Kids & Teens', slug: 'python-programming-for-kids-teens', category: 'Coding & AI' },
                        { title: 'Robotics & Microcontroller Lab', slug: 'robotics-microcontroller-lab', category: 'Robotics & STEM' }
                    ];
                } else if (this.answers.goal === 'Confidence & Speaking') {
                    this.recommendedTrack = 'Public Speaking & Communication';
                    this.recommendedDescription = 'Articulation, persuasive rhetoric, and stage presence will accelerate leadership potential and academic viva scores.';
                    this.recommendedCourses = [
                        { title: 'Public Speaking & Debating Mastery', slug: 'public-speaking-debating-mastery', category: 'Communication' }
                    ];
                } else if (this.answers.goal === 'Handwriting & Art' || this.answers.age === '4-6 Years') {
                    this.recommendedTrack = 'Early Foundation & Creative Arts';
                    this.recommendedDescription = 'Fine motor grip, stroke consistency, phonetic mastery, and color visualization provide an unmatched developmental base.';
                    this.recommendedCourses = [
                        { title: 'Print & Cursive Handwriting Mastery', slug: 'print-cursive-handwriting-mastery', category: 'Foundational' },
                        { title: 'Creative Sketching & Color Theory', slug: 'creative-sketching-color-theory', category: 'Creative Arts' }
                    ];
                }
                this.step = 7;
            }
        }">

            <!-- Progress Bar -->
            <div class="mb-8" x-show="step <= 6">
                <div class="flex items-center justify-between text-sm font-semibold text-slate-500 mb-2">
                    <span>Question <span x-text="step"></span> of 5</span>
                    <span x-text="Math.round((step / 6) * 100) + '% Completed'"></span>
                </div>
                <div class="h-2 w-full bg-slate-200 rounded-full overflow-hidden">
                    <div class="h-full bg-amber-500 transition-all duration-300" :style="'width: ' + ((step / 6) * 100) + '%'"></div>
                </div>
            </div>

            <!-- Quiz Card -->
            <div class="rounded-3xl bg-white p-6 sm:p-10 border border-slate-200/80 shadow-md">
                
                <!-- Question 1: Age -->
                <div x-show="step === 1" class="space-y-6">
                    <span class="text-sm font-bold uppercase tracking-wider text-amber-600">Question 1</span>
                    <h2 class="text-2xl font-bold text-slate-900">What is the learner's age group?</h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <button 
                            type="button" 
                            @click="answers.age = '4-6 Years'; step = 2"
                            class="p-5 rounded-2xl border-2 text-left transition hover:border-amber-500 hover:bg-amber-50/50"
                            :class="answers.age === '4-6 Years' ? 'border-amber-500 bg-amber-50' : 'border-slate-200'"
                        >
                            <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center text-lg mb-2">
                                <i class="fa-solid fa-shapes"></i>
                            </div>
                            <strong class="block text-slate-900">Ages 4 - 6</strong>
                            <span class="text-sm text-slate-500">Preschool & Kindergarten</span>
                        </button>

                        <button 
                            type="button" 
                            @click="answers.age = '7-10 Years'; step = 2"
                            class="p-5 rounded-2xl border-2 text-left transition hover:border-amber-500 hover:bg-amber-50/50"
                            :class="answers.age === '7-10 Years' ? 'border-amber-500 bg-amber-50' : 'border-slate-200'"
                        >
                            <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-lg mb-2">
                                <i class="fa-solid fa-rocket"></i>
                            </div>
                            <strong class="block text-slate-900">Ages 7 - 10</strong>
                            <span class="text-sm text-slate-500">Primary / Elementary School</span>
                        </button>

                        <button 
                            type="button" 
                            @click="answers.age = '11-14 Years'; step = 2"
                            class="p-5 rounded-2xl border-2 text-left transition hover:border-amber-500 hover:bg-amber-50/50"
                            :class="answers.age === '11-14 Years' ? 'border-amber-500 bg-amber-50' : 'border-slate-200'"
                        >
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-lg mb-2">
                                <i class="fa-solid fa-lightbulb"></i>
                            </div>
                            <strong class="block text-slate-900">Ages 11 - 14</strong>
                            <span class="text-sm text-slate-500">Middle School</span>
                        </button>

                        <button 
                            type="button" 
                            @click="answers.age = '15+ Years'; step = 2"
                            class="p-5 rounded-2xl border-2 text-left transition hover:border-amber-500 hover:bg-amber-50/50"
                            :class="answers.age === '15+ Years' ? 'border-amber-500 bg-amber-50' : 'border-slate-200'"
                        >
                            <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center text-lg mb-2">
                                <i class="fa-solid fa-graduation-cap"></i>
                            </div>
                            <strong class="block text-slate-900">Ages 15 & Above</strong>
                            <span class="text-sm text-slate-500">High School & Competitive Prep</span>
                        </button>
                    </div>
                </div>

                <!-- Question 2: Primary Goal -->
                <div x-show="step === 2" class="space-y-6" x-cloak>
                    <span class="text-sm font-bold uppercase tracking-wider text-amber-600">Question 2</span>
                    <h2 class="text-2xl font-bold text-slate-900">What is your primary developmental goal?</h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <button 
                            type="button" 
                            @click="answers.goal = 'Improve Math Speed & Focus'; step = 3"
                            class="p-5 rounded-2xl border-2 text-left transition hover:border-amber-500 hover:bg-amber-50/50"
                            :class="answers.goal === 'Improve Math Speed & Focus' ? 'border-amber-500 bg-amber-50' : 'border-slate-200'"
                        >
                            <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center text-lg mb-2">
                                <i class="fa-solid fa-bolt"></i>
                            </div>
                            <strong class="block text-slate-900">Math Speed & Laser Focus</strong>
                            <span class="text-sm text-slate-500">Rapid mental math, memory, concentration</span>
                        </button>

                        <button 
                            type="button" 
                            @click="answers.goal = 'Tech & Coding Skills'; step = 3"
                            class="p-5 rounded-2xl border-2 text-left transition hover:border-amber-500 hover:bg-amber-50/50"
                            :class="answers.goal === 'Tech & Coding Skills' ? 'border-amber-500 bg-amber-50' : 'border-slate-200'"
                        >
                            <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-lg mb-2">
                                <i class="fa-solid fa-laptop-code"></i>
                            </div>
                            <strong class="block text-slate-900">Coding, AI & Robotics</strong>
                            <span class="text-sm text-slate-500">Logical reasoning, hardware, programming</span>
                        </button>

                        <button 
                            type="button" 
                            @click="answers.goal = 'Confidence & Speaking'; step = 3"
                            class="p-5 rounded-2xl border-2 text-left transition hover:border-amber-500 hover:bg-amber-50/50"
                            :class="answers.goal === 'Confidence & Speaking' ? 'border-amber-500 bg-amber-50' : 'border-slate-200'"
                        >
                            <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center text-lg mb-2">
                                <i class="fa-solid fa-microphone-lines"></i>
                            </div>
                            <strong class="block text-slate-900">Public Speaking & Confidence</strong>
                            <span class="text-sm text-slate-500">Overcoming stage fright, articulation</span>
                        </button>

                        <button 
                            type="button" 
                            @click="answers.goal = 'Handwriting & Art'; step = 3"
                            class="p-5 rounded-2xl border-2 text-left transition hover:border-amber-500 hover:bg-amber-50/50"
                            :class="answers.goal === 'Handwriting & Art' ? 'border-amber-500 bg-amber-50' : 'border-slate-200'"
                        >
                            <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center text-lg mb-2">
                                <i class="fa-solid fa-palette"></i>
                            </div>
                            <strong class="block text-slate-900">Handwriting & Creativity</strong>
                            <span class="text-sm text-slate-500">Fine motor control, sketching, neat presentation</span>
                        </button>
                    </div>
                </div>

                <!-- Question 3: Learning Style -->
                <div x-show="step === 3" class="space-y-6" x-cloak>
                    <span class="text-sm font-bold uppercase tracking-wider text-amber-600">Question 3</span>
                    <h2 class="text-2xl font-bold text-slate-900">How does the child engage best?</h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <button 
                            type="button" 
                            @click="answers.learning_style = 'Hands-on with objects'; step = 4"
                            class="p-5 rounded-2xl border-2 text-left transition hover:border-amber-500 hover:bg-amber-50/50"
                        >
                            <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-lg mb-2">
                                <i class="fa-solid fa-puzzle-piece"></i>
                            </div>
                            <strong class="block text-slate-900">Kinesthetic / Hands-on</strong>
                            <span class="text-sm text-slate-500">Loves tools, physical beads, building kits</span>
                        </button>

                        <button 
                            type="button" 
                            @click="answers.learning_style = 'Visual & Interactive'; step = 4"
                            class="p-5 rounded-2xl border-2 text-left transition hover:border-amber-500 hover:bg-amber-50/50"
                        >
                            <div class="w-10 h-10 rounded-xl bg-teal-100 text-teal-600 flex items-center justify-center text-lg mb-2">
                                <i class="fa-solid fa-eye"></i>
                            </div>
                            <strong class="block text-slate-900">Visual & Interactive</strong>
                            <span class="text-sm text-slate-500">Understands through diagrams, software, games</span>
                        </button>

                        <button 
                            type="button" 
                            @click="answers.learning_style = 'Conversational & Social'; step = 4"
                            class="p-5 rounded-2xl border-2 text-left transition hover:border-amber-500 hover:bg-amber-50/50"
                        >
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-lg mb-2">
                                <i class="fa-solid fa-handshake"></i>
                            </div>
                            <strong class="block text-slate-900">Conversational & Team</strong>
                            <span class="text-sm text-slate-500">Thrives with group discussions & feedback</span>
                        </button>

                        <button 
                            type="button" 
                            @click="answers.learning_style = 'Structured & Self-Paced'; step = 4"
                            class="p-5 rounded-2xl border-2 text-left transition hover:border-amber-500 hover:bg-amber-50/50"
                        >
                            <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center text-lg mb-2">
                                <i class="fa-solid fa-book-open"></i>
                            </div>
                            <strong class="block text-slate-900">Structured Milestone Steps</strong>
                            <span class="text-sm text-slate-500">Clear levels, daily worksheets, visible badges</span>
                        </button>
                    </div>
                </div>

                <!-- Question 4: Preferred Mode -->
                <div x-show="step === 4" class="space-y-6" x-cloak>
                    <span class="text-sm font-bold uppercase tracking-wider text-amber-600">Question 4</span>
                    <h2 class="text-2xl font-bold text-slate-900">Preferred Class Format</h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <button 
                            type="button" 
                            @click="answers.mode = 'In-Person (Chennai)'; step = 5"
                            class="p-5 rounded-2xl border-2 text-left transition hover:border-amber-500 hover:bg-amber-50/50"
                        >
                            <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-lg mb-2">
                                <i class="fa-solid fa-building-columns"></i>
                            </div>
                            <strong class="block text-slate-900">In-Person Campus</strong>
                            <span class="text-sm text-slate-500">Physical classroom in Chennai</span>
                        </button>

                        <button 
                            type="button" 
                            @click="answers.mode = 'Live Online'; step = 5"
                            class="p-5 rounded-2xl border-2 text-left transition hover:border-amber-500 hover:bg-amber-50/50"
                        >
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-lg mb-2">
                                <i class="fa-solid fa-laptop"></i>
                            </div>
                            <strong class="block text-slate-900">Live Online</strong>
                            <span class="text-sm text-slate-500">Interactive live 1:8 video batches</span>
                        </button>

                        <button 
                            type="button" 
                            @click="answers.mode = 'Hybrid / Flexible'; step = 5"
                            class="p-5 rounded-2xl border-2 text-left transition hover:border-amber-500 hover:bg-amber-50/50"
                        >
                            <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center text-lg mb-2">
                                <i class="fa-solid fa-arrows-rotate"></i>
                            </div>
                            <strong class="block text-slate-900">Hybrid / Flexible</strong>
                            <span class="text-sm text-slate-500">Combination of campus & online</span>
                        </button>
                    </div>
                </div>

                <!-- Question 5: Commitment -->
                <div x-show="step === 5" class="space-y-6" x-cloak>
                    <span class="text-sm font-bold uppercase tracking-wider text-amber-600">Question 5</span>
                    <h2 class="text-2xl font-bold text-slate-900">How much time can the learner dedicate per week?</h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <button 
                            type="button" 
                            @click="answers.time_commitment = '1-2 Hours (Weekend)'; step = 6"
                            class="p-5 rounded-2xl border-2 text-left transition hover:border-amber-500 hover:bg-amber-50/50"
                        >
                            <strong class="block text-slate-900">1 - 2 Hours</strong>
                            <span class="text-sm text-slate-500">Weekend batch / Light pace</span>
                        </button>

                        <button 
                            type="button" 
                            @click="answers.time_commitment = '3-4 Hours'; step = 6"
                            class="p-5 rounded-2xl border-2 text-left transition hover:border-amber-500 hover:bg-amber-50/50"
                        >
                            <strong class="block text-slate-900">3 - 4 Hours</strong>
                            <span class="text-sm text-slate-500">Standard optimal pace (Recommended)</span>
                        </button>

                        <button 
                            type="button" 
                            @click="answers.time_commitment = '5+ Hours'; step = 6"
                            class="p-5 rounded-2xl border-2 text-left transition hover:border-amber-500 hover:bg-amber-50/50"
                        >
                            <strong class="block text-slate-900">5+ Hours</strong>
                            <span class="text-sm text-slate-500">Intensive / Competition track</span>
                        </button>
                    </div>
                </div>

                <!-- Step 6: Contact Capture to View Result -->
                <div x-show="step === 6" class="space-y-6" x-cloak>
                    <span class="text-sm font-bold uppercase tracking-wider text-emerald-600">Final Step</span>
                    <h2 class="text-2xl font-bold text-slate-900">Your Recommended Track is Ready!</h2>
                    <p class="text-sm text-slate-600">
                        Where should we send your personalized assessment report & recommended curriculum PDF?
                    </p>

                    <form @submit.prevent="calculateResults()" class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Parent / Guardian Name *</label>
                                <input 
                                    type="text" 
                                    x-model="answers.parent_name" 
                                    required 
                                    placeholder="e.g. Meera Raman" 
                                    class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:border-amber-500 focus:outline-none"
                                >
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Student Name *</label>
                                <input 
                                    type="text" 
                                    x-model="answers.student_name" 
                                    required 
                                    placeholder="e.g. Krrish Raman" 
                                    class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:border-amber-500 focus:outline-none"
                                >
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">WhatsApp / Phone *</label>
                                <input 
                                    type="tel" 
                                    x-model="answers.phone" 
                                    required 
                                    placeholder="+91 98765 43210" 
                                    class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:border-amber-500 focus:outline-none"
                                >
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email Address</label>
                                <input 
                                    type="email" 
                                    x-model="answers.email" 
                                    placeholder="meera@example.com" 
                                    class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:border-amber-500 focus:outline-none"
                                >
                            </div>
                        </div>

                        <button 
                            type="submit" 
                            class="w-full rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold py-3.5 text-sm shadow-md transition active:scale-95 mt-4 inline-flex items-center justify-center gap-2"
                        >
                            <span>View Recommended Skill Track</span>
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </button>
                    </form>
                </div>

                <!-- Step 7: Final Result Showcase -->
                <div x-show="step === 7" class="space-y-6 text-center" x-cloak>
                    <div class="h-16 w-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto text-2xl font-bold shadow-sm">
                        <i class="fa-solid fa-award"></i>
                    </div>
                    
                    <div>
                        <span class="text-sm font-bold uppercase tracking-wider text-emerald-600 block mb-1">
                            Your Tailored Curriculum Match
                        </span>
                        <h2 class="text-3xl font-extrabold text-slate-900" x-text="recommendedTrack"></h2>
                        <p class="text-sm text-slate-600 max-w-lg mx-auto mt-2" x-text="recommendedDescription"></p>
                    </div>

                    <div class="rounded-2xl bg-amber-50 border border-amber-200 p-6 text-left max-w-lg mx-auto space-y-3">
                        <h4 class="text-sm font-bold uppercase tracking-wider text-amber-800">
                            Recommended Starting Courses:
                        </h4>
                        <template x-for="item in recommendedCourses" :key="item.slug">
                            <div class="flex items-center justify-between bg-white p-3.5 rounded-xl border border-amber-100">
                                <div>
                                    <span class="block font-bold text-sm text-slate-900" x-text="item.title"></span>
                                    <span class="text-sm text-amber-600" x-text="item.category"></span>
                                </div>
                                <a :href="'/courses/' + item.slug" class="rounded-lg bg-slate-900 text-white text-sm font-semibold px-3.5 py-1.5 hover:bg-slate-800">
                                    View Syllabus
                                </a>
                            </div>
                        </template>
                    </div>

                    <div class="pt-4 flex flex-wrap items-center justify-center gap-3">
                        <button 
                            type="button" 
                            @click="$dispatch('open-enquiry-modal', { notes: 'Skill Quiz Results: ' + recommendedTrack + ' (Age: ' + answers.age + ', Goal: ' + answers.goal + ')' })"
                            class="rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold px-6 py-3 text-sm shadow"
                        >
                            Book Free Trial for Recommended Level
                        </button>
                        <x-whatsapp-btn label="Consult Counselor on WhatsApp" />
                    </div>
                </div>

            </div>

        </div>
    </section>
</x-layouts.app>