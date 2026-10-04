@props(['course'])

<div class="group relative flex flex-col justify-between rounded-3xl bg-white p-5 sm:p-6 shadow-sm border border-slate-200/80 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:border-amber-400/50">
    <div>
        <!-- Top Tags Row -->
        <div class="flex items-center justify-between gap-2 mb-3">
            @if($course->category)
                <a href="{{ route('courses.category', $course->category->slug) }}" class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 hover:bg-amber-100 transition px-3 py-1 text-xs font-semibold text-amber-800 border border-amber-200/80 whitespace-nowrap">
                    @if(!empty($course->category->display_icon))
                        <i class="{{ $course->category->display_icon }} text-[11px] text-amber-600"></i>
                    @else
                        <i class="fa-solid fa-graduation-cap text-[11px] text-amber-600"></i>
                    @endif
                    <span class="truncate max-w-[210px]">{{ $course->category->name }}</span>
                </a>
            @else
                <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-800 border border-amber-200/80 whitespace-nowrap">
                    <i class="fa-solid fa-graduation-cap text-[11px] text-amber-600"></i>
                    <span>Skill Program</span>
                </span>
            @endif
        </div>

        <!-- Course Icon Image -->
        <a href="{{ route('courses.show', $course->slug) }}" class="relative flex items-center justify-center w-full h-36 sm:h-40 mb-4 bg-slate-50/70 hover:bg-slate-100/70 rounded-2xl p-4 border border-slate-100 overflow-hidden transition group/img">
            <img 
                src="{{ $course->image_url }}" 
                alt="{{ $course->title }}"
                class="max-h-28 sm:max-h-32 w-auto object-contain transition-transform duration-300 group-hover:scale-105"
                loading="lazy"
            >
        </a>

        <!-- Course Title -->
        <h3 class="text-lg sm:text-xl font-bold text-slate-900 group-hover:text-amber-600 transition line-clamp-2">
            <a href="{{ route('courses.show', $course->slug) }}">
                {{ $course->title }}
            </a>
        </h3>

        <!-- Short Description -->
        <p class="mt-2 text-sm text-slate-600 line-clamp-3 leading-relaxed">
            {{ $course->short_description }}
        </p>
    </div>

    <!-- Bottom Actions -->
    <div class="mt-6 pt-4 border-t border-slate-100 flex flex-col gap-3">
        <div class="flex items-center justify-between text-sm">
            @if(!empty($course->duration))
                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-600">
                    <i class="fa-regular fa-clock text-amber-500"></i>
                    <span>{{ $course->duration }}</span>
                </span>
            @else
                <span></span>
            @endif
            <a 
                href="{{ route('courses.show', $course->slug) }}" 
                class="inline-flex items-center gap-1.5 font-bold text-amber-600 hover:text-amber-700 transition group-hover:translate-x-0.5"
            >
                <span>View Syllabus</span>
                <i class="fa-solid fa-arrow-right text-sm"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 gap-2">
            <button 
                type="button" 
                @click="$dispatch('open-enquiry-modal', { course_id: '{{ $course->id }}', course_title: '{{ addslashes($course->title) }}' })" 
                class="w-full rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold py-2.5 px-3 transition text-center shadow-sm"
            >
                Enroll Now
            </button>
            <x-whatsapp-btn 
                :course="$course" 
                label="WhatsApp" 
                size="sm" 
                class="w-full text-center" 
            />
        </div>
    </div>
</div>