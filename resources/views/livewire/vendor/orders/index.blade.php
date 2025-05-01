<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <x-dashboard.page-header>
        Orders
        <br>
        <div>
            <x-nav-link href="?nav=Pending" :active="$nav == 'Pending'">Pending</x-nav-link>
            <x-nav-link href="?nav=Cancelled" :active="$nav == 'Cancelled'">Cancelled</x-nav-link>
            <x-nav-link href="?nav=Accepted" :active="$nav == 'Accepted'">Accepted</x-nav-link>
        </div>
    </x-dashboard.page-header>


    <x-dashboard.container>
        <x-dashboard.overview.section>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Orders
                </x-slot>
                <x-slot name="content">
                    {{auth()->user()->orderToMe()->count() ?? "0"}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Pending
                </x-slot>
                <x-slot name="content">
                    {{auth()->user()->orderToMe()->where(['status' => 'Pending'])->count() ?? "0"}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Cancel
                </x-slot>
                <x-slot name="content">
                    {{auth()->user()->orderToMe()->where(['status' => 'Cancel'])->count() ?? "0"}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
                <x-slot name="title">
                    Accepted
                </x-slot>
                <x-slot name="content">
                    {{auth()->user()->orderToMe()->where(['status' => 'Accepted'])->count() ?? "0"}}
                </x-slot>
            </x-dashboard.overview.div>
            <x-dashboard.overview.div>
               
            </x-dashboard.overview.div>
        </x-dashboard.overview.section>


        <x-dashboard.section>
            <x-dashboard.section.header>
                <x-slot name="title">
                    Your Order
                </x-slot>
                <x-slot name="content">
                    Your order taken from the {{auth()->user()->isVendor() ? "Resellers" : "Users"}}
                </x-slot>
            </x-dashboard.section.header>

            <x-dashboard.section.inner>

                <x-dashboard.foreach :data="$order">
                    <x-dashboard.table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>A/C</th>
                            </tr>
                        </thead>
                    </x-dashboard.table>
                </x-dashboard.foreach>
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </x-dashboard.container>
</div>
