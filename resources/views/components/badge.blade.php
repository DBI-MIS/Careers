@props (['textColor','bgColor'])

@php
    $textColor = match ($textColor) {
        'gray' => 'text-gray-800',
        'blue' => 'text-blue-800',
        'red' => 'text-red-800',
        'yellow' => 'text-yellow-800',
        'green' => 'text-green-800',
        'white' => 'text-white',
        default => 'text-gray-800',
    };

    $bgColor = match ($bgColor) {
        'gray' => 'bg-gray-800',
        'blue' => 'bg-blue-800',
        'red' => 'bg-red-800',
        'yellow' => 'bg-yellow-800',
        'green' => 'bg-green-800',
        default => 'bg-blue-800',
    };
    
@endphp
<button {{ $attributes }} class=" {{$textColor}} {{$bgColor}} rounded-xl px-3 py-1 text-xs md:text-base">
            {{ $slot }}</button>