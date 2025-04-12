
<x-app-layout>
    <x-dashboard.page-header>
        Vendor Settings
        <br>
        @include('auth.system.vendors.navigations')
    </x-dashboard.page-header>
    
    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Settings
                </x-slot>
                <x-slot name="content">

                </x-slot>
            </x-dashboard.section.header>
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
        </x-dashboard.section>
    </x-dashboard.container>
    {{-- <x-dashboard.container>
        <x-dashboard.section>

        </x-dashboard.section>
    </x-dashboard.container> --}}


</x-app-layout>