@php
    $contactTitle = $globalSettings['seo_contact_title'] ?? 'Contact Us & Campus Location | Sri Deekshaa International Academy';
    $contactDesc = $globalSettings['seo_contact_description'] ?? 'Get in touch with Sri Deekshaa International Academy. Visit our Chennai campus, call us, or book an academic counseling session.';
@endphp
<x-layouts.app :title="$contactTitle" :metaDescription="$contactDesc">
    <!-- Header -->
    <section class="bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-white pt-10 pb-12 sm:pt-14 sm:pb-16 relative overflow-hidden border-b border-slate-800/80">
        <!-- Background Ambient Glow & Grid -->
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:20px_20px]"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/3 w-80 h-80 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <!-- Centered Breadcrumbs -->
            <div class="flex justify-center mb-4 sm:mb-5">
                <x-breadcrumb :items="[['label' => 'Contact Us']]" />
            </div>

            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight">
                Visit Our Campus or Speak with an Advisor
            </h1>

            <p class="mt-4 text-base sm:text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Have questions about our programs, scheduling, or fee options? We are here to guide you every step of the way.
            </p>
        </div>
    </section>

    <!-- Main Contact Section -->
    <section class="py-12 sm:py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">
                
                <!-- Left: Contact Details & Branch Info -->
                <div class="lg:col-span-5 space-y-6">
                    
                    <div class="rounded-3xl bg-white p-6 sm:p-8 lg:p-10 border border-slate-200/80 shadow-xs space-y-6">
                        <div>
                            <span class="inline-block rounded-full bg-amber-100 px-3.5 py-1 text-xs font-bold text-amber-800 uppercase tracking-wider mb-2 border border-amber-200/80">
                                Campus Helpdesk
                            </span>
                            <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-2">
                                Campus Information
                            </h2>
                            <p class="text-sm text-slate-600 leading-relaxed">
                                Connect directly with our academy counselors, visit our master campus, or reach out via phone, email, or WhatsApp.
                            </p>
                        </div>
                        
                        <div class="space-y-4 text-sm text-slate-600 pt-2 border-t border-slate-100">
                            <div class="flex items-start gap-3.5">
                                <div class="p-2.5 rounded-xl bg-amber-100 text-amber-700 shrink-0 w-9 h-9 flex items-center justify-center">
                                    <i class="fa-solid fa-location-dot text-base"></i>
                                </div>
                                <div>
                                    <strong class="block text-slate-900 font-semibold">Campus Address</strong>
                                    <span class="leading-relaxed">{{ $globalSettings['address'] ?? 'Plot No. 42, 2nd Avenue' }}, {{ $globalSettings['city'] ?? 'Chennai' }} - {{ $globalSettings['pincode'] ?? '600040' }}</span>
                                </div>
                            </div>

                            <div class="flex items-start gap-3.5">
                                <div class="p-2.5 rounded-xl bg-emerald-100 text-emerald-700 shrink-0 w-9 h-9 flex items-center justify-center">
                                    <i class="fa-solid fa-phone text-base"></i>
                                </div>
                                <div>
                                    <strong class="block text-slate-900 font-semibold">Phone &amp; Counseling Desk</strong>
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $globalSettings['phone'] ?? '+91 98765 43210') }}" class="text-amber-600 hover:underline">
                                        {{ $globalSettings['phone'] ?? '+91 98765 43210' }}
                                    </a>
                                </div>
                            </div>

                            <div class="flex items-start gap-3.5">
                                <div class="p-2.5 rounded-xl bg-blue-100 text-blue-700 shrink-0 w-9 h-9 flex items-center justify-center">
                                    <i class="fa-solid fa-envelope text-base"></i>
                                </div>
                                <div>
                                    <strong class="block text-slate-900 font-semibold">Email Enquiries</strong>
                                    <span>{{ $globalSettings['email'] ?? 'info@srideekshaa.com' }}</span>
                                </div>
                            </div>

                            <div class="flex items-start gap-3.5">
                                <div class="p-2.5 rounded-xl bg-slate-100 text-slate-700 shrink-0 w-9 h-9 flex items-center justify-center">
                                    <i class="fa-solid fa-clock text-base"></i>
                                </div>
                                <div>
                                    <strong class="block text-slate-900 font-semibold">Working Hours</strong>
                                    <span>{{ $globalSettings['working_hours'] ?? 'Mon - Sat: 9:00 AM - 7:30 PM | Sun: 9:00 AM - 1:30 PM' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-100">
                            <x-whatsapp-btn label="Chat Instantly on WhatsApp" class="w-full text-center" />
                        </div>
                    </div>

                    <!-- Campus Map -->
                    <div class="rounded-3xl bg-white p-5 sm:p-6 border border-slate-200/80 shadow-xs overflow-hidden space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-map-location-dot text-amber-500 text-base"></i>
                                <h3 class="font-bold text-slate-900 text-sm">Interactive Campus Map</h3>
                            </div>
                            <a 
                                href="https://maps.google.com/?q={{ urlencode(($globalSettings['address'] ?? 'Sri Deekshaa') . ' ' . ($globalSettings['city'] ?? 'Chennai')) }}" 
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
                            ></iframe>
                        </div>
                    </div>

                </div>

                <!-- Right: Full Contact Form -->
                <div class="lg:col-span-7">
                    <div class="rounded-3xl bg-white p-6 sm:p-8 lg:p-10 border border-slate-200/80 shadow-sm">
                        <span class="inline-block rounded-full bg-amber-100 px-3.5 py-1 text-xs font-bold text-amber-800 uppercase tracking-wider mb-2 border border-amber-200/80">
                            Quick Inquiries
                        </span>
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-2">
                            Send an Enquiry or Schedule a Campus Visit
                        </h2>
                        <p class="text-sm text-slate-600 mb-8 leading-relaxed">
                            Fill out the form below and our counseling department will contact you within 24 hours with curriculum syllabi and trial schedules.
                        </p>

                        <form action="{{ route('enquiries.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="source" value="Contact Page Form">

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Parent / Guardian Name *</label>
                                    <input 
                                        type="text" 
                                        name="parent_name" 
                                        required 
                                        placeholder="e.g. Anand Sundaram" 
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white"
                                    >
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Student Name *</label>
                                    <input 
                                        type="text" 
                                        name="student_name" 
                                        required 
                                        placeholder="e.g. Diya Sundaram" 
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white"
                                    >
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Phone / WhatsApp *</label>
                                    <input 
                                        type="tel" 
                                        name="phone" 
                                        required 
                                        placeholder="+91 98765 43210" 
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white"
                                    >
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email Address</label>
                                    <input 
                                        type="email" 
                                        name="email" 
                                        placeholder="anand@example.com" 
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white"
                                    >
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Student Age (Years)</label>
                                    <input 
                                        type="number" 
                                        name="student_age" 
                                        min="3" 
                                        max="50" 
                                        placeholder="e.g. 9" 
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white"
                                    >
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Learning Mode</label>
                                    <select 
                                        name="mode_preference" 
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white"
                                    >
                                        <option value="In-Person">In-Person Classroom (Chennai)</option>
                                        <option value="Online">Interactive Live Online</option>
                                        <option value="Hybrid">Hybrid (Flexible)</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Your Message or Query</label>
                                <textarea 
                                    name="notes" 
                                    rows="4" 
                                    placeholder="Tell us about the courses you're interested in, student learning history, or preferred timing..." 
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white"
                                ></textarea>
                            </div>

                            <button 
                                type="submit" 
                                class="w-full rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold py-3.5 text-sm shadow-md transition active:scale-95"
                            >
                                Submit Request
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    
    <!-- Academy Branches / Locations Section -->
    @if($locations->isNotEmpty())
        <section class="py-16 sm:py-24 bg-white border-t border-slate-200/80">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                    <span class="inline-block rounded-full bg-amber-100 text-amber-800 px-3.5 py-1 text-xs font-bold uppercase tracking-wider mb-3">
                        Our Network
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-900">
                        Academy Branches & Learning Centers
                    </h2>
                    <p class="mt-3 text-base text-slate-600">
                        Discover a Sri Deekshaa International Academy center near you. Each center features certified instructors and state-of-the-art learning environments.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    @foreach($locations as $loc)
                        <div class="flex flex-col justify-between rounded-3xl bg-slate-50/80 p-6 sm:p-7 border border-slate-200/80 shadow-xs hover:shadow-md hover:border-amber-300 transition duration-200 group">
                            <div>
                                <div class="flex items-start justify-between gap-3 mb-4">
                                    <div class="w-10 h-10 rounded-2xl bg-amber-500/10 text-amber-600 flex items-center justify-center shrink-0 group-hover:bg-amber-500 group-hover:text-white transition-colors duration-200">
                                        <i class="fa-solid fa-building-columns text-base"></i>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-white text-slate-700 border border-slate-200 shadow-2xs">
                                        {{ $loc->city }}, {{ $loc->state }}
                                    </span>
                                </div>

                                <h3 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-amber-600 transition-colors">
                                    {{ $loc->name }}
                                </h3>

                                @if($loc->description)
                                    <p class="text-xs text-slate-500 mb-4 line-clamp-2 leading-relaxed">
                                        {{ $loc->description }}
                                    </p>
                                @endif

                                <div class="space-y-2.5 text-xs text-slate-600 pt-3 border-t border-slate-200/60">
                                    @if($loc->address)
                                        <div class="flex items-start gap-2.5">
                                            <i class="fa-solid fa-location-dot text-amber-500 mt-0.5 shrink-0 text-sm"></i>
                                            <span class="leading-relaxed">{{ $loc->address }}{{ $loc->pincode ? ' - '.$loc->pincode : '' }}</span>
                                        </div>
                                    @endif

                                    @if($loc->phone)
                                        <div class="flex items-center gap-2.5">
                                            <i class="fa-solid fa-phone text-emerald-500 shrink-0 text-sm"></i>
                                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $loc->phone) }}" class="hover:text-amber-600 font-medium transition">
                                                {{ $loc->phone }}
                                            </a>
                                        </div>
                                    @endif

                                    @if($loc->email)
                                        <div class="flex items-center gap-2.5">
                                            <i class="fa-solid fa-envelope text-blue-500 shrink-0 text-sm"></i>
                                            <a href="mailto:{{ $loc->email }}" class="hover:text-amber-600 font-medium transition break-all">
                                                {{ $loc->email }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            @if($loc->directions_url)
                                <div class="mt-6 pt-4 border-t border-slate-200/60">
                                    <a 
                                        href="{{ $loc->directions_url }}" 
                                        target="_blank" 
                                        rel="noopener noreferrer" 
                                        class="inline-flex items-center justify-center w-full gap-2 rounded-xl bg-white hover:bg-amber-500 hover:text-white px-4 py-2.5 text-xs font-bold text-slate-800 border border-slate-200/90 shadow-2xs hover:border-transparent transition"
                                    >
                                        <span>Get Directions</span>
                                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.app>