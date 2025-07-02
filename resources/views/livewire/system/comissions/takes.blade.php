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
                                {{-- <option value="user_id">Shop</option> --}}
                            </select>
                            <x-text-input class="border-0 rounded-none" placeholder="ID's" wire:model="qry" />
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
            <x-dashboard.section.header>
                <x-slot name="title">
                    Total Overview
                </x-slot>
                <x-slot name="content">

                </x-slot>
            </x-dashboard.section.header>
            <x-dashboard.section.inner>
                <x-dashboard.table :data="$takes" >
                    <thead>
                        <tr>
                            <th>Profit</th>
                            <th>Take</th>
                            <th>Give</th>
                            <th>Store</th>
                            <th>Return</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td> {{$takes->sum('profit') ?? 0}} </td>
                            <td> {{$takes->sum('take_comission') ?? 0}} </td>
                            <td> {{$takes->sum('distribute_comission') ?? 0}} </td>
                            <td> {{$takes->sum('store') ?? 0}} </td>
                            <td> {{$takes->sum('return') ?? 0}} </td>
                        </tr>
                    </tbody>
                </x-dashboard.table>
            </x-dashboard.section.inner>
        </x-dashboard.section>
        <x-dashboard.section >
            <x-dashboard.table :data="$takes">
                
                <thead>
                    <th>ID</th>
                    <th>Seller</th>
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
                    <th>Date</th>
                    <th>Confirmed</th>
                    <th>
                        A/C
                    </th>
                </thead>

                <tbody>

                    @foreach ($takes as $item)
                        <tr >
                            <td> {{$item->id ?? "N/A"}} </td>
                            <th>
                                {{$item->user_id}}
                            </th>
                            <td> {{$item->order_id ?? 0}} </td>
                            <td>
                                 {{$item->product_id ?? 0}}     
                            </td>
                            <td> {{$item->buying_price ?? 0}} </td>
                            <td> {{$item->selling_price ?? 0}} </td>
                            <td> {{$item->profit ?? "0"}} </td>
                            <td> {{$item->comission_range ?? "0"}} % </td>
                            <td> {{$item->take_comission ?? "0"}}</td>
                            <td> {{$item->distribute_comission ?? "0"}}</td>
                            <td> {{$item->store ?? "0"}}</td>
                            <td> {{$item->return ?? "0"}}</td>
                            <td>
                                {{ $item->created_at?->toFormattedDateString() }}
                            </td>
                            <td>
                                @if ($item->confirmed == true)
                                    <span class="p-1 px-2 rounded-xl bg-green-900 text-white">Confirmed</span>
                                    <x-nav-link href="{{route('system.comissions.take.refund', ['id' => $item->id])}}" > Refund </x-nav-link>
                                @else 
                                    <span class="p-1 px-2 rounded-xl bg-gray-900 text-white">Pending</span>
                                    <x-nav-link href="{{route('system.comissions.take.confirm', ['id' => $item->id])}}"> Confirm </x-nav-link>
                                @endif
                            </td>
                            <td>
                                <div class="flex space-x-2">
                                    <x-nav-link href="{{route('system.comissions.distributes', ['id' => $item->id])}}">Details</x-nav-link>
                                </div>
                            </td>
                        </tr>    
                    @endforeach
                
                </tbody>
                
            </x-dashboard.table>
        </x-dashboard.section> 
    </x-dashboard.container>


    <x-modal name="filter-modal" maxWidth="lg">
        <div class="p-2">
            <div>
                Filter
            </div>
            <x-hr/>
            <div>
                <div class="md:flex space-y-2 justify-between items-center">
                    <div>
                        <div class="">
                            <x-input-label class=" capitalize pb-2" value="Date From" />
                            <x-text-input type="date" wire:model="start_date" />
                        </div>
                    </div>
                    <div>
                        <div class="">
                            <x-input-label class=" capitalize pb-2" value="Date To" />
                            <x-text-input type="date" wire:model="end_date" vale="{{today()}}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="" wire:show="ord">
                <x-hr/>
                    <x-input-label class=" capitalize pb-2" value='Shop ID' for="shop_id" />
                    <x-text-input type="text" wire:model="qry" />
                <x-hr/>
            </div>
        </div>
    </x-modal>
</div>
