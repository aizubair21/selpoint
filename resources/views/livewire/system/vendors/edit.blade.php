<div>
    <x-dashboard.page-header>
        @include('auth.system.vendors.navigations')
    </x-dashboard.page-header>

    @php
        $user = $vendor->user;
    @endphp
    @includeIf('auth.system.users.edit');
    {{-- @livewire('component', ['user' => $user], key($user->id)) --}}
</div>
