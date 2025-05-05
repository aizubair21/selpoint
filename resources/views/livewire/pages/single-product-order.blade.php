<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <x-dashboard.container>
        <x-dashboard.section>
            @includeIf('components.client.product-single')
        </x-dashboard.section>
        <x-hr/>

        <x-dashboard.section> 
            <x-dashboard.section.header>
                <x-slot name="title">
                    Order Now
                </x-slot>
                <x-slot name="content">
                    <strong>
                        {{ $total ?? '0'}} TK 
                    </strong>
                </x-slot>
            </x-dashboard.section.header>
            <x-hr/>
            <x-dashboard.section.inner>
                @includeIf('components.client.order-details')
            </x-dashboard.section.inner>
        </x-dashboard.section>
    </x-dashboard.container>
</div>
