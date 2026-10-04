@props(['event' => null])

@php
    $popupEvent = $event ?? $upcomingPopupEvent ?? null;
@endphp

@if($popupEvent instanceof \App\Models\Event && ! $popupEvent->is_completed && $popupEvent->is_active && $popupEvent->show_popup)
<div 
    x-data="{
        open: false,
        eventId: '{{ $popupEvent->id }}',
        init() {
            // Check if dismissed in this session
            const dismissed = sessionStorage.getItem('sdia_popup_dismissed_' + this.eventId);
            if (!dismissed) {
                setTimeout(() => {
                    this.open = true;
                }, 1400);
            }
        },
        closeModal() {
            this.open = false;
            sessionStorage.setItem('sdia_popup_dismissed_' + this.eventId, 'true');
        }
    }"
    x-show="open"
    x-cloak
    @keydown.escape.window="closeModal()"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 overflow-y-auto"
>
    <!-- Dark Backdrop -->
    <div 
        x-show="open"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="closeModal()"
        class="fixed inset-0 bg-slate-950/75 backdrop-blur-xs transition-opacity"
    ></div>

    <!-- Modal Dialog -->
    <div 
        x-show="open"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:scale-95"
        class="relative w-full max-w-lg rounded-3xl bg-white shadow-2xl border border-slate-200 overflow-hidden text-slate-800 z-10 transition-all my-auto"
    >
        <!-- Close Button -->
        <button 
            type="button" 
            @click="closeModal()" 
            class="absolute top-3 right-3 z-20 flex h-9 w-9 items-center justify-center rounded-full bg-slate-900/60 text-white hover:bg-slate-900 transition backdrop-blur-xs cursor-pointer shadow-md"
            aria-label="Close event popup"
        >
            <i class="fa-solid fa-xmark text-sm"></i>
        </button>

        <!-- Banner Header -->
        <div class="relative h-44 sm:h-52 w-full overflow-hidden bg-slate-900">
            <img 
                src="{{ $popupEvent->banner_url }}" 
                alt="{{ $popupEvent->title }}"
                class="h-full w-full object-cover"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-950/30 to-transparent"></div>

            <div class="absolute top-3 left-3 flex flex-wrap gap-2">
                <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-500 text-slate-950 px-3 py-0.5 text-xs font-extrabold uppercase tracking-wider shadow-sm">
                    <i class="fa-solid fa-bell text-[10px]"></i>
                    Upcoming Event
                </span>
                <span class="rounded-full bg-slate-900/80 backdrop-blur-md text-white text-[11px] font-semibold px-2.5 py-0.5 border border-white/20">
                    {{ $popupEvent->mode }}
                </span>
            </div>

            <!-- Date on banner -->
            <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs font-bold">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-calendar-days text-amber-400"></i>
                    <span>{{ $popupEvent->formatted_date }}</span>
                </div>
                <span class="rounded-full bg-emerald-500 text-white text-xs font-extrabold px-2.5 py-0.5 shadow">
                    {{ $popupEvent->registration_fee > 0 ? '₹' . number_format($popupEvent->registration_fee) : 'Free Entry' }}
                </span>
            </div>
        </div>

        <!-- Popup Body -->
        <div class="p-6 sm:p-7 space-y-4">
            <div class="space-y-2">
                <div class="flex items-center gap-2 text-sm font-semibold text-slate-500">
                    <i class="fa-solid fa-clock text-amber-500"></i>
                    <span>{{ $popupEvent->formatted_time }}</span>
                    @if($popupEvent->location_name)
                        <i class="fa-solid fa-circle text-[3px] text-slate-300"></i>
                        <span class="truncate"><i class="fa-solid fa-location-dot text-slate-400 mr-1"></i>{{ $popupEvent->location_name }}</span>
                    @endif
                </div>

                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 leading-snug">
                    {{ $popupEvent->title }}
                </h3>

                <p class="text-sm text-slate-600 line-clamp-3 leading-relaxed">
                    {{ $popupEvent->short_description }}
                </p>
            </div>

            <!-- Actions Row -->
            <div class="pt-2 flex flex-col sm:flex-row items-center gap-3">
                <a 
                    href="{{ route('events.show', $popupEvent->slug) }}" 
                    class="w-full sm:flex-1 inline-flex items-center justify-center gap-2 rounded-2xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold py-3 px-5 text-sm text-center shadow-md transition active:scale-95"
                >
                    <span>View Event & Register</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>

                <button 
                    type="button"
                    @click="closeModal(); $dispatch('open-enquiry-modal', { notes: 'Inquiry for Event: {{ addslashes($popupEvent->title) }}' })"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 rounded-2xl border border-slate-300 hover:bg-slate-50 text-slate-700 font-bold py-3 px-4 text-sm transition cursor-pointer"
                >
                    <i class="fa-solid fa-pen-to-square text-sm text-amber-600"></i>
                    <span>Quick Inquiry</span>
                </button>
            </div>

            <div class="text-center pt-1">
                <button 
                    type="button" 
                    @click="closeModal()" 
                    class="text-xs text-slate-400 hover:text-slate-600 transition"
                >
                    Dismiss for now
                </button>
            </div>
        </div>
    </div>
</div>
@endif
