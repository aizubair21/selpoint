<?php

namespace App\Livewire\Vendor\Products;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\HandleImageUpload;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Illuminate\Support\Str;

#[layout('layouts.app')]
class Create extends Component
{
    use HandleImageUpload, WithFileUploads;

    #[Validate]
    public $products = [], $thumb, $categories, $attr = [];
    public $belongs_to, $shop, $ableToCreate = true;

    protected function rules()
    {
        return [
            'products.name' => 'required|min:5',
            'products.title' => 'required|min:5|max:255',
            'products.category_id' => 'required',
            'products.buying_price' => 'required',
            'products.price' => 'required',
            'thumb' => 'required'
        ];
    }


    #[On('refresh')]
    public function mount()
    {

        /**
         * if any category not fount
         * throw an warning,
         * as every product must belongs to a category
         *  
         * */
        $roles = auth()->user()->getRoleNames();
        // dd($roles);
        if (count($roles) > 2) {
            $this->belongs_to = auth()->user()->active_nav;
        } else {
            $this->belongs_to = auth()->user()->isVendor() ? 'vendor' : 'reseller';
        }
        // dd($this->account);

        if ($this->belongs_to == 'reseller') {
            $this->shop = auth()->user()->resellerShop();
        }

        if ($this->belongs_to == 'vendor') {
            $this->shop = auth()->user()->vendorShop();
        };

        // dd($this->shop);

        if (!$this->shop) {
            $this->dispatch('error', 'You must have a shop to create a product');
            return redirect()->route('vendor.shops.create');
        }

        // if max products reached
        if (auth()->user()->myProducts()->count() >= $this->shop->max_product_upload) {
            $this->dispatch('error', 'You have reached the maximum number of products allowed for your shop.');
            $this->ableToCreate = false;
        }

        $this->categories = Category::getAll();
    }



    public function create()
    {

        if (auth()->user()->myProducts()->count() >= $this->shop->max_product_upload) {
            $this->dispatch('error', 'You have reached the maximum number of products allowed for your shop.');
            $this->ableToCreate = false;
            return;
        }
        $this->validate();
        $data = array_merge(
            $this->products,
            [
                'slug' => Str::slug($this->products['title']),
                'thumbnail' => $this->handleImageUpload($this->thumb, 'products', null),
                'belongs_to_type' => $this->belongs_to,
            ]
        );
        // dd($data);
        $pd = Product::create($data);

        $this->dispatch('success', 'Product Created');
        $this->redirectIntended(route('vendor.products.edit', ['product' => encrypt($pd->id)]), true);
    }

    public function render()
    {
        return view('livewire.vendor.products.create');
    }
}
