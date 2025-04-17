<?php

namespace App\Livewire\User\Upgrade\Vendor;

use App\Models\reseller;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Url;

class Create extends Component
{
    #[URL]
    public $upgrade = 'vendor';

    public $shop_name_en, $shop_name_bn, $phone, $email, $country, $district, $upozila, $village, $zip, $road_no, $house_no;

    public function mount()
    {
        // 
        if ($this->upgrade == 'vendor') {
            $vi = vendor::where(['user_id' => Auth::id()])->orderBy('id', 'desc')->first();
        } else {
            $vi = reseller::where(['user_id' => Auth::id()])->orderBy('id', 'desc')->first();
        }

        if ($vi && $vi->status == 'Pending') {
            session()->flash('info', 'Unable to request again, your request is pending');
            $this->redirectIntended(route('upgrade.vendor.index', ['upgrade' => $this->upgrade]), true);
        }
        if ($vi && $vi->status == 'Active') {
            session()->flash('info', 'Unable to request again, you have an active Membership');
            $this->redirectIntended(route('upgrade.vendor.index', ['upgrade' => $this->upgrade]), true);
        }
    }


    public function render()
    {
        return view('livewire.user.upgrade.vendor.create')->layout('layouts.user.dash.userDash');
    }


    public function store(Request $request)
    {


        // $vendorId = vendor::create($request->except('_token'));


        if ($this->upgrade == 'vendor') {
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
            $vendorId = vendor::create($validated);
        }
        if ($this->upgrade == 'reseller') {
            $validated = $this->validate([
                // unique, but ignore when upgate 
                'shop_name_en' => ['required', 'string', 'max:100', 'min:5', 'unique:resellers'],
                'shop_name_bn' => 'required',
                'phone' => ['required', 'max:11', 'min:10', 'unique:resellers'],
                'email' => [
                    'required',
                    'email',
                    'unique:resellers'
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
            $vendorId = reseller::create($validated);
        }
        // dd();
        // return redirect()->route();
        $this->redirectIntended(route('upgrade.vendor.edit', ['upgrade' => $this->upgrade, 'id' => $vendorId->id, 'nav' => 'document']), true);
    }
}
