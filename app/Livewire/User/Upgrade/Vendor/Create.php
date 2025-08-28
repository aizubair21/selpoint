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
use Livewire\Attributes\Layout;

#[layout('layouts.user.dash.userDash')]
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
        return view('livewire.user.upgrade.vendor.create');
    }


    public function store(Request $request)
    {

        // dd($request->all());
        // $vendorId = vendor::create($request->except('_token'));

        if ($this->upgrade == 'vendor') {
            $validated = $this->validate([

                'shop_name_en' => [
                    'required',
                    'string',
                    'max:100',
                    'min:5',
                    'unique:vendors'
                ],
                'phone' => [
                    'required',
                    'max:11',
                    'min:10',
                    'unique:vendors'
                ],
                'logo' => 'required',
                'email' => [
                    'required',
                    'email',
                    'unique:vendors'
                ],
                'country' => [
                    'required',
                    'string'
                ],
                'district' => [
                    'required',
                    'string'
                ],
                'upozila' => [
                    'nullable',
                    'string'
                ],
                'village' => [
                    'required',
                    'string'
                ],
                'zip' => [
                    'required',
                    'integer'
                ],
                'road_no' => 'required',
                'house_no' => 'required',
                'address' => [
                    'required',
                ]

            ]);
            $validated['logo'] = $this->handleImageUpload($this->logo, 'shop-logo', '');
            $info = array(
                [
                    'slug' => str::slug($this->shop_name_en),
                    'banner' => $this->handleImageUpload($this->banner, 'shop-banner', ''),
                    'fixed_amount' => 500,
                ]
            );
            $vendorId = vendor::create(array_merge($validated, $info));
        }
        if ($this->upgrade == 'reseller') {
            $validated = $this->validate([
                'shop_name_en' => [
                    'required',
                    'string',
                    'max:100',
                    'min:5',
                    'unique:resellers'
                ],
                'phone' => [
                    'required',
                    'max:11',
                    'min:10',
                    'unique:resellers'
                ],
                'logo' => [
                    'required'
                ],
                'email' => [
                    'required',
                    'email',
                    'unique:resellers'
                ],
                'country' => [
                    'required',
                    'string'
                ],
                'district' => [
                    'required',
                    'string'
                ],
                'upozila' => [
                    'nullable',
                    'string'
                ],
                'village' => [
                    'required',
                    'string'
                ],
                'zip' => [
                    'required',
                    'integer'
                ],
                'road_no' => 'required',
                'house_no' => 'required',
                'address' => [
                    'required'
                ]
            ]);
            $validated['logo'] = $this->handleImageUpload($this->logo, 'shop-logo', '');
            $info = array(
                [
                    'slug' => str::slug($this->shop_name_en),
                    'banner' => $this->handleImageUpload($this->banner, 'shop-banner', ''),
                    'fixed_amount' => 500,
                ]
            );
            $vendorId = reseller::create(array_merge($validated, $info));
        }
        // dd();
        // return redirect()->route();
        $this->redirectIntended(route('upgrade.vendor.edit', ['upgrade' => $this->upgrade, 'id' => $vendorId->id, 'nav' => 'document']), true);
    }
}
