<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <x-dashboard.page-header>
        Categories
    </x-dashboard.page-header>

    @livewire('vendor.categories.create',  key('cat_101'))

    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Categories List
                </x-slot>
                <x-slot name="content">
                    View and Edit your listed categories
                </x-slot>
            </x-dashboard.section.header>

            <x-dashboard.section.inner>
                
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </x-dashboard.container>
</div>
