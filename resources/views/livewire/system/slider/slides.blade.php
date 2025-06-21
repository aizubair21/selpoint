<div>
    <x-dashboard.page-header>
        Slider- {{$slider->name}}
    </x-dashboard.page-header>
    

    <x-dashboard.container>

        <x-dashboard.section>
            <x-dashboard.section.inner>
                
                <div class="p-3 flex flex-wrap">

                    @foreach ($slides as $key => $item)
                        <div class="border w-full group max-w-72 rounded p-3 mb-1 relative">
                            <div class="p-2">
                            {{-- {{$slides[$key]['main_title']}} --}}
                                @if ($image[$key]['image'])
                                    <img src="{{$image[$key]['image']->temporaryUrl()}}" style="height:150px; width:100%;" alt="">
                                @else 
                                    <img src="{{asset('storage/'.$slides[$key]['image'])}}" style="height:150px; width:100%;" alt="">

                                @endif
                                <input type="file" accept="jpg, jpeg, png" max="500" class="border p-1 w-full" wire:model="image.{{$key}}.image">
                            </div>
                            <div class="py-2 space-y-2">
                                <x-text-input type="text" wire:model="slides.{{$key}}.main_title" class="w-full" placeholder="Main Title" />
                                <x-text-input type="text"  wire:model="slides.{{$key}}.sub_title" class="w-full" placeholder="Sub Title" />
                                <textarea name="" id=""  wire:model="slides.{{$key}}.des" class="w-full" rows="3"></textarea>
                            </div>


                            <x-danger-button class="absolute left-0 top-0" wire:click="deleteSlides({{$slides[$key]['id']}})">
                                <i class="fas fa-trash"></i>
                            </x-danger-button>
                            <x-primary-button class="absolute right-0 top-0" wire:click="updateSlides({{$key}},{{$slides[$key]['id']}})">
                                <i class="fas fa-file"></i>
                            </x-primary-button>
                        
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
