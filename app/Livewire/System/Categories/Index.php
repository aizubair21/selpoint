<?php

namespace App\Livewire\System\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

#[Layout('layouts.app')]
class Index extends Component
{
    // protected $listeners = ['$refresh'];

    public function render()
    {
        // Fetch categories from the database or any other source
        $categories = Category::whereNull('belongs_to')
            ->with(['children' => function ($query) {
                $query->orderBy('name');
            }, 'user'])
            ->orderBy('name')
            ->get();
        return view('livewire.system.categories.index', [
            'categories' => $categories,
        ]);
    }

    #[On('added')]
    public function added()
    {
        $this->dispatch('refresh');
        $this->dispatch('close-modal', 'category_create');
    }
}
