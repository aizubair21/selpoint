<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    <div class="flex justify-between items-center p-2">
        <div>

            @if (count($orders))
            {{count($orders)}} consignment are available.
            @else
            No consignment found !
            @endif
        </div>
        <div>
            <div class="inline px-2 py-1 rounded-xl bg-indigo-900 text-white shadow text-sm">
                <i class="fas fa-location pr-2"></i> {{$riderInfo?->targeted_area ?? "N/A"}}
            </div>
        </div>
    </div>
    <x-hr />
    <div>
        <div style="display:grid; grid-template-columns:repeat(auto-fit, 160px); gap:1rem;">
            @foreach ($orders as $order)

            <div class="bg-white rounded shadow text-center flex flex-col justify-between" style="height:250px">
                <div class="py-2 bg-gray-200">
                    <h3 class="text-xs text-gray-500"> Order ID </h3>
                    <div class="font-bold">
                        {{$order->id}}
                    </div>
                </div>
                <div class="px-3 py-2">
                    <div class="text-4xl font-bold">
                        <sup>
                            ৳
                        </sup>
                        {{$order->total + $order->shipping}}
                    </div>
                    <div class="text-sm text-gray-500 flex justify-center items-center text-center">
                        {{-- <div>
                            <sup>
                                ৳
                            </sup>
                        </div> --}}
                        <div class=" pl-1 font-bold">
                            {{$order?->total ?? "N/A"}}
                        </div>
                        <div class="px-1" style="line-height:8px">
                            +
                        </div>
                        <div class="flex justify-center items-cenrer">

                            {{-- <div>
                                <sup>
                                    ৳
                                </sup>
                            </div> --}}
                            <div class="">
                                {{$order?->shipping ?? "N/A"}}
                            </div>
                        </div>
                    </div>

                </div>
                <p class="text-sm  px-3 py-2 text-gray-600" style="line-height: 18px">
                    {{$order->location}}
                    <br>
                    {{$order->number}}
                </p>
                <div class="">

                    <div class="p-1">
                        <x-primary-button>
                            Confirm
                        </x-primary-button>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>
    <x-hr />

</div>