<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <x-dashboard.container>
        

        <x-dashboard.section>

            <x-dashboard.section.header>
                <x-slot name="title">
                    Your Orders
                </x-slot>

                <x-slot name="content">
                    view, remove your orders.
                </x-slot>
            </x-dashboard.section.header>

        </x-dashboard.section>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    <x-nav-link>Received</x-nav-link>
                    <x-nav-link>Pending</x-nav-link>
                    <x-nav-link>Cancelled</x-nav-link>
                </x-slot>

                <x-slot name="content">
                </x-slot>
            </x-dashboard.section.header>
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
                                    <x-nav-link>View</x-nav-link>
                                </td>
                                <td>{{$item->id}}</td>
                                <td>
                                    {{$item->status ?? "N/A"}}
                                </td>
                                <td>
                                    <div class="flex">

                                        <img width="30px" height="30px" src="{{asset('storage/'. $item->product?->thumbnail)}}" alt="" srcset="">
                                        {{$item->product?->name ?? "N/A"}}
                                    </div>
                                </td>
                                <td>
                                    {{$item->Quantity ?? "N/A"}}
                                </td>
                                <td>
                                    {{$item->total ?? "N/A"}} TK
                                </td>
                                <td>
                                    <x-danger-button>cancel</x-danger-button>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </x-dashboard.table>
            </x-dashboard.foreach>

        </x-dashboard.section>
    </x-dashboard.container>
</div>
