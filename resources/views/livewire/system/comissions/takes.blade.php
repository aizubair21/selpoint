<div>
    <x-dashboard.page-header>
        Comission Takes
    </x-dashboard.page-header>

    <x-dashboard.container>
        <x-dashboard.section.header>
            <x-slot name="title">
                <div class="md:flex justify-between">
                    <form wire:submit.prevent="check">
                        <div class="flex bg-white">
                            <select wire:model="query_for" id="query_for" class="border-0 text-xs ">
                                <option value="order_id">Order</option>
                                <option value="product_id">Product</option>
                                <option value="user_id">Shop</option>
                            </select>
                            <x-text-input class="border-0 rounded-none" placeholder="ID's" wie:model="id" />
                        </div>
                    </form>

                    <div>
                        <x-primary-button x-on:click="$dispatch('open-modal', 'filter-modal')">
                            <i class="fas fa-filter"></i>
                        </x-primary-button>
                    </div>

                </div>
            </x-slot>
            <x-slot name="content"></x-slot>
        </x-dashboard.section.header>
        <x-dashboard.section>
            <x-dashboard.table>
                
                <thead>
                    <th>ID</th>
                    <th>Order</th>
                    <th>Product</th>
                    <th>Buy</th>
                    <th>Sell</th>
                    <th>Profit</th>
                    <th>Rate</th>
                    <th>Take</th>
                    <th>Give</th>
                    <th>Store</th>
                    <th>Return</th>
                    <th>Confirmed</th>
                    <th>
                        A/C
                    </th>
                </thead>

                <tbody>

                    @foreach ($takes as $item)
                        <tr >
                            <td> {{$item->id ?? "N/A"}} </td>
                            <td> {{$item->order_id ?? 0}} </td>
                            <td></td>
                            <td> {{$item->buying_price ?? 0}} </td>
                            <td> {{$item->selling_price ?? 0}} </td>
                            <td> {{$item->profit ?? "0"}} </td>
                            <td> {{$item->comission_range ?? "0"}} % </td>
                            <td> {{$item->take_comission ?? "0"}}</td>
                            <td> {{$item->distribute_comission ?? "0"}}</td>
                            <td> {{$item->store ?? "0"}}</td>
                            <td> {{$item->return ?? "0"}}</td>
                            <td>
                                @if ($item->Confirmed)
                                    <span class="p-1 px-2 rounded-xl bg-green-900 text-white">Confirmed</span>
                                @else 
                                    <span class="p-1 px-2 rounded-xl bg-gray-900 text-white">Pending</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex space-x-2">
                                     <x-nav-link href="{{route('system.comissions.take.refund', ['id' => $item->id])}}" x-show="$wire.item.confirm" > Refund </x-nav-link>
                                    <x-nav-link href="{{route('system.comissions.take.confirm', ['id' => $item->id])}}" x-show="!$wire.item.confirm" > Confirm </x-nav-link>
                                    <x-nav-link href="{{route('system.comissions.distributes', ['id' => $item->id])}}">Details</x-nav-link>
                                </div>
                            </td>
                        </tr>    
                    @endforeach
                
                </tbody>
                
            </x-dashboard.table>
        </x-dashboard.section> 
    </x-dashboard.container>


    <x-modal name="filter-modal" >
        <div class="p-2">
            <h5 class="">
                Filter
            </h5>
            <x-hr/>
            <div>

            </div>
        </div>
    </x-modal>
</div>
