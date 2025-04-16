<div>
    {{-- Do your work, then step back. --}}
    <x-dashboard.page-header>
        Resellers
    </x-dashboard.page-header>



    <x-dashboard.container>

        <x-dashboard.section>
            <x-dashboard.overview.section>
                <x-dashboard.overview.div>
                    <x-slot name="title">
                        Resellers
                    </x-slot>
                    <x-slot name="content">
                        29
                    </x-slot>
                </x-dashboard.overview.div>
            </x-dashboard.overview.section>

        </x-dashboard.section>
       
       
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name='title'>
                    <div class="flex justify-between items-start">
                        <div>
                            <x-nav-link href="?filter=*" class="px-2 mb-2" :active="$filter == '*' " >All</x-nav-link>
                            <x-nav-link href="?filter=Active" class="px-2 mb-2" :active="$filter == 'Active' " >Active</x-nav-link>
                            <x-nav-link href="?filter=Pending" class="px-2 mb-2" :active="$filter == 'Pending' " >Pending</x-nav-link>
                            <x-nav-link href="?filter=Disabled" class="px-2 mb-2" :active="$filter == 'Disabled' " >Disabled</x-nav-link>
                            <x-nav-link href="?filter=Suspended" class="px-2 mb-2" :active="$filter == 'Suspended' " >Suspended</x-nav-link>
                        </div>
        
                        <div>
                            <x-text-input wire:model.live="find" wire:keydown.enter="search" type="search" placeholder="Search Vendor" class="my-1 py-1" />
                            <x-primary-button type="button" x-on:click.prevent="$dispatch('open-modal', 'vendor-filter-modal')">Filter</x-primary-button>
                        </div>
                                    
                    </div>
        
                </x-slot>
                <x-slot name='content'>
                    
                </x-slot>
            </x-dashboard.section.header>
            <x-dashboard.section.inner>
                <x-dashboard.table>

                </x-dashboard.table>
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </x-dashboard.container>
</div>
