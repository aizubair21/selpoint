<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <x-dashboard.page-header>
        Footer Builder
    </x-dashboard.page-header>


    {{--
    <pre>
        {{ json_encode($layout, JSON_PRETTY_PRINT) }}   
    </pre> --}}

    {{--
    <pre>
        {{ json_encode($icons, JSON_PRETTY_PRINT) }}   
    </pre> --}}

    <div>
        <x-primary-button wire:click="addSection({{ count($layout['sections']) + 1 }})">
            + Section
        </x-primary-button>
        <br>
        <br>
        <div class="space-y-6">
            @foreach($layout['sections'] as $sIndex => $section)
            <div class="border p-4 bg-gray-50 rounded">
                <div class="flex items-center mb-2">
                    <button class="border p-1">
                        <i wire:click="deleteSection({{ $sIndex }})" class="fas fa-trash text-red-500 p-1"></i>
                    </button>
                    <input type="text" wire:model="layout.sections.{{ $sIndex }}.title" class="border px-2 py-1 w-full"
                        placeholder="Section Title" />
                </div>

                <div class="grid grid-cols-{{ count($section['columns']) }} gap-4">
                    @foreach($section['columns'] as $cIndex => $col)
                    <div class="border p-2 bg-white rounded">

                        <div class="flex items-center mb-2">
                            <button wire:click="deleteColumn({{$sIndex}}, {{$cIndex}})" class="text-xs mr-2">
                                <i class="fas fa-trash"></i>
                            </button>
                            <h4 class="font-semibold ">Column {{ $cIndex+1 }}</h4>
                        </div>

                        @foreach($col['widgets'] as $wIndex => $widget)
                        <div class="border p-2 mb-2 rounded">
                            @if($widget['type'] === 'text')
                            <textarea
                                wire:model="layout.sections.{{ $sIndex }}.columns.{{ $cIndex }}.widgets.{{ $wIndex }}.content"
                                class="w-full border px-2 py-1" placeholder="Text...">
                            </textarea>
                            <button wire:click="deleteWidget({{ $sIndex }}, {{ $cIndex }}, {{ $wIndex }})"
                                class="text-sm text-red-500 mt-1">
                                Erase
                            </button>
                            @elseif($widget['type'] === 'link')
                            <input
                                wire:model="layout.sections.{{ $sIndex }}.columns.{{ $cIndex }}.widgets.{{ $wIndex }}.label"
                                placeholder="Link Label" class="border w-full px-2 py-1 mb-1" />
                            <input
                                wire:model="layout.sections.{{ $sIndex }}.columns.{{ $cIndex }}.widgets.{{ $wIndex }}.url"
                                placeholder="Link URL" class="border w-full px-2 py-1" />

                            <button wire:click="deleteWidget({{ $sIndex }}, {{ $cIndex }}, {{ $wIndex }})"
                                class="text-sm text-red-500 mt-1">
                                Erase
                            </button>
                            @elseif($widget['type'] === 'icon')
                            <input type="file"
                                wire:model="layout.sections.{{ $sIndex }}.columns.{{ $cIndex }}.widgets.{{ $wIndex }}.icon"
                                placeholder="Icon name (e.g., facebook)" class="border w-full px-2 py-1 mb-1" />
                            <input
                                wire:model="layout.sections.{{ $sIndex }}.columns.{{ $cIndex }}.widgets.{{ $wIndex }}.url"
                                placeholder="Icon URL" class="border w-full px-2 py-1" />

                            <button wire:click="deleteWidget({{ $sIndex }}, {{ $cIndex }}, {{ $wIndex }})"
                                class="text-sm text-red-500 mt-1">
                                Erase
                            </button>
                            @endif
                        </div>
                        @endforeach

                        <div class="space-x-2">
                            <button wire:click="addWidget({{ $sIndex }}, {{ $cIndex }}, 'text')"
                                class="border px-2  rounded-sm text-sm text-blue-500">+ Text</button>
                            <button wire:click="addWidget({{ $sIndex }}, {{ $cIndex }}, 'link')"
                                class="border px-2  rounded-sm text-sm text-green-500">+ Link</button>
                            <button wire:click="addWidget({{ $sIndex }}, {{ $cIndex }}, 'icon')"
                                class="border px-2  rounded-sm text-sm text-purple-500">+ Icon</button>
                        </div>
                    </div>
                    @endforeach
                </div>

                <x-secondary-button wire:click="addColumn({{ $sIndex }})" class="mt-2 text-green-600">+ Column
                </x-secondary-button>
            </div>
            @endforeach
        </div>

        <x-primary-button wire:click="save" class="bg-green-600 text-white px-4 py-2 rounded mt-4">Save Footer
        </x-primary-button>

        @if(session()->has('success'))
        <div class="text-green-600 mt-2">{{ session('success') }}</div>
        @endif
    </div>

</div>