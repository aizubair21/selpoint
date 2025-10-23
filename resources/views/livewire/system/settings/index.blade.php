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


        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    <div class="flex items-center justify-between">
                        <div>
                            QUEUE Setup
                        </div>
                    </div>
                </x-slot>

                <x-slot name="content">
                    Start your queue for your system. This will help you to manage your queue system.
                </x-slot>
            </x-dashboard.section.header>

            <x-dashboard.section.inner>
                @if ($isQueueRunning)
                <div class="text-green-500">
                    Queue is running.
                </div>
                @else
                <x-primary-button wire:click='startQueue' class="">
                    Start Queue
                </x-primary-button>
                @endif
            </x-dashboard.section.inner>
        </x-dashboard.section>


    </x-dashboard.container>
</div>