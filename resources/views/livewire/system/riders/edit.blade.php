<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <x-dashboard.page-header>
        Rider Upate - Delevary Man
    </x-dashboard.page-header>

    <x-dashboard.container>
        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    {{$rider->user?->name ?? "N/A" }}
                </x-slot>
                <x-slot name='content'>
                    <x-nav-link >User</x-nav-link>
                    <x-nav-link >Documents</x-nav-link>
                    <x-nav-link >Delevary</x-nav-link>
                </x-slot>
            </x-dashboard.section.header>
        </x-dashboard.section>
    </x-dashboard.container>
</div>
