<x-layouts.app :title="$metaTitle" :metaDescription="$metaDescription" :canonical="$canonicalUrl" :ogImage="$event->banner_url">
    @push('head')
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "Event",
      "name": @json($event->title),
      "description": @json($event->short_description),
      "startDate": "{{ $event->start_date ? $event->start_date->toIso8601String() : '' }}",
      "endDate": "{{ $event->end_date ? $event->end_date->toIso8601String() : ($event->start_date ? $event->start_date->addHours(2)->toIso8601String() : '') }}",
      "eventStatus": "{{ $event->is_completed ? 'https://schema.org/EventCompleted' : 'https://schema.org/EventScheduled' }}",
      "eventAttendanceMode": "{{ $event->mode === 'Live Online' ? 'https://schema.org/OnlineEventAttendanceMode' : ($event->mode === 'Hybrid' ? 'https://schema.org/MixedEventAttendanceMode' : 'https://schema.org/OfflineEventAttendanceMode') }}",
      "location": {
        "@@type": "Place",
        "name": @json($event->location_name ?: 'Sri Deekshaa International Academy'),
        "address": {
          "@@type": "PostalAddress",
          "streetAddress": @json($event->location_address ?: 'Chennai, Tamil Nadu, India'),
          "addressLocality": "Chennai",
          "addressRegion": "Tamil Nadu",
          "addressCountry": "IN"
        }
      },
      "image": [
        @json($event->banner_url)
      ],
      "organizer": {
        "@@type": "Organization",
        "name": "Sri Deekshaa International Academy",
        "url": "{{ url('/') }}"
      },
      "offers": {
        "@@type": "Offer",
        "price": "{{ $event->registration_fee }}",
        "priceCurrency": "INR",
        "availability": "https://schema.org/InStock",
        "url": "{{ route('events.show', $event->slug) }}"
      }
    }
    </script>
    @endpush

    <!-- Event Hero Banner -->
    <section class="bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-white pt-8 pb-12 lg:pt-10 lg:pb-16 relative overflow-hidden border-b border-slate-800/80">
        <!-- Background Ambient Glow & Grid -->
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:20px_20px]"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/3 w-80 h-80 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="mb-4 sm:mb-6">
                <x-breadcrumb :items="[
                    ['label' => 'Events', 'url' => route('events.index')],
                    ['label' => $event->title]
                ]" />
            </div>

            <div class="max-w-4xl space-y-4">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="rounded-full bg-amber-500/20 px-3.5 py-1 text-xs font-semibold text-amber-400 border border-amber-500/30">
                        {{ $event->mode }}
                    </span>

                    @if($event->is_completed)
                        <span class="rounded-full bg-slate-800 text-slate-400 text-xs font-semibold px-3 py-1 border border-slate-700">
                            Event Completed
                        </span>
                    @else
                        <span class="rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-semibold px-3 py-1 border border-emerald-500/30 flex items-center gap-1.5">
                            <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            Upcoming Event
                        </span>
                    @endif

                    <span class="rounded-full bg-slate-800 px-3 py-1 text-xs font-medium text-slate-300">
                        Fee: {{ $event->registration_fee > 0 ? '₹' . number_format($event->registration_fee) : 'Free Registration' }}
                    </span>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight">
                    {{ $event->title }}
                </h1>

                <p class="text-base sm:text-lg text-slate-300 leading-relaxed max-w-3xl">
                    {{ $event->short_description }}
                </p>

                <div class="pt-4 flex flex-wrap items-center gap-6 text-xs sm:text-sm text-slate-300 border-t border-slate-800">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-calendar-days text-amber-400 text-base"></i>
                        <div>
                            <span class="block text-[11px] text-slate-400">Date</span>
                            <span class="font-bold text-white">{{ $event->formatted_date }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-clock text-amber-400 text-base"></i>
                        <div>
                            <span class="block text-[11px] text-slate-400">Timing</span>
                            <span class="font-bold text-white">{{ $event->formatted_time }}</span>
                        </div>
                    </div>

                    @if($event->location_name)
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-location-dot text-amber-400 text-base"></i>
                            <div>
                                <span class="block text-[11px] text-slate-400">Venue / Location</span>
                                <span class="font-bold text-white">{{ $event->location_name }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content & Sidebar -->
    <section class="py-12 sm:py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                
                <!-- Left Details Area -->
                <div class="lg:col-span-8 space-y-10">
                    
                    <!-- Event Banner Image -->
                    <div class="rounded-3xl overflow-hidden bg-slate-200 shadow-md border border-slate-200">
                        <img 
                            src="{{ $event->banner_url }}" 
                            alt="{{ $event->title }}"
                            class="w-full max-h-[460px] object-cover"
                        >
                    </div>

                    <!-- Event Agenda & Description -->
                    <div class="rounded-3xl bg-white p-6 sm:p-10 border border-slate-200/80 shadow-xs space-y-6">
                        <div class="inline-flex items-center gap-2 rounded-full bg-amber-100/80 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-amber-800 border border-amber-200/60">
                            <i class="fa-solid fa-circle-info"></i>
                            <span>Event Overview & Agenda</span>
                        </div>

                        <div class="prose prose-slate max-w-none text-slate-800 leading-relaxed text-sm sm:text-base space-y-4">
                            @if($event->description)
                                {!! nl2br(e($event->description)) !!}
                            @else
                                <p>{{ $event->short_description }}</p>
                            @endif
                        </div>

                        @if($event->location_address)
                            <div class="rounded-2xl bg-slate-50 border border-slate-200 p-5 flex items-start gap-4 mt-6">
                                <div class="h-10 w-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 text-base">
                                    <i class="fa-solid fa-map-location-dot"></i>
                                </div>
                                <div class="text-sm">
                                    <h4 class="font-bold text-slate-900 uppercase tracking-wider text-sm">Venue Address</h4>
                                    <p class="text-slate-600 mt-1 leading-relaxed">{{ $event->location_address }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Event Guarantee Badges -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="rounded-2xl bg-white p-5 border border-slate-200/80 shadow-xs text-center space-y-2">
                            <div class="h-10 w-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mx-auto text-base">
                                <i class="fa-solid fa-award"></i>
                            </div>
                            <h4 class="text-base font-bold text-slate-900">Recognized Credentials</h4>
                            <p class="text-sm text-slate-600">Official ISO 9001 certified participation & merit certificates.</p>
                        </div>

                        <div class="rounded-2xl bg-white p-5 border border-slate-200/80 shadow-xs text-center space-y-2">
                            <div class="h-10 w-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center mx-auto text-base">
                                <i class="fa-solid fa-chalkboard-user"></i>
                            </div>
                            <h4 class="text-base font-bold text-slate-900">Expert Mentorship</h4>
                            <p class="text-sm text-slate-600">Guidance from national master trainers and cognitive specialists.</p>
                        </div>

                        <div class="rounded-2xl bg-white p-5 border border-slate-200/80 shadow-xs text-center space-y-2">
                            <div class="h-10 w-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto text-base">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <h4 class="text-base font-bold text-slate-900">All Welcome</h4>
                            <p class="text-sm text-slate-600">Separate categorized cohorts for students, parents, and teachers.</p>
                        </div>
                    </div>

                </div>

                <!-- Right Sticky Registration Card -->
                <div class="lg:col-span-4">
                    <div class="sticky top-24 space-y-6">
                        
                        <div class="rounded-3xl bg-white p-6 sm:p-8 border border-slate-200 shadow-xl space-y-6">
                            
                            <div>
                                <span class="text-sm text-slate-500 uppercase tracking-wider font-semibold">Entry / Registration</span>
                                <div class="flex items-baseline gap-2 mt-1">
                                    @if($event->registration_fee > 0)
                                        <span class="text-3xl font-extrabold text-slate-900">₹{{ number_format($event->registration_fee) }}</span>
                                        <span class="text-sm text-slate-500">per participant</span>
                                    @else
                                        <span class="text-2xl font-extrabold text-emerald-600">Free Registration</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Event Details Summary -->
                            <div class="space-y-3 text-sm text-slate-600 border-t border-slate-100 pt-4">
                                <div class="flex items-center justify-between">
                                    <span class="font-medium text-slate-500">Format:</span>
                                    <strong class="text-slate-800">{{ $event->mode }}</strong>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="font-medium text-slate-500">Date:</span>
                                    <strong class="text-slate-800">{{ $event->formatted_date }}</strong>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="font-medium text-slate-500">Time:</span>
                                    <strong class="text-slate-800">{{ $event->formatted_time }}</strong>
                                </div>
                                @if($event->location_name)
                                    <div class="flex items-center justify-between">
                                        <span class="font-medium text-slate-500">Venue:</span>
                                        <strong class="text-slate-800 truncate max-w-[170px]">{{ $event->location_name }}</strong>
                                    </div>
                                @endif
                            </div>

                            <!-- CTAs -->
                            <div class="space-y-3 pt-2">
                                @if($event->is_completed)
                                    <div class="rounded-xl bg-slate-100 text-slate-600 p-3 text-center text-xs font-semibold">
                                        This event has concluded. Stay tuned for future editions!
                                    </div>
                                @elseif($event->registration_url)
                                    <a 
                                        href="{{ $event->registration_url }}" 
                                        target="_blank" 
                                        rel="noopener noreferrer"
                                        class="w-full inline-flex items-center justify-center gap-2 rounded-2xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold py-3.5 px-4 text-sm text-center shadow-md transition active:scale-95"
                                    >
                                        <span>{{ $event->cta_button_text ?: 'Register Online' }}</span>
                                        <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                                    </a>
                                @else
                                    <button 
                                        type="button"
                                        @click="$dispatch('open-enquiry-modal', { notes: 'Registration for Event: {{ addslashes($event->title) }} (Date: {{ $event->formatted_date }})' })"
                                        class="w-full rounded-2xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold py-3.5 px-4 text-sm text-center shadow-md transition active:scale-95 cursor-pointer"
                                    >
                                        {{ $event->cta_button_text ?: 'Register for Event' }}
                                    </button>
                                @endif

                                <x-whatsapp-btn 
                                    label="Ask Event Coordinator on WhatsApp" 
                                    class="w-full text-center" 
                                />
                            </div>

                            <!-- Fast Registration Callback Form -->
                            @if(! $event->is_completed)
                                <div class="border-t border-slate-100 pt-5">
                                    <h4 class="text-sm font-bold uppercase tracking-wider text-slate-500 mb-3">
                                        Quick Spot Reservation
                                    </h4>
                                    
                                    <form action="{{ route('enquiries.store') }}" method="POST" class="space-y-3">
                                        @csrf
                                        <input type="hidden" name="source" value="Event Detail Page ({{ $event->slug }})">
                                        <input type="hidden" name="notes" value="Event Spot Booking: {{ $event->title }} ({{ $event->formatted_date }})">

                                        <input 
                                            type="text" 
                                            name="parent_name" 
                                            required 
                                            placeholder="Your / Parent Name *" 
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
                                            Confirm Event Booking
                                        </button>
                                    </form>
                                </div>
                            @endif

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Other Upcoming Events -->
    @if($otherEvents->count() > 0)
        <section class="py-16 bg-white border-t border-slate-200/80">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h3 class="text-2xl font-bold text-slate-900 mb-8">Other Upcoming Academy Events</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($otherEvents as $other)
                        <div class="rounded-2xl border border-slate-200 p-5 space-y-3 hover:shadow-md transition">
                            <span class="rounded-full bg-amber-100 text-amber-800 text-[10px] font-bold px-2.5 py-0.5">
                                {{ $other->formatted_date }}
                            </span>
                            <h4 class="font-bold text-slate-900 text-sm mt-1 line-clamp-2">
                                <a href="{{ route('events.show', $other->slug) }}" class="hover:text-amber-600">
                                    {{ $other->title }}
                                </a>
                            </h4>
                            <p class="text-xs text-slate-600 line-clamp-2">
                                {{ $other->short_description }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.app>
