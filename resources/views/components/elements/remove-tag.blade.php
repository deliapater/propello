@props([
    'href' => '#'
])

<a href="{!! $href !!}" {{ $attributes->merge(['class' => 'ml-1 text-gray-500 hover:text-red-500'], ['title' => 'Remove Tag']) }}>
    {{ $slot }}
</a>