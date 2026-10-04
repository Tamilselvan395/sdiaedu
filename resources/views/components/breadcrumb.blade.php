@props([
    'items' => [],
])

<nav {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white/5 border border-white/10 backdrop-blur-md text-xs sm:text-sm text-slate-300 max-w-full overflow-x-auto shadow-xs']) }} aria-label="Breadcrumb">
    <a href="{{ route('home') }}" class="hover:text-amber-400 transition flex items-center gap-1.5 shrink-0">
        <i class="fa-solid fa-house text-xs"></i>
        <span>Home</span>
    </a>
    
    @foreach($items as $item)
        <span class="text-slate-500 shrink-0">/</span>
        @if(!empty($item['url']) && !$loop->last)
            <a href="{{ $item['url'] }}" class="hover:text-amber-400 transition shrink-0">
                {{ $item['label'] }}
            </a>
        @else
            <span class="text-amber-400 font-semibold truncate">{{ $item['label'] }}</span>
        @endif
    @endforeach

    {{ $slot }}
</nav>
