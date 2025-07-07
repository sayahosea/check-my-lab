@props([
    'url' => '/',
    'title' => '',
    'path' => '',
    'second_path' => null
])

<li class="animate-fade-in" style="animation-delay: 0.1s;">
    <a href="{{ $url }}" class="flex items-center gap-4 p-2 text-black rounded-lg hover:bg-[#7AB5B7] transition-colors duration-300 menu-item-hover">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $path }}" />
            @if($second_path)
            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $second_path }}" />
            @endif
        </svg>
        {{ $title }}
    </a>
</li>
