@props([
    'id' => '',
    'color' => '',
    'hover' => '',
    'text' => '',
    'icon_path' => '',
    'url' => ''
])

@if($url)
    <a
        class="{{ $color }} font-semibold px-4 py-2 rounded mr-2 hover:{{ $hover }}"
        @if($id) id="{{ $id }}" @endif
        @if($url) href="{{ $url }}" @endif
    >
        {{ $text }}
    </a>
@else
    <button
        class="{{ $color }} font-semibold px-4 py-2 rounded mr-2 hover:{{ $hover }}"
        @if($id) id="{{ $id }}" @endif
    >
        {{ $text }}
    </button>
@endif
