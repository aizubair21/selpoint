<div>
    {{-- The Master doesn't talk, he acts. --}}
    <x-dashboard.page-header>
        Settings
    </x-dashboard.page-header>

    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    <div class="flex items-center justify-between">
                        <div>
                            Page Setup
                        </div>
                    </div>
                </x-slot>

                <x-slot name="content">
                    Setup your necessary pages from here. add, edit and delete.
                </x-slot>
            </x-dashboard.section.header>

            <x-dashboard.section.inner>
                <x-nav-link-btn href="{{route('system.pages.index')}}" class=""> 
                    Go To Page Setup
                </x-nav-link-btn>
            </x-dashboard.section.inner>
        </x-dashboard.section>


    </x-dashboard.container>
</div>
