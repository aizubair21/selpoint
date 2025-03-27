<x-app-layout>
   <x-dashboard.page-header> Dashboard </x-dashboard.page-header>

    <x-dashboard.container>
        <div>
            <x-dashboard.overview.section >
                <x-dashboard.overview.div >
                    <x-slot name="title">
                        Admins
                    </x-slot>
                    <x-slot name="content">
                        100 
                    </x-slot>
                </x-dashboard.overview.div>
                <x-dashboard.overview.div>
                    <x-slot name="title">
                        Vendors
                    </x-slot>
                    <x-slot name="content">
                        100 / 0
                    </x-slot>
                </x-dashboard.overview.div>
                <x-dashboard.overview.div>
                    <x-slot name="title">
                        Resellers
                    </x-slot>
                    <x-slot name="content">
                        100 / 0
                    </x-slot>
                </x-dashboard.overview.div>
                <x-dashboard.overview.div>
                    <x-slot name="title">
                        Riders
                    </x-slot>
                    <x-slot name="content">
                        100 / 0
                    </x-slot>
                </x-dashboard.overview.div>
                <x-dashboard.overview.div>
                    <x-slot name="title">
                        Users
                    </x-slot>
                    <x-slot name="content">
                        100 / 0
                    </x-slot>
                </x-dashboard.overview.div>
                
            
                <x-dashboard.overview.div>
                    <x-slot name="title">
                        Products
                    </x-slot>
                    <x-slot name="content">
                        100 / 100
                    </x-slot>
                </x-dashboard.overview.div>
                <x-dashboard.overview.div>
                    <x-slot name="title">
                        Category
                    </x-slot>
                    <x-slot name="content">
                        100 / 100
                    </x-slot>
                </x-dashboard.overview.div>
            </x-dashboard.overview.section>
            
        </div>
    </x-dashboard.container>


    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Vendor
                </x-slot>
                <x-slot name="content">
                    Recent Vendor Request
                </x-slot>
            </x-dashboard.section.header>
            
            <x-dashboard.section.inner>
                <x-dashboard.table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>01</td>
                                <td>Undefined</td>
                            </tr>
                        </tbody>
                </x-dashboard.table>
            </x-dashboard.section.inner>

        </x-dashboard.section>
    </x-dashboard.container>
   
    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Reseller
                </x-slot>
                <x-slot name="content">
                    Recent Reseller Request
                </x-slot>
            </x-dashboard.section.header>
            
            <x-dashboard.section.inner>
                asdfsa
            </x-dashboard.section.inner>

        </x-dashboard.section>
    </x-dashboard.container>
  
    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Rider
                </x-slot>
                <x-slot name="content">
                    Recent Rider Request
                </x-slot>
            </x-dashboard.section.header>
            
            <x-dashboard.section.inner>
                asdfsa
            </x-dashboard.section.inner>

        </x-dashboard.section>
    </x-dashboard.container>
    
</x-app-layout>
