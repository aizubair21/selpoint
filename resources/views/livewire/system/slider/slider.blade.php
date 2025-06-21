<div >
    <x-dashboard.page-header>
        Slider
    </x-dashboard.page-header>

    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    <div class="flex justify-between items-center">
                        <div>Sliders</div>

                        <x-secondary-button x-on:click="$dispatch('open-modal', 'open-slider-modal')">Add</x-secondary-button>
                    </div>
                    
                </x-slot>
                <x-slot name="content">

                </x-slot>
            </x-dashboard.section.header>


            <x-dashboard.section.inner>
                <x-dashboard.table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Placement</th>
                            <th>Data</th>
                            <th>A/C</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($slider as $item)

                            <tr>
                                <td> {{$loop->iteration}} </td>
                                <td> {{$item->name}} </td>
                                <td> {{$item->status ? "Active" : "Deactive"}} </td>
                                <td> {{$item->placement}} </td>
                                <td>
                                    {{$item->created_at->diffForHumans()}}
                                </td>
                                <td>
                                    <div class="flex space-x-2">
                                        <x-danger-button wire:click="deleteSide({{$item->id}})" >
                                            <i class="fas fa-trash"></i>
                                        </x-danger-button>
                                        
                                        <x-primary-button x-on:click="$dispatch('open-modal', 'open-slides-modal')" >
                                            <i class="fas fa-edit"></i>
                                        </x-primary-button>
                                        <x-nav-link href="{{route('system.slider.slides', ['id' => $item->id])}}" >slides</x-nav-link>
                                    </div>
                                </td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                </x-dashboard.table>
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </x-dashboard.container>


    <x-modal name="open-slider-modal" maxWidth="sm">
        <div class="px-2 py-2">Slider Modal</div>
        <div class="p-3">
            <strong>{{ $sler }}</strong>
            <form wire:submit.prevent="createNewSlider">
                <div class="flex">
                    <x-text-input wire:model="sliderName" class="rounded-0 py-1 w-full" placeholder="Give Slider Name" />
                    <select class="py-1 rounded shadow" wire:model="sliderPlacement" >
                        <option selected value="web">Web</option>
                        <option value="apps">Apps</option>
                        <option value="both">Both</option>
                    </select>
                </div>
                @error('sliderName')
                    <span class="text-xs text-red-900">{{$message }}</span>
                @enderror

                <br>
                <div>  
                    @if ($sliderImage)
                        <img src="{{$sliderImage->temporaryUrl()}}"  height="20" alt="" srcset="">
                        <br>
                    @endif 
                    <x-text-input type="file" wire:model="sliderImage" class="w-full border" />
                </div>
                @error('sliderImage')
                    <span class="text-xs text-red-900">{{$message }}</span>
                @enderror
                <div class="flex justify-start items-center my-2 border-t border-b py-2">
                    <input type="checkbox" id="active" wire:model="status" width="25px" height="25px" class="me-3" />
                    <x-input-label class="py-0 my-0" for="active" value="Active Now "/>
                </div>
                @error('status')
                    <span class="text-xs text-red-900">{{$message }}</span>
                @enderror
                <div class="flex justify-between">

                    <x-secondary-button x-on:click="$dispatch('close-modal', 'open-slider-modal')" type="button" class="mt-2">Cancel</x-secondary-button>
                    <x-primary-button class="mt-2">Add</x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>

    <x-modal name="open-slides-modal">
        <div class="px-3 py-2">Slides</div>
        <hr>
        <div class="p-3">
            @foreach ($slides as $key => $item)
                <div class="border rounded p-3 flex mb-1">
                    <div class="p-2">
                       {{-- {{$slides[$key]['main_title']}} --}}
                        @if ($slides[$key]['image'])
                            <img src="{{$slides[$key]['image']->temporaryUrl()}}" style="height:40px" alt="">
                        @endif
                        <input type="file" accept="jpg, jpeg, png" max="500" class="border p-1 w-full" wire:model="slides.{{$key}}.image">
                    </div>
                    <div class="py-2 space-y-2">
                        <x-text-input type="text" wire:model="slides.{{$key}}.main_title" class="w-full" placeholder="Main Title" />
                        <x-text-input type="text"  wire:model="slides.{{$key}}.sub_title" class="w-full" placeholder="Sub Title" />
                        <textarea name="" id=""  wire:model="slides.{{$key}}.des" class="w-full" rows="3"></textarea>
                    </div>
                  
                </div>
            @endforeach
            <br>
            <div class="text-end">
                <x-primary-button wire:click="addNewSlides"> <i class="fas fa-plus"></i> </x-primary-button>
            </div>
                <hr class="py-2">
            <div class="flex justify-between text-end">
                <x-secondary-button x-on:click="$dispatch('close-modal', 'open-slides-modal')">close</x-secondary-button>
                <x-primary-button wire:click="update" > update </x-primary-button>
            </div>
        </div>
    </x-modal>
</div>
