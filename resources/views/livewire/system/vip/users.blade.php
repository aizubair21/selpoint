<div>
    {{-- Success is as dangerous as failure. --}}
    <x-dashboard.page-header>
        VIP
        <br>
        <div>
            <x-nav-link :href="route('system.vip.index')" :active="request()->routeIs('system.vip.index')"> Package </x-nav-link>
            <x-nav-link :href="route('system.vip.users')" :active="request()->routeis('system.vip.users')"> User </x-nav-link>
        </div>
    </x-dashboard.page-header>

    <x-dashboard.container>

        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    VIP Users
                </x-slot>
                <x-slot name="content">
                    let your vip user manage
                </x-slot>
            </x-dashboard.section.header>
    
            <x-dashboard.section.inner>
                <x-dashboard.table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>VIP</th>
                            <th>Ref</th>
                            <th>Wallet</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
    
                    <tbody>
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </x-dashboard.table>
            </x-dashboard.section.inner>
        </x-dashboard.section>

    </x-dashboard.container>
</div>
