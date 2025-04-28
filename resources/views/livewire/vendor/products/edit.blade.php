
<div>
    {{-- Stop trying to control. --}}
    <x-dashboard.page-header>
        Product Edit
        <br>
        {{-- <x-dashboard.vendor.products.navigations :nav="$nav" /> --}}
        @include('components.dashboard.vendor.products.navigations')
    </x-dashboard.page-header>


    <x-dashboard.container>

        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    <div class="flex justify-between text-xs">
                        <div>

                            @if ($products['deleted_at'])
                                <div style="color: red; font-weight:bolder">
                                    Trashed
                                </div>
                            @else 
                                {{$products['status'] ? "Active" : "Drafted"}} | {{ Carbon\Carbon::parse($products['created_at'])->diffForHumans()}}
                            @endif
                        </div>
                        <div>
                            @if ($products['deleted_at'])
                                <x-secondary-button type="button" wire:click.prevent="restoreFromTrash">
                                   <i class="fa-solid fa-sync mr-2"></i> Restore
                                </x-secondary-button>
                            @else 
                                <x-secondary-button type="button" wire:click.prevent="moveToTrash">
                                   <i class="fa-solid fa-trash mr-2"></i> Trash
                                </x-secondary-button>
                            @endif
                        </div>
                    </div>
                </x-slot>
                
                <x-slot name="content">
                    <div>
                        <x-image src="{{asset('storage/'.$products['thumbnail'])}}" />
                    </div>
                    <div>
                        {{$products['title'] ?? "N/A"}}
                    </div>

                    <div class="text-sm">
                        category : <strong> {{$data['category']?->name ?? "N/A"}} </strong>
                    </div>
                </x-slot>
            </x-dashboard.section.header>
        </x-dashboard.section>
        
        <form wire:transition wire:submit.prevent="save">
            <div class="md:flex jusfity-between">
                <x-dashboard.section>
                    <x-dashboard.section.header>
                        <x-slot name="title">
                            Product Basic Info
                        </x-slot>
                        <x-slot name="content">
    
                        </x-slot>
                    </x-dashboard.section.header>
                    <x-dashboard.section.inner>
                        <x-input-file error='name' label="Products Name" name="name" inputClass="w-full">
                            <textarea  wire:model.live="products.name" rows="6" id="" class="w-full" ></textarea>
                        </x-input-file>
                        <x-input-file wire:model.live="products.title" error='name' label="Products title" name="title" inputClass="w-full">
                            <textarea  wire:model.live="products.title" rows="6" id="" class="w-full" ></textarea>
                        </x-input-file>
    
                        <x-hr/>
                        <x-input-file labelWidth="250px" class="md:flex" label="Products Category" error="category" >
                            <div class="text-xs">
                                Current Category is : <strong>{{ $data['category']?->name ?? "N/A" }}</strong>. Change category to another
                            </div>
                            <select wire:modal="products.category_id" id="">
                                <option value=""> -- Select Category -- </option>
                                @foreach (auth()->user()->myCategory as $item)
                                    <option @selected($data['category_id'] == $item->id) value="{{$item->id}}">{{$item->name}} </option>
                                @endforeach 
                            </select>
                        </x-input-file>
                        <x-hr/>
                    </x-dashboard.section.inner>
                </x-dashboard.section>


                <x-dashboard.section>
                    <x-dashboard.section.header>
                        <x-slot name="title">
                            Product Price
                        </x-slot>
                        <x-slot name="content"></x-slot>
                    </x-dashboard.section.header>
                    <x-dashboard.section.inner>
                        
                        <div >
                            <x-input-field class=" mx-1" labelWidht="100px" label="Product Buying Price" wire:model.live="products.buying_price" name="products.buying_price" error="products.buying_price" />
                            <x-input-field class=" mx-1" labelWidht="100px" label="Product Sell Price" wire:model.live="products.price" name="products.price" error="products.price" />
                            <x-input-field class=" mx-1" labelWidht="100px" type="number" label="Product Unite" wire:model.live="products.unite" name="products.unite" error="products.unite" />
                        </div>
                        <x-hr/>
                        <div>
                            {{-- <x-input-field class="mx-1" label="Product Buying Price" wire:model.live="products.buying_price" name="products.buying_price" error="products.buying_price" /> --}}
                            <x-input-file label="Wish to sell with Discount" name="offer_type" error="offer_type  ">
                                <input type="checkbox" @checked($products['offer_type']) wire:model.live="products.offer_type" style="width:25px; height:25px" />
                            </x-input-file>
                            <x-input-field wire:transition wire:show="products.offer_type" class="" labelWidth="250px" label="Product Discount Price" wire:model.live="products.discount" name="products.discount" error="products.discount" />
                            {{-- <x-input-field class="mx-1" type="number" label="Product Unite" wire:model.live="products.unite" name="products.unite" error="products.unite" /> --}}
                        </div>
                    </x-dashboard.section.inner>
                </x-dashboard.section>

                
            </div>
            <x-dashboard.section>
                <x-dashboard.section.header>
                    <x-slot name="title">
                        Image Attributes
                    </x-slot>
                    <x-slot name="content">
                        Give your products attributes, product different types, different product color package and quantity.
                    </x-slot>
                </x-dashboard.section.header>
                <x-dashboard.section.inner>
                    <div class="md:flex">
                        <input type="text" wire:model.live='attr.name' placeholder="Name" />
                        <input type="text" wire:model.live='attr.value' placeholder="Value" />
                    </div>
                </x-dashboard.section.inner>
            </x-dashboard.section>
            
            <x-dashboard.section>
                <div class="md:flex justify-between">
                    <x-dashboard.section.header>
                        <x-slot name="title">
                            Image Thumbnail
                        </x-slot>
                        <x-slot name="content">
                            Provide a mendatory thumbnail image for your products. This image consider for the thumbnail for social media platform. 
                            <input type="file" wire:model.live="thumb"  />
                        </x-slot>
                    </x-dashboard.section.header>
                    
                    <x-dashboard.section.inner>
                            @if ($products['thumbnail'] && !$thumb)
                                <x-image src="{{asset('storage/'. $products['thumbnail'])}}" />
                            @endif
                            @if ($thumb)
                                <img src="{{$thumb->temporaryUrl()}}" width="100px" height="200px" alt="">
                            @endif
                    </x-dashboard.section.inner>
                </div>
            </x-dashboard.section>

            <x-dashboard.section>
                <x-dashboard.section.header>
                    <x-slot name="title">
                        {{-- <div class="flex"></div> --}}
                        Other Image
                    </x-slot>
                    <x-slot name="content">
                        Other product image that showcase your product. other image mainly display at product details page. 
                    </x-slot>
                </x-dashboard.section.header>

                <x-dashboard.section.inner>
                    
                    <div  style="display: grid; grid-template-columns:repeat(auto-fit,100px); grid-gap:10px">
                        @foreach ($relatedImage as $item)
                            <div class="p-2 border">
                                <x-image  src="{{asset('storage/'. $item['image'])}}" />
                                <button type="button" wire:click="erageOldImage({{$item['id']}})">
                                    Erage
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <x-hr/>
                    <div style="display: grid; grid-template-columns:repeat(auto-fit,50px); grid-gap:10px">      
                        @foreach ($newImage as $ni)

                            <div class="p-2 border rounded">
                                <img src="{{$ni->temporaryUrl()}}" width="50px" height="50px" alt="">
                            </div>
                            
                        @endforeach
                    </div>
                    <x-text-input type="file" wire:model.live="newImage"  multiple />
                    <div class="text-xs">
                        Please choose all image at once, if you plan to upload multiple image.
                    </div>
                
                </x-dashboard.section.inner>
            </x-dashboard.section>

            <x-dashboard.section>
                <x-dashboard.section.header>
                    <x-slot name="title">
                        Description
                    </x-slot>
                    <x-slot name="content">
                        Descrive your product as you need.
                    </x-slot>
                </x-dashboard.section.header>
                <x-dashboard.section.inner>
                    <x-input-file label="Description" labelWidth="250px" error="products.description" >
                        
                        <textarea wire:model.live="products.description" class="w-full rounded border-gray-30o" placeholder="Describe your own" id="" rows="10"></textarea>
                
                    </x-input-file>
                </x-dashboard.section.inner>
            </x-dashboard.section>
            <x-primary-button>save</x-primary-button>
        </form>
            
    </x-dashboard.container>
</div>
