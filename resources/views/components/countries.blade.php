<div>
    @props(['label', 'countries'])
    @isset($label)
    <x-input-label for="country" :value="$label"></x-input-label>
    @endisset
    <x-select wire:model.live="country" id="country">
        <option value=""> -- Select Country -- </option>
        @foreach ($countries as $item)
        <option value="{{$item->name}}"> {{$item->name}} </option>
        @endforeach
    </x-select>
    <x-input-error :messages="$errors->get('country')" class="mt-2" />
</div>