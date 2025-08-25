<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <x-dashboard.container>
        <x-dashboard.section>
            @includeIf('components.client.product-single')
        </x-dashboard.section>
        <x-hr/>

        <x-dashboard.section> 
            <x-dashboard.section.header>
                <x-slot name="title">
                    Order Now
                </x-slot>
                <x-slot name="content">
                    <strong>
                    Single Product: {{ $total ?? '0'}} TK 
                    </strong>
                </x-slot>
            </x-dashboard.section.header>
            <x-hr/>
            <x-dashboard.section.inner>
                <form wire:submit.prevent="confirm">
                    
                    <div class="md:flex justify-between items-start ">
                        
                        <div class="w-48 bg-indigo-900 text-white pr-2 p-3 md:sticky top-0 rounded shadow">
                            <div class="p-4 rounded shadow">
                                <div>
                                    <div class="text-xs">
                                        Product
                                    </div>
                                    <div class="text-sm">
                                        {{$product->name}}
                                    </div>
                                </div>
                                <x-hr/>
                                <div class="flex justify-between">
                                    <div class="text-xs">Price</div>
                                    <div class="text-sm bold">
                                        {{$price}}
                                    </div>
                                </div>
                                <x-hr/>
                                <div class="flex justify-between">
                                    <div class="text-xs">Unite</div>
                                    <div class="text-sm bold">
                                        {{$quantity}}
                                    </div>
                                </div>
                                <x-hr/>
                                <div class="flex justify-between">
                                    <div class="text-xs">Shipping</div>
                                    <div class="text-sm bold">
                                        {{$shipping}}
                                    </div>
                                </div>
                                <x-hr/>
                                <div class="flex justify-between">
                                    <div class="text-xs">Total</div>
                                    <div class="text-sm bold">
                                        {{$shipping + $total}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="w-full md:w-1/2">
                            @if (!empty($product->attr->value))
                                <div class="md:flex">
                                    @php
                                        $arrayOfAttr = explode(',', $product->attr?->value);
                                    @endphp
                                    <x-input-label style="width: 350px" for="size">{{ $product->attr?->name }}</x-input-label>
                                    <select wire:model.live="size" class=" rounded border-gray-300" required>

                                        <option value="Size Less" selected disable> -- select --  </option>
                                        @if (count($arrayOfAttr) > 0)     
                                            @foreach ($arrayOfAttr as $attr)
                                                <option value="{{$attr ?? "Size Less"}}"  disable>{{ $attr ?? "Size Less" }}</option>
                                            @endforeach
                                        @endif
                                        
                                    </select>
                                    @error('size')
                                        <strong>{{$message}}</strong>
                                    @enderror
                                </div>
                            @endif
                            <x-input-field class="md:flex" type="number" wire:model.live="quantity" min="1" label="Quantity" error="quantity" name="quantity" />
                            
                            {{-- <x-input-field  wire:model.live="name" label="Your Name" error="name" name="name" /> --}}
                            <x-input-field class="md:flex" wire:model.live="phone" label="Your Active Phone" error="phone" name="phone" />
                            <x-input-field class="md:flex" wire:model.live="district" label="District" error="district" name="district" />
                            <x-input-field class="md:flex" wire:model.live="upozila" label="Upozila" error="upozila" name="upozila" />
                            <div>
                                <x-input-field class="md:flex" wire:model.live="house_no" label="House No" error="house_no" name="house_no" />
                                <x-input-field class="md:flex" wire:model.live="road_no" label="Road No" error="road_no" name="road_no" />
                            </div>
                            <x-hr/>
                            <div class="mt-4">
                                <x-input-label>Your Full Address</x-input-label>
                                @if ($errors->has('location'))
                                    <div class="text-sm text-red-600">{{ $errors->first('location') }}</div>
                                @endif
                                <x-text-input wire:model.live="location" id="" class="w-full rounded" cols="5" placeholder="Address" />
                            </div>
                            <x-hr/>
                            
                            <div class="p-3 rounded bg-indigo-200 mt-4">
                                <x-input-label>Develery Option</x-input-label>
                                 @if ($product->shipping_note)
                                    <div class=" flex bg-gray-50 shadow rounded-lg p-1 bg-indigo-900">
                                        <i class="h-auto block rounded bg-gray-50 shadow-xl fas fa-bell p-2"></i>
                                        <p class="p-2 text-xs text-white">
                                            {{$product->shipping_note}}
                                        </p>
                                    </div>
                                @endif
                                <div class="">
                                    <div class="px-2">
                                        @if ($product->cod)
                                            
                                            <div class="flex items-start py-3">
                                                <input type="radio" wire:model.live="delevery" value="cash" style="width: 20px; height:20px" class="m-0 mr-3" id="">
                                                <x-input-label class="">
                                                    Cash-On Delivery
                                                    <p class="text-xs">
                                                        Get home delivery. Get the product and pay.
                                                    </p>
                                                </x-input-label>    
                                            </div>    
                                            <hr>
                                        @endif

                                        @if ($product->courier)
                                            
                                            <div class="flex items-start py-3">
                                                <input type="radio" wire:model.live="delevery" value="courier" style="width: 20px; height:20px" class="m-0 mr-3" id="">
                                                <x-input-label class="">
                                                    Courier
                                                    <p class="text-xs">
                                                        You wish to take your order via a courier service. Check your nearest courier provider and give us the correct address.
                                                    </p>    
                                                </x-input-label>    
                                            </div>    
                                            <hr>
                                        @endif

                                        @if ($product->hand)
                                            
                                            <div class="flex items-start py-3">
                                                <input type="radio" wire:model.live="delevery" value="hand" style="width: 20px; height:20px" class="m-0 mr-3" id="">
                                                
                                                <div>

                                                    <x-input-label class="">
                                                        Hand to Hand
                                                    </x-input-label>
                                                    <p class="text-xs">
                                                        You plan to take the product direct form seller shop. Great ! save your shipping coast.
                                                    </p>    
                                                </div>
                                            </div>    
                                        @endif

                                        @error('delevery')
                                            <div class="text-xs text-red-900">
                                                <strong> {{$message}} </strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <x-hr/>
                                    <div class="bg-gray-50 rounded shadow px-2">
                                        <div @class(["flex items-start py-3", 'hidden' => $delevery == 'hand']) >
                                            <input type="radio" wire:model.live="area_condition" value="Dhaka" style="width: 20px; height:20px" class="m-0 p-0 mr-3" id="">
                                            <x-input-label class="m-0 p-0">Inside Dhaka</x-input-label>    
                                        </div>    
                                        <hr>
                                        <div @class(["flex items-start py-3", 'hidden' => $delevery == 'hand']) >
                                            <input type="radio" wire:model.live="area_condition" value="Other" style="width: 20px; height:20px" class="m-0 p-0 mr-3" id="">
                                            <x-input-label class="m-0 p-0">Outside of Dhaka</x-input-label>    
                                        </div>    

                                        @if ($delevery == 'hand')

                                            <div class="bg-green-50">
                                                <strong>
                                                    Shop : {{$product?->owner?->resellerShop()->shop_name_en ?? "N/A"}}
                                                    <x-nav-link class="px-2 rounded-xl bg-gray-50 " href="{{route('shops.visit', ['id' => $product?->owner?->resellerShop(), 'name' => $product?->owner?->resellerShop()->shop_name_en])}}">
                                                        visit
                                                    </x-nav-link>
                                                </strong>

                                            </div>
                                        @endif
                                    </div>

                                </div>
                                <span class="text-xs">Define delevary type you chose.  You might be consider extra delevary charged for <strong>Home Delevary</strong> outside of Dhaka</span>
                            </div>
                            <br>
                            <x-primary-button >Confirm Order</x-primary-button>
                           
                        </div>
                    </div>
                
                </form>
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </x-dashboard.container>
</div>
