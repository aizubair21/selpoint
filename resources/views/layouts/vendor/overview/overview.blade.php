<?php 
use Livewire\Volt\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\order;

// new class extends Component
// {
//     public $p, $tp, $ca, $tor, $por;

//     public function mount()
//     {
//     }
// }

$ac = auth()->user()->account_type();
// dd( auth()->user()->myProducts()->count());
$p = auth()->user()->myProducts()->where(['belongs_to_type' => $ac])?->count();
$ca = auth()->user()->myCategory()->where(['belongs_to' => $ac])?->count();
$por = auth()->user()->orderToMe()->where(['belongs_to_type' => $ac, 'status' => 'Pending'])?->count();
// $tp = auth()->user()->myProducts()->Trashed()?->count();

?>
<x-dashboard.overview.section>
    <x-dashboard.overview.div>
        <x-slot name="title">
            Products
        </x-slot>
        <x-slot name="content">
            
                <div>{{$p ?? "0"}}</div>
            
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
            
                <div>{{$ca ?? "0"}}</div>
            
        </x-slot>
    </x-dashboard.overview.div>


    <x-dashboard.overview.div>
        <x-slot name="title">
            Pending Order
        </x-slot>
        <x-slot name="content">
            
                <div>
                    {{$por ?? "0"}}
                </div>
            
        </x-slot>
    </x-dashboard.overview.div>


</x-dashboard.overview.section>