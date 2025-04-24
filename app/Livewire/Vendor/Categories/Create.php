<?php

namespace App\Livewire\Vendor\Categories;

use App\HandleImageUpload;
use App\Models\category;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;

#[layout('layouts.app')]
class Create extends Component
{
    use WithFileUploads, HandleImageUpload;

    #[validate]
    public $name, $image, $account;

    // protected refresh listeners
    // protected $listeners = ['$refresh'];


    public function mount()
    {
        $this->account = auth()->user()->isVendor() ? 'vendor' : 'reseller';
        // dd($this->account);
    }

    public function getData()
    {

        if (!auth()->user()->can('category_add')) {
            $this->dispatch('warning', "You are not able to add category. ");
        }
    }



    protected function rules()
    {
        return [
            'name' => 'required|max:50',
            'image' => 'nullable|mims:jpg, png, jped|max:100',
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
                'belongs_to' => $this->account,
            ]
        );
        $this->reset();
        $this->dispatch('refresh');
        $this->dispatch('success', 'Category Created');
    }

    public function render()
    {
        return view('livewire.vendor.categories.create');
    }
}
