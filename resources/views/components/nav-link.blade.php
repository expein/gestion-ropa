@props(['active'])

@php
$classes = ($active ?? false)
            ? 'rounded-md radius- inline-flex items-center px-1 py-1 text-sm font-medium leading-5 text-gray-900 focus:outline-none bg-indigo-100 transition duration-150 ease-in-out'
            : 'rounded-md inline-flex items-center px-1 py-1 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-indigo-600 hover:bg-indigo-100 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
