<div>
    <x-dashboard.page-header>
        Static Slider
    </x-dashboard.page-header>

    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    <div class="flex justify-between items-center">

                        <div>

                            <x-nav-link href="?nav=web" :active="$nav=='web'">Web</x-nav-link>
                            <x-nav-link href="?nav=apps" :active="$nav=='apps'">App</x-nav-link>
                            <x-nav-link href="?nav=both" :active="$nav=='both'">Both</x-nav-link>

                        </div>

                        <x-secondary-button x-on:click="$dispatch('open-modal', 'open-slider-modal')"> <i
                                class="fas fa-plus pr-2"></i> Add</x-secondary-button>
                    </div>

                </x-slot>
                <x-slot name="content">

                </x-slot>
            </x-dashboard.section.header>


            <x-dashboard.section.inner>

                @foreach ($slider as $key => $item)
                <div class="border rounded-md mb-2 shadow ">
                    <div class="px-3 py-2 flex justify-between items-center">

                        <strong class="text-lg">
                            {{$item['name']}}
                        </strong>

                        <div class="flex space-x-2">
                            <x-danger-button wire:click="deleteSide({{$item['id']}})">
                                <i class="fas fa-trash"></i>
                            </x-danger-button>

                            <x-primary-button wire:click="openUpdateModal({{$item['id']}})">
                                <i class="fas fa-edit"></i>
                            </x-primary-button>

                            <x-nav-link href="{{route('system.slider.slides', ['id' => $item['id']])}}">slides
                            </x-nav-link>
                        </div>
                    </div>
                    <hr class="my-1">
                    <div class="p-3">
                        <div class="lg:flex items-start justify-between p-2">

                            <div class="p-3">
                                <div class="flex justify-start items-start my-2 border-b py-2">
                                    <input type="checkbox" id="home_page" @checked($item['home'])
                                        style="width:20px; height:20px" class="me-3" />
                                    <div>
                                        <x-input-label class="py-0 my-0" for="home_page" value="Home Page" />
                                        <p class="text-xs">
                                            If checked, Banner will display on <strong>Home Page</strong>.
                                        </p>
                                    </div>
                                </div>
                                <div class="flex justify-start items-start my-2 border-b py-2">
                                    <input type="checkbox" id="about_page" @checked($item['about'])
                                        style="width:20px; height:20px" class="me-3" />
                                    <div>
                                        <x-input-label class="py-0 my-0" for="about_page" value="About Page" />
                                        <p class="text-xs">
                                            If checked, Banner will display on <strong>About-Us Page</strong>.
                                        </p>
                                    </div>
                                </div>
                                <div class="flex justify-start items-start my-2 border-b py-2">
                                    <input type="checkbox" id="order_page" @checked($item['order']) wire:model="order"
                                        style="width:20px; height:20px" class="me-3" />
                                    <div>
                                        <x-input-label class="py-0 my-0" for="order_page" value="Order Page" />
                                        <p class="text-xs">
                                            If checked, Banner will display on <strong>Order Page</strong>.
                                        </p>
                                    </div>
                                </div>
                                <div class="flex justify-start items-start my-2 border-b py-2">
                                    <input type="checkbox" id="product_details_page" width="25px" height="25px"
                                        @checked($item['product_details']) class="me-3" />
                                    <div>
                                        <x-input-label class="py-0 my-0" for="product_details_page"
                                            value="Product Details Page" />
                                        <p class="text-xs">
                                            If checked, Banner will display on <strong>Product Details Page</strong>.
                                        </p>
                                    </div>
                                </div>
                                <div class="flex justify-start items-start my-2 border-b py-2">
                                    <input type="checkbox" id="categories_product_page"
                                        @checked($item['categories_product']) style="width:20px; height:20px"
                                        class="me-3" />
                                    <div>
                                        <x-input-label class="py-0 my-0" for="categories_product_page"
                                            value="Categories Product Page" />
                                        <p class="text-xs">
                                            If checked, Banner will display on <strong>Categories Product Page</strong>.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="p-3 bg-gray-100">
                                <div class="flex justify-start items-start my-2 border-b py-2">
                                    <input type="checkbox" id="page_top" @checked($item['top'])
                                        style="width:20px; height:20px" class="me-3" />
                                    <div>
                                        <x-input-label class="py-0 my-0" for="page_top" value="Top" />
                                        <p class="text-xs">
                                            If checked, Banner will display on <strong>Top Of The Page</strong>.
                                        </p>
                                    </div>
                                </div>
                                <div class="flex justify-start items-start my-2 border-b py-2">
                                    <input type="checkbox" id="page_middle" @checked($item['middle'])
                                        style="width:20px; height:20px" class="me-3" />
                                    <div>
                                        <x-input-label class="py-0 my-0" for="page_middle" value="Middle" />
                                        <p class="text-xs">
                                            If checked, Banner will display on <strong>Middle Of The Page</strong>.
                                        </p>
                                    </div>
                                </div>
                                <div class="flex justify-start items-center my-2 border- py-2">
                                    <input type="checkbox" id="page_bottom" @checked($item['bottom'])
                                        style="width:20px; height:20px" class="me-3" />
                                    <div>
                                        <x-input-label class="py-0 my-0" for="page_bottom" value="Bottom" />
                                        <p class="text-xs">
                                            If checked, Banner will display on <strong>Bottom Of The Page</strong>.
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
                @endforeach
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </x-dashboard.container>


    <x-modal name="open-slider-modal">
        <div class="p-3">Slider Modal</div>
        <hr>
        <div class="p-3">
            <strong>{{ $sler }}</strong>
            <form wire:submit.prevent="createNewSlider">
                <div class="flex">
                    <x-text-input wire:model="sliderName" class="rounded-0 py-1 w-full"
                        placeholder="Give Slider Name" />
                </div>
                @error('sliderName')
                <span class="text-xs text-red-900">{{$message }}</span>
                @enderror


                <div class="lg:flex items-start justify-between p-2">

                    <div class="p-3">
                        <div class="flex justify-start items-start my-2 border-b py-2">
                            <input type="checkbox" id="home_page" wire:model="home" style="width:20px; height:20px"
                                class="me-3" />
                            <div>
                                <x-input-label class="py-0 my-0" for="home_page" value="Home Page" />
                                <p class="text-xs">
                                    If checked, Banner will display on <strong>Home Page</strong>.
                                </p>
                            </div>
                        </div>
                        <div class="flex justify-start items-start my-2 border-b py-2">
                            <input type="checkbox" id="about_page" wire:model="about" style="width:20px; height:20px"
                                class="me-3" />
                            <div>
                                <x-input-label class="py-0 my-0" for="about_page" value="About Page" />
                                <p class="text-xs">
                                    If checked, Banner will display on <strong>About-Us Page</strong>.
                                </p>
                            </div>
                        </div>
                        <div class="flex justify-start items-start my-2 border-b py-2">
                            <input type="checkbox" id="order_page" wire:model="order" style="width:20px; height:20px"
                                class="me-3" />
                            <div>
                                <x-input-label class="py-0 my-0" for="order_page" value="Order Page" />
                                <p class="text-xs">
                                    If checked, Banner will display on <strong>Order Page</strong>.
                                </p>
                            </div>
                        </div>
                        <div class="flex justify-start items-start my-2 border-b py-2">
                            <input type="checkbox" id="product_details_page" wire:model="product_details" width="25px"
                                height="25px" class="me-3" />
                            <div>
                                <x-input-label class="py-0 my-0" for="product_details_page"
                                    value="Product Details Page" />
                                <p class="text-xs">
                                    If checked, Banner will display on <strong>Product Details Page</strong>.
                                </p>
                            </div>
                        </div>
                        <div class="flex justify-start items-start my-2 border-b py-2">
                            <input type="checkbox" id="categories_product_page" wire:model="categories_product"
                                style="width:20px; height:20px" class="me-3" />
                            <div>
                                <x-input-label class="py-0 my-0" for="categories_product_page"
                                    value="Categories Product Page" />
                                <p class="text-xs">
                                    If checked, Banner will display on <strong>Categories Product Page</strong>.
                                </p>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="p-3 bg-gray-100">
                        <div class="flex justify-start items-start my-2 border-b py-2">
                            <input type="checkbox" id="page_top" wire:model="top" style="width:20px; height:20px"
                                class="me-3" />
                            <div>
                                <x-input-label class="py-0 my-0" for="page_top" value="Top" />
                                <p class="text-xs">
                                    If checked, Banner will display on <strong>Top Of The Page</strong>.
                                </p>
                            </div>
                        </div>
                        <div class="flex justify-start items-start my-2 border-b py-2">
                            <input type="checkbox" id="page_middle" wire:model="middle" style="width:20px; height:20px"
                                class="me-3" />
                            <div>
                                <x-input-label class="py-0 my-0" for="page_middle" value="Middle" />
                                <p class="text-xs">
                                    If checked, Banner will display on <strong>Middle Of The Page</strong>.
                                </p>
                            </div>
                        </div>
                        <div class="flex justify-start items-center my-2 border- py-2">
                            <input type="checkbox" id="page_bottom" wire:model="bottom" style="width:20px; height:20px"
                                class="me-3" />
                            <div>
                                <x-input-label class="py-0 my-0" for="page_bottom" value="Bottom" />
                                <p class="text-xs">
                                    If checked, Banner will display on <strong>Bottom Of The Page</strong>.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="flex justify-start items-start my-2 border-b p-2">
                    <input type="checkbox" id="active" wire:model="status" style="width:20px; height:20px"
                        class="me-3" />
                    <x-input-label class="py-0 my-0" for="active" value="Active Now " />
                </div>
                @error('status')
                <span class="text-xs text-red-900">{{$message }}</span>
                @enderror
                <div class="flex justify-between">

                    <x-secondary-button x-on:click="$dispatch('close-modal', 'open-slider-modal')" type="button"
                        class="mt-2">Cancel</x-secondary-button>
                    <x-primary-button class="mt-2"> <i class="fas fa-plus pr-2"></i> Add</x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>

    <x-modal name="open-slides-modal">
        <div class="px-3 py-2">Edit Slider</div>
        <div class="p-3">
            <form wire:submit.prevent="updateSlider">
                <div class="">
                    <x-input-label value="Name" />
                    <x-text-input wire:model="updateable.name" class="rounded-0 py-1 w-full"
                        placeholder="Give Slider Name" />
                </div>
                @error('sliderName')
                <span class="text-xs text-red-900">{{$message }}</span>
                @enderror

                <div class="lg:flex items-start justify-between p-2">

                    <div class="p-3">
                        <div class="flex justify-start items-start my-2 border-b py-2">
                            <input type="checkbox" id="home_page" wire:model="updateable.home"
                                style="width:20px; height:20px" class="me-3" />
                            <div>
                                <x-input-label class="py-0 my-0" for="home_page" value="Home Page" />
                                <p class="text-xs">
                                    If checked, Banner will display on <strong>Home Page</strong>.
                                </p>
                            </div>
                        </div>
                        <div class="flex justify-start items-start my-2 border-b py-2">
                            <input type="checkbox" id="about_page" wire:model="updateable.about"
                                style="width:20px; height:20px" class="me-3" />
                            <div>
                                <x-input-label class="py-0 my-0" for="about_page" value="About Page" />
                                <p class="text-xs">
                                    If checked, Banner will display on <strong>About-Us Page</strong>.
                                </p>
                            </div>
                        </div>
                        <div class="flex justify-start items-start my-2 border-b py-2">
                            <input type="checkbox" id="order_page" wire:model="updateable.order"
                                style="width:20px; height:20px" class="me-3" />
                            <div>
                                <x-input-label class="py-0 my-0" for="order_page" value="Order Page" />
                                <p class="text-xs">
                                    If checked, Banner will display on <strong>Order Page</strong>.
                                </p>
                            </div>
                        </div>
                        <div class="flex justify-start items-start my-2 border-b py-2">
                            <input type="checkbox" id="product_details_page" wire:model="updateable.product_details"
                                width="25px" height="25px" class="me-3" />
                            <div>
                                <x-input-label class="py-0 my-0" for="product_details_page"
                                    value="Product Details Page" />
                                <p class="text-xs">
                                    If checked, Banner will display on <strong>Product Details Page</strong>.
                                </p>
                            </div>
                        </div>
                        <div class="flex justify-start items-start my-2 border-b py-2">
                            <input type="checkbox" id="categories_product_page"
                                wire:model="updateable.categories_product" style="width:20px; height:20px"
                                class="me-3" />
                            <div>
                                <x-input-label class="py-0 my-0" for="categories_product_page"
                                    value="Categories Product Page" />
                                <p class="text-xs">
                                    If checked, Banner will display on <strong>Categories Product Page</strong>.
                                </p>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="p-3 bg-gray-100">
                        <div class="flex justify-start items-start my-2 border-b py-2">
                            <input type="checkbox" id="page_top" wire:model="updateable.top"
                                style="width:20px; height:20px" class="me-3" />
                            <div>
                                <x-input-label class="py-0 my-0" for="page_top" value="Top" />
                                <p class="text-xs">
                                    If checked, Banner will display on <strong>Top Of The Page</strong>.
                                </p>
                            </div>
                        </div>
                        <div class="flex justify-start items-start my-2 border-b py-2">
                            <input type="checkbox" id="page_middle" wire:model="updateable.middle"
                                style="width:20px; height:20px" class="me-3" />
                            <div>
                                <x-input-label class="py-0 my-0" for="page_middle" value="Middle" />
                                <p class="text-xs">
                                    If checked, Banner will display on <strong>Middle Of The Page</strong>.
                                </p>
                            </div>
                        </div>
                        <div class="flex justify-start items-center my-2 border- py-2">
                            <input type="checkbox" id="page_bottom" wire:model="updateable.bottom"
                                style="width:20px; height:20px" class="me-3" />
                            <div>
                                <x-input-label class="py-0 my-0" for="page_bottom" value="Bottom" />
                                <p class="text-xs">
                                    If checked, Banner will display on <strong>Bottom Of The Page</strong>.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- <div class="py-2">
                    <div class="flex py-1 border rounded px-2 mb-1">
                        <input type="radio" wire:model="updateable.placement" value="web" class="h-5 w-5 me-3" id="web">
                        <label for="Web">For Web</label>
                    </div>
                    <div class="flex py-1 border rounded px-2 mb-1">
                        <input type="radio" wire:model="updateable.placement" value="apps" class="h-5 w-5 me-3"
                            id="apps">
                        <label for="Web">For Apps</label>
                    </div>
                    <div class="flex py-1 border rounded px-2 mb-1">
                        <input type="radio" wire:model="updateable.placement" value="both" class="h-5 w-5 me-3"
                            id="both">
                        <label for="Web">Both (Web & Apps) </label>
                    </div>
                </div> --}}

                {{-- <div class="flex justify-start items-start my-2 border-b py-2">
                    <input type="checkbox" id="active" wire:model="status" style="width:20px; height:20px"
                        class="me-3" />
                    <x-input-label class="py-0 my-0" for="active" value="Active Now " />
                </div>
                @error('status')
                <span class="text-xs text-red-900">{{$message }}</span>
                @enderror --}}
                <div class="flex justify-between">

                    <x-secondary-button x-on:click="$dispatch('close-modal', 'open-slides-modal')" type="button"
                        class="mt-2">Cancel</x-secondary-button>
                    <x-primary-button class="mt-2"> <i class="fas fa-sync pr-2"></i> Save & Update</x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>
</div>