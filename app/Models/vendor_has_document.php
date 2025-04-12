<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vendor_has_document extends Model
{
    //
    // protected $table = 'vendor_has_document';
    protected $fillable = [
        'user_id',
        'venor_id',
        'deatline',
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
    ];
}
