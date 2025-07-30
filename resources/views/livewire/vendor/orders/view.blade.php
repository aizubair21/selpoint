<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <x-dashboard.page-header>
        View Orders 
        <br>
        <div class="text-sm font-normal">
            {{$orders->user_type}} <i class="fas fa-arrow-right mx-2"></i> {{ $orders->belongs_to_type}}
        </div>
          
        <div class="text-xs flex items-center sapce-x-2">
            {{$orders->delevery }} Delvevery <i class="fas fa-caret-right px-2"></i> {{$orders->area_condition == 'Dhaka' ? 'Inside Dhaka' : 'Outside of Dhaka'}} 
        </div>
    </x-dashboard.page-header>


    <x-dashboard.container>
        <x-dashboard.section>
            <div class="flex justify-between items-center space-y-2">
                
                <x-dropdown align="left" maxWidth='sm'>
                    <x-slot name="trigger">
                        <x-primary-button>
                            {{$orders->status}}
                        </x-primary-button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="p-2">
                            <div class="px-2 py-1" wire:click="updateStatus('Pending')">
                                Pending
                            </div>
                            <div class="px-2 py-1" wire:click="updateStatus('Accept')">
                                Accept
                            </div>
                            <div class="px-2 py-1" wire:click="updateStatus('Cancel')">
                                Cancel
                            </div>
                        </div>
                    </x-slot>
                </x-dropdown>

            </div>
            <div class="flex justify-end items-center space-x-2">
                {{-- <x-nav-link href="{{route('system.comissions.takes', ['query_for' => 'order_id', 'qry' => $orders->id])}}" >COMISSIONS</x-nav-link> --}}
                <x-secondary-button x-on:click="$dispatch('open-modal', 'profit-modal')"> Resel Profit {{$orders->resellerProfit?->sum('profit') ?? 0}} TK </x-secondary-button>
                <x-secondary-button x-show="$wire.$orders->user_type == 'reseller'" x-on:click="$dispatch('open-modal', 'comission-modal')"> comission {{$orders->comissionsInfo?->sum('take_comission') ?? 0}} TK </x-secondary-button>
            </div>
            {{-- <x-nav-link >Print</x-nav-link> --}}
        </x-dashboard.section>
        
        {{-- @if (auth()->user()->active_nav == 'vendor')                
            <x-dashboard.section>
                
            </x-dashboard.section>    
        @endif
         --}}
        <x-dashboard.overview.section>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Order ID
                </x-slot>
                <x-slot name="content">
                    {{$orders->id}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Products
                </x-slot>
                <x-slot name="content">
                    {{$orders->cartOrders->count() ?? "0"}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Sub Product
                </x-slot>
                <x-slot name="content">
                    {{$orders->cartOrders->sum('quantity') ?? "0"}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Your Profit
                </x-slot>
                <x-slot name="content">
                    @php
                        $buy = $orders->cartOrders->sum('product.buying_price');
                        $total = $orders->cartOrders->sum('buying_price');
                    @endphp
                    {{ $total - $buy ?? "0"}}
                </x-slot>
            </x-dashboard.overview.div>
            {{-- <x-dashboard.overview.div>
                <x-slot name="title">
                    Comissions
                </x-slot>
                <x-slot name="content">
                    {{ $orders->comissionsInfo->sum('take_comission') ?? "0"}}
                </x-slot>
            </x-dashboard.overview.div> --}}
        </x-dashboard.overview.section>

        <x-dashboard.section>
            <div class="flex justify-between items-start px-5">
                <div class="order-info">
                    
                    <div>Order ID: {{ $orders->id }}</div>
                    <div>Date: <span class="text-xs"> {{ $orders->created_at->toDayDateTimeString() }}</span> </div>
                    
                    <x-nav-link-btn href="{{route('vendor.orders.cprint', ['order' => $orders->id])}}">Print</x-nav-link-btn>
                    {{-- <a target="_blank" href="{{route('admin.order.print')}}" class="btn btn-sm btn-outline-primary"> <i class="fas fa-print pe-2"></i> Print</a>
                    <a target="_blank" href="{{route('admin.order.print', ['id' => $orders->id, 'target' => 'excel'])}}" class="btn btn-sm btn-outline-primary"> <i class="fab fa-excel pe-2"></i> Excel</a> --}}
                    {{-- <table class="table"></table> --}}
                </div>
                <div class="order-total text-end">
                    <table class="table">
                        <tr>
    
                        <p>
                            <strong>{{ $orders->user?->name ?? "Not Found !" }} <br> </strong> {{$orders->location}}
                            <br>
                            {{ $orders->house_no ?? 'Not Defined !' }},</> {{$orders->road_no ?? "Not Defined !"}}
                            <br>
                            {{$orders->number}}
    
                        
                        </p>
                        </tr>
                        <tr>
                            {{-- <th>House</th>
                            <td>
                            </td>
                        </tr>
                        <tr>
                            <th>Road</th>
                            <td>
                            </td>
                        </tr> --}}
                    </table>
                </div>
            </div>
            
            <x-dashboard.table>
                
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Owner</th>
                        <th>Resel Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Attr</th>
                        <th>Sell</th>
                        <th>Buy</th>
                        <th>Profit</th>
                        <th>Comissions</th>
                    </tr>
                </thead>
            
                <tbody>
                    @foreach ($orders->cartOrders as $item)
                        <tr>
                            <td> {{$loop->iteration}} </td>
                            <td> {{$item->id ?? "N/A"}} </td>
                            <td> 
                                <div class=" ">
                                    <img width="30px" height="30px" src="{{asset('storage/' . $item->product?->thumbnail)}}" alt="">
                                    <div>
                                        {{$item->product?->title ?? "N/A"}} 
                                    </div>
                                </div>

                                @if ( $item->product?->isResel() && auth()->user()?->account_type() == 'reseller')
                                    
                                    <x-primary-button wire:click.prevent="syncOrder({{$item->id}})" > 
                                        <i class="fas fa-sync"></i>    
                                    </x-primary-button>
                                @endif
                            </td>
                            <td>
                                @if ($item->product?->isResel())
                                    <span class="bg-indigo-900 text-md text-white rounded-lg px-2"> Resell </span>
                                @else 
                                    <span class="bg-indigo-900 text-md text-white rounded-lg px-2"> You </span>
                                @endif
                            </td>
                            <td>
                                {{$item->price}} TK
                            </td>
                            <td>
                                {{$item->quantity}}
                            </td>
                            <td>
                                {{$item->total}} TK
                            </td>
                            <td>
                                {{$item->size ?? "N/A"}}
                            </td>
                            <td>
                                @if (auth()->user()->account_type() == 'reseller')
                                
                                {{$item->product?->price ?? "N/A"}} TK
                                @else
                                {{$item->buying_price ?? "N/A"}} TK
                                @endif
                            </td>
                            <td>

                                {{$item->product?->buying_price ?? "N/A"}} TK

                            </td>
                            <td>
                                {{ ($item->price - $item->buying_price) * $item->quantity }}
                            </td>
                            <th>
                                {{$item->order->comissionsInfo?->sum('take_comission')}}
                            </th>
                        </tr>
                    @endforeach
                <tbody>
            
                <tfoot>
                    <tr class="border-t">
                        <td colspan="6" class="text-right">Sub Total</td>
                        <td>
                            {{ $orders->cartOrders->sum('total')}} Tk
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-right">Delevery</td>
                        <td>
                            {{ $orders->shipping ?? 0}} Tk
                        </td>
                    </tr>
                    <tr class="border-t font-bold text-lg bg-gray-100">
                        <td colspan="6" class="text-right">Total</td>
                        <td>
                            {{ $orders->shipping + $orders->cartOrders->sum('total')}} Tk
                        </td>
                        <td colspan="6"></td>
                    </tr>
                </tfoot>
            
            </x-dashboard.table>

            

        </x-dashboard.section>

       

        <x-modal name="comission-modal" >
            <div class="p-2">
                COMISSIONS
                <x-hr/>

                <x-dashboard.table :data="$orders->comissionsInfo" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Amount</th>
                            <th>Product</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders->comissionsInfo as $item)
                            <tr>
                                <td> {{$loop->iteration}} </td>
                                <td> {{$item->take_comission ?? 0}} </td>
                                <td> {{$item->product?->name ?? "N/A"}} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-dashboard.table>
            </div>
        </x-modal>

        <x-modal name='order-sync-modal'>
            <div class="p-3 bold border-b">
                Reseller Order Product
            </div>
            <div class="p-5">

                <form wire:submit.prevent="confirmSyncOrder" >
                    <x-input-field inputClass="w-full" class="md:flex" label="Customer Name" wire:model.live="name" name="name" error="name" />
                    <x-input-field inputClass="w-full" class="md:flex" label="Customer Phone" wire:model.live="phone" name="phone" error="phone" />
                    <x-input-field inputClass="w-full" class="md:flex" label="Customer District" wire:model.live="district" name="district" error="district" />
                    <x-input-field inputClass="w-full" class="md:flex" label="Customer Upozila" wire:model.live="upozila" name="upozila" error="upozila" />
                    <x-input-field inputClass="w-full" label="Customer Full Address" name="location" wire:model.live="location" error="location" />
                    <x-input-field inputClass="w-full" class="md:flex" label="Customer Road No" name="road_no" wire:model.live="road_no" error="house_no" />
                    <x-input-field inputClass="w-full" class="md:flex" label="Customer House No" name="house_no" wire:model.live="house_no" error="house_no" />
                    <x-hr/>
                   
                    <x-input-field inputClass="w-full" class="md:flex" label="Reseller Price  " wire:model.live="rprice" name="rprice" error="rprice" />
                
                    <div class="text-xs" wire:show='rprice'>
                        {{-- Profit: <strong> {{$this->rprice - $this->pd->price}} </strong> --}}
                    </div>

                    <x-hr/>
                    <x-input-field inputClass="w-full" class="md:flex" label="Product Quantity" wire:model.live="quantity" name="quantity" error="quantity" />
                    <x-input-field inputClass="w-full" class="md:flex" label="Product Size/Attribute" wire:model.live="attr" name="attr" error="attr" />
                    <x-hr/>
                    <x-input-file label="Area Condition" error='area_condition'>
                        <select wire:model.live="area_condition" id="" >
                            <option value="">Select Area</option>
                            <option value="Dhaka">Inside Dhaka</option>
                            <option value="Other">Out side of Dhaka</option>
                        </select>
                    </x-input-file>
                    <x-input-file label="Delevery Method" name="delevery" error="delevery" >
                        <select wire:model.live="delevery" id="" >
                            <option value="">Select Shipping Type</option>
                            <option value="Courier">Courier</option>
                            <option value="Home">Home Delevery</option>
                        </select>
                    </x-input-file>
                    <x-primary-button>Order</x-primary-button>
                </form>
            </div>
        </x-modal>
    </x-dashboard.container>
</div>
