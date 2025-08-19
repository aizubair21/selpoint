<div>
    <x-dashboard.page-header>
        Slider- {{$slider->name}}
    </x-dashboard.page-header>
    

    <x-dashboard.container>

        <x-dashboard.section>
            <x-dashboard.section.inner>
                
                <div class="flex flex-wrap gap-4">

                    @foreach ($slides as $key => $item)
                        <div class="border w-full group max-w-72 rounded p-3 mb-1 relative">
                            <div class="p-2">
                            {{-- {{$slides[$key]['main_title']}} --}}
                                @if ($image[$key]['image'])
                                    <img src="{{$image[$key]['image']->temporaryUrl()}}" style="height:150px; width:100%;" alt="">
                                @else 
                                    <img src="{{asset('storage/'.$slides[$key]['image'])}}" style="height:150px; width:100%;" alt="">

                                @endif

                                <div class="relative">
                                    <input type="file" id="slider_image_{{$key}}" accept="jpg, jpeg, png" max="500" class="absolute hidden border p-1 w-full" wire:model="image.{{$key}}.image">
                                    <label for="slider_image_{{$key}}" class="p-1 rounded border shadow">
                                        <i class="fas fa-upload px-1"></i>
                                    </label>
                                </div>
                            </div>
                            <div class="py-2 space-y-2">
                                <textarea rows="3" type="text" wire:model="slides.{{$key}}.main_title" class="w-full" placeholder="Main Title" placeholder="Main Title"></textarea>
                                {{-- <x-text-input type="text"  wire:model="slides.{{$key}}.main_title" class="w-full" placeholder="Main Title" /> --}}
                                {{-- <x-text-input type="text"  wire:model="slides.{{$key}}.sub_title" class="w-full" placeholder="Sub Title" /> --}}
                                <textarea name="" id=""  wire:model="slides.{{$key}}.description" class="w-full" rows="3" placeholder="Description"></textarea>
                                <x-text-input type="text"  wire:model="slides.{{$key}}.action_url" class="w-full" placeholder="Active URL" />
                            </div>
                            <x-hr/>
                            <div class="flex justify-between items-center">

                                <x-danger-button class="" wire:click="deleteSlides({{$slides[$key]['id']}})">
                                    <i class="fas fa-trash"></i>
                                </x-danger-button>
                                <x-primary-button :key="$key" class="" wire:click="updateSlides({{$key}},{{$slides[$key]['id']}})">
                                    <i class="fas fa-save pr-2 "></i> save
                                </x-primary-button>
                            </div>
                        
                        </div>
                    @endforeach
                    
                  
                </div>
                <div class="flex justify-end space-x-2">
                    <x-primary-button wire:click="addNewSlides"> <i class="fas fa-plus pr-2"></i> Slides </x-primary-button>
                    {{-- <x-primary-button wire:click="update" > update </x-primary-button> --}}
                </div>
            </x-dashboard.section.inner>
        </x-dashboard.section>

    </x-dashboard.container>
</div>
