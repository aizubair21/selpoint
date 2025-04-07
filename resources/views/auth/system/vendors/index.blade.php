<x-app-layout>
    <x-dashboard.page-header>
        Vendors
    </x-dashboard.page-header>

    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    {{-- <x-nav-link class="rounded-lg border px-3 py-2 shadow mb-2"> 
                        Make a vendor
                    </x-nav-link> --}}
                </x-slot>
                <x-slot name="content">
                   
                </x-slot>
            </x-dashboard.section.header>


            <x-dashboard.overview.section>
                <x-dashboard.overview.div>
                    <x-slot name="title">
                        Total Vendor
                    </x-slot>
                    <x-slot name="content">
                        100
                    </x-slot>
                </x-dashboard.overview.div>
                <x-dashboard.overview.div>
                    <x-slot name="title">
                        Pending
                    </x-slot>
                    <x-slot name="content">
                        100
                    </x-slot>
                </x-dashboard.overview.div>
                <x-dashboard.overview.div>
                    <x-slot name="title">
                        Active
                    </x-slot>
                    <x-slot name="content">
                        100
                    </x-slot>
                </x-dashboard.overview.div>
                <x-dashboard.overview.div>
                    <x-slot name="title">
                        Suspended
                    </x-slot>
                    <x-slot name="content">
                        0
                    </x-slot>
                </x-dashboard.overview.div>
            </x-dashboard.overview.section>
            <x-hr/>
            <x-dashboard.overview.section>
                <x-dashboard.overview.div>
                    <x-slot name="title">
                        Active Product
                    </x-slot>
                    <x-slot name="content">
                        0
                    </x-slot>
                </x-dashboard.overview.div>
                <x-dashboard.overview.div>
                    <x-slot name="title">
                        Get Comission
                    </x-slot>
                    <x-slot name="content">
                        0
                    </x-slot>
                </x-dashboard.overview.div>

            </x-dashboard.overview.section>
        </x-dashboard.section>
        
        <x-dashboard.section>
            {{-- filter  --}}

            {{-- <div class="row justify-content-between m-0 mb-3 p-0">
                <div class="col-lg-6">
                    <x-text-input type='search' class="w-100" placeholder="Search Vendors" />
                </div>

                <div class="col-lg-3"></div>
                <div class="col-lg-3 mt-3">
                    <x-primary-button x-on:click.prevent="$dispatch('open-modal', 'vendor-filter-modal')">
                        Filter
                    </x-primary-button>
                </div>
                
            </div> --}}
            @php
                $filter = request('filter') ?? "Active";
            @endphp

            <x-dashboard.table>
                <div class="flex justify-between items-start">
                    <div>
                        <x-nav-link href="{{URL::to(URL()->current())}}/?filter=Active" class="px-2 mb-2" :active="$filter == 'Active' " >Active</x-nav-link>
                        <x-nav-link href="{{URL::to(URL()->current())}}/?filter=Pending" class="px-2 mb-2" :active="$filter == 'Pending' " >Pending</x-nav-link>
                        <x-nav-link href="{{URL::to(URL()->current())}}/?filter=Disabled" class="px-2 mb-2" :active="$filter == 'Disabled' " >Disabled</x-nav-link>
                        <x-nav-link href="{{URL::to(URL()->current())}}/?filter=Suspended" class="px-2 mb-2" :active="$filter == 'Suspended' " >Suspended</x-nav-link>
                    </div>

                    <div>
                        <x-text-input type="search" placeholder="Search Vendor" class="my-1" />
                    </div>
                              
                </div>

            </x-dashboard.table>

            {{-- section inner  --}}
            <x-dashboard.section.inner>
                <x-dashboard.table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Commission</th> 
                            <th>Category</th>
                            <th>Product</th>
                            <th>Join</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                <div class="text-nowrap">
                                    Vendor 1
                                </div>
                                <div class="badge badge-info text-nowrap">Vendor Shop Name</div>
                            </td>
                            <td>Active</td>
                            <td>
                                <span class="badge badge-success">10%</span>
                            </td>
                            <td>10</td>
                            <td>100</td>
                            <td>2022-01-01</td>
                            <td>
                                <x-nav-link href="{{route('system.vendor.edit')}}">
                                    Edit
                                </x-nav-link>
                            </td>
                        </tr>
                    </tbody>
                </x-dashboard.table>
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </x-dashboard.container>

    <x-modal name="vendor-filter-modal" id="vendor-filter-modal" focusable class="h-screen overflow-y-scroll">
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Filter Vendor
                </x-slot>
                <x-slot name='content'>
                    {{-- <x-danger-button type="button" @click="close()"> --}}
                </x-slot>
            </x-dashboard.section.header>
            <x-dashboard.section.inner class="overflow-y-scroll">
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </x-modal>
</x-app-layout>