<?php

namespace App\Livewire\Vendor\Categories;

use App\HandleImageUpload;
use App\Models\category;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

#[layout('layouts.app')]
class Create extends Component
{
    use WithFileUploads, HandleImageUpload;

    #[validate]
    public $name, $image;

    public function mount()
    {
        if (!auth()->user()->can('category_add')) {
            $this->dispatch('warning', "You are not able to add category. ");
        }
    }


    protected function rules()
    {
        return [
            'name' => 'required|max:5',
        ];
    }
    public function save()
    {
        if (!auth()->user()->can('category_add')) {
            $this->dispatch('warning', "You are not able to add category. ");
        }
        $this->validate();
        category::create(
            [
                'name' => $this->name,
                'image' => $this->handleImageUpload($this->image, 'categories', null),
                'user_id' => Auth::id(),
                'belongs_to_type' => 'vendor',
            ]
        );

        $this->reset();
        $this->dispatch('success', 'Category Created');
    }

    public function render()
    {
        return view('livewire.vendor.categories.create');
    }
}
