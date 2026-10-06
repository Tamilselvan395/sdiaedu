@php
    $franchiseCodeClean = $selectedFranchise ? str_replace(['/', ' '], ['-', ''], $selectedFranchise->franchise_id ?? $selectedFranchise->slug) : '';
    $franchiseCanonical = ($searched && $selectedFranchise) 
        ? route('pages.franchise.verify', ['code' => $franchiseCodeClean])
        : route('pages.franchise');

    $franchiseTitle = ($searched && $selectedFranchise) 
        ? 'Franchise Partner Verification - ' . $selectedFranchise->name . ' (' . ($selectedFranchise->franchise_id ?? 'SDIA Partner') . ') | Sri Deekshaa International Academy' 
        : ($globalSettings['seo_franchise_title'] ?? 'Verify Franchise Partner | Sri Deekshaa International Academy');

    $franchiseDesc = ($searched && $selectedFranchise) 
        ? 'Official franchise partner accreditation certificate and authorized contact desk for ' . $selectedFranchise->name . ' (' . ($selectedFranchise->franchise_id ?? 'SDIA Partner') . '), ' . $selectedFranchise->city . '. Authorized partner of Sri Deekshaa International Academy.' 
        : ($globalSettings['seo_franchise_description'] ?? 'Official online franchise verification portal for Sri Deekshaa International Academy. Verify partner credentials, accreditation certificates, and authorized center details.');

    $franchiseOgImage = ($selectedFranchise && $selectedFranchise->certificate_image_url) 
        ? $selectedFranchise->certificate_image_url 
        : asset('images/franchise-partner-certificate.jpg');

    $isJpAcademy = $selectedFranchise && (str_contains(strtoupper($selectedFranchise->name), 'JP ACADEMY') || $selectedFranchise->franchise_id === 'SDIA-F-0013/2026' || $selectedFranchise->slug === 'jp-academy');
@endphp
<x-layouts.app 
    :title="$franchiseTitle" 
    :metaDescription="$franchiseDesc"
    :canonical="$franchiseCanonical"
    :ogImage="$franchiseOgImage"
