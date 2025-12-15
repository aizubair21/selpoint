<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <x-dashboard.container>

        <div>

            <div class="text-3xl">
                Checkout
            </div>
            <div>
                view and order your cart produtct. <x-nav-link href="{{route('carts.view')}}"><i
                        class="fa-solid fa-up-right-from-square me-2"></i> carts </x-nav-link>
            </div>

            <div>
                <div>
                    <b>
                        Notice:
                    </b>

                    You're order from Multiple Shops
                </div>

                <div class="text-xs">
                    You have added product from more than one shop. Please nothe that, items from different shops are
                    shipped seperately, which will result in <strong>Multiple Shipping Charges.
                    </strong> <br>
                    To reduce delivery cost and ensure a smoother experience, we recommend placing orders from <strong>a
                        single shop at a time.</strong> Review the shop name to your cart before placing orders.
                </div>
            </div>
        </div>


        <div>
            <div class="">

                <x-dashboard.foreach :data="$carts">
                    <x-dashboard.table>
                        <thead>
                            <th></th>
                            <th></th>
                            <th>Shop</th>
                            <th>Quantity</th>
                            <th>Attr</th>
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
                                    <x-nav-link
                                        href="{{route('products.details', ['id' => $cart['product_id'] ?? '',  'slug' => Str::slug($cart['name']) ?? ''])}}">
                                        <div class="block lg:flex items-center">
                                            <img width="30px" height="30px" src="{{asset('storage/'. $cart['image'])}}"
                                                alt="">
                                            <span class="text-xs ml-1 text-wrap">
                                                {{$cart['name'] ?? "N/A" }}
                                            </span>
                                        </div>
                                    </x-nav-link>
                                </td>
                                <td>
                                    <x-nav-link>

                                        <div class="text-xs px-1">
                                            {{auth()->user()->myCarts[$key]->product?->owner?->resellerShop()->shop_name_en
                                            ?? "N/A"}}
                                        </div>
                                    </x-nav-link>
                                </td>
                                <td>
                                    <div class="flex justify-between text-center px-1 py-0 border rounded"
                                        style="width: 120px">
                                        <button class="p-1 text-md" wire:click="decreaseQuantity({{$cart['id']}})">-
                                            </-button>
                                            <input style="width:50px"
                                                class="border-0 py-0 text-center text-sm w-sm rounded" min="1"
                                                type="text" @disabled(true) value="{{$cart['qty']}}" />
                                            <button class="p-1 text-md"
                                                wire:click="increaseQuantity({{$cart['id']}})">+</button>
                                    </div>
                                </td>

                                <td>
                                    @if (!empty(auth()->user()->myCarts()->find($cart['id'])->product?->attr->value))
                                    <div class="">
                                        @php
                                        $arrayOfAttr = explode(',',
                                        auth()->user()->myCarts()->find($cart['id'])->product?->attr?->value);
                                        @endphp
                                        <x-input-label class="text-xs" for="size">{{
                                            auth()->user()->myCarts()->find($cart['id'])->product?->attr?->name }}
                                        </x-input-label>
                                        <select wire:model.live="carts.{{$key}}.size"
                                            class="text-sm rounded border-gray-300">

                                            {{-- <option value="Size Less" selected disable>{{
                                                auth()->user()->myCarts()->find($cart['id'])->product?->attr?->name }}
                                            </option> --}}
                                            @if (count($arrayOfAttr) > 0)
                                            @foreach ($arrayOfAttr as $attr)
                                            <option value="{{$attr ?? " Size Less"}}" disable>{{ $attr ?? "Size Less" }}
                                            </option>
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
                                <td></td>
                                <td class="bold">
                                    <strong> {{$tp ?? "0"}} TK</strong>
                                </td>
                            </tr>
                            @if ($delevery == 'hand')

                            <tr>
                                <td colspan="2">
                                    Shipping
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>

                                <td>
                                    {{$shipping}} TK
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td colspan="2">
                                    Shipping
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>

                                <td>
                                    Depend On
                                </td>
                            </tr>

                            @endif
                            <tr>
                                <td colspan="2">
                                    Total Payable
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>

                                <td>
                                    {{$shipping + $tp}} TK
                                </td>
                            </tr>
                        </tfoot>

                    </x-dashboard.table>
                </x-dashboard.foreach>

                <br>
                <br>
                <div class="p-3 lg:w-1/2 m-2 bg-white rounded-md">

                    <form wire:submit.prevent="confirm" class="w-full">

                        <div>

                            <div class="w-full pr-2">

                                {{--
                                <x-input-field wire:model.live="name" label="Your Name" error="name" name="name" /> --}}
                                <x-input-field wire:model.live="phone" class="w-full" label="Your Active Phone"
                                    error="phone" name="phone" />

                                <div class="px-2 bg-gray-200">
                                    <div class="flex items-center py-3">
                                        <input type="radio" wire:model.live="area_condition" value="Dhaka"
                                            style="width: 20px; height:20px" class="mr-3 mb-0" id="">
                                        <x-input-label class="">Inside Dhaka</x-input-label>
                                    </div>
                                    <hr>
                                    <div class="flex items-center py-3">
                                        <input type="radio" wire:model.live="area_condition" value="Other"
                                            style="width: 20px; height:20px" class="mb-0 mr-3" id="">
                                        <x-input-label class="">Outside of Dhaka</x-input-label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <x-input-label>Your Full Address</x-input-label>
                                    @if ($errors->has('location'))
                                    <div class="text-sm text-red-600">{{ $errors->first('location') }}</div>
                                    @endif
                                    <textarea wire:model.live="location" id="" class="w-full rounded" cols="3"
                                        placeholder="Address"></textarea>
                                </div>
                                <hr>
                                <div class="p-1 rounded bg-indigo-200 mt-4">
                                    <x-input-label>Develery Option</x-input-label>
                                    <div class="px-2 bg-gray-200">
                                        <div class="flex items-start py-3">
                                            <input type="radio" wire:model.live="delevery" value="cash"
                                                style="width: 20px; height:20px" class="mr-3" id="">
                                            <x-input-label class="">
                                                Cash-On Delivery
                                                <p class="text-xs">
                                                    Get home delivery. Get the product and pay.
                                                </p>
                                            </x-input-label>
                                        </div>
                                        <hr>
                                        <div class="flex items-start py-3">
                                            <input type="radio" wire:model.live="delevery" value="courier"
                                                style="width: 20px; height:20px" class="mr-3" id="">

                                            <x-input-label class="">
                                                Courier
                                                <p class="text-xs">
                                                    You wish to take your order via a courier service. Check your
                                                    nearest
                                                    courier provider and give us the correct address.
                                                </p>
                                            </x-input-label>
                                        </div>
                                        <hr>
                                        <div class="flex items-start py-3">
                                            <input type="radio" wire:model.live="delevery" value="hand"
                                                style="width: 20px; height:20px" class="mr-3" id="">

                                            <div>
                                                <x-input-label class="">
                                                    Hand to Hand
                                                </x-input-label>
                                                <p class="text-xs">
                                                    You plan to take the product direct form seller shop. Great ! save
                                                    your
                                                    shipping coast.
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="text-xs">Define delevary type you chose. You might be consider extra
                                        delevary
                                        charged for <strong>Cash-On Delivery</strong> outside of Dhaka</div>
                                </div>



                            </div>

                            <div class="w-full">

                                <x-input-file label="Country" name="country" error="country">
                                    <select wire:model.live="country" id="country" class="w-full rounded-md ">
                                        <option value=""> -- Select Country --</option>
                                        @foreach (App\Models\Country::get() as $state)
                                        <option value="{{$state->name}}">{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                </x-input-file>
                                <x-hr />
                                <x-input-file label="District" name="state" error="district">
                                    <select wire:model.live="district" id="states" class="w-full rounded-md ">
                                        <option value=""> -- Select State --</option>
                                        @foreach ($states as $state)
                                        <option value="{{$state->name}}">{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                </x-input-file>
                                <x-hr />
                                <x-input-file label="Upozila" name="city" error="upozila">
                                    <select wire:model.live="upozila" id="states" class="w-full rounded-md ">
                                        <option value=""> -- Select City --</option>
                                        @foreach ($cities as $item)
                                        <option value="{{$item->name}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </x-input-file>
                                <x-hr />
                                <x-input-file label="Location" name="targeted_area" error="area_name">
                                    <select wire:model.live="area_name" id="states" class="w-full rounded-md ">
                                        <option value=""> -- Select Area --</option>
                                        @foreach ($area as $item)
                                        <option value="{{$item->name}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </x-input-file>
                                <div>
                                    <x-input-field inputClass="w-full" class="mb-1" wire:model.live="house_no"
                                        label="House No" error="house_no" name="house_no" />
                                    <x-input-field inputClass="w-full" class="mb-1" wire:model.live="road_no"
                                        label="Road No" error="road_no" name="road_no" />
                                </div>
                            </div>

                        </div>

                        <x-hr />
                        <div class="text-start">
                            <x-primary-button>Confirm Order</x-primary-button>
                        </div>
                    </form>

                </div>


            </div>

        </div>
    </x-dashboard.container>

</div>