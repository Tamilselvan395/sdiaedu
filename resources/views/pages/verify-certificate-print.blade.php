<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Examination Result - {{ $certificate->certificate_number }} | Sri Deekshaa International Academy</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @page {
            size: A4 portrait;
            margin: 12mm 15mm;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background: #ffffff !important;
                color: #000000 !important;
                margin: 0 !important;
                padding: 0 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .certificate-container {
                box-shadow: none !important;
                border: 1.5px solid #00a859 !important;
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 auto !important;
                page-break-inside: avoid !important;
            }
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased min-h-screen py-6 sm:py-10">

    <!-- Top Screen Action Bar (Hidden when printed) -->
    <div class="max-w-4xl mx-auto px-4 mb-6 no-print">
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-200 flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <a 
                    href="{{ route('pages.verify-certificate', ['certificate_number' => $certificate->certificate_number]) }}" 
                    class="inline-flex items-center gap-1.5 rounded-xl border border-slate-300 hover:bg-slate-50 text-slate-700 px-4 py-2 text-sm font-semibold transition"
                >
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    Back to Portal
                </a>
                <span class="text-sm text-slate-500 hidden sm:inline">
                    Enrollment ID: <strong class="text-slate-800 font-mono">{{ $certificate->certificate_number }}</strong>
                </span>
            </div>

            <div class="flex items-center gap-2">
                <button 
                    type="button" 
                    onclick="window.print()" 
                    class="inline-flex items-center gap-2 rounded-xl bg-[#00a859] hover:bg-[#00924c] text-white px-5 py-2 text-sm font-semibold shadow-md transition active:scale-95 cursor-pointer"
                >
                    <i class="fa-solid fa-print text-sm"></i>
                    Print / Save as PDF
                </button>
            </div>
        </div>
        <p class="text-xs text-slate-500 mt-2 text-center">
            Tip: In your browser print dialog, choose <strong class="text-slate-700">Destination: Save as PDF</strong> to generate an official digital copy. Ensure <em>"Background graphics"</em> is checked.
        </p>
    </div>

    <!-- Official Printable Certificate Document -->
    <div class="max-w-4xl mx-auto px-4">
        <div class="certificate-container relative bg-white rounded-2xl border border-slate-300 shadow-lg p-6 sm:p-12 text-slate-800">
            
            <!-- Top-Left Corner Green L-Bracket -->
            <div class="absolute top-5 left-5 w-12 h-12 border-t-[3.5px] border-l-[3.5px] border-[#00a859] pointer-events-none"></div>

            <!-- Bottom-Right Corner Green L-Bracket -->
            <div class="absolute bottom-5 right-5 w-12 h-12 border-b-[3.5px] border-r-[3.5px] border-[#00a859] pointer-events-none"></div>

            <!-- Examination Result Heading -->
            <div class="text-center pt-2 mb-8">
                <h1 class="font-serif text-2xl sm:text-3xl font-extrabold tracking-[0.22em] text-[#1a2b49] uppercase">
                    EXAMINATION RESULT
                </h1>
                <p class="text-sm font-semibold tracking-wider text-slate-500 uppercase mt-2">
                    {{ $certificate->formatted_exam_session }}
                </p>
            </div>

            <!-- Detail Rows with Dotted Lines -->
            <div class="space-y-0 text-sm border-t border-slate-200">
                <div class="flex items-center justify-between py-2.5 border-b border-dotted border-slate-300">
                    <span class="text-slate-600 font-medium">Student Name:</span>
                    <span class="font-bold text-slate-900 uppercase tracking-wide">
                        {{ strtoupper($certificate->student->full_name ?? ($certificate->student->first_name . ' ' . $certificate->student->last_name)) }}
                    </span>
                </div>

                <div class="flex items-center justify-between py-2.5 border-b border-dotted border-slate-300">
                    <span class="text-slate-600 font-medium">Course:</span>
                    <span class="font-bold text-slate-900 uppercase tracking-wide text-right max-w-lg">
                        {{ $certificate->static_course_title }}
                    </span>
                </div>

                <div class="flex items-center justify-between py-2.5 border-b border-dotted border-slate-300">
                    <span class="text-slate-600 font-medium">Total Marks:</span>
                    <span class="font-bold text-slate-900">{{ $certificate->formatted_total_marks }}</span>
                </div>

                <div class="flex items-center justify-between py-2.5 border-b border-dotted border-slate-300">
                    <span class="text-slate-600 font-medium">Percentage:</span>
                    <span class="font-bold text-slate-900">{{ $certificate->formatted_percentage }}</span>
                </div>

                <div class="flex items-center justify-between py-2.5 border-b border-dotted border-slate-300">
                    <span class="text-slate-600 font-medium">Division:</span>
                    <span class="font-bold text-slate-900">{{ $certificate->formatted_division }}</span>
                </div>

                <div class="flex items-center justify-between py-2.5 border-b border-dotted border-slate-300">
                    <span class="text-slate-600 font-medium">Status:</span>
                    <span class="font-bold text-[#00a859] uppercase tracking-wider">{{ $certificate->result_status ?? 'PASSED' }}</span>
                </div>
            </div>

            <!-- Subject-Wise Marks Section -->
            <div class="mt-8">
                <h2 class="font-serif text-center text-sm sm:text-base font-bold tracking-[0.2em] text-[#1a2b49] uppercase mb-4">
                    SUBJECT-WISE MARKS
                </h2>

                <div class="overflow-x-auto rounded-xl border border-slate-200">
                    <table class="w-full text-left text-sm">
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
                                    <td class="py-3 px-4 sm:px-6 font-bold text-slate-900 text-center">{{ $sub['obtained'] }}</td>
                                    <td class="py-3 px-4 sm:px-6 text-slate-600 text-center">{{ $sub['maximum'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Card Footer: Verified Status & Date -->
            <div class="mt-8 pt-4 border-t border-slate-200 flex items-center justify-between text-sm">
                <div class="flex items-center gap-1.5 text-[#00a859] font-bold">
                    <i class="fa-solid fa-circle-check text-base"></i>
                    <span>Verified</span>
                </div>

                <div class="text-slate-500 font-medium">
                    Published: {{ $certificate->issue_date ? $certificate->issue_date->format('d M Y') : '15 Nov 2024' }}
                </div>
            </div>

        </div>
    </div>

    @if(request()->query('autoprint') === '1')
        <script>
            window.addEventListener('load', function() {
                setTimeout(function() {
                    window.print();
                }, 500);
            });
        </script>
    @endif

</body>
</html>
