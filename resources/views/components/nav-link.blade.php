@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-md font-semibold inline-flex items-center px-1 pt-1 border-b-2 border-blue-400 leading-5 text-slate-900 focus:outline-none focus:border-blue-700 transition duration-150 ease-in-out'
            : 'text-md font-medium inline-flex items-center px-1 pt-1 border-b-2 border-transparent leading-5 text-slate-500 hover:text-slate-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a wire:navigate {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
