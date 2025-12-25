<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <x-dashboard.section.inner>
        <div class="text-center mb-3">
            <h1>Nolicx</h1>
            <h3>Sells Summery</h3>
            <h5>
                Print Date : {{\Carbon\Carbon::parse(now())->format('d M Y, D')}}
            </h5>
        </div>
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
                            <img width="30px" height="30px" src="{{asset('storage/'. $item->product?->thumbnail)}}"
                                alt="" class="mr-2 rounded-full">
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
</div>