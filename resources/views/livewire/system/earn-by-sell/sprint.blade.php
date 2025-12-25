<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
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
            @php
            $tp = 0;
            @endphp
            @foreach ($products as $item)
            @php
            $tp += $item?->product?->totalPrice();
            @endphp
            <tr>
                <td> {{$loop->iteration}} </td>
                <td> {{$item->id}} </td>

                <td>
                    <x-nav-link class="text-xs"
                        href="{{route('products.details', ['id' => $item->product?->id ?? '',  'slug' => $item->product?->slug ?? ''])}}">
                        <img width="30px" height="30px" src="{{asset('storage/'. $item->product?->thumbnail)}}" alt=""
                            class="mr-2 rounded-full">
                        {{$item->product?->name ?? "N/A" }}
                    </x-nav-link>
                    <br>
                    <div class="text-xs border rounded inline-block">
                        {{$item->product?->status ?? 'N/A'}}
                    </div>
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
                    {{$item->product?->created_at?->toFormattedDateString()}}
                </td>
                <td>
                    {{-- <div class="flex">
                        <x-nav-link href="/">
                            Disable
                        </x-nav-link>
                        <x-nav-link href="/">
                            View
                        </x-nav-link>
                    </div> --}}
                    @if ($item->status == 'Pending')
                    <span class="text-xs p-1 border rounded-md bg-yellow-200 text-yellow-900">Pending</span>
                    @elseif ($item->status == 'Accept')
                    <span class="text-xs p-1 border rounded-md bg-green-200 text-green-900">Accept</span>
                    @elseif ($item->status == 'Picked')
                    <span class="text-xs p-1 border rounded-md bg-lime-200 text-lime-900">Picked</span>
                    @elseif ($item->status == 'Delivery')
                    <span class="text-xs p-1 border rounded-md bg-sky-200 text-sky-900">Delivery</span>
                    @elseif ($item->status == 'Delivered')
                    <span class="text-xs p-1 border rounded-md bg-blue-200 text-blue-900">Delivered</span>
                    @elseif ($item->status == 'Confirm')
                    <span class="text-xs p-1 border rounded-md bg-indigo-200 text-indigo-900">Confirm</span>
                    @elseif ($item->status == 'Hold')
                    <span class="text-xs p-1 border rounded-md bg-gray-200 text-gray-900">Hold</span>
                    @elseif ($item->status == 'Cancel')
                    <span class="text-xs p-1 border rounded-md bg-red-200 text-red-900">Cancel</span>
                    @elseif ($item->status == 'Cancelled')
                    <span class="text-xs p-1 border rounded-md bg-red-200 text-red-900">Cancelled</span>
                    @else
                    <span class="text-xs p-1 border rounded-md bg-gray-200 text-gray-900">Unknown</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    Total {{$tp}}
                </td>
            </tr>
        </tfoot>
    </x-dashboard.table>
</div>