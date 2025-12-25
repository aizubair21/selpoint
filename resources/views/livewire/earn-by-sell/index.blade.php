<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    <x-dashboard.container>

        {{-- <p class="text-xl"> Sell and Profit </p>
        <x-dashboard.overview.section>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Total Sell
                </x-slot>
                <x-slot name="content">
                    <p class="">
                        {{$totalSell}} TK
                    </p>
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Profit
                </x-slot>
                <x-slot name="content">
                    {{$tp}} TK
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Neet
                </x-slot>
                <x-slot name="content">
                    {{$tn}} TK
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Shop
                </x-slot>
                <x-slot name="content">
                    {{$shop}}
                </x-slot>
            </x-dashboard.overview.div>

            <x-dashboard.overview.div>
                <x-slot name="title">
                    Vendor Shop
                </x-slot>
                <x-slot name="content">
                    {{$tpr}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Reseller Shop
                </x-slot>
                <x-slot name="content">
                    {{$tprr}}
                </x-slot>
            </x-dashboard.overview.div>
        </x-dashboard.overview.section> --}}


        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    {{-- <p class="text-xl">Product</p> --}}
                    <div class="flex items-center justify-between">

                        <div class="flex space-x-2">

                            <select wire:model.live="nav" id="" class="rounded py-1">
                                <option value="all">Both</option>
                                <option value="sold">Sold</option>
                                <option value="selling">On-Selling</option>
                            </select>

                            <x-secondary-button wire:click='print'>
                                <i class="fas fa-print"></i>
                            </x-secondary-button>
                        </div>
                        {{-- <div>
                            <select wire:model.live="user_type" id="" class="rounded py-1">
                                <option value="all">Both</option>
                                <option value="user">Reseller Shop</option>
                                <option value="reseller">Vendor Shop</option>
                            </select>
                        </div> --}}
                        <x-primary-button @click="$dispatch('open-modal', 'filter-modal')">Filter <i
                                class="fas fa-sort ms-2"></i> </x-primary-button>
                    </div>

                </x-slot>
                <x-slot name="content">
                    <p class="text-sm">
                        {{$products ? count($products) . " items found / Unique : " .
                        count($products->groupBy('product_id')) : "No
                        Data
                        Found "}}
                    </p>

                </x-slot>
            </x-dashboard.section.header>
            <hr>
            <x-dashboard.section.inner>
                {{$products?->links() ?? ""}}

                <x-dashboard.table :data="$products" class="p-2">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Flow</th>
                            <th>Owner</th>
                            <th>Price</th>
                            {{-- <th>Sell</th> --}}
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($products as $item)

                        <tr>
                            <td> {{$loop->iteration}} </td>
                            <td> {{$item->id}} </td>

                            <td>
                                <x-nav-link class="text-xs"
                                    href="{{route('products.details', ['id' => $item->product?->id ?? '',  'slug' => $item->product?->slug ?? ''])}}">
                                    <img width="30px" height="30px"
                                        src="{{asset('storage/'. $item->product?->thumbnail)}}" alt=""
                                        class="mr-2 rounded-full">
                                    {{$item->product?->name ?? "N/A" }}
                                </x-nav-link>
                                <br>

                            </td>

                            <td>
                                <div class="flex items-center">
                                    {{$item->user_type}} <i class="fas fa-angle-right mx-2"></i>
                                    {{$item->belongs_to_type}}
                                </div>
                            </td>

                            <td>
                                <div>
                                    <div class="text-gray-700 ">
                                        @switch($item->product?->belongs_to_type)
                                        @case('reseller')
                                        {{$item->product?->owner?->resellerShop()->shop_name_en ??
                                        $item->product?->owner?->name}}
                                        @break
                                        @case('vendor')
                                        {{$item->product?->owner?->vendorShop()->shop_name_en ??
                                        $item->product?->owner?->name}}
                                        @break
                                        @endswitch
                                        {{-- {{$item->product?->owner?->name}} ({{$item->product?->user_id}}) --}}
                                    </div>
                                    @if ($item->product?->isResel()->count())
                                    <span class="rounded-full p-1 text-xs bg-indigo-900 text-white">
                                        <i class="fas fa-caret-left"></i>R
                                    </span>
                                    @endif
                                    @if ($item->product?->resel()->count())
                                    <span class="rounded-full p-1 text-xs bg-indigo-900 text-white">
                                        {{$item->product?->resel()->count()}}<i class="fas fa-caret-right"></i>
                                    </span>
                                    @endif

                                </div>
                            </td>

                            <td>
                                {{$item->product?->price ?? 0}} TK
                                @if ($item->product?->offer_type)

                                <div class="flex items-center text-center p-1 rounded bg-gray-100 text-xs">
                                    D: {{$item->product?->discount}} |
                                    @php
                                    if ($item->product?->offer_type) {
                                    // $ds = $item->product?->price - $item->product?->discount;
                                    $com = round((100 * ($item->product?->price - $item->product?->discount)) /
                                    $item->product?->price, 0);
                                    echo($com . "% off");
                                    };
                                    @endphp
                                </div>
                                @endif
                            </td>
                            {{-- <td>
                                {{$item->product?->orders?->count()}}
                            </td> --}}
                            {{-- <td>
                                {{$item->product?->comissionsTake()?->sum('take_comission')}} -
                                {{$item->product?->comissionsTake()?->sum('distribute_comission')}} =
                                {{$item->product?->comissionsTake()?->sum('store')}}
                            </td> --}}
                            <td>
                                <div class="text-xs">
                                    {{$item->product?->created_at?->toFormattedDateString()}}
                                </div>
                            </td>
                            <td>

                                <x-dashboard.order-status :status="$item->status" />
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </x-dashboard.table>
            </x-dashboard.section.inner>
        </x-dashboard.section>


        <x-modal name="filter-modal">
            <div class="p-2 flex justify-between items-center">
                <div>
                    Filter
                </div>
                <div @click="$dispatch('close-modal', 'filter-modal')">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <hr>
            <div class="p-3">
                <form action="{{route('reseller.sel.index')}}" method="get">

                    <div class="w-full flex items-bottom justify-betweeen space-x-2">
                        <div>
                            <p class="text-xs">First Date</p>
                            <input type="date" id="firstDate" name="fd" class="py-1 rounded font-normal text-sm" />
                            <div class="text-xs">
                                {{\Carbon\Carbon::parse($fd)->format('d, M Y')}}
                            </div>
                        </div>

                        <div>
                            <p class="text-xs">Last Date</p>
                            <x-text-input type="date" name='lastDate' class="py-1 rounded font-normal text-sm" />
                            <div class="text-xs">
                                {{\Carbon\Carbon::parse($lastDate)->format('d, M Y')}}
                            </div>
                        </div>

                    </div>
                    <button class="rounded bg-lime-400 px-4 mt-1 py-1 text-sm border" type="submit">Check</button>
                </form>
            </div>
        </x-modal>
    </x-dashboard.container>

    <script>
        window.addEventListener('open-printable', (e) => {
                    // console.log(e.detail[0].url);
                    window.open(e.detail[0].url, '_blank');
                });
                
    </script>
</div>