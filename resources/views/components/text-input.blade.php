@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent']) }}>
