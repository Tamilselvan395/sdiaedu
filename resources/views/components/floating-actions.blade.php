@php
    $whatsappNumber = $globalSettings['whatsapp_number'] ?? \App\Models\Setting::get('whatsapp_number', '919876543210');
    $phone = $globalSettings['phone'] ?? \App\Models\Setting::get('phone', '+91 98765 43210');
    $cleanPhone = preg_replace('/[^0-9+]/', '', $phone);
    $whatsappMessage = $globalSettings['whatsapp_default_message'] ?? \App\Models\Setting::get('whatsapp_default_message', 'Hello Sri Deekshaa International Academy, I would like to know more about your courses and admission process.');
    $whatsappUrl = "https://wa.me/" . preg_replace('/[^0-9]/', '', $whatsappNumber) . "?text=" . rawurlencode($whatsappMessage);
@endphp

<!-- Floating Action Group: Enquire Form, Phone Call, WhatsApp Chat (Identical uniform size: 48px mobile / 52px desktop) -->
<div 
    x-data="{ modalOpen: false }"
    @open-enquiry-modal.window="modalOpen = true"
    @close-enquiry-modal.window="modalOpen = false"
    @keydown.escape.window="modalOpen = false"
    x-show="!modalOpen"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-90 translate-y-2"
    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90 translate-y-2"
    class="fixed bottom-6 right-6 z-40 hidden sm:flex flex-col items-end gap-3 print:hidden"
    x-cloak
>

    <!-- 1. Enquire Form Floating Button (Same Size) -->
    <div class="relative group flex items-center">
        <span class="pointer-events-none absolute right-full mr-3 whitespace-nowrap rounded-xl bg-slate-900/90 backdrop-blur-md px-3 py-1.5 text-xs font-semibold text-white shadow-xl opacity-0 translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition duration-200">
            Quick Enquiry
        </span>
        <button 
            type="button" 
            @click="$dispatch('open-enquiry-modal', {})"
            class="flex h-12 w-12 sm:h-13 sm:w-13 items-center justify-center rounded-full bg-gradient-to-tr from-amber-500 to-amber-400 hover:from-amber-600 hover:to-amber-500 text-slate-950 shadow-lg shadow-amber-500/30 hover:scale-110 active:scale-95 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-amber-300/40 cursor-pointer"
            aria-label="Open Quick Enquiry Form"
        >
            <i class="fa-solid fa-file-signature text-base sm:text-lg"></i>
        </button>
    </div>

    <!-- 2. Phone Call Floating Button (Same Size) -->
    <div class="relative group flex items-center">
        <span class="pointer-events-none absolute right-full mr-3 whitespace-nowrap rounded-xl bg-slate-900/90 backdrop-blur-md px-3 py-1.5 text-xs font-semibold text-white shadow-xl opacity-0 translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition duration-200">
            Call: {{ $phone }}
        </span>
        <a 
            href="tel:{{ $cleanPhone }}" 
            class="flex h-12 w-12 sm:h-13 sm:w-13 items-center justify-center rounded-full bg-gradient-to-tr from-sky-600 to-blue-500 hover:from-sky-700 hover:to-blue-600 text-white shadow-lg shadow-sky-600/30 hover:scale-110 active:scale-95 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-sky-300/40"
            aria-label="Call Sri Deekshaa Academy"
        >
            <i class="fa-solid fa-phone text-base"></i>
        </a>
    </div>

    <!-- 3. WhatsApp Chat Floating Button (Same Size) -->
    <div class="relative group flex items-center">
        <span class="pointer-events-none absolute right-full mr-3 whitespace-nowrap rounded-xl bg-slate-900/90 backdrop-blur-md px-3 py-1.5 text-xs font-semibold text-white shadow-xl opacity-0 translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition duration-200">
            Chat on WhatsApp
        </span>
        <a 
            href="{{ $whatsappUrl }}" 
            target="_blank" 
            rel="noopener noreferrer"
            class="flex h-12 w-12 sm:h-13 sm:w-13 items-center justify-center rounded-full bg-emerald-500 hover:bg-emerald-600 text-white shadow-2xl shadow-emerald-500/40 hover:scale-110 active:scale-95 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-emerald-300/50 relative"
            aria-label="Chat with Us on WhatsApp"
        >
            <i class="fa-brands fa-whatsapp text-2xl sm:text-[26px]"></i>
            <!-- Active pulse indicator dot -->
            <span class="absolute -top-0.5 -right-0.5 flex h-3.5 w-3.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-emerald-600 border-2 border-white"></span>
            </span>
        </a>
    </div>

</div>
