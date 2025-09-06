<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <x-dashboard.page-header>
        <div class="flex justify-between items-center">
            <div>
                Your Consignments

            </div>

            <x-nav-link-btn href="{{ route('dashboard')}}">
                <i class="fas fa-plus pr-2"></i> Pick
            </x-nav-link-btn>
        </div>
    </x-dashboard.page-header>

    <x-dashboard.container>
        <div class="flex justify-start items-center">
            <select wire:model.live="status" class="py-1 mt-1 rounded" id="select_status">
                <option value="All"> -- All -- </option>
                <option value="Pending">Pending</option>
                <option value="Received">Received</option>
                <option value="Completed">Delivered</option>
                <option value="Returned">Returned</option>
            </select>

            {{-- <div>
                <input type="date" name="datetime" id="datetime" class="py-1" />
            </div> --}}
        </div>
        {{-- The best athlete wants his opponent at his best. --}}
        @if (count($consignments) > 0)

        <div style="display:grid; grid-template-columns:repeat(auto-fit, 160px); gap:1rem;">
            @foreach ($consignments as $cod)

            <div class="relative bg-white rounded shadow text-center flex flex-col justify-between">



                <div class="py-2 bg-gray-200">
                    <h3 class="text-xs text-gray-500"> Order ID </h3>
                    <div class="font-bold">
                        {{$cod->id}}
                    </div>
                </div>

                <div class="p-2">
                    <div class="flex justify-center items-center -space-x-2 overflow-hidden">
                        @foreach ($cod->order?->cartOrders as $item)
                        <img src="{{asset('storage/' . $item->product?->thumbnail)}}"
                            class="inline-block size-10 rounded-full ring-2 ring-white outline -outline-offset-1 outline-black/5"
                            alt="" srcset="">
                        @endforeach
                    </div>
                </div>

                <div class="px-3 py-2">

                    <div class="text-2xl font-bold flex justify-center ">
                        {{$cod->total_amount}} Tk
                    </div>
                    <div class="text-sm text-gray-500 flex justify-center items-center text-center">
                        {{-- <div>
                            <sup>
                                ৳
                            </sup>
                        </div> --}}
                        <div class=" pl-1 font-bold">
                            {{$cod?->amount ?? "N/A"}}
                        </div>
                        <div class="px-1" style="line-height:8px">
                            +
                        </div>
                        <div class="flex justify-center items-cenrer">
                            <div class="">
                                {{$cod->system_comission ?? "N/A"}}
                            </div>
                        </div>
                    </div>

                </div>

                <div class="px-3 py-2">
                    <div class="text-xs text-gray-500">
                        <i class="fas fa-map-marker-alt pr-1"></i>
                        {{-- {{$cod->upozila}}, {{$cod->district}} --}}
                        {{$cod->order?->location ?? "N/A"}}
                    </div>
                    {{-- <div class="text-gray-500 text-sm">
                        {{$cod->number}}
                    </div> --}}
                </div>
                @if ($cod->status == 'Pending')
                <div class="pb-2">
                    <button class=" rounded border px-2 py-1 bg-indigo-900 text-white shadow text-sm"
                        wire:click.prevent="confirmOrder({{$cod->id}}, 'Received')">
                        Mark as Received
                    </button>
                </div>

                <div class="absolute p-1" style="top:43px; left:50%; transform:translatex(-50%)">
                    <div class="text-xs px-2 rounded-xl bg-white shadow"> Pending </div>
                </div>
                @endif

                @if ($cod->status == 'Received')
                <div class="pb-2">
                    <button class=" rounded border px-2 py-1 bg-indigo-900 text-white shadow text-sm"
                        wire:click="confirmOrder({{$cod->id}}, 'Completed')">
                        Mark as Delivered
                    </button>
                </div>

                <div class="absolute p-1" style="top:43px; left:50%; transform:translatex(-50%)">
                    <div class="text-xs px-2 rounded-xl bg-indigo-200 shadow"> Received </div>
                </div>
                @endif
                @if ($cod->status == 'Completed')
                <p class="p-2 bg-indigo-300">
                    You have delivered this order.
                </p>

                <div class="absolute p-1" style="top:43px; left:50%; transform:translatex(-50%)">
                    <div class="text-xs px-2 rounded-xl bg-indigo-900 text-white shadow"> Done </div>
                </div>
                @endif
            </div>

            @endforeach
        </div>

        @else
        <p class="bg-gray-50 p-1">No Consignment Found !</p>
        @endif

        {{-- <x-dashboard.section>
            <x-dashboard.section.inner>

            </x-dashboard.section.inner>
        </x-dashboard.section> --}}
    </x-dashboard.container>
</div>