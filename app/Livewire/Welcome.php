<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Slider_has_slide;

#[layout('layouts.user.app')]
class Welcome extends Component
{

    public $products = [];

    public function getProducts()
    {
        $this->products =  Product::where(['belongs_to_type' => 'reseller', 'status' => 'Active'])->orderBy('id', 'desc')->limit(20)->get();
    }

    public function render()
    {
        // $slider = Slider::query()->where(['status' => true])->whereNot('placement', '=', 'apps')->orderBy('id', 'desc')->get('id')->pluck('id');
        $slider = Slider::query()->where(['status' => true])->orderBy('id', 'desc')->get('id')->pluck('id');
        $slides = Slider_has_slide::query()->whereIn('slider_id', $slider)->orderBy('id', 'desc')->get('image')->pluck('image');
        // dd($slides);
        return view('livewire.welcome', compact('slides'));
    }
}
