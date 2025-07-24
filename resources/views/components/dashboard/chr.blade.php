@props(['item', 'loop' => 1])
<div class="p-2 border-b border-gray-200 w-full hover:bg-gray-50 cursor-pointer flex justify-between items-start" x-data="{ open: false }">
    <div class="flex-1 ">
        <span class="pr-2" >{{$loop}} </span>  {{ Str::ucfirst($item->name)}}

        <div class="w-full" x-show="open">
            {{-- subcategories: --}}
            @if ($item->children()->count() > 0)
                <div class="px-2 py-1 border-l w-full">
                    @foreach ($item->children as $child)
                        {{-- <div class="flex items-center text-gray-600">
                            {{ $child->name }}

                            <div>
                                @if ($child->products->count() > 0)
                                    <span class="text-xs text-gray-500 ml-2">
                                        ({{ $child->products->count() }} {{ __('Products') }})
                                    </span>
                                @endif
                            </div>
                        </div> --}}

                        <x-dashboard.chr :item="$child" :key="$child->id" :loop="$loop->iteration" />

                        {{-- {{ $child->name }} --}}
                        
                        {{-- {{ !$loop->last ? ', ' : '' }} --}}
                    @endforeach
                </div>
            @else
                <span class="text-sm text-gray-500">
                    {{ __('No Child') }}
                </span>
            @endif
        </div>
    </div>
    <div class="flex items-center">
        <div class="px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs mr-2">
            {{ $item->products->count() }} {{ __('Products') }}
        </div>
        <div class="px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs mr-2" x-on:click="open = !open"> 
            {{ $item->children()->count() }} {{ __('Child') }}
            <i x-show="!open" class="fas fa-caret-right"></i>
            <i x-show="open" class="fas fa-caret-down"></i>
        </div>
        <a href="" class="text-blue-500 hover:underline mr-2">
            <i class="fas fa-edit"></i>
        </a>
        <button wire:click="deleteCategory({{ $item->id }})" class="text-red-500 hover:underline">
            <i class="fas fa-trash"></i>
        </button>
    </div>
</div>