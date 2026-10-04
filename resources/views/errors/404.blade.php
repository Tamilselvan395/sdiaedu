<x-layouts.app title="Page Not Found (404)">
    @push('head')
        <meta name="robots" content="noindex, follow">
    @endpush

    <section class="min-h-[70vh] flex items-center justify-center py-16 px-4 sm:px-6 lg:px-8 bg-slate-900 text-white relative overflow-hidden">
        <!-- Background Ambient Glow -->
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:24px_24px]"></div>
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-2xl w-full text-center relative z-10 space-y-8">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full bg-amber-500/15 px-4 py-1.5 text-xs font-bold text-amber-400 uppercase tracking-widest border border-amber-500/30 mb-6">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    Error 404
                </span>
                <h1 class="text-7xl sm:text-9xl font-extrabold tracking-tight text-white mb-4">
                    4<span class="text-amber-500">0</span>4
                </h1>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-100 mb-3">
                    Oops! This Page Wandered Off
                </h2>
                <p class="text-slate-400 text-sm sm:text-base max-w-lg mx-auto leading-relaxed">
                    The skill course or page you are searching for might have been moved, renamed, or is currently taking a break. Let's get you back on track!
                </p>
            </div>

            <!-- Quick Action Links -->
            <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-4">
                <a 
                    href="{{ route('home') }}" 
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-amber-500 px-6 py-3 text-sm font-bold text-slate-950 hover:bg-amber-400 transition shadow-lg shadow-amber-500/20"
                >
                    <i class="fa-solid fa-house text-xs"></i>
                    Return Home
                </a>
                <a 
                    href="{{ route('courses.index') }}" 
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-800 hover:bg-slate-700 px-6 py-3 text-sm font-semibold text-white border border-slate-700 transition"
                >
                    <i class="fa-solid fa-graduation-cap text-xs"></i>
                    Explore Courses
                </a>
                <a 
                    href="{{ route('pages.assessment') }}" 
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-800 hover:bg-slate-700 px-6 py-3 text-sm font-semibold text-amber-400 border border-slate-700 transition"
                >
                    <i class="fa-solid fa-clipboard-question text-xs"></i>
                    Skill Assessment
                </a>
            </div>

            <!-- Academy Helpline -->
            <div class="pt-6 border-t border-slate-800/80 text-xs text-slate-400 flex items-center justify-center gap-2">
                <span>Need assistance? Reach our student counselors at</span>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone ?? '+919876543210') }}" class="text-amber-400 font-semibold hover:underline">
                    {{ $phone ?? '+91 98765 43210' }}
                </a>
            </div>
        </div>
    </section>

    <!-- Automated 404 Event Monitoring -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                event: 'page_not_found',
                error_code: 404,
                page_url: window.location.href,
                page_path: window.location.pathname,
                referrer: document.referrer || 'direct'
            });

            if (typeof gtag === 'function') {
                gtag('event', 'page_not_found', {
                    page_path: window.location.pathname,
                    page_location: window.location.href,
                    referrer: document.referrer || 'direct'
                });
            }
        });
    </script>
</x-layouts.app>
