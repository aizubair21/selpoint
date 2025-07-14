<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <x-dashboard.page-header>
        Categories to resel
        <br>
        <div>
            <x-nav-link href="{{route('reseller.resel-product.index')}}" > View All Products </x-nav-link>
        </div>
    </x-dashboard.page-header>


    <div style="display: grid; justify-content:start; grid-template-columns: repeat(auto-fill,100px); grid-gap:10px">
        {{-- {{$cat}} --}}
        @foreach ($categories as $item)
            <a href="{{route('reseller.resel-product.index', ['cat' => $item->id])}}" style="height: 100px" @class(['relative bg-white rounded'])>
                <img style="height:100px; width:100px" class="rounded" src="{{asset('storage/'. $item->image)}}" alt="">
                <div @class(['absolute bottom-0 text-center w-full px-1 bg-gray-200', 'bg-indigo-900 text-white' => $cat && $cat == $item->id])>
                    {{$item->name}}
                </div>
            </a>
        @endforeach
    </div>
</div>
