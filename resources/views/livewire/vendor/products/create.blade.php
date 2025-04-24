<div>
    <x-dashboard.page-header>
        Add Products
    </x-dashboard.page-header>

    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Product Create Form
                </x-slot>
                <x-slot name="content">
                    create new product to sell to a cheaf price. to make more profit. Correctly define your <strong>Bying Price</strong> and <strong>Selling Price</strong>. Keep it mind that, system takes <strong>20%</strong> of comission from your profit. 
                </x-slot>
            </x-dashboard.section.header>
        </x-dashboard.section>

        <form wire:submit.prevent="create">
            <div class="md:flex justify-between">

                <x-dashboard.section>
                    <x-dashboard.section.header>
                        <x-slot name="title">
                            Basic Information
                        </x-slot>
                        <x-slot name="content">
                            Provide your products related basic infromation.
                        </x-slot>
                    </x-dashboard.section.header>
                    <x-dashboard.section.inner>
                        <x-input-field inputClass="w-full" labelWdith="250px" label="Product Name" wire:model.live="products.name" name="products.name" error="products.name" />
                        <x-input-field inputClass="w-full" label="Product Title" wire:model.live="products.title" name="products.title" error="products.title" />
                        
                        <x-input-file label="Chose Category" name="products.category_id" error="products.category_id">
                            <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" wire:model.live="products.category_id" id="">
                                <option value=""> -- Chose an category -- </option>
                                @foreach ($categories as $cat)
                                <option value="{{$cat->id}}"> {{$cat->name ?? "N/A"}} </option>
                                @endforeach
                            </select>
                            @if (empty($categories))
                                {{-- @livewire('vendor.categories.create');     --}}
                                <x-primary-button type="button" x-on:click.prevent="$dispatch('open-modal', 'create-category-modal')">Create</x-primary-button>
                            @endif
                        </x-input-file>

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
                            <x-input-field class="mx-1" labelWidht="100px" label="Product Buying Price" wire:model.live="products.buying_price" name="products.buying_price" error="products.buying_price" />
                            <x-input-field class="mx-1" labelWidht="100px" label="Product Sell Price" wire:model.live="products.price" name="products.price" error="products.price" />
                            <x-input-field class="mx-1" labelWidht="100px" type="number" label="Product Unite" wire:model.live="products.unite" name="products.unite" error="products.unite" />
                        </div>
                        <x-hr/>
                        <div>
                            {{-- <x-input-field class="mx-1" label="Product Buying Price" wire:model.live="products.buying_price" name="products.buying_price" error="products.buying_price" /> --}}
                            <x-input-file label="Wish to sell with Discount" name="offer_type" error="offer_type  ">
                                <input type="checkbox" wire:model.live="products.offer_type" style="width:25px; height:25px" />
                            </x-input-file>
                            <x-input-field wire:transition wire:show="products.offer_type" class="md:flex" labelWidth="250px" label="Product Discount Price" wire:model.live="products.discount" name="products.discount" error="products.discount" />
                            {{-- <x-input-field class="mx-1" type="number" label="Product Unite" wire:model.live="products.unite" name="products.unite" error="products.unite" /> --}}
                        </div>
                    </x-dashboard.section.inner>
                </x-dashboard.section>
                
                
            </div>

            <div class="lg:flex justify-between">
                <x-dashboard.section>
                    <x-dashboard.section.header>
                        <x-slot name="title">
                            Image Thumbnail
                        </x-slot>
                        <x-slot name="content">
                            Provide a mendatory thumbnail image for your products. This image consider for the thumbnail for social media platform. 
                        </x-slot>
                    </x-dashboard.section.header>
                    <x-dashboard.section.inner>
                        <x-input-file label="Thumbnail" class="md:flex" labelWidth="250px" error="products.thumbnail" >
                            @if ($thumb)
                                <img src="{{$thumb->temporaryUrl()}}" width="400px" height="300px" alt="">
                            @endif
                            <input type="file" wire:model.live="thumb"  />
                        </x-input-file>
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
                        <x-input-file label="Description" class="md:flex" labelWidth="250px" error="products.description" >
                            
                            <textarea wire:model.live="products.description" class="w-full rounded border-gray-30o" placeholder="Describe your own" id="" rows="10"></textarea>
                            <x-primary-button>
                                create
                            </x-primary-button>
                        </x-input-file>
                    </x-dashboard.section.inner>
                </x-dashboard.section>
            </div>
        </form>


        <x-modal name="create-category-modal" >
            @livewire('vendor.categories.create')
        </x-modal>

    </x-dashboard.container>
</div>
