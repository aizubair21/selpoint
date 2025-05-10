<div>
    {{-- The whole world belongs to you. --}}

    <x-dashboard.page-header>
        Resel Products
    </x-dashboard.page-header>

    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    <div class="text-md">Product Review for Resel</div>
                </x-slot>

                <x-slot name="content">
                    If you plan to resel produt, you are requested to copy product data form here then add to your won product.
                </x-slot>
            </x-dashboard.section.header>
            <x-hr/>

            <x-dashboard.section.inner>

                <div style="width:170px" class="shadow-xl">
                    @includeIf('components.dashboard.reseller.resel-product-cart', ['pd' => $products])
                </div>
                <x-hr/>
                {{-- @includeIf('components.client.product-single', ['product' => $products]) --}}

                <div class="lg:flex justify-between item-start p-2">
                    <!-- card left -->
                    <div class="w-full lg:w-1/2 ">
                        <div class="img-display">
                            <div class="img-showcase relative">
                                <img id="preview" class=" p-2 rounded" style="width: 100%; object-fit:contain; max-width:400px; height:300px" height="400" src="{{ asset('storage/' . $products?->thumbnail) }}"alt="image">
                                <x-secondary-button type="button" class="absolute top-0 left-0" title="Download the image" wire:click.prevent='downImage("{{$products->thumbnail}}")'>
                                    <i class="fa-solid fa-floppy-disk"></i> 
                                </x-secondary-button>
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
                                <a wire:navigate href="{{route('category.products' , ['cat' =>$products->category?->name])}}" class="w-full p-1 bg-indigo-700 text-white uppercase" >
                                    {{$products->category?->name ?? "Undefined"}}
                                </a>
                                {{-- {{$catName->id}} --}}
                
                            </div>
                            <div class="upper text-sm">{{$products->name}}</div>
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

                                <div>
                                    <div>
                                        <div class="text-sm">Vendor</div>
                                        <div class="text-lg text-indigo-900"> 
                                            @php
                                                // use App\Models\User;
                                                $owner = App\Models\User::find($products->user_id);
                                            @endphp
                                            {{$owner->name ?? "n/a"}}
                                        </div>
                                    </div>
                                    <x-hr/>
                                    <div>
                                        <div class="text-sm">Shop</div>
                                        <div class="text-lg text-indigo-900"> 
                                            {{-- {{$products->id ?? "N/A"}} --}}
                                            {{$owner->isVendor()->shop_name_en ?? "n/a"}} <span class="text-xs"> ( {{$owner->isVendor()->shop_name_bn ?? "n/a"}} ) </span> 
                                        </div>
                                    </div>
                                    <x-hr/>
                                    <div>
                                        <div class="text-sm">Shop Addrss</div>
                                        <div class="text-sm text-indigo-900"> 
                                            {{-- {{$products->id ?? "N/A"}} --}}
                                            {{$owner->isVendor()->address ?? "n/a"}}
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div>
                                        <div class="text-sm">Shop Phone</div>
                                        <div class="text-lg text-indigo-900"> 
                                           
                                            {{$owner->isVendor()->phone ?? "n/a"}}
                                        </div>
                                    </div>
                                    <x-hr/>
                                    <div>
                                        <div class="text-sm">Shop Email</div>
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
                <div class="text-right">
                    <x-secondary-button onclick="copyPaymentNumber(this, 'pDes')">copy description</x-secondary-button>
                </div>
            </x-dashboard.section.inner>
        </x-dashboard.section>
     
    </x-dashboard.container>

    <script>
        function copyPaymentNumber(e, elementId) 
        {
            const paymentNumberInput = document.getElementById(elementId);
            const tempTextarea = document.createElement("textarea");
            tempTextarea.value = paymentNumberInput.value || paymentNumberInput.textContent || paymentNumberInput.innerText;
    
    
              // Append the textarea to the DOM (off-screen)
            tempTextarea.style.position = "fixed";
            tempTextarea.style.opacity = "0";
            document.body.appendChild(tempTextarea);
    
    
              // Select the content of the textarea
            tempTextarea.select();
            tempTextarea.setSelectionRange(0, 99999); // For mobile devices
    
            // Copy the selected content to the clipboard
            try {
                document.execCommand("copy");
                // console.log("Content copied to clipboard!");
                // alert('copied !')
                e.innerText = 'copied';
                setTimeout(() => {
                    e.innerText = 'copy description';
                }, 2000);
            } catch (err) {
                console.error("Failed to copy content: ", err);
            }
    
            // Remove the temporary textarea
            document.body.removeChild(tempTextarea);
    
            // var refer = document.getElementById('refer_link_display');
            // paymentNumberInput.select();
            // refer.setSelectionRange(0,9999);
            // document.exceCommand('copy');
            // let ke = new keyboardEvent();
            // navigator.clipboard.writeText(refer.value);
            
        }
    </script>
</div>
