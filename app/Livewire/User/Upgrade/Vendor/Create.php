<?php

namespace App\Livewire\User\Upgrade\Vendor;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Create extends Component
{

    public $shop_name_en, $shop_name_bn, $phone, $email, $country, $district, $upozila, $village, $zip, $road_no, $house_no;

    public function mount()
    {
        // 
        $vi = vendor::where(['user_id' => Auth::id()])->orderBy('id', 'desc')->first();
        if ($vi->status == 'Pending') {
            session()->flash('info', 'Unable to request again, your request is pending');
            $this->redirectIntended(route('upgrade.vendor.index'), true);
        }
    }


    public function render()
    {
        return view('livewire.user.upgrade.vendor.create')->layout('layouts.user.dash.userDash');
    }


    public function store(Request $request)
    {
        $validated = $this->validate([
            // unique, but ignore when upgate 
            'shop_name_en' => ['required', 'string', 'max:100', 'min:5', 'unique:vendors'],
            'shop_name_bn' => 'required',
            'phone' => ['required', 'max:11', 'min:10', 'unique:vendors'],
            'email' => [
                'required',
                'email',
                'unique:vendors'
            ],
            'country' => 'required',
            'district' => 'required',
            'upozila' => 'required',
            'village' => 'required',
            'zip' => ['required', 'integer'],
            'road_no' => 'required',
            'house_no' => 'required',
        ]);
        array_merge($validated, ['slug' => Str::slug($request->shop_name_en)]);
        // $request->mergeIfMissing();

        // $vendorId = vendor::create($request->except('_token'));
        $vendorId = vendor::create($validated);
        // dd();
        // return redirect()->route();
        $this->redirectIntended(route('upgrade.vendor.edit', ['id' => $vendorId->id]), true);
    }
}
