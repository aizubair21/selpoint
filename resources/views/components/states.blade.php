<div>
    @props(['label', 'states'])
    @isset($label)
    <x-input-label for="" :value="$label"></x-input-label>
    @endisset
    <x-select wire:model.live="state" id="state">
        <option value=""> -- Select State -- </option>
        @foreach ($states as $st)
        <option value="{{$st->name}}"> {{$st->name}} </option>
        @endforeach
    </x-select>
    <x-input-error :messages="$errors->get('state')" class="mt-2" />
</div>