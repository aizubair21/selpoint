<div x-data="{}" x-init="$wire.getData">

    <x-dashboard.page-header>
        <div class="flex justify-between">
            <div>
                comissions
            </div>

            <x-secondary-button>
                <i class="fas fa-filter" ></i>
            </x-secondary-button>
        </div>
    </x-dashboard.page-header>

    <x-dashboard.container>
        <x-dashboard.overview.section>

            <x-dashboard.overview.div>
                <x-slot name="title">
                    Pending
                </x-slot>
                <x-slot name="content">
                    {{$pc}} / {{$pcc}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Pending Give
                </x-slot>
                <x-slot name="content">
                    {{$pg}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Pending Store
                </x-slot>
                <x-slot name="content">
                    {{$ps}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Confirmed
                </x-slot>
                <x-slot name="content">
                    {{$cc}} / {{$ccc}}
                </x-slot>
            </x-dashboard.overview.div>

            {{-- <x-dashboard.overview.div>
                <x-slot name="title">
                    Generate
                </x-slot>
                <x-slot name="content">
                    {{$profit}}
                </x-slot>
            </x-dashboard.overview.div> --}}
           
            
           
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Distributed
                </x-slot>
                <x-slot name="content">
                    {{$give}}
                </x-slot>
            </x-dashboard.overview.div>
           
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Stored
                </x-slot>
                <x-slot name="content">
                    {{$store}}
                </x-slot>
            </x-dashboard.overview.div>
           
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Returned
                </x-slot>
                <x-slot name="content">
                    {{$return}}
                </x-slot>
            </x-dashboard.overview.div>
          
        </x-dashboard.overview.section>
        <x-hr/>
        
        <div class="flex justify-between items-center">
            <div>
                Today's Overview
            </div>

            <div class="flex">
                <x-text-input class="bg-transparent py-1" type="date"/>
            </div>
        </div>

        <x-dashboard.overview.section>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Generate
                </x-slot>
                <x-slot name="content">
                    {{$tgen ?? 0}}
                </x-slot>
            </x-dashboard.overview.div>
           
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Take
                </x-slot>
                <x-slot name="content">
                    {{$ttake ?? 0}}
                </x-slot>
            </x-dashboard.overview.div>
           
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Give
                </x-slot>
                <x-slot name="content">
                    {{$tgive ?? 0}}
                </x-slot>
            </x-dashboard.overview.div>
           
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Store
                </x-slot>
                <x-slot name="content">
                    {{$tstore ?? 0}}
                </x-slot>
            </x-dashboard.overview.div>
           
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Return
                </x-slot>
                <x-slot name="content">
                    {{$treturn ?? 0}}
                </x-slot>
            </x-dashboard.overview.div>
        </x-dashboard.overview.section>

        <x-dashboard.section>
            <x-dashboard.table>
                           
                @foreach ($todaysTakeComissions as $item)
                    
                    <div @class(["border-b mb-1 rounded py-1 flex justify-between items-end text-red-900"], [$item->confirmed => 'text-green-900'])>
                        <div>
                            <p class="text-xs"> {{ $item->created_at->toFormattedDateString() }} TK</p>
                            <p class="text-lg font-bold"> {{ $item->take_comission }} </p>
                        </div>
                        <div class="flex space-x-2">
                            <div> {{$item->distribute_comission}} </div> /
                            <div> {{ $item->store }} </div>
                        </div>
                        <div>
                            <x-nav-link href=""> Details </x-nav-link>
                        </div>
                    </div>
                
                @endforeach
            </x-dashboard.table>
        </x-dashboard.section> 

    </x-dashboard.container>

</div>
