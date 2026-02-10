@props(['active'])

@php
$classes = ($active ?? false)
    ? 'inline-flex items-center px-2 py-1 rounded-md border border-[#ffd700] text-[#ffd700] font-medium text-sm transition'
    : 'inline-flex items-center px-2 py-1 rounded-md border border-white/20 text-black hover:border-[#ffd700] hover:text-[#ffd700] hover:bg-[#ffd700]/5 text-sm transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
