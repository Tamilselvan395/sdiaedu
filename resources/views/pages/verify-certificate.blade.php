<x-layouts.app 
    title="{{ ($searched && $certificate) ? 'Certificate Results - ' . $certificate->certificate_number . ' | Sri Deekshaa International Academy' : ($globalSettings['seo_verify_title'] ?? 'Verify Student Certificate | Sri Deekshaa International Academy') }}" 
    metaDescription="{{ ($searched && $certificate) ? 'Official examination credential verification for ' . ($certificate->student->full_name ?? 'Student') . ' - Sri Deekshaa International Academy.' : ($globalSettings['seo_verify_description'] ?? 'Official online certificate verification portal for Sri Deekshaa International Academy graduates. Verify course credentials instantly.') }}"
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
            }
            .print-container {
                padding: 0 !important;
                margin: 0 !important;
                max-width: 100% !important;
                width: 100% !important;
            }
            #certificate-mark-sheet {
                border: 1.5px solid #00a859 !important;
                box-shadow: none !important;
                margin: 0 auto !important;
                width: 100% !important;
                max-width: 100% !important;
                page-break-inside: avoid !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .print-table {
                width: 100% !important;
                border-collapse: collapse !important;
            }
        }
    </style>

    @if($searched)
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
                        ['label' => 'Verify Certificate', 'url' => route('pages.verify-certificate')],
                        ['label' => $certificate ? 'Result: ' . $certificate->certificate_number : 'Search Result']
                    ]" />
                </div>
                <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-white">
                    Certificate Verification Results
                </h1>
            </div>
        </section>

        <!-- ======================================================= -->
        <!-- CERTIFICATE RESULT VIEW (EXACT ENHANCED REFERENCE UI)   -->
        <!-- ======================================================= -->
        <section class="py-8 sm:py-12 bg-slate-100/70 min-h-[85vh] print-page-wrapper">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 print-container" x-data="{ copyFeedback: false }">

                @if($certificate)
                    <!-- Centered Page Header (Matches competitor CEED style) -->
                    <div class="text-center mb-6 no-print">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 text-[#00a859] px-3.5 py-1 text-xs font-bold uppercase tracking-wider mb-2 border border-emerald-200">
                            <span class="h-2 w-2 rounded-full bg-[#00a859] animate-pulse"></span>
                            Verified Credential Record
                        </span>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">
                            Certificate Verification Results
                        </h1>
                        <p class="mt-1.5 text-sm sm:text-base text-slate-600 font-medium">
                            Enrollment Number: <span class="font-extrabold text-slate-900 font-mono tracking-wide">{{ $certificate->certificate_number }}</span>
                        </p>
                    </div>

                    <!-- Action Bar (Matches competitor CEED style exactly: Back to Search & Print Certificate) -->
                    <div class="flex items-center justify-between gap-4 mb-6 no-print">
                        <a 
                            href="{{ route('pages.verify-certificate') }}" 
                            style="background-color: #ffffff !important; color: #00a859 !important; border: 2px solid #00a859 !important;" 
                            class="inline-flex items-center gap-2 rounded-xl px-5 py-2.5 text-sm font-bold hover:bg-emerald-50 transition shadow-2xs cursor-pointer active:scale-95"
                        >
                            <i class="fa-solid fa-arrow-left"></i>
                            <span>Back to Search</span>
                        </a>

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

                    <!-- Mark Sheet Card (Matches exact design from uploaded images) -->
                    <div id="certificate-mark-sheet" class="relative bg-white rounded-2xl border border-slate-200/90 shadow-md p-6 sm:p-12 text-slate-800">
                        
                        <!-- Top-Left Corner Green L-Bracket (Matches reference image) -->
                        <div class="absolute top-5 left-5 w-12 h-12 pointer-events-none" style="border-top: 3.5px solid #00a859 !important; border-left: 3.5px solid #00a859 !important;"></div>

                        <!-- Bottom-Right Corner Green L-Bracket (Matches reference image) -->
                        <div class="absolute bottom-5 right-5 w-12 h-12 pointer-events-none" style="border-bottom: 3.5px solid #00a859 !important; border-right: 3.5px solid #00a859 !important;"></div>

                        <!-- Card Title: Centered serif EXAMINATION RESULT + session -->
                        <div class="text-center pt-2 mb-8">
                            <h2 class="font-serif text-2xl sm:text-3xl font-extrabold tracking-[0.22em] text-[#1a2b49] uppercase">
                                EXAMINATION RESULT
                            </h2>
                            <p class="text-sm font-semibold tracking-wider text-slate-500 uppercase mt-2">
                                {{ $certificate->formatted_exam_session }}
                            </p>
                        </div>

                        <!-- Dotted Detail Rows (Matches reference image structure) -->
                        <div class="space-y-0 text-sm border-t border-slate-200">
                            <div class="flex items-center justify-between py-2.5 border-b border-dotted border-slate-300">
                                <span class="text-slate-600 font-medium">Student Name:</span>
                                <span class="font-bold text-slate-900 uppercase tracking-wide">
                                    {{ strtoupper($certificate->student->full_name ?? ($certificate->student->first_name . ' ' . $certificate->student->last_name)) }}
                                </span>
                            </div>

                            <div class="flex items-center justify-between py-2.5 border-b border-dotted border-slate-300">
                                <span class="text-slate-600 font-medium">Course:</span>
                                <span class="font-bold text-slate-900 uppercase tracking-wide text-right max-w-md sm:max-w-lg">
                                    {{ $certificate->static_course_title }}
                                </span>
                            </div>

                            <div class="flex items-center justify-between py-2.5 border-b border-dotted border-slate-300">
                                <span class="text-slate-600 font-medium">Total Marks:</span>
                                <span class="font-bold text-slate-900 font-mono">{{ $certificate->formatted_total_marks }}</span>
                            </div>

                            <div class="flex items-center justify-between py-2.5 border-b border-dotted border-slate-300">
                                <span class="text-slate-600 font-medium">Percentage:</span>
                                <span class="font-bold text-slate-900 font-mono">{{ $certificate->formatted_percentage }}</span>
                            </div>

                            <div class="flex items-center justify-between py-2.5 border-b border-dotted border-slate-300">
                                <span class="text-slate-600 font-medium">Division:</span>
                                <span class="font-bold text-slate-900">{{ $certificate->formatted_division }}</span>
                            </div>

                            <div class="flex items-center justify-between py-2.5 border-b border-dotted border-slate-300">
                                <span class="text-slate-600 font-medium">Status:</span>
                                <span class="font-bold uppercase tracking-wider" style="color: #00a859 !important;">{{ $certificate->result_status ?? 'PASSED' }}</span>
                            </div>
                        </div>

                        <!-- Subject-Wise Marks Section -->
                        <div class="mt-9">
                            <h3 class="font-serif text-center text-sm sm:text-base font-bold tracking-[0.2em] text-[#1a2b49] uppercase mb-5">
                                SUBJECT-WISE MARKS
                            </h3>

                            <div class="overflow-x-auto rounded-xl border border-slate-200">
                                <table class="w-full text-left text-sm print-table">
                                    <thead class="bg-slate-50 border-b border-slate-200 text-slate-700 font-bold uppercase text-xs tracking-wider">
                                        <tr>
                                            <th class="py-3 px-4 sm:px-6">SUBJECT</th>
                                            <th class="py-3 px-4 sm:px-6 text-center w-28 sm:w-36">OBTAINED</th>
                                            <th class="py-3 px-4 sm:px-6 text-center w-28 sm:w-36">MAXIMUM</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200">
                                        @foreach($certificate->formatted_subject_marks as $sub)
                                             <tr class="hover:bg-slate-50/50 transition">
                                                <td class="py-3 px-4 sm:px-6 font-medium text-slate-800 uppercase">{{ $sub['subject'] }}</td>
                                                <td class="py-3 px-4 sm:px-6 font-bold text-slate-900 text-center font-mono">{{ $sub['obtained'] }}</td>
                                                <td class="py-3 px-4 sm:px-6 text-slate-600 text-center font-mono">{{ $sub['maximum'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Card Footer: Verified Status & Published Date (Matches reference image) -->
                        <div class="mt-8 pt-4 border-t border-slate-200 flex items-center justify-between text-sm">
                            <div class="flex items-center gap-1.5 font-bold" style="color: #00a859 !important;">
                                <i class="fa-solid fa-check text-sm font-bold" style="color: #00a859 !important;"></i>
                                <span class="font-bold" style="color: #00a859 !important;">Verified</span>
                            </div>

                            <div class="text-slate-500 font-medium">
                                Published: {{ $certificate->issue_date ? $certificate->issue_date->format('d M Y') : '15 Nov 2024' }}
                            </div>
                        </div>

                    </div>

                @else
                    <!-- Certificate Not Found -->
                    <div class="text-center mb-7 no-print">
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">
                            Certificate Verification Results
                        </h1>
                        <p class="mt-2 text-sm sm:text-base text-slate-600 font-medium">
                            Enrollment Number: <span class="font-extrabold text-slate-900 font-mono">{{ $queryNumber }}</span>
                        </p>
                    </div>

                    <div class="mb-6 no-print flex items-center justify-between gap-4">
                        <a 
                            href="{{ route('pages.verify-certificate') }}" 
                            class="inline-flex items-center gap-1.5 rounded-lg border-2 border-[#00a859] bg-white px-5 py-2 text-sm font-semibold text-[#00a859] hover:bg-emerald-50 transition shadow-xs cursor-pointer"
                        >
                            <i class="fa-solid fa-arrow-left text-xs"></i>
                            Back to Search
                        </a>
                    </div>

                    <div class="rounded-2xl bg-white border border-rose-200 shadow-sm p-8 sm:p-12 text-center space-y-4">
                        <div class="h-14 w-14 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center mx-auto text-xl font-bold border border-rose-200">
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                        <h2 class="text-xl font-bold text-slate-900">Certificate Not Found</h2>
                        <p class="text-sm text-slate-600 max-w-md mx-auto">
                            No credential record matches enrollment code "<strong class="font-mono text-slate-900">{{ $queryNumber }}</strong>". Please verify the code or contact the academy records desk.
                        </p>
                        <div class="pt-3 flex flex-wrap items-center justify-center gap-3">
                            <a 
                                href="{{ route('pages.verify-certificate') }}" 
                                class="rounded-xl bg-slate-900 hover:bg-slate-800 text-white px-5 py-2.5 text-sm font-semibold transition shadow-xs"
                            >
                                Try Another Search
                            </a>
                            <x-whatsapp-btn label="Contact Academy Desk" size="sm" />
                        </div>
                    </div>
                @endif

            </div>
        </section>

    @else
        <!-- ======================================================= -->
        <!-- SEARCH VIEW (WHEN NOT SEARCHED YET)                     -->
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
                    <x-breadcrumb :items="[['label' => 'Verify Certificate']]" />
                </div>

                <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight">
                    Verify Student Certificate
                </h1>

                <p class="mt-4 text-base sm:text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed">
                    Verify the authenticity of examination credentials, graduation diplomas, and achievement certificates issued by Sri Deekshaa International Academy.
                </p>
            </div>
        </section>

        <!-- Verification Search Form -->
        <section class="py-12 sm:py-16 bg-slate-50">
            <div class="max-w-3xl mx-auto px-4 sm:px-6">
                
                <div class="rounded-3xl bg-white p-6 sm:p-10 border border-slate-200/80 shadow-md">
                    <form 
                        action="{{ route('pages.verify-certificate') }}" 
                        method="GET" 
                        onsubmit="
                            var code = this.certificate_number.value.trim();
                            if (code) {
                                event.preventDefault();
                                window.location.href = '{{ url('/verify-certificate/results') }}/' + encodeURIComponent(code);
                            }
                        "
                        class="space-y-4"
                    >
                        <label class="block text-sm font-bold text-slate-900">
                            Enter Certificate Identification Number
                        </label>
                        
                        <div class="flex flex-col sm:flex-row gap-3">
                            <input 
                                type="text" 
                                name="certificate_number" 
                                value="{{ $queryNumber ?? '' }}" 
                                required 
                                placeholder="e.g. SDIA-2026-ABA-01 or SDIA-2026-VM-02" 
                                class="flex-1 rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-base font-mono text-slate-900 focus:bg-white focus:outline-none focus:border-amber-500 uppercase"
                            >
                            <button 
                                type="submit" 
                                class="rounded-2xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold px-8 py-3 text-sm shadow-md transition active:scale-95 cursor-pointer"
                            >
                                Verify Credential
                            </button>
                        </div>
                        <div class="text-sm text-slate-500 pt-1">
                            <span>The certificate ID is printed on the physical credential or issued marksheet.</span>
                        </div>
                    </form>

                    <!-- Static Accredited Programs Directory -->
                    @if(!empty($staticCourses))
                        <div class="mt-10 pt-8 border-t border-slate-100">
                            <div class="text-center max-w-xl mx-auto mb-6">
                                <span class="text-xs font-bold uppercase tracking-wider text-amber-600 bg-amber-50 px-3 py-1 rounded-full border border-amber-200">
                                    Official Certification Directory
                                </span>
                                <h3 class="text-lg font-bold text-slate-900 mt-2">
                                    Accredited Programs under Academy Registry
                                </h3>
                                <p class="text-sm text-slate-500 mt-1">
                                    Standardized course tracks verifiable through our digital credentials service.
                                </p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach($staticCourses as $id => $title)
                                    <div class="flex items-center gap-2.5 p-3 rounded-xl bg-slate-50 border border-slate-200/80">
                                        <span class="h-2 w-2 rounded-full bg-[#00a859] shrink-0"></span>
                                        <span class="text-sm font-medium text-slate-800">{{ $title }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

            </div>
        </section>
    @endif
</x-layouts.app>