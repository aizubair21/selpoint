<style>
    input[type='checkbox'], input[type='radio']{
        width: 20px;
        height: 20px;;
    }
</style>
@props(['disabled' => false, 'check' => false])
<input @checked($check) @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
