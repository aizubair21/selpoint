
<div>
    
    {{-- @assets
    @endAssets --}}
        {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet"> --}}
        {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> --}}

  <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">

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
                    <br>

                    {{-- notify if user reach maximum product upload limit. --}}
                    @if (!$ableToCreate)
                        <span class="p-3 shadow-lg rounded bg-red-200 text-red-900">You have reached your maximum product upload limit ({{$shop->max_product_upload ?? 0}}). Please contact support to increase your limit.</span>
                    @endif
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
                                @foreach ($categories as $children)
                                    <option value="{{$children->id}}"> {{$children->name}} </option>

                                    @if (count($children->children) > 0)
                                        @foreach ($children->children as $child)
                                            <option value="{{$child->id}}"> --{{$child->name}} </option>
                                            
                                            @if (count($child->children) > 0)
                                                @foreach ($child->children as $grandChild)
                                                    <option value="{{$grandChild->id}}"> ---- {{$grandChild->name}} </option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                        
                                    @endif
                                @endforeach
                            </select>
                            {{-- <x-primary-button type="button" x-on:click.prevent="$dispatch('open-modal', 'create-category-modal')">Create</x-primary-button> --}}
                            {{-- @if (empty($categories))
                                @livewire('vendor.categories.create');    
                            @endif --}}
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
                            <x-input-field class="mx-1" labelWidht="100px" type="number" label="Product Unit" wire:model.live="products.unit" name="products.unit" error="products.unit" />
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

            <div>
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
                            <x-text-input wire:model='attr.name' placeholder="Name" />
                            <x-text-input wire:model='attr.value' placeholder="Value" />
                        </div>
                    </x-dashboard.section.inner>
                </x-dashboard.section>

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
                                <img src="{{$thumb->temporaryUrl()}}" width="300px" height="300px" alt="">
                            @endif
                            <div class="relative">
                                <input type="file" class="absolute hidden" id="prod_thumbnail" wire:model.live="thumb"  />
                                <label for="prod_thumbnail" class="p-2 rounded border">
                                    <i class="fas fa-upload"></i>
                                </label>
                            </div>
                        </x-input-file>
                    </x-dashboard.section.inner>
                </x-dashboard.section>
                
                
                {{-- <x-dashboard.section>
                    <x-dashboard.section.header>
                        <x-slot name="title">
                            Image Showcase
                        </x-slot>
                        <x-slot name="content">
                            Provide a number of image to showcase your product quality. 
                        </x-slot>
                    </x-dashboard.section.header>
                    <x-dashboard.section.inner>
                        <x-input-file label="Thumbnail" class="md:flex" labelWidth="250px" error="products.thumbnail" >
                            @if ($thumb)
                                <img src="{{$thumb->temporaryUrl()}}" width="300px" height="300px" alt="">
                            @endif
                            <div class="relative">
                                <input type="file" class="absolute hidden" id="prod_thumbnail" wire:model.live="thumb"  />
                                <label for="prod_thumbnail" class="p-2 rounded border">
                                    <i class="fas fa-upload"></i>
                                </label>
                            </div>
                        </x-input-file>
                    </x-dashboard.section.inner>
                </x-dashboard.section> --}}

                <x-dashboard.section>
                    <x-dashboard.section.header>
                        <x-slot name="title">
                            SEO
                        </x-slot>
                        <x-slot name="content">
                            set up your on-page seo. keyword, title, tags and descriiption.
                        </x-slot>
                    </x-dashboard.section.header>

                    <x-dashboard.section.inner>
                        <x-input-field labelWidth="250px" inputClass="w-full" class="mx-1 md:flex" labelWidht="100px" label="SEO Keyword" wire:model.lazy="meta.keyword" name="meta.keyword" error="meta.keyword" />
                        <x-input-field labelWidth="250px" inputClass="w-full" class="mx-1 md:flex" labelWidht="100px" label="SEO Title" wire:model.lazy="meta.title" name="meta.title" error="meta.title" />
                        <x-input-field labelWidth="250px" inputClass="w-full" class="mx-1 md:flex" labelWidht="100px" label="SEO Tags" wire:model.lazy="meta.tags" name="meta.tags" error="meta.tags" />
                        <x-input-file labelWidth="250px" inputClass="w-full" class="mx-1 md:flex" labelWidht="100px" label="SEO Description" name="meta.description" error="meta.description">
                            <textarea wire:model.lazy="meta.description" rows="3" class="rounded w-full"></textarea>
                        </x-input-file>
                        <x-input-file labelWidth="250px" inputClass="w-full" class="mx-1 md:flex" labelWidht="100px" label="SEO Thumb" name="meta.thumbnail" error="meta.thumbnail">
                            <div>
                                @if ($meta['thumbnail'])
                                    <img style="width:300px; height:200px" src="{{$meta['thumbnail']->temporaryUrl()}}" alt="" srcset="">
                                @endif
                                <hr>
                                <div class="relative">
                                    <p>
                                        200 x 300 image
                                    </p>
                                    <input type="file" wire:model.live="meta.thumbnail" id="meta_thumb" class="absolute hidden">
                                    <label for="meta_thumb" class="p-2 border rounded">
                                        <i class="fas fa-upload"></i>
                                    </label>
                                </div>
                            </div>
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
                        <div class="flex flex-wrap items-center p-3 border-b bg-gray-50 gap-2">
                        </div>
                        <x-input-file label="Description" class="md:flex" labelWidth="250px" error="products.description" >
                            
                            {{-- <button type="button" onmouse="format('bold')" class="px-2 py-1 hover:bg-gray-200 rounded" title="Bold"><b>B</b></button> --}}
                            {{-- <button type="button" onmouse="format('italic')" class="px-2 py-1 hover:bg-gray-200 rounded italic" title="Italic">I</button> --}}
                            {{-- <button type="button" onmouse="format('underline')" class="px-2 py-1 hover:bg-gray-200 rounded underline" title="Underline">U</button> --}}
                            {{-- <button type="button" onmouse="format('strikeThrough')" class="px-2 py-1 hover:bg-gray-200 rounded line-through" title="Strike">S</button> --}}
                            {{-- <button type="button" onmouse="format('insertOrderedList')" class="px-2 py-1 hover:bg-gray-200 rounded" title="Ordered List">OL</button> --}}
                            {{-- <button type="button" onmouse="format('insertUnorderedList')" class="px-2 py-1 hover:bg-gray-200 rounded" title="Unordered List">UL</button> --}}
                            {{-- <button type="button" onmouse="format('formatBlock', 'H1')" class="px-2 py-1 hover:bg-gray-200 rounded text-xl" title="Heading 1">H1</button> --}}
                            {{-- <button type="button" onmouse="format('formatBlock', 'H2')" class="px-2 py-1 hover:bg-gray-200 rounded text-lg" title="Heading 2">H2</button> --}}
                            {{-- <button type="button" onmouse="addLink()" class="px-2 py-1 hover:bg-gray-200 rounded text-blue-600" title="Insert Link">🔗</button> --}}
                            {{-- <button type="button" onmouse="removeFormatting()" class="px-2 py-1 hover:bg-gray-200 rounded text-red-600" title="Clear Formatting">🧹</button> --}}
                            {{-- <textarea wire:model="products.description" class="w-full rounded border-gray-30o" placeholder="Describe your own" id="summornote" rows="10">
                            </textarea> --}}
                            {{-- <div id="editor"
                                class="border rounded min-h-[200px] p-4 focus:outline-none"
                                contenteditable="true">
                                <p  class="text-gray-700">Start writing here...</p>
                            </div> --}}
                            <hr>


                            <main wire:ignore>
                                <trix-toolbar id="my_toolbar"></trix-toolbar>
                                <div class="more-stuff-inbetween"></div>
                                <input type="hidden" name="content" id="my_input" wire:model.live="products.description" value="{{$products['description']}}" >
                                <trix-editor toolbar="my_toolbar" input="my_input"></trix-editor>
                            </main>

                            <hr>
                                {!! $products['description'] !!}
                            <hr>

                            <x-primary-button>
                                create
                            </x-primary-button>
                        </x-input-file>
                    </x-dashboard.section.inner>
                </x-dashboard.section>
            </div>
        </form>


        <x-modal name="create-category-modal" >
           <livewire:reseller.categories.create />
        </x-modal>

    </x-dashboard.container>

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
    <!-- Trix Editor -->
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

    @script
    <script>
        document.querySelector("trix-editor").addEventListener('trix-change', ()=> {
            @this.set('products.description', document.querySelector("#my_input").value);            
        })
    </script>
    @endscript
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/2.0.0/trix.min.js"></script> --}}
    
</div>
