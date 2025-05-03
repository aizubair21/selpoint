<?php 
use Livewire\Volt\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\order;

new class extends Component
{
    public $p, $tp, $ca, $tor, $por;

    public function mount()
    {
        // 
        // dd( auth()->user()->myProducts()->count());
        $this->p = auth()->user()->myProducts()?->count();
        $this->ca = auth()->user()->myCategory()?->count();
        $this->por = auth()->user()->orderToMe()?->count();
        // $this->tp = auth()->user()->myProducts()->Trashed()?->count();
    }
}


?>
<x-dashboard.overview.section>
    <x-dashboard.overview.div>
        <x-slot name="title">
            Products
        </x-slot>
        <x-slot name="content">
            @volt('product')
                <div>{{$this->p ?? "0"}}</div>
            @endvolt
        </x-slot>
    </x-dashboard.overview.div>
    
    
    {{-- <x-dashboard.overview.div>
        <x-slot name="title">
            In Active Product
        </x-slot>
        <x-slot name="content">
            <x-dashboard.overview.vendor.non-active-product-count></x-dashboard.overview.vendor.non-active-product-count>
        </x-slot>
    </x-dashboard.overview.div> --}}


    <x-dashboard.overview.div>
        <x-slot name="title">
            Total Category
        </x-slot>
        <x-slot name="content">
            @volt('product')
                <div>{{$this->ca ?? "0"}}</div>
            @endvolt
        </x-slot>
    </x-dashboard.overview.div>


    <x-dashboard.overview.div>
        <x-slot name="title">
            Pending Order
        </x-slot>
        <x-slot name="content">
            @volt('order')
                <div>
                    {{$this->por ?? "0"}}
                </div>
            @endvolt
        </x-slot>
    </x-dashboard.overview.div>


</x-dashboard.overview.section>