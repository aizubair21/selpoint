<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[layout('layouts.user.app')]
class SingleProductOrder extends Component
{
    #[URL]
    private $slug;

    public $product, $purchaseData;

    public function mount()
    {
        dd($this->slug);
        $this->product = Product::where(['slug' => $this->slug, 'status' => 'active', 'belongs_to_type' => 'reseller'])->first();
        // if (!$this->product) {
        //     return redirect('/');
        // }
    }


    public function render()
    {
        return view('livewire.pages.single-product-order');
    }
}
