@props(['disabled' => false])

<input @disabled($disabled) style="width: 20px; height:20px" {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
