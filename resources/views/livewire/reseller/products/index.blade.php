<div>
    <x-dashboard.page-header>
        <div class="flex justify-between items-start">
            Products

            <div class="flex">
                <x-nav-link-btn href="{{route('vendor.products.create')}}">
                    <i class="fas fa-plus pr-2"></i> New
                </x-nav-link-btn>
                <x-nav-link-btn href="{{route('reseller.resel-product.index')}}">Recel from vendor</x-nav-link-btn>
            </div>
        </div>
        <br>

        @php
        $nav = request('nav') ?? 'own';
        @endphp
        <x-nav-link href="{{url()->current()}}/?nav=own" :active="$nav == 'own'">
            Your Product
        </x-nav-link>
        <x-nav-link href="{{url()->current()}}/?nav=resel" :active="$nav == 'resel'">
            Resel Product
        </x-nav-link>
    </x-dashboard.page-header>

    <x-dashboard.container>


        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title" class="float-right clearfix">
                    <div class="flex items-center">
                        <x-text-input type="search" placeholder="Search by name" class="mx-2 hidden lg:block py-1">
                        </x-text-input>
                        <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'filter-modal')">Filter
                        </x-primary-button>
                    </div>

                </x-slot>
                <x-slot name="content">
                    <div class="flex justify-between items-center">
                        <div>
                            <x-nav-link href="" :active="true">
                                Active
                            </x-nav-link>
                            <x-nav-link href="">
                                In Active
                            </x-nav-link>
                            <x-nav-link href="">
                                Trash
                            </x-nav-link>
                        </div>

                    </div>
                </x-slot>
            </x-dashboard.section.header>
            <x-dashboard.section.inner>
                <x-dashboard.table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>Product</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Sell</th>
                            <th>Earning</th>
                            <th>Insert At</th>
                            <th>A/C</th>
                        </tr>
                    </thead>

                    <tbody>
                    <tbody>
                        @foreach ($data as $product)
                        <tr>
                            <td>
                                <input type="checkbox" wire:model.live="selectedModel" class="rounded"
                                    value="{{$product->id}}" style="width:20px; height:20px" />
                            </td>
                            <td> {{$loop->iteration}} </td>
                            <td>
                                <div class="relative">

                                    <img class="w-12 h-12 rounded-md shadow"
                                        src="{{asset('/storage/'. $product->thumbnail)}}" />
                                </div>
                            </td>
                            <td>
                                <p>
                                    {{$product->name ?? "N/A"}}
                                </p>
                                <a title="Pending Order #{{$product->orders()->first()->id}}" @class(['rounded
                                    text-white px-1 bg-red-900 mr-1 inline-flex text-xs hidden' , ' block'=>
                                    $product->orders()->pending()->exists()])>
                                    {{$product->orders()->first()->id ?? 'N\A'}}
                                </a>
                                <a title="Accept Order #{{$product->orders()->first()->id}}" @class(['rounded text-white
                                    px-1 bg-green-900 mr-1 inline-flex text-xs hidden', ' block'=>
                                    $product->orders()->accept()->exists()])>
                                    {{$product->orders()->first()->id ?? 'N\A'}}
                                </a>
                            </td>
                            <td>
                                {{$product->status ? 'Active' : "In Active"}}
                            </td>
                            <td>
                                {{$product->orders()->count()}}
                            </td>
                            <td>
                                {{
                                $product->orders()->confirm()->sum('total')
                                }}
                            </td>
                            <td>
                                {{$product->created_at?->diffForHumans() ?? "N/A"}}
                            </td>
                            <td>
                                <x-nav-link
                                    href="{{route('reseller.products.edit', ['id' => encrypt($product->id) ])}}">edit
                                </x-nav-link>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </tbody>
                </x-dashboard.table>
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </x-dashboard.container>

    {{-- filter model --}}
    <x-modal name="filter-modal" maxWidth="xl" focusable class="h-screen overflow-y-scroll">
        <div class="p-3">
            <x-dashboard.section.header>
                <x-slot name="title">
                    Filter Your Own
                </x-slot>
                <x-slot name="content">

                </x-slot>
            </x-dashboard.section.header>
            <x-dashboard.section.inner>
                <form action="" method="get">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3>Filter by Create date</h3>
                            <ul class="ms-4 mt-2">
                                <li>
                                    <div class="flex items-center mb-2">
                                        <x-text-input class="p-0 m-0 mr-3" type="radio" name="" value="today" />
                                        <x-input-label class="p-0 m-0">Today</x-input-label>
                                    </div>
                                    <div class="flex items-center mb-2">
                                        <x-text-input class="p-0 m-0 mr-3" type="radio" name="" value="today" />
                                        <x-input-label class="p-0 m-0">Today</x-input-label>
                                    </div>
                                    <div class="flex items-center mb-2">
                                        <x-text-input class="p-0 m-0 mr-3" type="radio" name="" value="today" />
                                        <x-input-label class="p-0 m-0">Today</x-input-label>
                                    </div>
                                    <div class="flex items-center mb-2">
                                        <x-text-input class="p-0 m-0 mr-3" type="radio" name="" value="today" />
                                        <x-input-label class="p-0 m-0">Today</x-input-label>
                                    </div>
                                </li>
                            </ul>
                        </div>


                        <div>
                            <h3>Filter by Status</h3>
                            <ul class="ms-4 mt-2">
                                <li>
                                    <div class="flex items-center mb-2">
                                        <x-text-input class="p-0 m-0 mr-3" type="radio" name="" value="today" />
                                        <x-input-label class="p-0 m-0">Active</x-input-label>
                                    </div>
                                    <div class="flex items-center mb-2">
                                        <x-text-input class="p-0 m-0 mr-3" type="radio" name="" value="today" />
                                        <x-input-label class="p-0 m-0">Disable</x-input-label>
                                    </div>
                                    <div class="flex items-center mb-2">
                                        <x-text-input class="p-0 m-0 mr-3" type="radio" name="" value="today" />
                                        <x-input-label class="p-0 m-0">Trash</x-input-label>
                                    </div>

                                </li>
                            </ul>
                        </div>
                        <div></div>

                    </div>
                </form>
            </x-dashboard.section.inner>
        </div>
    </x-modal>

</div>