>
    <style>
        @page {
            size: A4 portrait;
            margin: 12mm 15mm;
        }
        @media print {
            header, footer, nav, .no-print, #header-nav, .cookie-banner, .whatsapp-float, .top-announcement-bar {
                display: none !important;
            }
            body {
                background: #ffffff !important;
                color: #000000 !important;
                padding: 0 !important;
                margin: 0 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .print-page-wrapper {
                background: #ffffff !important;
                padding: 0 !important;
                margin: 0 !important;
                min-height: auto !important;
                box-shadow: none !important;
            }
            .print-container {
                max-width: 100% !important;
                width: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .print-certificate-box {
                box-shadow: none !important;
                page-break-inside: avoid !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
    </style>

    @if($searched)
        <!-- ======================================================= -->
        <!-- SEARCHED VIEW: CERTIFICATE ABOVE + DETAILS BELOW        -->
        <!-- ======================================================= -->

        <!-- Ambient Hero Header with Breadcrumbs (no-print) -->
        <section class="no-print bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-white pt-8 pb-10 relative overflow-hidden border-b border-slate-800/80">
            <!-- Background Ambient Glow & Grid -->
            <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:20px_20px]"></div>
            <div class="absolute top-0 right-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 left-1/3 w-80 h-80 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10 text-center">
                <!-- Centered Breadcrumbs -->
                <div class="flex justify-center mb-3">
                    <x-breadcrumb :items="[
                        ['label' => 'Franchise Verification', 'url' => route('pages.franchise')],
                        ['label' => $selectedFranchise ? 'Result: ' . ($selectedFranchise->franchise_id ?? $selectedFranchise->name) : 'Search Result']
                    ]" />
                </div>
                <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-white">
                    Franchise Partner Verification Results
                </h1>
            </div>
        </section>

        <!-- Result View: Certificate & Center Contact Desk -->
        <section class="py-8 sm:py-12 bg-slate-100/80 min-h-[85vh] print-page-wrapper">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 print-container" x-data="{ copyFeedback: false }">

                @if($selectedFranchise)
                    <!-- Centered Header -->
                    <div class="text-center mb-6 no-print">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 text-[#00a859] px-3.5 py-1 text-xs font-bold uppercase tracking-wider mb-2 border border-emerald-200">
                            <span class="h-2 w-2 rounded-full bg-[#00a859] animate-pulse"></span>
                            Verified Franchise Partner Credential
                        </span>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">
                            {{ $selectedFranchise->name }}
                        </h2>
                        <p class="mt-1.5 text-sm sm:text-base text-slate-600 font-medium">
                            Franchise Partner ID: <span class="font-extrabold text-slate-900 font-mono tracking-wide bg-white px-2.5 py-0.5 rounded border border-slate-300">{{ $selectedFranchise->franchise_id ?? 'SDIA-F-0013/2026' }}</span>
                        </p>
                    </div>

                    <!-- Action Bar (Back to Search & Print Certificate) -->
                    <div class="flex flex-wrap items-center justify-between gap-3 mb-6 no-print">
                        <a 
                            href="{{ route('pages.franchise') }}" 
                            style="background-color: #ffffff !important; color: #00a859 !important; border: 2px solid #00a859 !important;" 
                            class="inline-flex items-center gap-2 rounded-xl px-5 py-2.5 text-sm font-bold hover:bg-emerald-50 transition shadow-2xs cursor-pointer active:scale-95"
                        >
                            <i class="fa-solid fa-arrow-left"></i>
                            <span>Back to Search</span>
                        </a>

                        <div class="flex items-center gap-2">
                            @if($selectedFranchise->certificate_image_url)
                                <a 
                                    href="{{ $selectedFranchise->certificate_image_url }}" 
                                    target="_blank"
                                    download="SriDeekshaa-Franchise-Certificate-{{ $selectedFranchise->franchise_id ?? 'SDIA-Partner' }}.jpg"
                                    class="inline-flex items-center gap-1.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white px-4 py-2.5 text-xs sm:text-sm font-bold shadow-xs transition active:scale-95 cursor-pointer"
                                >
                                    <i class="fa-solid fa-download text-amber-400 text-xs"></i>
                                    <span>Download Certificate</span>
                                </a>
                            @endif

                            <button 
                                type="button" 
                                onclick="window.print()" 
                                style="background-color: #00a859 !important; color: #ffffff !important; border: 2px solid #00a859 !important;" 
                                class="inline-flex items-center gap-2 rounded-xl px-6 py-2.5 text-sm font-bold shadow-sm hover:opacity-95 transition active:scale-95 cursor-pointer"
                            >
                                <i class="fa-solid fa-print text-white text-sm"></i>
                                <span style="color: #ffffff !important;">Print Certificate</span>
                            </button>
                        </div>
                    </div>

                    <!-- ======================================================= -->
                    <!-- 1. ABOVE: FRANCHISE CERTIFICATE                         -->
                    <!-- ======================================================= -->
                    <div class="print-certificate-box mb-8">
                        @if($selectedFranchise->certificate_image_url)
                            <!-- Official High-Resolution Uploaded Certificate -->
                            <div class="rounded-3xl p-2 sm:p-4 bg-gradient-to-b from-amber-200 via-amber-400 to-amber-600 shadow-xl border-2 border-amber-400/90 max-w-3xl mx-auto">
                                <div class="relative rounded-2xl overflow-hidden bg-slate-950 border border-amber-300/60 shadow-inner group">
                                    <img 
                                        src="{{ $selectedFranchise->certificate_image_url }}" 
                                        alt="Franchise Partner Certificate - {{ $selectedFranchise->name }}" 
                                        class="w-full h-auto block select-none"
                                        loading="eager"
                                    >
                                </div>
                            </div>
                        @else
                            <!-- High-Fidelity Dynamic Digital Certificate for Any Partner -->
                            <div class="rounded-3xl p-2 sm:p-4 bg-gradient-to-b from-amber-200 via-amber-400 to-amber-600 shadow-xl border-2 border-amber-400 max-w-3xl mx-auto">
                                <div class="relative bg-gradient-to-b from-[#0B1B3D] via-[#07132a] to-[#040b18] text-white rounded-2xl border-4 border-amber-400/90 p-6 sm:p-10 overflow-hidden shadow-2xl">
                                    <!-- Background Radial Ambient Glow -->
                                    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(245,158,11,0.12)_0%,transparent_70%)] pointer-events-none"></div>
                                    <div class="absolute inset-2 border border-amber-300/30 rounded-xl pointer-events-none"></div>

                                    <!-- Corner Filigree Ornaments -->
                                    <div class="absolute top-4 left-4 w-10 h-10 border-t-2 border-l-2 border-amber-400/80 pointer-events-none"></div>
                                    <div class="absolute top-4 right-4 w-10 h-10 border-t-2 border-r-2 border-amber-400/80 pointer-events-none"></div>
                                    <div class="absolute bottom-4 left-4 w-10 h-10 border-b-2 border-l-2 border-amber-400/80 pointer-events-none"></div>
                                    <div class="absolute bottom-4 right-4 w-10 h-10 border-b-2 border-r-2 border-amber-400/80 pointer-events-none"></div>

                                    <!-- Header Crest & Institution Name -->
                                    <div class="text-center relative z-10 space-y-1.5">
                                        <div class="inline-flex items-center justify-center gap-2">
                                            <div class="h-12 w-12 rounded-full bg-gradient-to-br from-amber-300 to-amber-600 p-0.5 shadow-md flex items-center justify-center">
                                                <div class="h-full w-full rounded-full bg-slate-950 flex items-center justify-center text-amber-400 text-xl font-bold">
                                                    <i class="fa-solid fa-award"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="font-serif text-lg sm:text-2xl font-extrabold tracking-widest text-amber-300 uppercase">
                                            SRI DEEKSHAA INTERNATIONAL ACADEMY
                                        </h3>
                                        <p class="text-[11px] sm:text-xs tracking-widest text-slate-300 font-semibold uppercase">
                                            An ISO 9001:2015 Certified Educational Institution
                                        </p>
                                    </div>

                                    <!-- Certificate Ribbon Title -->
                                    <div class="my-5 text-center relative z-10">
                                        <div class="inline-block relative">
                                            <div class="bg-gradient-to-r from-amber-500 via-amber-400 to-amber-500 text-slate-950 px-6 py-2 rounded-md font-serif font-black text-xs sm:text-sm tracking-[0.2em] uppercase shadow-md border border-amber-200">
                                                FRANCHISE PARTNER ACKNOWLEDGEMENT
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Body Text & Partner Heading -->
                                    <div class="text-center relative z-10 my-5 sm:my-7 space-y-3">
                                        <p class="text-xs uppercase tracking-widest text-slate-300 font-semibold">
                                            THIS IS TO ACKNOWLEDGE THAT
                                        </p>

                                        <h2 class="font-serif text-2xl sm:text-4xl font-black text-white tracking-wide uppercase drop-shadow-md">
                                            {{ $selectedFranchise->name }}
                                        </h2>

                                        <p class="text-xs sm:text-sm text-slate-200 font-medium max-w-lg mx-auto leading-relaxed">
                                            is an Authorized Franchise Partner of <span class="text-amber-300 font-bold">Sri Deekshaa International Academy</span>.
                                        </p>

                                        <!-- Franchise ID Pill -->
                                        <div class="pt-1">
                                            <span class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-400 to-amber-500 text-slate-950 px-5 py-1.5 rounded-full font-mono font-extrabold text-xs sm:text-sm tracking-wider shadow-md border border-amber-300">
                                                <i class="fa-solid fa-shield-halved text-xs"></i>
                                                <span>FRANCHISE ID: {{ $selectedFranchise->franchise_id ?? 'SDIA-F-0013/2026' }}</span>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Certificate Footer Row -->
                                    <div class="mt-6 pt-4 border-t border-amber-400/40 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs tracking-wider relative z-10 text-slate-300">
                                        <div class="font-bold uppercase text-center sm:text-left">
                                            <span class="text-amber-400">YEAR OF PARTNERSHIP:</span> {{ $selectedFranchise->partnership_year ?? '2026' }}
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <div class="h-8 w-8 rounded-full border border-amber-400 flex items-center justify-center text-amber-400 text-xs font-bold bg-amber-400/10">
                                                <i class="fa-solid fa-stamp"></i>
                                            </div>
                                            <span class="font-bold text-amber-300 uppercase text-[10px]">AUTHORIZED FRANCHISE SEAL</span>
                                        </div>

                                        <div class="font-bold uppercase text-center sm:text-right text-amber-400">
                                            TOGETHER FOR A BRIGHTER TOMORROW
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- ======================================================= -->
                    <!-- 2. BELOW: CONTACT NUMBER AND ADDRESS (USER REQUIREMENT) -->
                    <!-- ======================================================= -->
                    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-md p-6 sm:p-10 space-y-8">
                        
                        <!-- Header Bar -->
                        <div class="flex items-center justify-between pb-4 border-b border-slate-200">
                            <div>
                                <span class="text-xs font-bold uppercase tracking-wider text-amber-600">
                                    Official Center Credentials
                                </span>
                                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 mt-0.5">
                                    Franchise Contact Number &amp; Campus Address
                                </h3>
                            </div>
                            <div class="flex items-center gap-1.5 font-bold text-xs sm:text-sm text-[#00a859]">
                                <i class="fa-solid fa-circle-check"></i>
                                <span>Accredited</span>
                            </div>
                        </div>

                        <!-- 2-Column Grid: Contact Desk on Left, Address & Map on Right -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                            
                            <!-- Left: Contact Details Desk -->
                            <div class="space-y-6 bg-slate-50 rounded-2xl p-6 border border-slate-200/80">
                                
                                <div class="flex items-center gap-3 pb-3 border-b border-slate-200">
                                    <div class="h-10 w-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-lg shrink-0">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-base">Contact Number</h4>
                                        <p class="text-xs text-slate-500">Direct branch desk &amp; admissions</p>
                                    </div>
                                </div>

                                <!-- Contact Number Callout -->
                                <div>
                                    <span class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">
                                        Campus Phone Desk
                                    </span>
                                    <a 
                                        href="tel:{{ preg_replace('/[^0-9+]/', '', $selectedFranchise->phone ?? '+91 93446 20346') }}" 
                                        class="inline-flex items-center gap-2 text-2xl sm:text-3xl font-black text-slate-900 hover:text-amber-600 transition tracking-tight font-mono"
                                    >
                                        <i class="fa-solid fa-phone text-emerald-600 text-xl"></i>
                                        <span>{{ $selectedFranchise->phone ?? '+91 93446 20346' }}</span>
                                    </a>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex flex-wrap items-center gap-3 pt-1">
                                    <a 
                                        href="tel:{{ preg_replace('/[^0-9+]/', '', $selectedFranchise->phone ?? '+91 93446 20346') }}" 
                                        class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs sm:text-sm shadow-xs transition active:scale-95"
                                    >
                                        <i class="fa-solid fa-phone text-amber-400"></i>
                                        <span>Call Center</span>
                                    </a>

                                    @php
                                        $wpNumber = preg_replace('/[^0-9]/', '', $selectedFranchise->phone ?? '919344620346');
                                        if (strlen($wpNumber) === 10) {
                                            $wpNumber = '91' . $wpNumber;
                                        }
                                        $wpText = urlencode("Hello " . $selectedFranchise->name . " (Franchise ID: " . ($selectedFranchise->franchise_id ?? 'SDIA-F-0013/2026') . "), I would like to inquire about courses and programs.");
                                    @endphp
                                    <a 
                                        href="https://wa.me/{{ $wpNumber }}?text={{ $wpText }}" 
                                        target="_blank" 
                                        rel="noopener noreferrer" 
                                        class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-[#25D366] hover:bg-[#20ba5a] text-white font-bold text-xs sm:text-sm shadow-xs transition active:scale-95"
                                    >
                                        <i class="fa-brands fa-whatsapp text-base"></i>
                                        <span>WhatsApp</span>
                                    </a>
                                </div>

                                <!-- Email & Working Hours -->
                                <div class="pt-3 border-t border-slate-200/80 space-y-2.5 text-xs text-slate-600">
                                    @if($selectedFranchise->email)
                                        <div class="flex items-center gap-2.5">
                                            <i class="fa-solid fa-envelope text-blue-600 text-sm shrink-0"></i>
                                            <div>
                                                <span class="font-bold text-slate-800">Email:</span>
                                                <a href="mailto:{{ $selectedFranchise->email }}" class="text-slate-700 hover:text-amber-600 ml-1">
                                                    {{ $selectedFranchise->email }}
                                                </a>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="flex items-center gap-2.5">
                                        <i class="fa-solid fa-clock text-amber-600 text-sm shrink-0"></i>
                                        <div>
                                            <span class="font-bold text-slate-800">Hours:</span>
                                            <span class="text-slate-700 ml-1">Mon &ndash; Sat: 9:00 AM &ndash; 7:30 PM</span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Right: Physical Campus Address & Map View -->
                            <div class="space-y-6 bg-slate-50 rounded-2xl p-6 border border-slate-200/80">
                                
                                <div class="flex items-center gap-3 pb-3 border-b border-slate-200">
                                    <div class="h-10 w-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-lg shrink-0">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-base">Center Address</h4>
                                        <p class="text-xs text-slate-500">Official registered campus premises</p>
                                    </div>
                                </div>

                                <!-- Physical Address Card -->
                                <div>
                                    <span class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">
                                        Physical Campus Location
                                    </span>
                                    <div class="p-3.5 rounded-xl bg-white border border-slate-200 text-sm leading-relaxed text-slate-800 shadow-2xs">
                                        <strong class="block text-slate-950 font-bold mb-0.5">{{ $selectedFranchise->name }}</strong>
                                        {{ $selectedFranchise->address ?? 'Plot No. 18, 3rd Cross Street, JP Academy Campus, Velachery Main Road' }},
                                        <br>
                                        {{ $selectedFranchise->city ?? 'Chennai' }}, {{ $selectedFranchise->state ?? 'Tamil Nadu' }} &ndash; <strong class="font-mono text-slate-900">{{ $selectedFranchise->pincode ?? '600042' }}</strong>.
                                    </div>
                                </div>

                                <!-- Map Preview & Navigation Button -->
                                <div>
                                    <div class="aspect-video w-full rounded-xl overflow-hidden bg-slate-200 border border-slate-300 shadow-inner mb-2.5">
                                        <iframe 
                                            src="{{ $selectedFranchise->effective_map_url }}" 
                                            class="w-full h-full border-0" 
                                            allowfullscreen="" 
                                            loading="lazy" 
                                            referrerpolicy="no-referrer-when-downgrade" 
                                            title="{{ $selectedFranchise->name }} Location Map"
                                        ></iframe>
                                    </div>

                                    <a 
                                        href="{{ $selectedFranchise->directions_url }}" 
                                        target="_blank" 
                                        rel="noopener noreferrer" 
                                        class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs sm:text-sm shadow-xs transition active:scale-95"
                                    >
                                        <i class="fa-solid fa-diamond-turn-right text-sm"></i>
                                        <span>Get Directions on Google Maps</span>
                                    </a>
                                </div>

                            </div>

                        </div>

                        <!-- Card Footer: Verification Published Status -->
                        <div class="pt-4 border-t border-slate-200 flex items-center justify-between text-xs sm:text-sm text-slate-500">
                            <div class="flex items-center gap-1.5 font-bold text-[#00a859]">
                                <i class="fa-solid fa-shield-check"></i>
                                <span>Verified Partner Record</span>
                            </div>
                            <div>
                                Partnership Year: <strong class="text-slate-800">{{ $selectedFranchise->partnership_year ?? '2026' }}</strong>
                            </div>
                        </div>

                    </div>

                @else
                    <!-- Franchise ID Not Found -->
                    <div class="text-center mb-7 no-print">
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">
                            Franchise Partner Verification Results
                        </h1>
                        <p class="mt-2 text-sm sm:text-base text-slate-600 font-medium">
                            Franchise Identification Number: <span class="font-extrabold text-slate-900 font-mono">{{ $queryCode }}</span>
                        </p>
                    </div>

                    <div class="mb-6 no-print flex items-center justify-between gap-4">
                        <a 
                            href="{{ route('pages.franchise') }}" 
                            style="background-color: #ffffff !important; color: #00a859 !important; border: 2px solid #00a859 !important;" 
                            class="inline-flex items-center gap-1.5 rounded-lg border-2 bg-white px-5 py-2 text-sm font-semibold hover:bg-emerald-50 transition shadow-xs cursor-pointer"
                        >
                            <i class="fa-solid fa-arrow-left text-xs"></i>
                            Back to Search
                        </a>
                    </div>

                    <div class="rounded-2xl bg-white border border-rose-200 shadow-sm p-8 sm:p-12 text-center space-y-4">
                        <div class="h-14 w-14 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center mx-auto text-xl font-bold border border-rose-200">
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                        <h2 class="text-xl font-bold text-slate-900">Franchise Partner Record Not Found</h2>
                        <p class="text-sm text-slate-600 max-w-md mx-auto">
                            No credential record matches franchise ID &ldquo;<strong class="font-mono text-slate-900">{{ $queryCode }}</strong>&rdquo;. Please verify the identification code or contact academy records desk.
                        </p>
                        <div class="pt-3 flex flex-wrap items-center justify-center gap-3">
                            <a 
                                href="{{ route('pages.franchise') }}" 
                                class="rounded-xl bg-slate-900 hover:bg-slate-800 text-white px-5 py-2.5 text-sm font-semibold transition shadow-xs"
                            >
                                Try Another Search
                            </a>
                            <x-whatsapp-btn label="Contact Academy Records Desk" size="sm" />
                        </div>
                    </div>
                @endif

            </div>
        </section>

    @else
        <!-- ======================================================= -->
        <!-- SEARCH VIEW (WHEN NOT SEARCHED YET - NO CARDS!)         -->
        <!-- ======================================================= -->
        <!-- Header Banner -->
        <section class="bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-white pt-10 pb-12 sm:pt-14 sm:pb-16 relative overflow-hidden border-b border-slate-800/80">
            <!-- Background Ambient Glow & Grid -->
            <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:20px_20px]"></div>
            <div class="absolute top-0 right-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 left-1/3 w-80 h-80 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                <!-- Centered Breadcrumbs -->
                <div class="flex justify-center mb-4 sm:mb-5">
                    <x-breadcrumb :items="[['label' => 'Franchise Partner Verification']]" />
                </div>

                <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight">
                    Verify Franchise Partner
                </h1>

                <p class="mt-4 text-base sm:text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed">
                    Verify the authenticity of authorized franchise partner accreditation certificates, center licenses, and official campus contact desks issued by Sri Deekshaa International Academy.
                </p>
            </div>
        </section>

        <!-- Verification Search Form -->
        <section class="py-12 sm:py-16 bg-slate-50 min-h-[60vh]">
            <div class="max-w-3xl mx-auto px-4 sm:px-6">
                
                <div class="rounded-3xl bg-white p-6 sm:p-10 border border-slate-200/80 shadow-md">
                    <form 
                        action="{{ route('pages.franchise') }}" 
                        method="GET" 
                        onsubmit="
                            var code = this.franchise_id.value.trim().replace(/[\/\s]/g, '-');
                            if (code) {
                                event.preventDefault();
                                window.location.href = '{{ url('/franchise/verify') }}/' + encodeURIComponent(code);
                            }
                        "
                        class="space-y-4"
                    >
                        <label class="block text-sm font-bold text-slate-900">
                            Enter Franchise Identification Number
                        </label>
                        
                        <div class="flex flex-col sm:flex-row gap-3">
                            <input 
                                type="text" 
                                name="franchise_id" 
                                value="{{ $queryCode ?? '' }}" 
                                required 
                                placeholder="e.g. SDIA-F-0013/2026" 
                                class="flex-1 rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-base font-mono text-slate-900 focus:bg-white focus:outline-none focus:border-amber-500 uppercase"
                            >
                            <button 
                                type="submit" 
                                class="rounded-2xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold px-8 py-3 text-sm shadow-md transition active:scale-95 cursor-pointer"
                            >
                                Verify Franchise
                            </button>
                        </div>
                        <div class="text-sm text-slate-500 pt-1">
                            <span>The franchise ID is printed on the physical partner acknowledgement certificate (e.g., <strong class="font-mono text-slate-700">SDIA-F-0013/2026</strong>).</span>
                        </div>
                    </form>

                    <!-- Quick Sample ID for testing / demonstration -->
                    <div class="mt-8 pt-6 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3 text-xs text-slate-500">
                        <span>Sample Partner ID:</span>
                        <a 
                            href="{{ route('pages.franchise.verify', ['code' => 'SDIA-F-0013-2026']) }}" 
                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 border border-amber-200 text-amber-800 font-mono font-bold hover:bg-amber-100 transition"
                        >
                            <i class="fa-solid fa-certificate text-amber-600"></i>
                            <span>SDIA-F-0013-2026 (JP ACADEMY)</span>
                        </a>
                    </div>
                </div>

            </div>
        </section>
    @endif
</x-layouts.app>
