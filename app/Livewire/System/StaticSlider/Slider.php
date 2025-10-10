<?php

namespace App\Livewire\System\StaticSlider;

use Livewire\Component;
use App\HandleImageUpload;
use Livewire\Attributes\Layout;
use App\Models\Static_slider as sliderModel;
use App\Models\Static_slider_slides;
use Illuminate\Support\Facades\DB;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;

#[layout('layouts.app')]
class Slider extends Component
{
    use WithFileUploads, HandleImageUpload;
    #[URL]
    public $nav = 'web';
    public $slider = [];

    #[validate('required')]
    public $sliderName;
    public $sliderImage, $sliderPlacement = 'web', $status = false, $sler = '', $slides = [], $ss, $updateable = [];
    public $home, $product, $order, $about, $product_details, $categories_product, $top, $middle, $bottom;


    public function mount()
    {
        $this->getData();
    }

    #[On('refresh')]
    public function getData()
    {
        $this->slider = sliderModel::orderBy('id', 'desc')->get()->toArray();
    }

    public function createNewSlider()
    {
        $this->validate();
        try {


            DB::transaction(function () {

                sliderModel::create([
                    'name' => $this->sliderName,
                    'placement' => $this->sliderPlacement,
                    'status' => $this->status,
                    'home' => $this->home,
                    'product' => $this->product,
                    'about' => $this->about,
                    'order' => $this->order,
                    'product_details' => $this->product_details,
                    'categories_product' => $this->categories_product,
                    'placement_top' => $this->top,
                    'placement_middle' => $this->middle,
                    'placement_bottom' => $this->bottom,
                ]);
            });
            $this->getData();
            $this->dispatch('close-modal', 'open-slider-modal');
        } catch (\Throwable $th) {
            dd($th);
            $this->sler = 'Error !';
        }
    }

    public function updateStatusTrue(sliderModel $slider)
    {
        try {
            // sliderModel::query()->where(['placement' => $slider->placement])->update(['status' => false]);
            $slider->status = true;
            $slider->save();
        } catch (\Throwable $th) {
            // throw $th;
        }

        $this->dispatch('refresh');
    }
    public function updateStatusFalse(sliderModel $slider)
    {
        try {
            // sliderModel::query()->where(['placement' => $slider->placement])->update(['status' => false]);
            $slider->status = false;
            $slider->save();
        } catch (\Throwable $th) {
            throw $th;
        }
        $this->dispatch('refresh');
    }


    public function deleteSide($id)
    {
        try {
            sliderModel::destroy($id);
        } catch (\Throwable $th) {
            //throw $th;
        }

        $this->getData();
    }


    public function openUpdateModal($id)
    {
        $this->updateable = sliderModel::find($id)->toArray();
        // dd($this->updateable);
        $this->dispatch('open-modal', 'open-slides-modal');
    }


    public function updateSlider()
    {
        $sl = sliderModel::find($this->updateable['id']);

        // switch ($this->updateable['placement']) {
        //     case 'both':
        //         // sliderModel::query()->where(['status' => true])->update(['stauts' => false]);
        //         sliderModel::query()->where(['placement' => 'both'])->orWhere(['status' => true])->update(['status' => false]);
        //         break;

        //     case 'apps':
        //         sliderModel::query()->where(['placement' => 'apps'])->update(['status' => false]);
        //         sliderModel::query()->where(['placement' => 'both', 'status' => true])->update(['placement' => 'web']);
        //         break;

        //     case 'web':
        //         sliderModel::query()->where(['placement' => 'web'])->update(['status' => false]);
        //         sliderModel::query()->where(['placement' => 'both', 'status' => true])->update(['placement' => 'apps']);
        //         break;
        // };

        $sl->update([
            'name' => $this->updateable['name'],
            'placement' => $this->updateable['placement'],
            'status' => true,
        ]);

        $this->getData();
    }

    public function render()
    {
        return view('livewire.system.static-slider.slider');
    }
}
