@props(['item'])
<div>
    <div class="py-1 text-lg">
        <div class="flex items-center justify-between">
            <div class="text-lg flex-1">
                
                <x-nav-link class="text-gray-900" href="{{ route('category.products', ['cat' => $item->slug]) }}">
                    {{-- <i class="fas fa-chevron-right"></i> --}}
                    {{ $item->name }}
                </x-nav-link>
                
            </div>
            <div class="text-sm text-gray-500">
                {{-- <i class="fas fa-chevron-right"></i> --}}
                <i class="fas fa-chevron-right"></i>
            </div>
            
        </div>
    </div>
    @if ($item->children->count() > 0)
        {{-- <i class="fas fa-chevron-down text-gray-500"></i> --}}
        <div class="ms-2 border-l border-gray-900 pl-2">
            {{-- <x-client.cat-loop :item="$item" /> --}}
            @foreach ($item->children as $child)
                <x-client.cat-loop :item="$child" :key="$child->id" />
            @endforeach
        </div>
    @endif
</div>