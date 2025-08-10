{{-- resources/views/components/label.blade.php --}}
@props(['value', 'for' => null])

<label 
    for="{{ $for }}" 
    {{ $attributes->merge(['class' => 'block text-sm font-medium text-gray-700']) }}
>
    {{ $value ?? $slot }}
</label>