<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;

#[layout('layouts.user.app')]
class Products extends Component
{
    use WithPagination;

    public $cart, $products = [], $offset = 10, $limit = 50, $load = false;

    protected $listeners = ['$refresh'];

    public function getData()
    {
        // dd(User::count());
        $this->products = Product::where(['belongs_to_type' => 'reseller', 'status' => 'Active'])->orderBy('id', 'desc')->limit($this->limit)->get();


        if (count($this->products) > $this->limit) {
            $this->load = true;
        } else {
            $this->load = false;
        }
    }

    public function loadMore()
    {
        $this->limit += $this->offset;
        $this->getData();
    }


    public function render()
    {
        // dd($products);
        return view('livewire.pages.products');
    }
}
