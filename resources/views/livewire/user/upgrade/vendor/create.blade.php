<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <x-dashboard.section >
        <x-dashboard.section.header>
            <x-slot name="title">
                Vendor Request Form
            </x-slot>

            <x-slot name="content">
                Request to be a vendor
                <x-nav-link href="{{route('upgrade.vendor.index')}}" class="">
                    previous request
                </x-nav-link>
               
            </x-slot>
        </x-dashboard.section.header>
    </x-dashboard.section>
   
    <form action="{{route('upgrade.vendor.store')}}" method="post"> 
        @csrf
        @include('user.pages.profile-upgrade.vendor.partials.basic')

        {{-- <x-dashboard.section>
            <x-dashboard.section.inner>
                <x-primary-button>
                    submit
                </x-primary-button>
            </x-dashboard.section.inner>
        </x-dashboard.section> --}}
    </form>
</div>
