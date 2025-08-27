<div>
    <!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->
    @php
    $footer = \App\Models\FooterLayout::where('is_active', true)->first();
    $layout = $footer ? json_decode($footer->layout, true) : null;
@endphp

@if($layout)
<footer class="bg-gray-900 text-white p-6">
    <div class="grid grid-cols-{{ count($layout['sections']) }} gap-6">
        @foreach($layout['sections'] as $section)
            <div>
                <h4 class="font-bold mb-2">{{ $section['title'] }}</h4>
                <div class="grid grid-cols-{{ count($section['columns']) }} gap-4">
                    @foreach($section['columns'] as $col)
                        <ul>
                            @foreach($col['widgets'] as $widget)
                                @if($widget['type'] === 'text')
                                    <p>{{ $widget['content'] }}</p>
                                @elseif($widget['type'] === 'link')
                                    <li><a href="{{ $widget['url'] }}" class="hover:underline">{{ $widget['label'] }}</a></li>
                                @elseif($widget['type'] === 'icon')
                                    <a href="{{ $widget['url'] }}" target="_blank" class="mr-2 inline-block">
                                        <i class="fab fa-{{ $widget['icon'] }}"></i>
                                    </a>
                                @endif
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</footer>
@endif

</div>