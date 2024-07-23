@props(['href'])

@php
// echo $href;
$isActive = $href == request()->path();
$classes = $isActive ? 'text-[#ff00ff]' : 'text-gray-200 hover:text-[#ff00ff]';
@endphp

<a href="{{ url($href) }}" {{ $attributes->merge(['class' => "$classes font-semibold text-lg"]) }}>
    {{ $slot }}
</a>
