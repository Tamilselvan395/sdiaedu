@php
    $franchiseTitle = $globalSettings['seo_franchise_title'] ?? 'Franchise Enquiry & Center Locations | Sri Deekshaa International Academy';
    $franchiseDesc = $globalSettings['seo_franchise_description'] ?? 'Explore franchise opportunities with Sri Deekshaa International Academy. View our campus location map, address, and submit a franchise enquiry to launch an accredited learning center.';
@endphp
<x-layouts.app :title="$franchiseTitle" :metaDescription="$franchiseDesc">
    <!-- Header Banner -->
    <section class="bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-white pt-10 pb-12 sm:pt-14 sm:pb-16 relative overflow-hidden border-b border-slate-800/80">
        <!-- Background Ambient Glow & Grid -->
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:20px_20px]"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/3 w-80 h-80 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <!-- Centered Breadcrumbs -->
            <div class="flex justify-center mb-4 sm:mb-5">
                <x-breadcrumb :items="[['label' => 'Franchise Opportunities']]" />
            </div>

            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight">
                Franchise Enquiries & Center Locations
            </h1>

            <p class="mt-4 text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto">
                {{ $globalSettings['franchise_hero_subtitle'] ?? "Bring Sri Deekshaa's ISO 9001 certified cognitive, academic, and creative programs to your city. Review our campus address, view our location on the map, or submit your franchise enquiry below." }}
            </p>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="py-12 sm:py-20 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-start">
                
                <!-- Left: Franchise Address & Map View -->
                <div class="space-y-6 w-full">
                    
                    <!-- Franchise Office Address Card -->
                    <div class="rounded-3xl bg-white p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
                        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                            <div>
                                <span class="text-xs font-bold text-amber-600 uppercase tracking-wider">Headquarters</span>
                                <h2 class="text-2xl font-bold text-slate-900 mt-0.5">Master Franchise Office</h2>
                            </div>
                            <div class="h-12 w-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-xl shrink-0">
                                <i class="fa-solid fa-building-columns"></i>
                            </div>
                        </div>

                        <div class="space-y-4 text-sm text-slate-600">
                            <!-- Physical Address -->
                            <div class="flex items-start gap-3.5">
                                <div class="p-2.5 rounded-xl bg-amber-50 border border-amber-200/60 text-amber-700 shrink-0 w-10 h-10 flex items-center justify-center text-sm mt-0.5">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div>
                                    <strong class="block text-slate-900 font-semibold mb-0.5">Official Campus & Franchise Address</strong>
                                    <p class="leading-relaxed text-slate-700">
                                        {{ $globalSettings['address'] ?? 'Plot No. 42, 2nd Avenue, Sri Deekshaa Learning Campus' }},
                                        <br>
                                        {{ $globalSettings['city'] ?? 'Chennai' }}, {{ $globalSettings['state'] ?? 'Tamil Nadu' }} - {{ $globalSettings['pincode'] ?? '600040' }}, {{ $globalSettings['country'] ?? 'India' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Phone Desk -->
                            <div class="flex items-start gap-3.5">
                                <div class="p-2.5 rounded-xl bg-emerald-50 border border-emerald-200/60 text-emerald-700 shrink-0 w-10 h-10 flex items-center justify-center text-sm mt-0.5">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <div>
                                    <strong class="block text-slate-900 font-semibold mb-0.5">Franchise Helpdesk Phone</strong>
                                    @php
                                        $fPhone = $globalSettings['franchise_phone'] ?? $globalSettings['phone'] ?? '+91 98765 43210';
                                        $fEmail = $globalSettings['franchise_email'] ?? $globalSettings['email'] ?? 'info@srideekshaa.com';
                                    @endphp
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $fPhone) }}" class="text-amber-600 hover:text-amber-700 font-medium">
                                        {{ $fPhone }}
                                    </a>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="flex items-start gap-3.5">
                                <div class="p-2.5 rounded-xl bg-blue-50 border border-blue-200/60 text-blue-700 shrink-0 w-10 h-10 flex items-center justify-center text-sm mt-0.5">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <div>
                                    <strong class="block text-slate-900 font-semibold mb-0.5">Franchise Inquiries Email</strong>
                                    <a href="mailto:{{ $fEmail }}" class="text-slate-700 hover:text-amber-600">
                                        {{ $fEmail }}
                                    </a>
                                </div>
                            </div>

                            <!-- Hours -->
                            <div class="flex items-start gap-3.5">
                                <div class="p-2.5 rounded-xl bg-slate-100 text-slate-700 shrink-0 w-10 h-10 flex items-center justify-center text-sm mt-0.5">
                                    <i class="fa-solid fa-clock"></i>
                                </div>
                                <div>
                                    <strong class="block text-slate-900 font-semibold mb-0.5">Consultation & Office Hours</strong>
                                    <span class="text-slate-700">{{ $globalSettings['working_hours'] ?? 'Monday - Saturday: 9:00 AM - 7:30 PM | Sunday: 9:00 AM - 1:30 PM' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Direct WhatsApp Action & Brochure -->
                        <div class="pt-4 border-t border-slate-100 space-y-2.5">
                            <x-whatsapp-btn 
                                label="Chat with Franchise Coordinator on WhatsApp" 
                                class="w-full text-center" 
                            />
                            @if(!empty($globalSettings['franchise_brochure_url']))
                                <a 
                                    href="{{ $globalSettings['franchise_brochure_url'] }}" 
                                    target="_blank" 
                                    rel="noopener noreferrer" 
                                    class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold py-3 px-4 text-xs transition shadow-xs"
                                >
                                    <i class="fa-solid fa-file-pdf text-amber-400"></i>
                                    <span>Download Franchise Prospectus</span>
                                </a>
                            @endif
                        </div>

                        <!-- Existing Centers / Locations link -->
                        @if($locations->isNotEmpty())
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                <div>
                                    <span class="text-xs text-slate-500 font-medium">Branch Network</span>
                                    <p class="text-sm font-bold text-slate-900">{{ $locations->count() }} Accredited Centers & Branches</p>
                                </div>
                                <a href="#franchise-locations" class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-600 hover:text-amber-700 bg-amber-50 hover:bg-amber-100 px-3.5 py-2 rounded-xl transition border border-amber-200">
                                    <span>Browse All Centers</span>
                                    <i class="fa-solid fa-arrow-down text-[10px]"></i>
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Franchise Map View Card -->
                    <div class="rounded-3xl bg-white p-5 sm:p-6 border border-slate-200/80 shadow-xs space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-map-location-dot text-amber-500 text-base"></i>
                                <h3 class="font-bold text-slate-900 text-base">Master Campus & Headquarters Map</h3>
                            </div>
                            <a 
                                href="https://maps.google.com/?q={{ urlencode(($globalSettings['address'] ?? 'Sri Deekshaa International Academy') . ', ' . ($globalSettings['city'] ?? 'Chennai')) }}" 
                                target="_blank" 
                                rel="noopener noreferrer" 
                                class="text-xs font-bold text-amber-600 hover:text-amber-700 flex items-center gap-1 transition"
                            >
                                <span>Get Directions</span>
                                <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                            </a>
                        </div>
                        
                        <div class="aspect-video w-full rounded-2xl overflow-hidden bg-slate-100 border border-slate-200/60 shadow-inner">
                            <iframe 
                                src="{{ $globalSettings['map_embed_url'] ?? 'https://maps.google.com/maps?q=Chennai&t=&z=13&ie=UTF8&iwloc=&output=embed' }}" 
                                class="w-full h-full border-0" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade" 
                                title="Sri Deekshaa Academy Master Campus Map"
                            ></iframe>
                        </div>
                    </div>

                </div>

                <!-- Right: Franchise Enquiry Form -->
                <div class="w-full">
                    <div class="rounded-3xl bg-white p-6 sm:p-10 border border-slate-200/80 shadow-sm space-y-6">
                        <div>
                            <span class="inline-block rounded-full bg-amber-100 px-3.5 py-1 text-xs font-bold text-amber-800 uppercase tracking-wider mb-2 border border-amber-200/80">
                                Franchise Application
                            </span>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                                Submit Franchise Enquiry
                            </h2>
                            <p class="text-sm text-slate-600 mt-2 leading-relaxed">
                                Please share your contact information and preferred location. Our franchise development director will contact you with full franchise prospectus and center setup blueprints.
                            </p>
                        </div>

                        @if(session('success'))
                            <div class="rounded-2xl bg-emerald-50 border border-emerald-200 p-4 flex items-start gap-3">
                                <i class="fa-solid fa-circle-check text-emerald-600 text-lg mt-0.5 shrink-0"></i>
                                <div class="text-sm text-emerald-800 font-medium leading-relaxed">
                                    {{ session('success') }}
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('enquiries.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="source" value="Franchise Enquiry Page">
                            <input type="hidden" name="student_name" value="Franchise Applicant">

                            <!-- Applicant Full Name -->
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">
                                    Applicant / Director Full Name *
                                </label>
                                <input 
                                    type="text" 
                                    name="parent_name" 
                                    required 
                                    placeholder="e.g. Ramesh Kumar" 
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white transition"
                                >
                            </div>

                            <!-- Phone / WhatsApp & Email Grid -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">
                                        Phone / WhatsApp *
                                    </label>
                                    <input 
                                        type="tel" 
                                        name="phone" 
                                        required 
                                        placeholder="e.g. +91 98765 43210" 
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white transition"
                                    >
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">
                                        Email Address *
                                    </label>
                                    <input 
                                        type="email" 
                                        name="email" 
                                        required 
                                        placeholder="e.g. ramesh@example.com" 
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white transition"
                                    >
                                </div>
                            </div>

                            <!-- Proposed City / Region -->
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">
                                    Proposed Center Location / City *
                                </label>
                                <input 
                                    type="text" 
                                    id="proposed-location-input"
                                    name="mode_preference" 
                                    required 
                                    placeholder="e.g. Chennai - Velachery, Coimbatore, Madurai, Bengaluru..." 
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white transition"
                                >
                            </div>

                            <!-- Additional Notes / Message -->
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">
                                    Premises Availability / Investment Capacity / Questions
                                </label>
                                <textarea 
                                    name="notes" 
                                    rows="4" 
                                    placeholder="Tell us about your background, existing space/school setup (if any), or specific questions regarding the franchise..." 
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white transition resize-none"
                                ></textarea>
                            </div>

                            <!-- Submit Button -->
                            <button 
                                type="submit" 
                                class="w-full rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold py-3.5 px-6 text-sm sm:text-base shadow-md transition active:scale-98 cursor-pointer flex items-center justify-center gap-2"
                            >
                                <i class="fa-solid fa-paper-plane text-sm"></i>
                                <span>Send Franchise Enquiry</span>
                            </button>

                            <p class="text-xs text-slate-500 text-center pt-2">
                                <i class="fa-solid fa-lock text-slate-400 mr-1"></i>
                                Your information is confidential and will only be used for franchise evaluation.
                            </p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- All Franchise Centers & Map Views Section -->
    <section id="franchise-locations" class="py-16 sm:py-24 bg-white border-t border-slate-200 scroll-mt-10" x-data="{ activeCity: 'all' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                <span class="inline-flex items-center gap-2 rounded-full bg-amber-100 text-amber-800 px-4 py-1.5 text-xs font-bold uppercase tracking-wider mb-3 border border-amber-200">
                    <i class="fa-solid fa-network-wired"></i>
                    <span>Campus &amp; Franchise Network</span>
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    All Franchise Centers &amp; Locations
                </h2>
                <p class="mt-3 text-base sm:text-lg text-slate-600 leading-relaxed">
                    Explore our accredited branch network across South India. Find center addresses, direct contact numbers, and interactive map directions.
                </p>

                <!-- City Filter Pills -->
                @php
                    $cities = $locations->pluck('city')->unique()->filter()->values();
                @endphp
                @if($cities->count() > 1)
                    <div class="flex flex-wrap items-center justify-center gap-2 mt-6">
                        <button 
                            type="button" 
                            @click="activeCity = 'all'" 
                            :class="activeCity === 'all' ? 'bg-amber-500 text-slate-950 font-bold shadow-xs' : 'bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium'"
                            class="px-4 py-2 rounded-full text-xs sm:text-sm transition cursor-pointer"
                        >
                            All Locations ({{ $locations->count() }})
                        </button>
                        @foreach($cities as $city)
                            <button 
                                type="button" 
                                @click="activeCity = '{{ strtolower($city) }}'" 
                                :class="activeCity === '{{ strtolower($city) }}' ? 'bg-amber-500 text-slate-950 font-bold shadow-xs' : 'bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium'"
                                class="px-4 py-2 rounded-full text-xs sm:text-sm transition cursor-pointer"
                            >
                                {{ $city }} ({{ $locations->where('city', $city)->count() }})
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Centers Grid -->
            @if($locations->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($locations as $center)
                        <div 
                            x-show="activeCity === 'all' || activeCity === '{{ strtolower($center->city) }}'"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            class="flex flex-col bg-slate-50/70 rounded-3xl border border-slate-200/90 overflow-hidden shadow-xs hover:shadow-md hover:border-amber-400/60 transition-all duration-300 group"
                        >
                            <!-- Visual Banner / Map View -->
                            <div class="relative w-full aspect-video sm:h-52 bg-slate-200 overflow-hidden border-b border-slate-200/80">
                                @if($center->image)
                                    <img 
                                        src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($center->image) }}" 
                                        alt="{{ $center->name }}" 
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                                        loading="lazy"
                                    >
                                @else
                                    <iframe 
                                        src="{{ $center->effective_map_url }}" 
                                        class="w-full h-full border-0 group-hover:scale-102 transition-transform duration-500" 
                                        allowfullscreen="" 
                                        loading="lazy" 
                                        referrerpolicy="no-referrer-when-downgrade" 
                                        title="{{ $center->name }} Map"
                                    ></iframe>
                                @endif
                                <div class="absolute top-3 right-3">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-white/95 text-slate-800 shadow-sm border border-slate-200 backdrop-blur-xs">
                                        <i class="fa-solid fa-location-dot text-amber-500"></i>
                                        <span>{{ $center->city }}</span>
                                    </span>
                                </div>
                            </div>

                            <!-- Center Details Body -->
                            <div class="p-6 flex-1 flex flex-col justify-between space-y-5">
                                <div>
                                    <div class="flex items-center justify-between gap-2 mb-2">
                                        <span class="text-[11px] font-bold text-amber-700 uppercase tracking-wider bg-amber-100/80 px-2.5 py-0.5 rounded-md">
                                            {{ $center->state }}
                                        </span>
                                        <span class="inline-flex items-center gap-1 text-[11px] text-emerald-700 font-semibold bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200/60">
                                            <i class="fa-solid fa-circle-check text-[10px]"></i>
                                            <span>Active Center</span>
                                        </span>
                                    </div>
                                    <h3 class="text-xl font-bold text-slate-900 group-hover:text-amber-600 transition-colors">
                                        {{ $center->name }}
                                    </h3>
                                    @if($center->description)
                                        <p class="mt-2 text-xs text-slate-600 leading-relaxed line-clamp-2">
                                            {{ $center->description }}
                                        </p>
                                    @endif

                                    <!-- Address Block -->
                                    <div class="mt-4 pt-4 border-t border-slate-200/80 space-y-2.5 text-xs text-slate-600">
                                        <div class="flex items-start gap-2.5">
                                            <i class="fa-solid fa-map-pin text-amber-500 mt-0.5 shrink-0 text-sm"></i>
                                            <div class="leading-relaxed">
                                                <span class="text-slate-800 font-semibold">Address:</span>
                                                <p class="text-slate-600 mt-0.5">
                                                    {{ $center->address }}
                                                    @if($center->pincode)
                                                        - {{ $center->pincode }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>

                                        @if($center->phone)
                                            <div class="flex items-center gap-2.5">
                                                <i class="fa-solid fa-phone text-emerald-600 shrink-0 text-xs"></i>
                                                <span class="text-slate-800 font-semibold">Phone:</span>
                                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $center->phone) }}" class="text-slate-700 hover:text-amber-600 font-medium">
                                                    {{ $center->phone }}
                                                </a>
                                            </div>
                                        @endif

                                        @if($center->email)
                                            <div class="flex items-center gap-2.5">
                                                <i class="fa-solid fa-envelope text-blue-600 shrink-0 text-xs"></i>
                                                <span class="text-slate-800 font-semibold">Email:</span>
                                                <a href="mailto:{{ $center->email }}" class="text-slate-700 hover:text-amber-600 truncate">
                                                    {{ $center->email }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="pt-4 border-t border-slate-200/80 flex items-center gap-2.5">
                                    <a 
                                        href="{{ $center->directions_url }}" 
                                        target="_blank" 
                                        rel="noopener noreferrer" 
                                        class="flex-1 inline-flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold shadow-xs transition"
                                    >
                                        <i class="fa-solid fa-location-arrow text-[11px] text-amber-400"></i>
                                        <span>Directions</span>
                                    </a>
                                    <button 
                                        type="button" 
                                        onclick="selectFranchiseLocation('{{ addslashes($center->name) }} ({{ addslashes($center->city) }})')"
                                        class="flex-1 inline-flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 text-xs font-bold shadow-xs transition cursor-pointer"
                                    >
                                        <i class="fa-solid fa-file-pen text-[11px]"></i>
                                        <span>Enquire Here</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 rounded-3xl bg-slate-50 border border-slate-200">
                    <i class="fa-solid fa-map-location-dot text-4xl text-slate-400 mb-3"></i>
                    <h3 class="text-lg font-bold text-slate-700">No Franchise Centers Currently Listed</h3>
                    <p class="text-sm text-slate-500 mt-1">Please submit the enquiry form above to become our first franchise partner in your region.</p>
                </div>
            @endif

        </div>
    </section>

    <!-- Helper Script for Franchise Selection -->
    <script>
        function selectFranchiseLocation(locationName) {
            const input = document.getElementById('proposed-location-input');
            if (input) {
                input.value = locationName;
                input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                input.focus();
            }
        }
    </script>
</x-layouts.app>
