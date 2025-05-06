<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <x-dashboard.container>
        

        <x-dashboard.section>

            <x-dashboard.section.header>
                <x-slot name="title">
                    Your Orders
                </x-slot>

                <x-slot name="content">
                    <x-nav-link href="?nav='Received'" :active="$nav == 'Received'">Received</x-nav-link>
                    <x-nav-link href="?nav='Pending'" :active="$nav == 'Pending'">Pending</x-nav-link>
                    <x-nav-link href="?nav='Rejected'" :active="$nav == 'Rejected'">Rejected</x-nav-link>
                    <x-nav-link href="?trash" :active="$trash">Cancelled</x-nav-link>
                </x-slot>
            </x-dashboard.section.header>

        </x-dashboard.section>
        <x-dashboard.section>
           
            <x-dashboard.foreach :data="$orders" >
                <x-dashboard.table>
                    <thead>
                        <tr>
                            <th></td>
                            <th>ID</th>
                            <th>Status</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
                            <tr>
                                <td>
                                    <x-nav-link href="{{route('user.orders.details', ['id' => $item->id])}}">View</x-nav-link>
                                </td>
                                <td>{{$item->id}}</td>
                                <td>
                                    {{$item->status ?? "N/A"}}
                                </td>
                                <td>
                                    {{-- <div class="flex">

                                        <img width="30px" height="30px" src="{{asset('storage/'. $item->product?->thumbnail)}}" alt="" srcset="">
                                        {{$item->product?->name ?? "N/A"}}
                                    </div> --}}
                                    {{$item->cartOrders?->count() ?? "N/A"}}
                                    {{-- @if($item->cartOrders->count() > 0)
                                        <div style="display: flex; gap: 10px;">
                                            @foreach($item->cartOrders as $item)
                                                <div style="margin-left:7px">
                                                    <img style="width:25px; height:25px;" src="{{ asset('storage/' . $item->product?->thumbnail) }}"> 
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif --}}
                                </td>
                                <td>
                                    {{$item->quantity ?? "N/A"}}
                                </td>
                                <td>
                                    {{$item->total ?? "N/A"}} TK
                                </td>
                                <td>
                                    {{-- <x-secondary-button>cancel</x-secondary-button> --}}
                                    <x-danger-button wire:click="remove({{$item->id}})">Cancel</x-danger-button>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </x-dashboard.table>
            </x-dashboard.foreach>

        </x-dashboard.section>
    </x-dashboard.container>
</div>
