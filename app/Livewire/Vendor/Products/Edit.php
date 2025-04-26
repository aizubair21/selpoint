<?php

namespace App\Livewire\Vendor\Products;

use App\HandleImageUpload;
use App\Models\product_has_image;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[layout('layouts.app')]
class Edit extends Component
{

    use WithFileUploads, HandleImageUpload;

    #[URL]
    public $product;

    public $data;
    public $products, $thumb, $relatedImage = [], $newImage = [];

    #[On('refresh')]
    public function mount()
    {
        $this->data = auth()->user()->myProducts()->withTrashed()->find(decrypt($this->product));
        // if ($this->data->trashed()) {
        //     $this->redirectIntended(route('vendor.products.view'), true);
        // }

        $this->products = $this->data->toArray();
        $this->relatedImage = $this->data->showcase->toArray();
    }

    public function save()
    {
        // dd($this->data);


        $totalImage = array_merge($this->relatedImage, $this->newImage);
        // $this->data->showcase->delete();
        foreach ($totalImage as $key => $image) {
            product_has_image::create([
                'product_id' => decrypt($this->product),
                'image' => $this->handleImageUpload($image, 'product-showcase', $totalImage[$key]),
            ]);
        }
        $this->reset('newImage');
        $this->dispatch('refresh');
        // dd($totalImage);
    }

    public function restoreFromTrash()
    {
        $this->data->restore();
        $this->dispatch('success', "Restore From Trash");
        $this->dispatch('refresh');
    }

    public function moveToTrash()
    {
        $this->data->delete();
        $this->dispatch('success', "Restore From Trash");
        $this->dispatch('refresh');
    }

    public function erageOldImage()
    {
        dd('asdf');
        product_has_image::destroy($id);
        $this->dispatch('refresh');
        $this->dispatch('success', 'Image Deletd !');
    }


    public function render()
    {
        return view('livewire.vendor.products.edit');
    }
}
