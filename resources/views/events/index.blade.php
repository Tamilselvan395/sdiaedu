<x-layouts.app :title="$globalSettings['seo_events_title'] ?? ($metaTitle ?? 'Upcoming Academy Events & Workshops | Sri Deekshaa International Academy')" :metaDescription="$globalSettings['seo_events_description'] ?? ($metaDescription ?? null)">
    <!-- Events Hero Banner -->
    <section class="bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-white pt-10 pb-12 sm:pt-14 sm:pb-16 relative overflow-hidden border-b border-slate-800/80">
        <!-- Background Ambient Glow & Grid -->
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:20px_20px]"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/3 w-80 h-80 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <!-- Centered Breadcrumbs -->
            <div class="flex justify-center mb-4 sm:mb-5">
                <x-breadcrumb :items="[['label' => 'Events & Workshops']]" />
            </div>

            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight leading-tight text-white">
                Upcoming Events, Olympiads & Workshops
            </h1>

            <p class="mt-4 text-base sm:text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Join our state and national skill championships, hands-on STEM robotics bootcamps, and certified teacher training seminars.
            </p>
        </div>
    </section>

    <!-- Upcoming Events Section -->
    <section class="py-16 sm:py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-10 pb-4 border-b border-slate-200">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Upcoming Events</h2>
                    <p class="text-sm text-slate-500 mt-1">Open for student and educator registrations</p>
                </div>
                <span class="rounded-full bg-amber-100 text-amber-800 text-xs font-bold px-3 py-1 border border-amber-200">
                    {{ $upcomingEvents->count() }} Upcoming
                </span>
            </div>

            @if($upcomingEvents->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($upcomingEvents as $event)
                        <article class="group rounded-3xl bg-white border border-slate-200/80 shadow-xs hover:shadow-xl hover:border-amber-400/60 transition-all duration-300 flex flex-col justify-between overflow-hidden">
                            <div>
                                <!-- Banner Header -->
                                <div class="relative h-48 w-full overflow-hidden bg-slate-100">
                                    <img 
                                        src="{{ $event->banner_url }}" 
                                        alt="{{ $event->title }}"
                                        class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                        loading="lazy"
                                    >
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
                                    
                                    <!-- Badges -->
                                    <div class="absolute top-3 left-3 flex flex-wrap gap-2">
                                        <span class="rounded-full bg-slate-900/85 backdrop-blur-md text-white text-xs font-bold px-3 py-1 shadow-xs border border-white/20">
                                            {{ $event->mode }}
                                        </span>
                                    </div>

                                    <div class="absolute top-3 right-3">
                                        <span class="rounded-full bg-emerald-500 text-white text-xs font-extrabold px-3 py-1 shadow-md">
                                            {{ $event->registration_fee > 0 ? '₹' . number_format($event->registration_fee) : 'Free Entry' }}
                                        </span>
                                    </div>

                                    <!-- Bottom Date Overlay -->
                                    <div class="absolute bottom-3 left-3 right-3 text-white text-sm font-semibold flex items-center gap-2">
                                        <i class="fa-solid fa-calendar-day text-amber-400"></i>
                                        <span>{{ $event->formatted_date }}</span>
                                    </div>
                                </div>

                                <!-- Card Content -->
                                <div class="p-6 space-y-3">
                                    <div class="flex items-center gap-2 text-sm text-slate-500">
                                        <i class="fa-solid fa-clock text-amber-500"></i>
                                        <span>{{ $event->formatted_time }}</span>
                                        @if($event->location_name)
                                            <i class="fa-solid fa-circle text-[3px] text-slate-300"></i>
                                            <span class="truncate max-w-[150px]"><i class="fa-solid fa-location-dot text-slate-400 mr-1"></i>{{ $event->location_name }}</span>
                                        @endif
                                    </div>

                                    <h3 class="text-xl font-bold text-slate-900 group-hover:text-amber-600 transition leading-snug line-clamp-2">
                                        <a href="{{ route('events.show', $event->slug) }}">
                                            {{ $event->title }}
                                        </a>
                                    </h3>

                                    <p class="text-sm text-slate-600 line-clamp-3 leading-relaxed">
                                        {{ $event->short_description }}
                                    </p>
                                </div>
                            </div>

                            <!-- Bottom CTA -->
                            <div class="p-6 pt-0 border-t border-slate-100 mt-4 flex items-center justify-between gap-3">
                                <a 
                                    href="{{ route('events.show', $event->slug) }}" 
                                    class="inline-flex items-center gap-1.5 text-sm font-semibold text-amber-600 hover:text-amber-700 transition"
                                >
                                    <span>Details & Register</span>
                                    <i class="fa-solid fa-arrow-right text-xs"></i>
                                </a>

                                <button 
                                    type="button" 
                                    @click="$dispatch('open-enquiry-modal', { notes: 'Inquiry for Event: {{ addslashes($event->title) }}' })"
                                    class="rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-semibold text-sm px-4 py-2 transition"
                                >
                                    Quick Register
                                </button>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="rounded-3xl bg-white p-12 text-center border border-slate-200 max-w-lg mx-auto space-y-3">
                    <div class="h-14 w-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mx-auto text-2xl">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">No Upcoming Events Right Now</h3>
                    <p class="text-sm text-slate-500">
                        We are finalizing our next championship and workshop dates. Please check back soon or register your interest with our counseling desk.
                    </p>
                    <div class="pt-2">
                        <x-whatsapp-btn label="Contact Academy Desk" size="sm" />
                    </div>
                </div>
            @endif

        </div>
    </section>

    <!-- Past Events Archive Section -->
    @if($pastEvents->count() > 0)
        <section class="py-16 bg-white border-t border-slate-200/80">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-10 text-center max-w-2xl mx-auto">
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 text-slate-700 px-3 py-1 text-xs font-bold uppercase tracking-wider mb-2">
                        <i class="fa-solid fa-box-archive text-xs"></i>
                        <span>Event Archive</span>
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Past Academy Highlights</h2>
                    <p class="text-sm text-slate-500 mt-1">Celebrating our students' achievements in previous olympiads and exhibitions</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($pastEvents as $pastEvent)
                        <div class="rounded-2xl border border-slate-200 bg-slate-50/50 p-5 space-y-3">
                            <div class="flex items-center justify-between text-sm text-slate-500">
                                <span>{{ $pastEvent->formatted_date }}</span>
                                <span class="rounded-full bg-slate-200 text-slate-700 text-xs font-semibold px-2.5 py-0.5">Completed</span>
                            </div>
                            <h4 class="font-bold text-slate-900 text-base hover:text-amber-600 transition">
                                <a href="{{ route('events.show', $pastEvent->slug) }}">
                                    {{ $pastEvent->title }}
                                </a>
                            </h4>
                            <p class="text-sm text-slate-600 line-clamp-2 leading-relaxed">
                                {{ $pastEvent->short_description }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.app>
