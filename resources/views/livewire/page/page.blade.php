<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    @if ($pages)
    <x-dashboard.container>

        <h1>
            {{$pages->name}}
        </h1>
        <x-hr/>
        <p>
            {!! $pages->content !!}
        </p>
    </x-dashboard.container>
    @else
        <p class="w-full py-2 bg-gray-50">
            Not Found !
        </p>
    @endif
</div>
