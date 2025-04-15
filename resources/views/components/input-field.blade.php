<div>
    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
    @props(['label', 'name', 'error', 'value', 'type', 'required' => false, 'data' => [] ])
    @php
        $type = $type ?? 'text';
        $value = $value ?? old($name);
        if (!empty($data)) {
            $value = $data->$name;
        }
    
    @endphp

    <div class="form-group">
        <div class="md:flex justify-between">
            <div style="width:350px">         
                <!-- Label -->
                <x-input-label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }} {{$required ? "*" : ""}} </x-input-label>
                
                <!-- Error Message -->
                @if ($errors->has($name))
                    <div class="text-sm text-red-600">{{ $errors->first($name) }}</div>
                @endif
            </div>
            <!-- Text Input -->
            <x-text-input
                type="{{ $type }}"
                id="{{ $name }}" 
                name="{{ $name }}" 
                class="w-full"
                value="{{ $value }}" 
                {{ $attributes }} 
                placeholder="{{$label}}"
                :required="$required"
            />
        </div>

    </div>

    {{-- how to user this component  --}}
    {{-- <x-input-field label="Username" name="username" error="username" /> --}}


</div>