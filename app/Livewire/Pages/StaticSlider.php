<?php

namespace App\Livewire\Pages;

use App\Models\Static_slider;
use Livewire\Component;
use Livewire\Attributes\Url;

class StaticSlider extends Component
{
    public $data = [], $page, $placement;
    public function mount(Static_slider $slider)
    {
        $q = $slider->query();
        switch ($this->page) {
            case 'home':
                $q->home();
                break;

            case 'about':
                $q->about();
                break;

            case 'product':
                $q->product();
                break;

            case 'product-details':
                $q->productSlider();
                break;
        }

        switch ($this->placement) {
            case 'top':
                $q->top();
                break;

            case 'middle':
                $q->middle();
                break;

            case 'bottom':
                $q->bottom();
                break;

            default:
                $q->top();
                break;
        }

        $this->data = $q->active()->orderBy('order', 'desc')->with('slides')->get();
    }

    public function render()
    {
        return view(
            'livewire.pages.static-slider',
        );
    }
}
