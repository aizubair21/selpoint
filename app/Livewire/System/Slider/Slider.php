<?php

namespace App\Livewire\System\Slider;

use App\HandleImageUpload;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Slider as sliderModel;
use App\Models\Slider_has_slide;
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
    public $sliderImage, $sliderPlacement = 'web', $status = true, $sler = '', $slides = [], $ss, $updateable = [];


    public function mount()
    {
        $this->getData();
    }

    #[On('refresh')]
    public function getData()
    {
        $this->slider = sliderModel::where(['placement' => $this->nav])->with('slides')->orderBy('id', 'desc')->get();
    }

    public function createNewSlider()
    {

        $this->validate();
        try {



            // 
            if ($this->status) {

                switch ($this->sliderPlacement) {
                    case 'both':
                        sliderModel::query()->update(['stauts' => false]);
                        break;

                    case 'apps':
                        sliderModel::query()->where(['placement' => 'apps'])->update(['status' => false]);
                        break;

                    case 'web':
                        sliderModel::query()->where(['placement' => 'web'])->update(['status' => false]);
                        break;
                }
            }
            DB::transaction(function () {

                sliderModel::create([
                    'name' => $this->sliderName,
                    'placement' => $this->sliderPlacement,
                    'image' => $this->handleImageUpload($this->sliderImage, 'slider', null),
                    'status' => $this->status,
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
        $sl->update([
            'name' => $this->updateable['name'],
            'placement' => $this->updateable['placement'],
        ]);
        $this->dispatch('refresh');
    }


    public function render()
    {

        return view('livewire.system.slider.slider');
    }
}
