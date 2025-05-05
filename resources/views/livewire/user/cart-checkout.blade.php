<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Checkout
                </x-slot>
                <x-slot name="content">
                    view and order your cart produtct.
                </x-slot>
            </x-dashboard.section.header>
        </x-dashboard.section>

        <pre>
            @php
                // print_r(auth()->user()->myCarts()->groupBy('belongs_to')->toArray() );
            @endphp
        </pre>

        {{-- <x-dashboard.section>
            <x-dashboard.foreach :data="auth()->user()->myCarts">
                <x-dashboard.table>
                    <thead>
                        <th></th>
                        <th>product</th>
                        <th>quantity</th>
                        <th>price</th>
                    </thead>
    
                    <tbody>
                        @foreach (auth()->user()->myCarts as $cart)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <div class="flex">
                                        <img width="30px" height="30px" src="{{asset('storage/' . $cart->thumbnail)}}" alt="">
                                        {{$cart->product?->name ?? "N/A"}}
                                    </div>
                                </td>
                                <td>
                                    {{$cart->quantity ?? "0"}}
                                </td>
                                <td> {{$cart->total ?? "0"}} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-dashboard.table>
            </x-dashboard.foreach>
        </x-dashboard.section> --}}


        <x-dashboard.section>
            <x-dashboard.foreach :data="$carts" >
                <x-dashboard.table>
                    <thead>
                        <th></th>
                        <th></th>
                        <th>Quantity</th>
                        <th>Size</th>
                        <th>Price</th>
                    </thead>
    
                    <tbody>
                        @php
                            $tprice = 0;
                        @endphp
                        @foreach ($carts as $key => $cart)
                            @php
                                $sprice = $cart['price'] * $cart['qty'];
                                $tprice =+ $sprice;
                            @endphp
                            <tr>
                                <td> {{$loop->iteration}} </td>
                                <td class="text-sm">
                                    <x-nav-link href="{{route('products.details', ['id' => $cart['product_id'] ?? '',  'slug' => Str::slug($cart['name']) ?? ''])}}" >
                                        <div class="block lg:flex">
                                            <img width="30px" height="30px" src="{{asset('storage/'. $cart['image'])}}" alt="">
                                            <span class="text-xs ml-1 text-wrap" >
                                                {{$cart['name'] ?? "N/A" }}
                                            </span>
                                        </div>
                                    </x-nav-link>
                                </td>
                                <td>
                                    <div class="flex justify-between px-1 py-0 border rounded" style="width: 120px">
                                        <button class="p-1 text-lg" wire:click="decreaseQuantity({{$cart['id']}})" >-</-button>
                                        <input style="width:50px" class="border-0 py-0 text-center text-sm w-sm rounded" min="1" type="text" @disabled(true) value="{{$cart['qty']}}"  />
                                        <button class="p-1 text-lg" wire:click="increaseQuantity({{$cart['id']}})" >+</button>
                                    </div>
                                </td>
                                <td>
                                    @if (!empty(auth()->user()->myCarts()->find($cart['id'])->product?->attr->value))
                                        <div class="">
                                            @php
                                                $arrayOfAttr = explode(',', auth()->user()->myCarts()->find($cart['id'])->product?->attr?->value);
                                            @endphp
                                            <x-input-label class="text-xs" for="size">{{ auth()->user()->myCarts()->find($cart['id'])->product?->attr?->name }}</x-input-label>
                                            <select wire:model.live="carts.{{$key}}.size" wire:change="changeSize({{$key}})" class="text-sm rounded border-gray-300">
                                                
                                                        {{-- <option value="Size Less" selected disable>{{ auth()->user()->myCarts()->find($cart['id'])->product?->attr?->name }}    </option> --}}
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
                                </td>
                                <td class="text-nowrap">
                                    {{$cart['price']}} x {{$cart['qty']}} = {{ $sprice ?? "N/A" }}
                                </td>
                               
                            </tr>
                        @endforeach
                    </tbody>
                    
                    <tfoot class="bg-gray-200">
                        <tr>
                            <td colspan="2">
                                Price
                            </td>
                            <td>
                            </td>
                            <td></td>
                            <td class="bold" >
                                <strong> {{$tp ?? "0"}} TK</strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Shipping
                            </td>
                            <td></td>
                            <td></td>
                            
                            <td >
                                {{$area_condition == 'Dhaka' ? '80' : '120'}} TK
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Total Payable
                            </td>
                            <td></td>
                            <td></td>
                            
                            <td >
                                {{($area_condition == 'Dhaka' ? '80' : '120') + $tp}} TK
                            </td>
                        </tr>
                    </tfoot>
    
                </x-dashboard.table>
            </x-dashboard.foreach>

           
        </x-dashboard.section>
    </x-dashboard.container>


    
    <x-dashboard.container>
        <x-dashboard.section>
            <form wire:submit.prevent="confirm">

                <div class="md:flex justify-between">
                    
                    <div class="w-full md:w-1/2 pr-2">

                        {{-- <x-input-field  wire:model.live="name" label="Your Name" error="name" name="name" /> --}}
                        <x-input-field  wire:model.live="phone" label="Your Active Phone" error="phone" name="phone" />
                        
                        <x-hr/>
                        <div class="px-2 bg-gray-200">
                            <div class="flex items-center py-3">
                                <input type="radio" wire:model.live="area_condition" value="Dhaka" style="width: 20px; height:20px" class="mr-3" id="">
                                <x-input-label class="">Inside Dhaka</x-input-label>    
                            </div>    
                            <hr>
                            <div class="flex items-center py-3">
                                <input type="radio" wire:model.live="area_condition" value="Other" style="width: 20px; height:20px" class="mr-3" id="">
                                <x-input-label class="">Outside of Dhaka</x-input-label>    
                            </div>    
                        </div>
                        <x-hr/>
                        <div class="mt-4">
                            <x-input-label>Your Full Address</x-input-label>
                            @if ($errors->has('location'))
                                <div class="text-sm text-red-600">{{ $errors->first('location') }}</div>
                            @endif
                            <textarea wire:model.live="location" id="" class="w-full rounded" cols="5" placeholder="Address"></textarea>
                        </div>
                        <hr>
                        <div class="p-1 rounded bg-indigo-200 mt-4">
                            <x-input-label>Develery Option</x-input-label>
                            <div class="px-2 bg-gray-200">
                                <div class="flex items-center py-3">
                                    <input type="radio" wire:model.live="delevery" value="Home" style="width: 20px; height:20px" class="mr-3" id="">
                                    <x-input-label class="">Home Delevery</x-input-label>    
                                </div>    
                                <hr>
                                <div class="flex items-center py-3">
                                    <input type="radio" wire:model.live="delevery" value="Courier" style="width: 20px; height:20px" class="mr-3" id="">
                                    <x-input-label class="">Courier</x-input-label>    
                                </div>    
                            </div>
                            <span class="text-xs">Define delevary type you chose.  You might be consider extra delevary charged for <strong>Home Delevary</strong> outside of Dhaka</span>
                        </div>

    
                        
                    </div>

                    <div class="w-full md:w-1/2">
                        
                        <x-input-field  wire:model.live="district" label="District" error="district" name="district" />
                        <x-input-field  wire:model.live="upozila" label="Upozila" error="upozila" name="upozila" />
                        <div>
                            <x-input-field  wire:model.live="house_no" label="House No" error="house_no" name="house_no" />
                            <x-input-field  wire:model.live="road_no" label="Road No" error="road_no" name="road_no" />
                        </div>
                        <x-primary-button >Confirm Order</x-primary-button>
                        <br><br>
                    </div>
                </div>
            
            </form>
        </x-dashboard.section>
    </x-dashboard.container>
</div>
