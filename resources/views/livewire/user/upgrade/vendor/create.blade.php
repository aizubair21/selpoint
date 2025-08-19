<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <x-dashboard.section >
        <x-dashboard.section.header>
            <x-slot name="title">
            {{Str::ucfirst($upgrade)}} Request Form
            </x-slot>

            <x-slot name="content">
                Request to be a {{Str::ucfirst($upgrade)}}
                <x-nav-link href="{{route('upgrade.vendor.index', ['upgrade' => $upgrade])}}" class="">
                    previous request
                </x-nav-link>
               
            </x-slot>
        </x-dashboard.section.header>
    </x-dashboard.section>
   
    <form wire:submit.prevent="store" method="post"> 
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
