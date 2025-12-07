<div>
    @props(['label', 'cities'])
    @isset($label)
        
    <x-input-label for="" :value="$label"></x-input-label>
    @endisset
    <x-select wire:model.live="city" id="city">
        <option value=""> -- Select City -- </option>
        @foreach ($cities as $item)
        <option value="{{$item->name}}"> {{$item->name}} </option>
        @endforeach
    </x-select>


    <x-input-error :messages="$errors->get('city')" class="mt-2" />
</div>