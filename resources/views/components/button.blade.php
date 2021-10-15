@props(['color' => 'theme'])
@php
    $colorMap = [
        'theme' => 'bg-gray-800 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300',
        'primary' => 'bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300',
        ];
@endphp

<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center px-4 py-2  border border-transparent
    rounded-md font-semibold text-xs text-white uppercase tracking-widest
    disabled:opacity-25 transition ease-in-out duration-150 '.$colorMap[$color]
    ]) }}>
    {{ $slot }}
</button>
