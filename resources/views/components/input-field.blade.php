<div>
    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
    @props(['label', 'name', 'error'])

    <div class="form-group">
        <!-- Label -->
        <x-input-label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</x-input-label>
        
        <!-- Text Input -->
        <x-text-input
            id="{{ $name }}" 
            name="{{ $name }}" 
            class="w-full"
            value="{{ old($name) }}" 
            {{ $attributes }} 
            placeholder="{{$label}}"
        />

        <!-- Error Message -->
        @if ($errors->has($name))
            <p class="mt-2 text-sm text-red-600">{{ $errors->first($name) }}</p>
        @endif
    </div>

    {{-- how to user this component  --}}
    {{-- <x-input-field label="Username" name="username" error="username" /> --}}


</div>