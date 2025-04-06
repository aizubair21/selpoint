<x-app-layout>
    <x-dashboard.page-header>
        vendors
    </x-dashboard.page-header>

    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Your Vendors
                </x-slot>
                <x-slot name="content">
                    System have 4 active vendor, 2 pending vendor, 1 inactive vendor
                </x-slot>
            </x-dashboard.section.header>

        </x-dashboard.section>
        
        <x-dashboard.section>
            {{-- filter  --}}

            <div class="row justify-content-between m-0 mb-3 p-0">
                <div class="col-lg-8">
                    <x-text-input type='search' class="w-100" placeholder="Search Vendors" />
                </div>
                <div class="col-lgk-4">
                    <x-primary-button type="button">
                        Filter
                    </x-primary-button>
                </div>
            </div>

            <div class="d-flex">
                <x-nav-link class="px-2 mb-2" :active="true">Active</x-nav-link>
                <x-nav-link class="px-2 mb-2">Request</x-nav-link>
                <x-nav-link class="px-2 mb-2">Pending</x-nav-link>
                <x-nav-link class="px-2 mb-2">Inactive</x-nav-link>
            </div>

            {{-- section inner  --}}
            <x-dashboard.section.inner>
                <x-dashboard.table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>C. Rate</th> 
                            <th>Join</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Vendor 1</td>
                            <td>Active</td>
                            <td>
                                <span class="badge badge-success">10%</span>
                            </td>
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
</x-app-layout>