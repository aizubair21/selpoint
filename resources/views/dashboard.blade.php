<x-app-layout>
   <x-dashboard.page-header> 
        @if (auth()->user()->hasRole('vendor'))
            Vendor
        @endif
        @if (auth()->user()->hasRole('rider'))
            Rider
        @endif
        @if (auth()->user()->hasRole('admin'))
            Admin
        @endif
        @if (auth()->user()->hasRole('reseller'))
            Reseller
        @endif
        Dashboard 
    </x-dashboard.page-header>

    {{-- system dashboard over view  --}}
    @if (auth()->user()->hasAnyRole('admin','system'))     
        <x-dashboard.container>
            <x-dashboard.overview.section>
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
            <x-hr />
            {{-- <x-dashboard.section>
                <x-dashboard.section.header>
                    <x-slot name="title">
                        Comissions
                    </x-slot>
                    <x-slot name="content">
                        
                    </x-slot>
                </x-dashboard.section.header>
                
                <x-dashboard.section.inner>
                    <x-dashboard.overview.section>
                        <x-dashboard.overview.div>
                            <x-slot name="title">
                                Total Comission
                            </x-slot>
                            <x-slot name="content">
                                178989 TK
                            </x-slot>
                        </x-dashboard.overview.div>
                        <x-dashboard.overview.div>
                            <x-slot name="title">
                                Today
                            </x-slot>
                            <x-slot name="content">
                                178989 TK
                            </x-slot>
                        </x-dashboard.overview.div>
                        <x-dashboard.overview.div>
                            <x-slot name="title">
                                This Month
                            </x-slot>
                            <x-slot name="content">
                                178989 TK
                            </x-slot>
                        </x-dashboard.overview.div>
                    </x-dashboard.overview.section>

                </x-dashboard.section.inner>

            </x-dashboard.section> --}}
        </x-dashboard.container>
  
        <x-dashboard.container>

            <div class="row m-0">
                <div class="col-md-6 p-0 col-lg-7">
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
                </div>
                <div class="col-md-6 p-0 col-lg-5">
                    <x-dashboard.section>   
                        <x-dashboard.section.header>
                            <x-slot name="title">
                                Active Admin
                            </x-slot>
                            <x-slot name="content">
                                View Your Active Admins
                            </x-slot>
                        </x-dashboard.section.header>
    
                        <x-dashboard.section.inner>
                            <x-dashboard.table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                            </x-dashboard.table>
                        </x-dashboard.section.inner>
                    </x-dashboard.section>
                </div>
            </div>

        </x-dashboard.container>
    @endif


    {{-- vendor dashboard overview  --}}
    <x-has-role name="vendor">
        @includeIf('layouts.vendor.vendor')
    </x-has-role>

    {{-- reseller dashboard overview  --}}
    <x-has-role name="reseller">
        @includeIf('layouts.reseller.reseller')
    </x-has-role>   

    {{-- rider dashboard overview  --}}


    
</x-app-layout>
