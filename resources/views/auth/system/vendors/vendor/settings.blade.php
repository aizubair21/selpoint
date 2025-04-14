
<x-app-layout>
    <x-dashboard.page-header>
        Vendor Settings
        <br>
        @include('auth.system.vendors.navigations')
    </x-dashboard.page-header>
    
    <x-dashboard.container>
        <form action="{{route('system.vendor.update', ['id' => $vendor->id])}}" method="post">
            <x-dashboard.section>
                <x-dashboard.section.header>
                    <x-slot name="title">
                        Settings
                    </x-slot>
                    <x-slot name="content">
                        Set up your vendor membership status and important things.
                    </x-slot>
                </x-dashboard.section.header>
                <x-dashboard.section.inner>
                    @csrf
                    <x-hr/>
                    <div class="flex">
                        <div class="flex items-center p-2 ">
                            <x-text-input :checked="$vendor->status == 'Active'" type="radio" class="m-0 mr-2" name="status" value="Active" id="active_check" />
                            <x-input-label class="m-0" >Active</x-input-label>
                        </div>
                        <div class="flex items-center p-2 ">
                            <x-text-input :checked="$vendor->status == 'Pending'" type="radio" class="m-0 mr-2" name="status" value="Pending" id="Pending_check" />
                            <x-input-label class="m-0" >Pending</x-input-label>
                        </div>
                        <div class="flex items-center p-2 ">
                            <x-text-input :checked="$vendor->status == 'Disabled'" type="radio" class="m-0 mr-2" name="status" value="Disabled" id="Disabled_check" />
                            <x-input-label class="m-0" >Disabled</x-input-label>
                        </div>
                        <div class="flex items-center p-2 ">
                            <x-text-input :checked="$vendor->status == 'Suspended'" type="radio" class="m-0 mr-2" name="status" value="Suspended" id="Suspended_check" />
                            <x-input-label class="m-0" >Suspended</x-input-label>
                        </div>
                    </div>
                    <x-hr />

                    
                    <x-input-label>Comission Rate (%) </x-input-label>
                    <x-text-input name="system_get_comission" value="{{$vendor->system_get_comission}}" placeholder="10" />
                    <div class='text-xs'>
                        You take {{$vendor->system_get_comission ?? "0"}}% profit from this vendor revinew.
                    </div>
                    <x-hr />
                    <x-primary-button>
                        Save
                    </x-primary-button>
                </x-dashboard.section.inner>
            </x-dashboard.section>
        </form>

        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Rejection
                </x-slot>
                <x-slot name="content">
                    If you wish to reject the vendor membership request, Follow the bellow rejection projess. first check to the checkbox, the give a rejection causes message.
                </x-slot>
            </x-dashboard.section.header>
            <x-dashboard.section.inner>
                <form action="{{route('system.vendor.update', ['id' => $vendor->id])}}"method="post">
                    @csrf
                    <div class="flex mb-3">
                        <x-text-input type="checkbox" name="is_rejected" value="1" style="width:25px; height:25px; margin-right:10px" />
                        <x-input-label>Rejecte the request!</x-input-label>
                    </div>

                    <textarea name="rejected_for" id="" rows="8" class="w-full" placeholder="Describe why you wish to reject .... "></textarea>
                    <x-hr />

                    <x-primary-button>
                        submit
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