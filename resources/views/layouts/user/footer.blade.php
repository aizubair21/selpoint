<div>
    <section class="bg-white text-black py-12">
        <x-dashboard.container>

            <div class="container mx-auto px-4">
                @php
                $layout = [];
                $foot = App\Models\FooterLayout::where('name', 'default')->first();
                if ($foot) {
                $layout = json_decode($foot->layout, true);
                }
                @endphp
                @foreach($layout['sections'] as $section)
                <div class="mb-10">

                    <!-- Section Title -->
                    @if(!empty($section['title']))
                    <h2 class="text-lg font-bold mb-4">
                        {{ $section['title'] }}
                    </h2>
                    @endif

                    <div class="grid gap-5 lg:grid-cols-{{ count($section['columns']) }} sm:grid-cols-1">

                        @foreach($section['columns'] as $col)

                        <div class="space-y-3">

                            @foreach($col['widgets'] as $widget)

                            {{-- TEXT WIDGET --}}
                            @if($widget['type'] === 'text' && !empty($widget['content']))
                            <p class="text-gray-800 text-sm leading-relaxed">
                                {{ $widget['content'] }}
                            </p>
                            @endif

                            {{-- LINK WIDGET --}}
                            @if($widget['type'] === 'link' && !empty($widget['url']))
                            <a href="{{ $widget['url'] }}" class="text-orange-400 text-sm hover:underline block">
                                {{ $widget['label'] ?? 'Link' }}
                            </a>
                            @endif

                            {{-- ICON WIDGET --}}
                            @if($widget['type'] === 'icon' && !empty($widget['url']))
                            <a href="{{ $widget['url'] ?? '#' }}" target="_blank" class="inline-block mr-3">
                                <img src="{{ asset('storage/') ." /". $widget['url'] }}" alt="icon" class="h-24">
                            </a>
                            @endif

                            @endforeach

                        </div>

                        @endforeach

                    </div>

                </div>
                @endforeach

            </div>

        </x-dashboard.container>
    </section>

    <div class="cpy_">
        <p class="">© 2025 All Rights Reserved</p>
    </div>

</div>