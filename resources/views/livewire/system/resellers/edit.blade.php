<div>
    {{-- Success is as dangerous as failure. --}}
    <x-dashboard.page-header>
        Resellers
        <br>
        <x-nav-link href="{{route('system.users.edit', ['id' => $resellers->user?->id ?? ''])}}">
            {{$resellers->user?->name ?? "N/A"}}
        </x-nav-link>
        - <span class="text-sm"> {{$resellers->shop_name_bn ?? "N/A"}} </span>
        <br>
        <span class="text-xs">Pending</span>
        <br>


        <div>
            <x-nav-link :active="$nav == 'user'" href="?nav=user">user</x-nav-link>
            <x-nav-link :active="$nav == 'documents'" href="?nav=documents">Documents</x-nav-link>
            <x-nav-link :active="$nav == 'products'" href="?nav=products">Products</x-nav-link>
            <x-nav-link :active="$nav == 'categories'" href="?nav=categories">Categories</x-nav-link>
            <x-nav-link :active="$nav == 'orders'" href="?nav=orders">Orders</x-nav-link>
        </div>
    </x-dashboard.page-header>
    
    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Reseller Status
                </x-slot>
                <x-slot name="content">
                    <x-hr />
                    <div>
                        <form wire:submit.prevent='updateStatus'>
    
                            <div class="flex items-center justify-between">
    
                                <div >
                                    <p class="text-sm">Current Status is : <strong> {{$resellers  ->status}} </strong>. Change status to - </p>
                                    <select id="" wire:model="requestStatus" class="rounded-lg py-1" >
                                        <option value="Select Status">-- Select -- </option>
                                        <option @if($resellers->status == 'Active') selected @endif value="Active">Active</option>
                                        <option @if($resellers->status == 'Pending') selected @endif value="Pending">Pending</option>
                                        <option @if($resellers->status == 'Disabled') selected @endif value="Disabled">Disabled</option>
                                        <option @if($resellers->status == 'Suspended') selected @endif value="Suspended">Suspended</option>
                                    </select>
                                    
                                    {{-- <div class="mt-1" x-show="sd != 'Active'">
                                        <textarea class="rounded-lg" name="" id="" rows="2"></textarea>
                                    </div> --}}
                                    
                                </div>
                                <div class="text-end">
                                    <p class="text-sm">
                                        update : {{$resellers ->updated_at->diffForHumans()}}
                                    </p>
                                    <x-primary-button class="ml-2">set</x-primary-button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <x-hr/>
                    <div>
                        <form wire:submit.prevent="setComission">
                            <div class="flex justify-between items-start">
                                <div>
                                    <input type="text" wire:model.live="comission" class="rounded shadow" id="">
                                    <div class='text-xs'>
                                        You take {{$resellers->system_get_comission ?? "0"}}% profit from this vendor revinew.
                                    </div>
                                </div>
                                <div>
                                    <x-primary-button>set</x-primary-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </x-slot>
            </x-dashboard.section.header>
        </x-dashboard.section>

        @if ($nav == 'documents')
    
            <x-dashboard.section>
                <x-dashboard.section.header>
                    <x-slot name="title">
                        Documents
                    </x-slot>
                    <x-slot name="content">
                        See the listed document submitted by the user
                    </x-slot>
                </x-dashboard.section.header>
                <x-dashboard.section.inner>
                    <x-input-file label="Document Submited Last Date" error="deatline">
                        <div class="border px-2 rounded shadow-sm">    
                            {{Carbon\Carbon::parse($resellers->documents->deatline)->toFormattedDateString()}} - {{Carbon\Carbon::parse($resellers->documents->deatline)->diffForHumans()}}
                        </div>
                    </x-input-file>
                    <x-hr />
                    <form wire:submit.prevent="updateDeatline">
                        <x-input-file label="set New Date" error="deatline">
                            <div class="flex">
    
                                <x-text-input wire:model.live="deatline" type="date" class="py-1" />
                                <x-primary-button type="button" wire:show="deatline" class="ms-2 py-1" type="submit">set</x-primary-button>
                            </div>
                        </x-input-file>
                    </form>
                </x-dashboard.section.inner>
            </x-dashboard.section>
      
            <x-dashboard.section>
                @php
                    $resellersDocument = $resellers->documents;
                @endphp
    
                <x-input-file label="Nid" error="nid">
                    <x-text-input type="number" class="form-control py-1" value="{{$resellersDocument->nid}}" label="NID No" name="nid" error="nid" />
                </x-input-file>
                <x-hr/>
    
                <x-input-file label="NID Image (front side)" error='nid_front'>
                    <img width="300px" height="200px" src="{{asset('storage/'.$resellersDocument->nid_front)}}" alt="">                
                </x-input-file>
                <x-hr/>
                
                <x-input-file label="NID Image (back side)" error='nid_back'>
                    <img width="300px" height="200px" src="{{asset('storage/'.$resellersDocument->nid_back)}}" alt="">                    
                </x-input-file>
                <x-hr />
            </x-dashboard.section>
            <x-dashboard.section>
                
                <x-input-file label="TIN No" error='tin'>
                    <x-text-input type="text" name="" value="{{$resellersDocument->shop_tin}}" id="" />
                </x-input-file>
                <x-hr/>
    
                <x-input-file label="TIN Image" error='shop_tin'>
                        <img width="300px" height="200px" src="{{asset('storage/'.$resellersDocument['shop_tin_image'])}}" alt="">                  
                </x-input-file>
            </x-dashboard.section>
    
            <x-dashboard.section>
                <x-input-file label="Shop Trade" error="shop_trade">
                    <x-text-input type="text" name="" value="{{$resellersDocument->shop_trade}}" id="" />
                </x-input-file>
                <x-hr/>
    
                <x-input-file label="Trade License Image" error='shop_trade_image'>
                    <img width="300px" height="200px" src="{{asset('storage/'.$resellersDocument['shop_trade_image'])}}" alt="">
                </x-input-file>
    
            
            </x-dashboard.section>
            
        @endif
        @if ($nav == 'products')
            <x-dashboard.section>
                <x-dashboard.section.inner>
                </x-dashboard.section.inner>
            </x-dashboard.section>
            
        @endif
        @if ($nav == 'orders')
            
            <x-dashboard.section>
                <x-dashboard.section.inner>
                </x-dashboard.section.inner>
            </x-dashboard.section>
        @endif
    </x-dashboard.container>
    @if ($nav == 'user')
        @livewire('system.users.edit', ['id' => $resellers->user?->id], key($resellers->user?->id))
    @endif
</div>
