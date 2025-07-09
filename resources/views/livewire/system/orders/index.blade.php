<div>
    <x-dashboard.page-header>
        <div class="flex justify-between items-center">
            Orders
            
            {{-- <x-secondary-button type="button"  x-on:click="$dispatch('open-modal', 'filter-modal')">
                <i class="fas fa-filter"></i>
            </x-secondary-button> --}}
            {{-- <x-dropdown>
                <x-slot name="trigger">
                    <div class="p-2 rounded-md px-3 w-36">
                        Filter <i class="fas fa-caret-down ps-3"></i>
                    </div>
                </x-slot>
                <x-slot name="content">

                    <div class="px-2">

                        <div class="flex items-center mb-1" >
                            <input type="radio" id="Accept" value="Accept" wire:model.live="status" style="width:20px; height:20px" class="mr-3">
                            <x-input-label value="Accept" />
                        </div>
                        <div class="flex items-center mb-1" >
                            <input type="radio" id="pending" value="Pending" wire:model.live="status" style="width:20px; height:20px" class="mr-3">
                            <x-input-label value="Pending" />
                        </div>
                        <div class="flex items-center mb-1" >
                            <input type="radio" id="cancel" value="Cancel" wire:model.live="status" style="width:20px; height:20px" class="mr-3">
                            <x-input-label value="Cancel" />
                        </div>
                        <div class="flex items-center mb-1" >
                            <input type="radio" id="cancelled" value="Cancelled" wire:model.live="status" style="width:20px; height:20px" class="mr-3">
                            <x-input-label value="Cancelled" />
                        </div>

                    </div>
                    <x-hr/>
                </x-slot>
            </x-dropdown> --}}
           
        </div>
    </x-dashboard.page-header>
    
    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    
                    <div class="flex justify-between items-center">
                        <div class="flex items-center"> 
                            <select class="rounded border-0" wire:model.live="qf">
                                <option value="id">Order</option>
                                <option value="user_id">Buyer</option>
                                <option value="belongs_to">Seller</option>
                                {{-- <option value="belongs_to">Date</option> --}}
                            </select>
                            <x-text-input type="search" wire:model.live="search" placeholder="Search" />
                        </div>
                        
                        <select class="rounded border-0 " wire:model.live="type" id="">
                            <option value="">Both</option>
                            <option value="user">U > R</option>
                            <option value="reseller">R > V</option>
                        </select>
                        <select class="rounded border-0 " wire:model.live="status" id="">
                            <option value="">Any</option>
                            <option value="Accept">Accept</option>
                            <option value="Pending">Pending</option>
                            <option value="Cancel">Cancel</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="None">None</option>
                        </select>
                      
                        {{-- <x-text-input type="date" wire:model.live="date" id="datePic" /> --}}
                        <select wire:model.live="date" id="" class="border-0 bg-transparent">
                            <option value="">Null</option>
                            <option selected value="today">Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="between">Custom</option>
                        </select>
                    </div>

                    {{-- <x-primary-button>Filter</x-primary-button> --}}
                </x-slot>
                <x-slot name="content">
                    @if ($date == 'between')    
                        <div class="flex">
                            <x-text-input  type="date" wire:model.live="sd" id="sd"  />
                            <x-text-input type="date" wire:model.live="ed" id="ed" />
                        </div>
                    @endif
                    {{$orders->links()}}
                </x-slot>
            </x-dashboard.section.header>

            <x-dashboard.section.inner>
                <x-dashboard.foreach :data="$orders">
                    <x-dashboard.table>
                 
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Types</th>
                                <th>
                                    Status
                                   
                                </th>
                                <th>Date</th>
                                <th>A/C</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach ($orders as $item)
                                <tr>
                                    <td> {{$loop->iteration }} </td>
                                    <td> {{$item->id ?? "N/A"}} </td>
                                    <td> 
                                        <div class="flex items-center">
                                            {{ $item->user_type }} <i class="fas fa-arrow-right px-2"></i> {{ $item->belongs_to_type }}     
                                        </div>    
                                    </td>
                                    <th>
                                       {{$item->status ?? "N/A"}}
                                    </th>
                                    <td>
                                        {{$item->created_at?->toFormattedDateString()}} 
                                    </td>
                                    <td>
                                        <div class="flex">
    
                                            <x-nav-link href="{{route('system.orders.details', ['id' => $item->id])}}">Details</x-nav-link>
                                            <x-danger-button wire:click="delete({{$item->id}})">
                                                <i class="fas fa-trash"></i>
                                            </x-danger-button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </x-dashboard.table>
                </x-dashboard.foreach>
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </x-dashboard.container>

    <x-modal  name="filter-modal" maxWidth="lg">
        <div class="p-3">

            <h2>Filter</h2>
            <form >

                <x-hr/>



                <x-hr/>
                <div class="flex justify-between space-x-2">
                    <x-secondary-button type="button" x-on:click="$dispatch('close-modal', 'filter-modal')">Close</x-secondary-button>
                    <x-primary-button type="submit">Filter</x-primary-button>
                </div>
            </form>

        </div>
    </x-modal>
</div>
