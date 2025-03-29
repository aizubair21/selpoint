<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class VipPackage extends Model
{

    //
    protected $fillable = [
        'name',
        'slug',
        'price',
        'coin',
        'm_coin',
        'countdown', //how many times user may stay to complate task
        'status', //draft, active, comming_soon
        'description',
        'ref_owner_get_coin', // if user use referred code, and purchase a vip package, how many coin earn by referred owner
        'owner_get_coin', // if user purchase a vip package, how many coin earn by owner
    ];


    /**
     * valid scope
     */
    // public function scopeValid($query)
    // {
    //     //check is it created 360 days before from now
    //     return $query->where('created_at', '<', now()->subDays(360));
    // }


    /**
     * invliad scope
     */
    // public function scopeInvalid($query)
    // {
    //     //check is it created 360 days before from now
    //     return $query->where('created_at', '>', now()->subDays(360));
    // }

    public function user()
    {
        return $this->belongsToMany(User::class, 'vips', 'package_id', 'user_id');
    }

    // public function owner()
    // {
    //     return $this->belongsTo(vip::class, 'package_id', 'id');
    // }

    //package has a payment option
    // public function payOption()
    // {
    //     return $this->hasMany(package_pay::class, 'package_id', 'id');
    // }
}
