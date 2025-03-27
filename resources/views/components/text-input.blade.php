@props(['disabled' => false, 'checked' => false])
<style>
    input[type='checkbox'], input[type='radio']{
        width: 20px;
        height: 20px;;
    }
</style>
<input @checked($checked) @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
