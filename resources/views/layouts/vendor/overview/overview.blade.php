<x-dashboard.overview.section>
    <x-dashboard.overview.div>
        <x-slot name="title">
            Total Products
        </x-slot>
        <x-slot name="content">
            <x-dashboard.overview.vendor.product-count></x-dashboard.overview.vendor.product-count>
        </x-slot>
    </x-dashboard.overview.div>
    
    
    <x-dashboard.overview.div>
        <x-slot name="title">
            In Active Product
        </x-slot>
        <x-slot name="content">
            <x-dashboard.overview.vendor.non-active-product-count></x-dashboard.overview.vendor.non-active-product-count>
        </x-slot>
    </x-dashboard.overview.div>


    <x-dashboard.overview.div>
        <x-slot name="title">
            Total Category
        </x-slot>
        <x-slot name="content">
            <x-dashboard.overview.vendor.category-count></x-dashboard.overview.vendor.category-count>
        </x-slot>
    </x-dashboard.overview.div>


    <x-dashboard.overview.div>
        <x-slot name="title">
            Pending Order
        </x-slot>
        <x-slot name="content">
            <x-dashboard.overview.vendor.pending-order-count></x-dashboard.overview.vendor.pending-order-count>
        </x-slot>
    </x-dashboard.overview.div>


</x-dashboard.overview.section>