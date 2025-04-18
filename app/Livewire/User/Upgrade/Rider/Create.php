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
        if (auth()->user()?->isRider()->status == 'Pending') {
            Session::flash('warning', 'You have a pending request to be a rider');
            $this->dispatch('alsert', 'You have an pending request to be a rider');
            $this->redirectIntended(route('upgrade.rider.index'), true);
        }
    }


    public $phone, $email, $nid, $nid_photo_front, $nid_photo_back, $fixed_address, $current_address, $area_condition, $targeted_area;

    public function store()
    {
        // max image size to 300 KB
        $validData = $this->validate([
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'nid' => 'required',
            'nid_photo_front' => 'nullable|mimes:jpg,jpeg,png| max:300',
            'nid_photo_back' => 'nullable|mimes:jpg,jpeg,png| max:300',
            'fixed_address' => 'required',
            'current_address' => 'required',
            'area_condition' => 'required',
            'targeted_area' => 'nullable',
        ]);

        // array_merge($validData)
        rider::create([
            'user_id' => Auth::id(),
            'phone' => $validData['phone'],
            'email' => $validData['email'],
            'nid' => $validData['nid'],
            'nid_photo_front' => $this->handleImageUpload($this->nid_photo_front, 'rider-document', null),
            'nid_photo_back' => $this->handleImageUpload($this->nid_photo_back, 'rider-document', null),
            'fixed_address' => $validData['fixed_address'],
            'current_address' => $validData['current_address'],
            'area_condition' => $validData['area_condition'],
            'targeted_area' => $this->targeted_area,
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
