<?php

namespace App\Livewire\Pages\Shops;

use App\Models\reseller;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Support\Str;

#[layout('layouts.user.app')]
class All extends Component
{
    use WithPagination;
    #[URL]
    public $q, $location;
    public $state = '';

    public function getShopByMyLocation()
    {
        if (auth()->user()->city) {
            $this->location = auth()->user()->city;
            $this->state = 'me';
        } else {
            $this->dispatch('warning', 'You do not have location specified.');
        }
        // dd(auth()->user()->city ?? 'Bangladesh');
    }

    public function getAllShops()
    {
        $this->state = 'all';
        $this->location = '';
    }

    public function render()
    {

        $shops = [];
        if ($this->q) {
            $shops = reseller::where('country', '=', Str::ucfirst(auth()->user()->country))->where('shop_name_en', 'like', "%" . Str::ucfirst($this->q) . "%")->paginate(config('app.paginate'));
        }

        if ($this->location) {
            $shops = reseller::where('country', '=', Str::ucfirst(auth()->user()->country))->where(function ($q) {
                $q->where('district', 'like', '%' . Str::ucfirst($this->location) . '%')
                    ->orWhere('upozila', 'like', '%' . Str::ucfirst($this->location) . '%')
                    ->orWhere('village', 'like', '%' . Str::ucfirst($this->location) . '%');
            })->paginate(config('app.paginate'));
        }
        return view('livewire.pages.shops.all', compact('shops'));
    }
}
