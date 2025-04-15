<div>
    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
    @props(['label', 'error'])
   

    <div class="form-group">
        <div class="md:flex justify-between">
            <div style="width:350px">         
                <!-- Label -->
                <x-input-label for="{{ $name ?? $label }}" class="block text-sm font-medium text-gray-700">{{ $label }} </x-input-label>
                
                <!-- Error Message -->
                @if ($errors->has($error))
                    <div class="text-sm text-red-600">{{ $errors->first($error) }}</div>
                @endif
            </div>
            <!-- Text Input -->
            {{$slot}}
        </div>

    </div>

    {{-- how to user this component  --}}
    {{-- <x-input-field label="Username" name="username" error="username" /> --}}


</div>