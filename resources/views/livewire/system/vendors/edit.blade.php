<div>
    <x-dashboard.page-header>
        Vendor Update
        <br>
        @include('auth.system.vendors.navigations')
    </x-dashboard.page-header>

    <x-dashboard.container>
        <x-dashboard.section>

            <x-dashboard.section.header>
                <x-slot name="title">
                    {{$vendor->shop_name_en ?? "N/A"}} / {{$vendor->shop_name_bn ?? "N/a"}}
                </x-slot>

                <x-slot name="content">
                    <div>
                        {{$vendor->user?->name ?? "N/A"}} - {{$vendor?->status ?? "N/A"}}
                    </div>
                    <span style="font-size: 12px">
                        {{$vendor->created_at?->toFormattedDateString()}}
                    </span>
                </x-slot>
            </x-dashboard.section.header>

            <x-dashboard.section.inner>
            </x-dashboard.section.inn>
        </x-dashboard.section>
    </x-dashboard.container>
</div>
