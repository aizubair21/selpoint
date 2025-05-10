<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <x-dashboard.page-header>
        Categories to resel
    </x-dashboard.page-header>

    <div style="display: grid; justify-content:center; grid-template-columns: repeat(auto-fill, minmax(100px, auto)); grid-gap:10px">
        @foreach ($categories as $cat)
            <a href="{{route('reseller.resel-product.index', ['cat' => $cat->id])}}" style="height: 100px" class="relative bg-white rounded shadow">
                <img style="height:100px; width:100px" class="rounded" src="{{asset('storage/'. $cat->image)}}" alt="">
                <div class="absolute bottom-0 text-center w-full px-1 bg-gray-200">
                    {{$cat->name}}
                </div>
            </a>
        @endforeach
    </div>
    {{-- <x-dashboard.container>
        <x-dashboard.section>
            
            <x-dashboard.section.inner>
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </x-dashboard.container> --}}
</div>
