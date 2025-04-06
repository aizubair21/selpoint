<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vendor extends Model
{
    //
    protected $fillable = [
        'user_id',
        'shop_name',
        'district',
        'address',
        'nid',
        'nid_front',
        'nid_back',
        'shop_address',
        'shop_phone',
        'shop_email',
        'shop_license',
        'shop_license_front',
        'shop_license_back',
        'shop_license_tin',
        'shop_license_tin_front',
        'shop_license_tin_back',

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

    /**
     * model belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
