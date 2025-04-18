<?php

namespace App\Livewire\User\Upgrade\Rider;

use App\Models\rider;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[layout('layouts.user.dash.userDash')]
class Create extends Component
{

    public $phone, $email, $nid, $nid_photo_front, $nid_photo_back, $fixed_address, $current_address, $area_condition, $targeted_area;

    public function store()
    {
        // max image size to 300 KB
        $validData = $this->validate([
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'nid' => 'required',
            'nid_photo_front' => 'required|mimes:jpg,jpeg,png| size:300KB',
            'nid_photo_back' => 'required|mimes:jpg,jpeg,png| size:300KB',
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
            'nid_photo_front' => $this->processImageStore($this->nid_photo_front, 'rider-nid-front-'),
            'nid_photo_back' => $this->processImageStore($this->nid_photo_back, 'rider-nid-back-'),
            'fixed_address' => $validData['fixed_address'],
            'current_address' => $validData['current_address'],
            'area_condition' => $validData['area_condition'],
            'targeted_area' => $validData['targeted_area'],
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


    public function render()
    {
        return view('livewire..user.upgrade.rider.create');
    }
}
