<div>
    {{-- The Master doesn't talk, he acts. --}}
    <style>
        #taskPrev{
            position: fixed;
            bottom: 10px;
            right: 20px;
            width: 70px;
            height: 30px;
            border: 1px solid rgb(25, 78, 46);
            border-radius: 25px;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #ffffff;
            /* box-shadow: 0px 0px 5px gray; */
            font-size: 18px;
            /* display: none; */

        }

        #taskPrev .badges{
            position: absolute;
            top: -12px;
            left: 0px;
            padding: 1px 5px;
            background-color: green;
            color: white;
            font-size: 10px;
            border-radius: 25px;
        }

        .price-alert{
            position: fixed;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            z-index: 9999;

        }
    </style>

    <x-dashboard.container>
        <div class=" ">
            <div class="">
                <x-dashboard.section>
                    @includeIf('components.client.product-single')
                </x-dashboard.section>
            </div>

            {{-- <div class="lg:w-12 p-2">
                <div class="py-2">Related Products</div>
                @foreach($relatedProduct as $product)
                    <div class="col-6 p-1 mb-3">
                        <x-client.product-cart :$product :key="$product->id" />
                    </div>
                @endforeach
            </div> --}}
        </div>

        
        {{-- <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Related Products
                </x-slot>
                <x-slot name="content">

                </x-slot>
            </x-dashboard.section.header>
            <x-dashboard.section.inner>
                <div class="">
                    @foreach($relatedProduct as $product)
                        <div class="col-6 p-1 mb-3">
                            <x-client.product-cart :$product :key="$product->id" />
                        </div>
                    @endforeach
                </div>
            </x-dashboard.section.inner>
        </x-dashboard.section> --}}

        {{-- summery and specifications  --}}
        <x-dashboard.section x-data="{tab:'summery'}">
            <x-dashboard.section.header>
                <x-slot name="title">
                    Product Specification & Summery
                </x-slot>
                <x-slot name="content">
                    <div class="w-full border-b flex items-center" style="height: 28px">
                        <div class="px-2 cursor-pointer" x-on:click="tab = 'summery'" > Summery </div>
                        <div class="px-2 cursor-pointer" x-on:click="tab = 'shop'"> About Shop </div>
                    </div>
                </x-slot>
            </x-dashboard.section.header>
            <x-dashboard.section.inner>
                <div x-show="tab == 'summery'" x-transition>
                    <div class="bg-white p-2 w-full">
                        {!! $product->description ?? "No Description Found !" !!}
                    </div>
                </div>
                <div x-show="tab == 'shop'" x-transition>
                    <div class="mx:w-[-350px] rounded border bg-gray-200 pt-2" >
                    @if (auth()?->user()?->id == $product->user_id)
                        <strong class="p-2 rounded border bg-sky-900 text-white">It's your product </strong>
                    @else 
                        <x-dashboard.section >
                            <x-dashboard.section.header>
                                <x-slot name="title">
                                    Shop Details
                                </x-slot>
                                <x-slot name="content">
                                    this product belongs to bellow shop. see about the shop.
                                </x-slot>
                            </x-dashboard.section.header>
                
                            <x-dashboard.section.inner>
                                <div class="flex flex-wrap">
                                    <div class=" border-b w-48 m-2 p-2">
                                        <div class="text-sm font-normal">
                                            Shop Name
                                        </div>
                                        <div class="text-md font-bold">
                                            {{$product?->owner?->resellerShop()->shop_name_en ?? "N/A"}}
                                        </div>
                                    </div>
                                    <div class=" border-b w-48 m-2 p-2">
                                        <div class="text-sm font-normal">
                                            Shop Owner
                                        </div>
                                        <div class="text-md font-bold">
                                            {{$product?->owner?->name ?? "N/A"}}
                                        </div>
                                    </div>
                                    <div class=" border-b w-48 m-2 p-2">
                                        <div class="text-sm font-normal">
                                            Shop Location
                                        </div>
                                        <div class="text-md font-bold">
                                            {{$product?->owner?->resellerShop()->address ?? "N/A"}}
                                        </div>
                                    </div>
                                    <div class=" border-b w-48 m-2 p-2">
                                        <div class="text-sm font-normal">
                                            Shop Address
                                        </div>
                                        <div class="text-md font-bold">
                                            {{$product?->owner?->resellerShop()->address ?? "N/A"}}
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="flex flex-wrap ">
                                    <x-nav-link-btn href="">  Visit Shop</x-nav-link-btn>
                                    <x-nav-link-btn href="" class="space-x-2 space-y-2">Shop Products</x-nav-link-btn>
                                    <x-nav-link-btn href="">Report Against Shop</x-nav-link-btn>
                                </div>
                            </x-dashboard.section.inner>
                        </x-dashboard.section>
                    @endif
                </div>
                </div>
            </x-dashboard.section.inner>

        </x-dashboard.section>

       

        {{-- reveiws  --}}
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Reviews & Ratings
                </x-slot>
                <x-slot name="content">

                </x-slot>
            </x-dashboard.section.header>
            <x-dashboard.section.inner>
                
            </x-dashboard.section.inner>
        </x-dashboard.section>
       
       
       
        {{-- Product Q/A  --}}
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Product Q/A 
                </x-slot>
                <x-slot name="content">
                    Han any question regarding this products?
                </x-slot>
            </x-dashboard.section.header>
            <x-dashboard.section.inner> 
                
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </x-dashboard.container>


    {{-- daily task counter  --}}
    @if (!$taskNotCompletYet)
        <div id="taskPrev" >
            <div class="badges "> Task</div>
            Done
        </div>
    @else
        <div id="taskPrev">
            <div class="badges" > {{$package->countdown ?? 0}} MIN</div>
            <div id="min">
                {{$min}}
            </div>
            :
            <div id="sec">
                {{$sec}}
            </div>
        </div>
    @endif



    @auth

    @script
        <script>
            
            let task = {{$taskNotCompletYet}};
            let duration = {{$package->countdown}} * 60;            
            
            if (task) {
                let min = 0, sec = 0;
                let ct = {{$currentTaskTime}} ?? 0;
                let counterLoop = setInterval(() => {

                    if (ct > duration) {
                        clearInterval(counterLoop);
                    }
                    // console.log(ct, duration);
                    // min = Math.floor(ct/60);
                    // sec = ct - (min * 60)
                    
                    // document.getElementById('min').innerText = min;
                    // document.getElementById('sec').innerText = sec;
                        $wire.dispatch("count-task");
                    ct++;
                }, 1000);
            }

            console.log('hello');
        </script>
    @endscript

    @endauth
</div>
