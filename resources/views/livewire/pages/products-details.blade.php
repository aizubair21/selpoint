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
        <x-dashboard.section x-data={show:false}>
            <x-dashboard.section.header>
                <x-slot name="title">
                    <div class="flex justify-between items-center">
                        Product Q/A 
                        <button x-html="show ? 'collapse' : 'expand'" class="border text-xs p-2 rounded-lg" x-on:click="show = !show">
                            
                        </button>
                    </div>
                </x-slot>
                <x-slot name="content">
                    Have any question regarding this products?
                </x-slot>
            </x-dashboard.section.header>
            <x-dashboard.section.inner > 
                <div class="mb-2">
                    <div class="py-2 ">
                        <div class="flex items-center text-xs mb-2">
                            <div class="">Your Qestions</div>
                        </div>

                        {{-- quetion body  --}}
                        <div class="p-2 border-l mb-3">
                            <div class="text-sm text-bold text-gray-600">July 16, 2025</div>
                            <div class="p-2">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. A quaerat labore voluptatem rerum delectus vero iusto quia culpa voluptatum quae.
                                <div class="text-gray-600 font-normal">
                                    <i class="fa-solid fa-sync"></i>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis, similique.
                                    <i>replied by shop</i>
                                </div>
                            </div>
                        </div>
                        {{-- quetion body  --}}
                    </div>
                </div>
                <div x-show="show" x-transition>
                    <x-hr/>
                    No More Question Found !
                    <x-hr/>
                </div>
                @auth
                    <div class="border rounded p-2 text-end">
                        <textarea name="" id="" cols="3" class="w-full rounded border-0 mb-2" placeholder="ask a question "></textarea>
                        <x-primary-button>ask</x-primary-button>
                    </div>
                @else
                    <div class="border rounded p-2 text-center">
                        login to ask question
                    </div>
                @endauth
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
                let duration = {{$countdown}} * 60;            
                
                if (task && duration > 0) {
                    let min = 0, sec = 0;
                    let ct = {{$currentTaskTime}} ?? 0;
                    let counterLoop = setInterval(() => {

                        if (ct > duration) {
                            clearInterval(counterLoop);
                            window.location.reload();
                        }else{

                            $wire.dispatch("count-task");
                            console.log(ct, duration);
                        }
                        
                    }, 1000);
                };

            </script>
        @endscript
        
        {{-- <script>
            let token = "{{csrf_token()}}";
            let req = new XMLHttpRequest();

            req.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(JSON.parse(this.response));
                    
                }
            };
            req.open("get", "http://eruhi.local/http/test", true);
            req.send();

        </script> --}}
    @endauth
</div>
