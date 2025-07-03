<?php

namespace App\Livewire\Reseller\Resel\Products;

use App\Http\Controllers\ResellerController;
use App\Models\Product;
use App\Models\Reseller_resel_product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[layout('layouts.app')]
class View extends Component
{
    #[URL]
    public $pd;
    public $products, $confirmResel = false, $confirmOrder, $forResel = [], $reselPrice, $resellerCat;

    public function mount()
    {
        $this->products = Product::where(['belongs_to_type' => 'vendor', 'id' => $this->pd, 'status' => 'Active'])->first();
        $this->forResel = $this->products->only('name', 'title', 'slug', 'description', 'thunbnail', 'price', 'meta_title', 'meta_description', 'meta_tags', 'keyword', 'meta_thunbnail');
        $this->reselPrice = $this->forResel['price'];
        if (!$this->products) {
            return redirect()->back();
        }
    }

    public function confirmClone()
    {
        // clone product basic info

        $isAlreadycloned = Reseller_resel_product::where(['parent_id' => $this->products->id, 'user_id' => auth()->user()->id])->exists();
        if (!$isAlreadycloned) {
            # code...
            if (!empty($this->resellerCat || !empty($this->reselPrice))) {
                // $rc = new ResellerController();
                // $rc->cloneProducts($this->products->id, $this->reselPrice, $this->resellerCat);

                $this->forResel['user_id'] = auth()->user()->id;
                $this->forResel['belongs_to_type'] = 'reseller';
                $this->forResel['buying_price'] = $this->products->price;
                $this->forResel['unit'] = 0;
                $this->forResel['price'] = $this->reselPrice;
                $this->forResel['category_id'] = $this->resellerCat;
                $this->forResel['status'] = 'Active';

                // save as new to reseller
                $newProduct = Product::create($this->forResel);

                // create link to track reseller, vendor and product
                $rrp = new Reseller_resel_product();
                $rrp->forceFill(
                    [
                        'user_id' => Auth::id(),
                        'belongs_to' => $this->products->user_id,
                        'product_id' => $newProduct->id,
                        'parent_id' => $this->products->id
                    ]
                );
                $rrp->save();


                // Reseller_resel_product::forcefill()


                $this->redirectIntended('reseller.products.edit', true);
            } else {
                $this->dispatch('error', 'Price and Category must be defined !');
            }
        } else {
            $this->dispatch('error', 'Already Cloned !');
        }
    }


    public function render()
    {
        return view('livewire.reseller.resel.products.view');
    }
}
