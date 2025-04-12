<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vendor extends Model
{
    //
    protected $fillable = [
        'user_id',
        'shop_name_bn',
        'shop_name_en',
        'description',
        'logo',
        'banner',

        // business address and contact
        'phone',
        'country',
        'district/state',
        'upozila/city',
        'village',
        'zip',
        'road_no',
        'house_ho',

        // business type 
        'business_type', // Corporation, LLC, Sole Provider, Partnership, Other

        // verification 
        'nid',
        'nid_front',
        'nid_back',

        'shop_trade',
        'shop_trade_image',
        'shop_tin',
        'shop_tin_image',
        'shop_bin',
        'shop_bin_image',

        // payments 
        'bank_name',
        'holder_name',
        'ac',
        'swift_code',

        // certificate
        'iso',
        'minority',
        'women',
        'other',


        // has many reference
        'ref_to_company',
        'ref_name',
        'ref_contact',

        // security
        'nomini',
        'nomini_relation',
        'nomini_nid',
        'nomini_phone',

        // authorization 
        'is_rejected',
        'rejected_for',
        'system_get_comission',
        'information_update_date',
        'status',
    ];

    /**
     * cast information_update_date to datetime
     */
    protected $casts = [
        'information_update_date' => 'datetime',
    ];


    //////////////// 
    // SCOPE //
    ///////////////
    public function scomeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopePending($query)
    {
        return $query->where('status', 0);
    }
    public function scopeSuspend($query)
    {
        return $query->where('status', 2);
    }




    //////////////// 
    // relation //
    ///////////////


    /**
     * model belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
