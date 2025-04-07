
<x-app-layout>
    <x-dashboard.page-header>
        Vendor Documents
        <br>
        @include('auth.system.vendors.navigations')
    </x-dashboard.page-header>
    
    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Documents
                </x-slot>
                <x-slot name="content">
                    
                </x-slot>
            </x-dashboard.section.header>
            <x-dashboard.section.inner>
                
                <div>
                    <form action="/">
                        <fieldset>
                            <legend>Personal Details</legend>
                            <label for="fname">First Name:</label>
                            <input type="text" id="fname" name="fname">
                            <label for="lname">Last Name:</label>
                            <input type="text" id="lname" name="lname">
                        </fieldset>
                    </form>
                </div>
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </x-dashboard.container>
    {{-- <x-dashboard.container>
        <x-dashboard.section>

        </x-dashboard.section>
    </x-dashboard.container> --}}


</x-app-layout>