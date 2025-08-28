<?php

namespace App\Livewire\Reseller\Resel;

use App\Models\vendor;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Product;

#[layout('layouts.app')]
class Shops extends Component
{
    #[URL]
    public $slug, $id, $q, $location;

    public $state = '';

    public function getShopByMyLocation()
    {
        if (auth()->user()->city) {
            $this->location = auth()->user()->city;
            $this->state = 'me';
            $this->q = '';
        } else {
            $this->dispatch('warning', 'You do not have location specified.');
        }
        // dd(auth()->user()->city ?? 'Bangladesh');
    }

    public function getAllShops()
    {
        $this->state = 'all';
        $this->q = '';
        $this->location = 'Bangladesh';
    }

    public function render()
    {
        $getShops = [];
        $products = [];
        $query = vendor::where('status', '=', 'Active');

        if (Auth::check()) {
            $query->where(['country' => auth()->user()?->country]);
        }

        if ($this->q) {
            $query->whereAny(['shop_name_en', 'shop_name_bn'], 'like', "%" . Str::ucfirst($this->q ?? $this->location) . "%");
            $this->slug = '';
            $this->id = '';
        }

        if ($this->location) {
            $query->where(function ($q) {
                $q->where('district', 'like', '%' . Str::ucfirst($this->location) . '%')
                    ->orWhere('upozila', 'like', '%' . Str::ucfirst($this->location) . '%')
                    ->orWhere('village', 'like', '%' . Str::ucfirst($this->location) . '%')
                    ->orWhere('country', 'like', '%' . Str::ucfirst($this->location) . '%');
            });
            $this->slug = '';
            $this->id = '';
        }

        $shops = $query->paginate(config('app.paginate'));

        if ($this->slug) {
            $getShops = vendor::where(['slug' => $this->slug])->first();
            if ($getShops) {
                $products = product::query()->active()->vendor()->where('user_id', '=', $getShops->user?->id)->paginate(config('app.paginate'));
            }
        }
        return view('livewire.reseller.resel.shops', compact('shops', 'getShops', 'products'));
    }
}
