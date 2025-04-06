<x-app-layout>
    <x-dashboard.page-header>
         Edit Vendor info
         <x-hr />
         <div class="flex items-center text-sm">
            <div class="p-1 m-1">
                <div class="badge badge-success">ACTIVE</div>
            </div>
            <p class="p-1 m-1">
                 10% comission
            </p>
        </div>
    </x-dashboard.page-header>

    @include('auth.system.vendors.overview')

    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                @php
                    $filter = request('filter') ?? "Settings";
                @endphp
                <x-slot name="title">
                    <x-nav-link :active="$filter == 'Settings'" href="{{url()->current()}}/?filter=Settings">Settings</x-nav-link>
                    <x-nav-link :active="$filter == 'Documents'" href="{{url()->current()}}/?filter=Documents">Documents</x-nav-link>
                    <x-nav-link :active="$filter == 'Products'" href="{{url()->current()}}/?filter=Products">Products</x-nav-link>
                    <x-nav-link :active="$filter == 'Categories'" href="{{url()->current()}}/?filter=Categories">Categories</x-nav-link>
                </x-slot>

                <x-slot name="content">

                </x-slot>
            </x-dashboard.section.header>

            {{-- body  --}}
            @if ($filter == 'Settings')
                
                <x-dashboard.section.inner>
                    <form action="" method="post">
                        @csrf
                        <x-hr/>
                        <div class="flex">
                            <div class="flex items-center p-2 ">
                                <x-text-input type="radio" class="m-0 mr-2" name="status" value="Active" id="active_check" />
                                <x-input-label class="m-0" >Active</x-input-label>
                            </div>
                            <div class="flex items-center p-2 ">
                                <x-text-input type="radio" class="m-0 mr-2" name="status" value="Pending" id="Pending_check" />
                                <x-input-label class="m-0" >Pending</x-input-label>
                            </div>
                            <div class="flex items-center p-2 ">
                                <x-text-input type="radio" class="m-0 mr-2" name="status" value="Disable" id="Disable_check" />
                                <x-input-label class="m-0" >Disable</x-input-label>
                            </div>
                            <div class="flex items-center p-2 ">
                                <x-text-input type="radio" class="m-0 mr-2" name="status" value="Suspended" id="Suspended_check" />
                                <x-input-label class="m-0" >Suspended</x-input-label>
                            </div>
                        </div>
                        <x-hr />
                        <x-input-label>Comission Rate</x-input-label>
                        <x-text-input type="text" placeholder="10" />

                        <x-primary-button>
                            Save
                        </x-primary-button>
                    </form>
                </x-dashboard.section.inner>
            @endif

            @if ($filter == 'Documents')
                <x-dashboard.section.inner>

                </x-dashboard.section.inner>
            @endif

            @if ($filter == 'Products')
                <x-dashboard.section.inner>

                </x-dashboard.section.inner>
            @endif

            @if ($filter == 'Categories')
                <x-dashboard.section.inner>

                </x-dashboard.section.inner>
            @endif
        </x-dashboard.section>
    </x-dashboard.container>
</x-app-layout>