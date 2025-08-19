<?php

namespace App\Livewire\User\Upgrade\Vendor;

use App\HandleImageUpload;
use App\Models\reseller;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Url;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads, HandleImageUpload;

    #[URL]
    public $upgrade = 'vendor';

    public $shop_name_en, $shop_name_bn, $phone, $email, $country, $district, $upozila, $village, $zip, $road_no, $house_no, $address, $logo, $banner, $description;

    public function mount()
    {
        // 
        if ($this->upgrade == 'vendor') {
            $vi = vendor::where(['user_id' => Auth::id()])->orderBy('id', 'desc')->first();
        } else {
            $vi = reseller::where(['user_id' => Auth::id()])->orderBy('id', 'desc')->first();
        }

        $this->phone = Auth::user()->phone;
        $this->email = Auth::user()->email;

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
                'logo' => 'required',
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
            $request->mergeIfMissing(
                [
                    'slug' => str::slug($this->shop_name_en),
                    'logo' => $this->handleImageUpload($this->logo, 'vendor', ''),
                    'banner' => $this->handleImageUpload($this->banner, 'vendor', ''),
                ]
            );
            $vendorId = vendor::create($request->all());
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
            $request->mergeIfMissing(
                [
                    'slug' => str::slug($this->shop_name_en),
                    'logo' => $this->handleImageUpload($this->logo, 'vendor', ''),
                    'banner' => $this->handleImageUpload($this->banner, 'vendor', ''),
                ]
            );
            $vendorId = reseller::create($request->all());
        }
        // dd();
        // return redirect()->route();
        $this->redirectIntended(route('upgrade.vendor.edit', ['upgrade' => $this->upgrade, 'id' => $vendorId->id, 'nav' => 'document']), true);
    }
}
