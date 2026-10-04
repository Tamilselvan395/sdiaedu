@props([
    'message' => null,
    'course' => null,
    'label' => 'Chat on WhatsApp',
    'class' => '',
    'floating' => false,
    'size' => 'md',
])

@php
    $whatsappNumber = $globalSettings['whatsapp_number'] ?? \App\Models\Setting::get('whatsapp_number', '919876543210');
    
    if (!$message) {
        if ($course) {
            $courseTitle = is_object($course) ? $course->title : $course;
            $message = "Hello Sri Deekshaa International Academy, I am interested in the {$courseTitle} course. Please share more details.";
        } else {
            $message = $globalSettings['whatsapp_default_message'] ?? "Hello Sri Deekshaa International Academy, I would like to know more about your courses and admission process.";
        }
    }
    
    $whatsappUrl = "https://wa.me/" . preg_replace('/[^0-9]/', '', $whatsappNumber) . "?text=" . rawurlencode($message);
@endphp

@if($floating)
    <x-floating-actions />
@else
    <a 
        href="{{ $whatsappUrl }}" 
        target="_blank" 
        rel="noopener noreferrer" 
        class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-medium shadow-sm transition active:scale-95 {{ $size === 'sm' ? 'px-3 py-1.5 text-xs' : ($size === 'lg' ? 'px-6 py-3.5 text-base font-semibold' : 'px-4 py-2.5 text-sm') }} {{ $class }}"
    >
        <i class="fa-brands fa-whatsapp {{ $size === 'sm' ? 'text-xs' : ($size === 'lg' ? 'text-lg' : 'text-sm') }} shrink-0"></i>
        <span>{{ $label }}</span>
    </a>
@endif