<div>
    {{-- The whole world belongs to you. --}}


    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    <div class="text-md">Product Review for Resel</div>
                </x-slot>
                
                <x-slot name="content">
                    <div class="text-xs font-normal">
                        wish to resel this product, just click on the button bellow
                    </div>
                    <div class="flex"> 
                        <x-primary-button class="" type="button" x-on:click="$dispatch('open-modal', 'confirm-resel')">
                            resell this product
                        </x-primary-button>
                    </div>
                </x-slot>
            </x-dashboard.section.header>
            <x-hr/>

            <x-dashboard.section.inner>

                
                {{-- @includeIf('components.client.product-single', ['product' => $products]) --}}

                <div class="lg:flex justify-between item-start p-2">
                    <!-- card left -->
                    <div class="w-full lg:w-1/2 ">
                        <div class="img-display">
                            <div class="img-showcase relative">
                                <img id="preview" class=" p-2 rounded" style="width: 100%; object-fit:contain; max-width:400px; height:300px" height="400" src="{{ asset('storage/' . $products?->thumbnail) }}"alt="image">
                                {{-- <x-secondary-button type="button" class="absolute top-0 left-0" title="Download the image" wire:click='downImage({{$products->thumbnail}})'>
                                    <i class="fa-solid fa-floppy-disk"></i> 
                                </x-secondary-button> --}}
                            </div>
                
                            @if ($products->showcase)
                                <div class="d-flex align-items-center" style="flex-wrap: wrap">
                                    <button class="p-1 rounded mb-1">
                                        <img class=" border p-1 rounded" onclick="previewImage(this)" src="{{asset('storage/'. $products?->thumbnail)}}" width="45px" height="45px" alt="">
                                    </button>
                                    @foreach ($products->showcase as $images)
                                        <button class="p-1 rounded mb-1">
                                            <img width="45px" height="45px"  class=" border p-1 rounded" onclick="previewImage(this)" src="{{asset('storage/'. $images?->image)}}" width="45px" height="45px" alt="">
                                        </button>
                                    @endforeach
                                </div>
                            @endif
                
                        </div>
                    </div>
                
                    <div class="w-full lg:w-1/2 py-3 lg:py-0 px-4 lg:px-0">
                        <div>
                            <div class="text-gray-400 bold rounded" style="font-size: 12px">
                                {{-- @php
                                    $catName = DB::table("categories")->where(['id'=>$products->category_id])->select(['id', 'name'])->first();
                                @endphp --}}
                                <a wire:navigate href="{{route('reseller.resel-product.index' , ['cat' =>$products->category_id])}}" class="w-full p-1 bg-indigo-700 text-white uppercase" >
                                    {{$products->category?->name ?? "Undefined"}}
                                </a>
                                {{-- {{$catName->id}} --}}
                
                            </div>
                            {{-- <div class="upper text-sm">{{$products->name}}</div> --}}
                            <div class="text-indigo-900 bold text-3xl capitalize">{{$products->title}}</div>
                            
                        </div>
                        <hr>
                        
                
                        <div class="py-2 my-2">
                
                            @if ($products->attr)
                                <h4 class=""> {{ !empty($products->attr?->name) }} </h4>
                                @php
                                    //convert the string attr-value to array
                                    $arrayOfAttr = explode(',', $products->attr?->value);
                                @endphp
                                <div class="flex justify-start items-center my-1" style="flex-wrap: wrap;gap: 10px;">
                                    @foreach ($arrayOfAttr as $attr)
                                        <div class="border rounded mr-2 d-none @if($attr) d-block @endif" style="width:45px; height:35px; align-content:center; text-align:center">
                                            {{ $attr }}
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="text-2xl flex bold">
                            Price : <div class="bold text-bold text-indigo-900"> {{ $products->price}} TK </div>
                        </div>
                        

                        <div class="rounded-lg bg-gray-200 p-3 mt-3">
                            <div class="md:flex justify-between w-full">

                                @php
                                    // use App\Models\User;
                                    $owner = App\Models\User::find($products->user_id);
                                @endphp
                                <div>
                                    <div>
                                        <div class="text-sm">Vendor</div>
                                        <x-nav-link class="text-lg text-indigo-900"> 
                                            {{$owner->name ?? "n/a"}}
                                        </x-nav-link>
                                    </div>
                                    <x-hr/>
                                    <div>
                                        <div class="text-sm">Shop / Brand</div>
                                        <div class="text-lg text-indigo-900"> 
                                            {{-- {{$products->id ?? "N/A"}} --}}
                                            {{$owner->isVendor()->shop_name_en ?? "n/a"}} <span class="text-xs"> ( {{$owner->isVendor()->shop_name_bn ?? "n/a"}} ) </span> 
                                        </div>
                                    </div>
                                    <x-hr/>
                                    <div>
                                        <div class="text-sm">Addrss</div>
                                        <div class="text-sm text-indigo-900"> 
                                            {{-- {{$products->id ?? "N/A"}} --}}
                                            {{$owner->isVendor()->address ?? "n/a"}}
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div>
                                        <div class="text-sm">Phone</div>
                                        <div class="text-lg text-indigo-900"> 
                                           
                                            {{$owner->isVendor()->phone ?? "n/a"}}
                                        </div>
                                    </div>
                                    <x-hr/>
                                    <div>
                                        <div class="text-sm">Email</div>
                                        <div class="text-lg text-indigo-900"> 
                                           
                                            {{$owner->isVendor()->email ?? "n/a"}}
                                        </div>
                                    </div>
                                </div>
                               
                            </div> 
                        </div>


                    </div>
                
                
                    <script>
                        function previewImage(element){
                            const file = element.src;
                            console.log(file);
                            document.getElementById('preview').src = file;
                            // const reader = new FileReader();
                            // reader.onload = () => {
                            //     const preview = document.getElementById('preview');
                            //     preview.src = reader.result;
                            // };
                            // reader.readAsDataURL(file);
                                
                        }
                    </script>
                </div>

            </x-dashboard.section.inner>
        </x-dashboard.section>

        <x-dashboard.section>
            <x-dashboard.section.inner>
                <x-input-label>Description</x-input-label>
                {{-- <textarea id="" class="w-full rounded pt-3" rows="10"> {{$products->description}}  </textarea> --}}
                <textarea id="pDes" class="w-full rounded pt-3" rows="10">
                    {{$products->description}}
                </textarea>
                {{-- <div class="text-right">
                    <x-secondary-button onclick="copyPaymentNumber(this, 'pDes')">copy description</x-secondary-button>
                </div> --}}
            </x-dashboard.section.inner>
        </x-dashboard.section>
        
        <div style="width:170px" class="shadow-xl">
            @includeIf('components.dashboard.reseller.resel-product-cart', ['pd' => $products])
        </div>
        <x-hr/>
    </x-dashboard.container>

    {{-- resel confirm modal  --}}
    <x-modal name="confirm-resel">
        <div class="p-2 px-4">
            <div class="py-2 font-bold">
                Resel Product
            </div>
            <x-hr/>
            <div>
                <div class="text-sm">
                    Your are going to add this product to your product list to resell this with a veiw to earn more profit with your custom price. Your may able to update product price after product successfully cloed to your product list. By clicking <strong>CONFIRM</strong> button, bellow task goig to be done ...
                    <x-hr/>
                    <ul list-item="number">
                        <li>
                            Product going to be add to your product list.
                        </li>
                        <li>
                            Sytem take a track for your reseling.
                        </li>
                        <li>
                            product owner get a message from you that you are reselling this products. 
                        </li>
                        
                    </ul>
                </div>
            </div>
            <x-hr/>
            <div class="md:flex justify-between ">
                <div class="mb-2">

                    <x-input-label value="Resel Price" />
                    <x-text-input min="{{$products->price}}" type="number" wire:model.live="reselPrice" class="w-full" />
                </div>

                <div>
                    <x-input-label value="Reseller Category" />
                    <select wire:model="resellerCat" id="" class="rounded border w-full">
                        <option value="">Select Category</option>
                        @foreach ($categories as $children)
                            <option value="{{$children->id}}"> {{$children->name}} </option>

                            @if (count($children->children) > 0)
                                @foreach ($children->children as $child)
                                    <option value="{{$child->id}}"> -- {{$child->name}} </option>
                                    
                                    @if (count($child->children) > 0)
                                        @foreach ($child->children as $grandChild)
                                            <option value="{{$grandChild->id}}"> ---- {{$grandChild->name}} </option>
                                        @endforeach
                                    @endif
                                @endforeach
                                
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
                <div>
                    Profit : {{$reselPrice - $products->price}}
                </div>
            {{-- <p class="p-2 mt-2 bg-gray-500 text-white font-bold">
                Your are able to update product price just once. Other information won't be ommitable.
                <br>
            </p> --}}
            For procced, click to confirm button.
            <div class="flex justify-end items-start space-x-3">
                <x-primary-button type="button" wire:click="confirmClone">Confirm</x-primary-button>
            </div>
        </div>
    </x-modal>
    {{-- resel confirm modal  --}}
</div>
