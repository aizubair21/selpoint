@props(['item', 'active' => false, 'cat' => ''])
{{-- @props(['item', 'active' => false]) --}}
<div class="cat-item" x-data="{ open: true }">
    <div class="py-1 text-lg">
        <div class="flex items-center justify-between {{ $active ? 'bg-gray-100' : '' }}">
            <div class="text-lg flex-1">

                <x-nav-link class=" {{ $active ? 'text-indigo-900' : '' }} text-gray-900" href="{{ route('category.products', ['cat' => $item->slug]) }}">
                    {{-- <i class="fas fa-chevron-right"></i> --}}
                    {{ Str::ucfirst( $item->name) }}
                </x-nav-link>
                
            </div>
            <div class="text-sm text-gray-500" x-on:click="open = !open">
                {{-- <i class="fas fa-chevron-right"></i> --}}
                {{-- <i class="fas fa-chevron-right text-gray-500"></i> --}}
                {{-- <i class="fas fa-chevron-right"></i> --}}
                <i x-show="open" class="fas fa-chevron-down text-gray-500"></i>
                <i x-show="!open" class=" {{ $active ? 'text-indigo-900' : '' }} fas fa-chevron-right"></i>
            </div>
            
        </div>
    </div>
    @if ($item->children->count() > 0)
        {{-- <i class="fas fa-chevron-down text-gray-500"></i> --}}
        <div class="ms-2 border-l border-gray-900 pl-2" x-show="open" x-collapse>
           
            @foreach ($item->children as $child)
                <x-client.cat-loop :item="$child" :key="$child->id" :active="$cat == $child->slug" :cat="$cat" />
            @endforeach
        </div>
    @endif
</div>