@props([
    'eyebrow' => null,
    'title' => '',
    'subtitle' => null,
    'align' => 'center',
    'badgeColor' => 'amber',
])

<div class="{{ $align === 'center' ? 'text-center mx-auto max-w-3xl' : 'max-w-2xl' }} mb-8 sm:mb-10">
    @if($eyebrow)
        <div class="inline-flex items-center gap-2 rounded-full bg-amber-100/80 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-amber-800 mb-3 border border-amber-200/60">
            <span class="inline-block h-1.5 w-1.5 rounded-full bg-amber-500"></span>
            {{ $eyebrow }}
        </div>
    @endif
    
    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-slate-900 leading-tight">
        {!! $title !!}
    </h2>

    @if($subtitle)
        <p class="mt-4 text-base sm:text-lg text-slate-600 leading-relaxed">
            {{ $subtitle }}
        </p>
    @endif
</div>