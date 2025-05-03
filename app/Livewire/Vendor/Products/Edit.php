<?php

namespace App\Livewire\Vendor\Products;

use App\HandleImageUpload;
use App\Models\product_has_attribute;
use App\Models\product_has_image;
use Illuminate\Support\Facades\Storage as FacadesStorage;
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
    public $product, $nav = 'Product';

    public $data, $categories;
    public $products, $thumb, $relatedImage = [], $newImage = [], $attr = [];

    #[On('refresh')]
    public function mount()
    {
        $ac = 'vendor';
        $roles = auth()->user()->getRoleNames();

        if (count($roles) > 2) {
            $ac = auth()->user()->active_nav;
        } else {

            $ac = auth()->user()->isVendor() ? 'vendor' : 'reseller';
        }
        // dd($this->account);

        $this->categories = auth()->user()->myCategory;

        $this->data = auth()->user()->myProducts()->withTrashed()->find(decrypt($this->product));
        // if ($this->data->trashed()) {
        //     $this->redirectIntended(route('vendor.products.view'), true);
        // }

        $this->products = $this->data->toArray();
        $this->relatedImage = $this->data->showcase->toArray();
        $this->attr = $this->data->attr->toArray();
    }

    public function save()
    {

        // dd($this->attr);
        $this->data->name = $this->products['name'];
        $this->data->title = $this->products['title'];
        $this->data->category_id = $this->products['category_id'];
        $this->data->buying_price = $this->products['buying_price'];
        $this->data->price = $this->products['price'];
        $this->data->discount = $this->products['discount'];
        $this->data->offer_type = $this->products['offer_type'];
        $this->data->description = $this->products['description'];
        $this->data->thumbnail = $this->handleImageUpload($this->thumb, 'products', $this->products['thumbnail']);
        $this->data->save();

        if ($this->attr && $this->attr['id']) {
            $this->data->attr->update(
                [
                    'name' => $this->attr['name'],
                    'value' => $this->attr['value'],
                ]
            );
        } else {
            product_has_attribute::create(
                [
                    'product_id' => decrypt($this->product),
                    'name' => $this->attr['name'],
                    'value' => $this->attr['value'],
                ]
            );
        }

        // $totalImage = array_merge($this->relatedImage, $this->newImage);
        // $this->data->showcase->delete();
        if ($this->newImage) {
            foreach ($this->newImage as $key => $image) {
                product_has_image::create([
                    'product_id' => decrypt($this->product),
                    'image' => $this->handleImageUpload($image, 'product-showcase', $this->newImage[$key]),
                ]);
            }
        }
        $this->reset('newImage');
        $this->dispatch('refresh');
        $this->dispatch('success', 'Product Updated !');
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

    public function erageOldImage($id)
    {
        $img = $this->data->showcase->find($id);
        // dd($img);
        if ($img) {
            // unlink(asset('storage/' . $img));
            // Storage::disk('public')->delete($oldImage);
            $img->delete();
            FacadesStorage::disk('public')->delete($img->image);
        }

        $this->dispatch('refresh');
        $this->dispatch('success', 'Image Deletd !');
    }


    public function render()
    {
        return view('livewire.vendor.products.edit');
    }
}
    