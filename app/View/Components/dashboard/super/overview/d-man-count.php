<?php

namespace App\View\Components\dashboard\super\overview;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class d-man-count extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.super.overview.d-man-count');
    }
}
