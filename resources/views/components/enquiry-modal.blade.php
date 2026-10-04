<div 
    x-data="{ 
        open: false, 
        courseId: '', 
        courseTitle: '',
        loading: false,
        submitted: false,
        openModal(detail) {
            this.open = true; 
            this.courseId = detail?.course_id || ''; 
            this.courseTitle = detail?.course_title || '';
            document.body.classList.add('overflow-hidden');
        },
        closeModal() {
            this.open = false;
            document.body.classList.remove('overflow-hidden');
            this.$dispatch('close-enquiry-modal');
        }
    }" 
    @open-enquiry-modal.window="openModal($event.detail)"
    @keydown.escape.window="closeModal()"
    class="relative z-[100]"
    x-cloak
>
    <!-- Backdrop -->
    <div 
        x-show="open" 
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-slate-950/75 backdrop-blur-sm transition-opacity z-[100]"
        @click="closeModal()"
    ></div>

    <!-- Modal Scrollable Viewport Container -->
    <div 
        x-show="open" 
        class="fixed inset-0 z-[101] overflow-y-auto"
    >
        <div class="flex min-h-full items-center justify-center p-3 sm:p-6 text-center">
            
            <!-- Modal Card (max-height bounded & flex-col so it fits every screen) -->
            <div 
                x-show="open" 
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                @click.stop
                class="relative w-full max-w-xl transform rounded-3xl bg-white p-5 sm:p-7 text-left shadow-2xl transition-all border border-slate-100 max-h-[92vh] sm:max-h-[88vh] flex flex-col my-auto"
            >
                <!-- Close button -->
                <button 
                    @click="closeModal()" 
                    type="button" 
                    class="absolute top-4 right-4 sm:top-5 sm:right-5 rounded-full p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition cursor-pointer z-10"
                    aria-label="Close modal"
                >
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>

                <!-- Header (Always pinned at top) -->
                <div class="mb-3.5 pr-8 shrink-0">
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-3 py-0.5 text-xs font-semibold text-amber-800 mb-1.5">
                        Free Consultation & Trial
                    </span>
                    <h3 class="text-xl sm:text-2xl font-bold text-slate-900 leading-tight">
                        Book an Academic Consultation
                    </h3>
                    <p class="mt-1 text-xs sm:text-sm text-slate-600" x-show="courseTitle">
                        Inquiring about: <strong class="text-amber-600 font-semibold" x-text="courseTitle"></strong>
                    </p>
                    <p class="mt-1 text-xs sm:text-sm text-slate-600" x-show="!courseTitle">
                        Get in touch with our counselors to discover the best skill track for your child.
                    </p>
                </div>

                <!-- Form (Scrollable body with guaranteed visibility for all inputs) -->
                <form action="{{ route('enquiries.store') }}" method="POST" class="flex-1 overflow-y-auto overscroll-contain pr-1 sm:pr-2 space-y-3 sm:space-y-3.5">
                    @csrf
                    <input type="hidden" name="course_id" :value="courseId">
                    <input type="hidden" name="source" value="Website Popup Modal">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                        <div>
                            <label class="block text-xs sm:text-sm font-semibold text-slate-700 mb-1">Parent / Guardian Name *</label>
                            <input 
                                type="text" 
                                name="parent_name" 
                                required 
                                placeholder="e.g. Ramesh Kumar" 
                                class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2 text-sm text-slate-900 focus:border-amber-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-200"
                            >
                        </div>

                        <div>
                            <label class="block text-xs sm:text-sm font-semibold text-slate-700 mb-1">Student Name *</label>
                            <input 
                                type="text" 
                                name="student_name" 
                                required 
                                placeholder="e.g. Aarav Kumar" 
                                class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2 text-sm text-slate-900 focus:border-amber-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-200"
                            >
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                        <div>
                            <label class="block text-xs sm:text-sm font-semibold text-slate-700 mb-1">WhatsApp / Phone *</label>
                            <input 
                                type="tel" 
                                name="phone" 
                                required 
                                placeholder="+91 98765 43210" 
                                class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2 text-sm text-slate-900 focus:border-amber-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-200"
                            >
                        </div>

                        <div>
                            <label class="block text-xs sm:text-sm font-semibold text-slate-700 mb-1">Email Address</label>
                            <input 
                                type="email" 
                                name="email" 
                                placeholder="parent@example.com" 
                                class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2 text-sm text-slate-900 focus:border-amber-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-200"
                            >
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                        <div>
                            <label class="block text-xs sm:text-sm font-semibold text-slate-700 mb-1">Student Age (Years)</label>
                            <input 
                                type="number" 
                                name="student_age" 
                                min="3" 
                                max="80" 
                                placeholder="e.g. 8" 
                                class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2 text-sm text-slate-900 focus:border-amber-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-200"
                            >
                        </div>

                        <div>
                            <label class="block text-xs sm:text-sm font-semibold text-slate-700 mb-1">Preferred Learning Mode</label>
                            <select 
                                name="mode_preference" 
                                class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2 text-sm text-slate-900 focus:border-amber-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-200"
                            >
                                <option value="In-Person">In-Person Campus (Chennai)</option>
                                <option value="Online">Live Interactive Online</option>
                                <option value="Hybrid">Hybrid (Classroom + Online)</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs sm:text-sm font-semibold text-slate-700 mb-1">Questions / Specific Goals</label>
                        <textarea 
                            name="notes" 
                            rows="2" 
                            placeholder="Tell us about your learning goals or schedule preferences..." 
                            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2 text-sm text-slate-900 focus:border-amber-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-200"
                        ></textarea>
                    </div>

                    <!-- Footer Action Buttons (Pinned at bottom, never cut off) -->
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5 shrink-0 bg-white">
                        <button 
                            @click="closeModal()" 
                            type="button" 
                            class="rounded-xl px-4 py-2.5 text-xs sm:text-sm font-medium text-slate-600 hover:bg-slate-100 transition cursor-pointer"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold px-5 sm:px-6 py-2.5 text-xs sm:text-sm shadow-md transition active:scale-95 cursor-pointer"
                        >
                            Submit Consultation Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>