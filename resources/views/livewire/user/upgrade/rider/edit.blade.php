<div>
    <x-dashboard.section>
        <x-dashboard.section.header>
            <x-slot name="title">
               rider request
            </x-slot>
            <x-slot name="content">
                Edit and Upgrade Your Vendor Request Form <a href="{{route('upgrade.rider.index')}}">Previous Request</a>
                <br>
               {{-- <x-client.upgrade-status :upgrade="$upgrade" :$id /> --}}
               {{-- @includeIf('components.client.upgrade-status') --}}
            </x-slot>
        </x-dashboard.section.header>
    
        <x-dashboard.section.inner>
            
        </x-dashboard.section.inner>
    </x-dashboard.section>
</div>
