<div>
    @if (count($data[0]->slides))

    <div class="body">

        <div class="slider">
            <div class="slides">
                @foreach ($data as $slider)
                @foreach ($slider->slides as $key => $item)

                <div class="slide {{ $key == 0 ? 'active' : '' }}">
                    {{-- <img src="https://via.placeholder.com/800x400?text=Product+1" loading="lazy" /> --}}
                    <a href="{{ $item->action_url ?? route('products.index') }}" wire:nvigation
                        class="slide-link w-full">
                        {{-- <img src="https://placehold.co/600x400/orange/white" /> --}}
                        <img src="{{asset('storage/' .$item->image)}}" class="w-full" />
                    </a>
                </div>

                @endforeach
                @endforeach
            </div>

        </div>

    </div>
    @endif
</div>