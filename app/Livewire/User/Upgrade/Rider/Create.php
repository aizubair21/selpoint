<?php

namespace App\Livewire\User\Upgrade\Rider;

use App\Models\rider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\HandleImageUpload;

#[layout('layouts.user.dash.userDash')]
class Create extends Component
{
    use WithFileUploads, HandleImageUpload;

    public function mount()
    {
        if (auth()->user()?->requestsToBeRider()?->pending()->exists() || auth()->user()?->requestsToBeRider()?->active()->exists()) {
            Session::flash('warning', 'You have another unprocessable request !');
            $this->dispatch('alert', 'You have another unprocessable request !');
            $this->redirectIntended(route('upgrade.rider.index'), true);
        }
    }


    public $phone, $otherPhone, $email, $nid, $nid_photo_front, $nid_photo_back, $fixed_address, $current_address, $area_condition, $targeted_area;

    public function store()
    {

        // validate the image file type
        // dd($this->nid_photo_front);
        // max image size to 300 KB
        $validData = $this->validate([
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'nid' => 'required',
            'nid_photo_front' => 'nullable|mimes:jpg,jpeg,png| max:1024',
            'nid_photo_back' => 'nullable|mimes:jpg,jpeg,png| max:1024',
            'fixed_address' => 'required',
            'current_address' => 'required',
            'area_condition' => 'required',
            'targeted_area' => 'required',
        ]);

        // array_merge($validData)
        rider::create([
            'user_id' => Auth::id(),
            'phone' => $validData['phone'],
            'email' => $validData['email'],
            'nid' => $validData['nid'],
            'nid_photo_front' => $this->handleImageUpload($this->nid_photo_front, 'rider', null),
            'nid_photo_back' => $this->handleImageUpload($this->nid_photo_back, 'rider', null),
            'fixed_address' => $validData['fixed_address'],
            'current_address' => $validData['current_address'],
            'area_condition' => $validData['area_condition'],
            'targeted_area' => $this->targeted_area,
            'doc_1' => $this->otherPhone,

            'country' => auth()->user()->country ?? 'Bangladesh',
            'district' => auth()->user()?->city ?? 'Dhaka',
        ]);
        // rider::created($validData);
        $this->redirectIntended(route('upgrade.rider.index'), true);
    }

    private function processImageStore($image, $targetStoreName)
    {
        //
        $targetPath = 'rider-document';
        if ($image) {
            $ext = $image->getClientOriginalExtension();
            $name = "$targetStoreName" . time() . ".$ext";
            // $filePath = $image->move(public_path($targetStorePath), $name);
            $image->storeAs($targetPath, $name, 'public');

            return $name;
        }
    }

    public function update()
    {
        //     
    }



    public function render()
    {
        return view('livewire..user.upgrade.rider.create');
    }
}
