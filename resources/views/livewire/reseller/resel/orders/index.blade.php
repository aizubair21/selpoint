<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}

    <x-dashboard.page-header>
        Orders
        <br>
        
        @if (auth()->user()->active_nav == 'reseller')     
            <div>
                <x-nav-link href="{{route('vendor.orders.index')}}" :active="request()->routeIs('vendor.orders.*')" > To Me </x-nav-link>
                <x-nav-link href="{{route('reseller.resel-order.index')}}" :active="request()->routeIs('reseller.resel-order.*')" > Resel </x-nav-link>
            </div>
        @endif

    </x-dashboard.page-header>


    <x-dashboard.container>
        <x-dashboard.section>
            
            <x-dashboard.section.header>
                <x-slot name="title">
                    Your Resell Product
                </x-slot>
                
                <x-slot name="content">
                    View your resel product, income and comission here
                </x-slot>
            </x-dashboard.section.header>

            <x-dashboard.section.inner>
                <x-dashboard.foreach :data="$od" >

                    <x-dashboard.table>
                        <thead>
                            <tr>
                                <th>  </th>
                                <th> # </th>
                                <th> Pd </th>
                                <th> Profit </th>
                                <th> Com (10%) </th>
                                <th> Date </th>
                                <th> Status </th>
                                <th> A/C </th>
                            </tr>
                        </thead>
    
                        <tbody>
                            @if ($od)
                                
                                @foreach ($od as $item)
                                
                                    <tr>
                                        <td>0002</td>
                                        <td>01</td>
                                        <td>
                                            <div class="flex ">
                                                <img src="" style="height:20px; width:20px" alt="">
                                                <div class="pl-1"> Lorem Ipsum </div>
                                            </div>
                                        </td>
                                        <td> 
                                            1300 - 900 = 400    
                                        </td>
                                        <td>
                                            40
                                        </td>
                                        <td>
                                            23 May, 2001
                                        </td>
                                        <td>
                                            Pending
                                        </td>
                                        <td>
                                            <x-nav-link>view</x-nav-link>
                                            <x-nav-link>Print</x-nav-link>
                                        </td>
                                    </tr>
                                
                                @endforeach

                            @endif
                        </tbody>
                    </x-dashboard.table>
             
                </x-dashboard.foreach>
            </x-dashboard.section.inner>

        </x-dashboard.section>
    </x-dashboard.container>

</div>
