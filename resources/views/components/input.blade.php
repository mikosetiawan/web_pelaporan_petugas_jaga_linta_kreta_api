{{-- resources/views/components/input.blade.php --}}
@props(['type' => 'text', 'name', 'value' => null])

<input 
    type="{{ $type }}" 
    name="{{ $name }}" 
    id="{{ $name }}"
    value="{{ old($name, $value) }}"
    {{ $attributes->merge(['class' => 'block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm']) }}
>