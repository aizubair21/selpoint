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
        'slug',
        'description',
        'logo',
        'banner',

        // business address and contact
        'phone',
        'email',
        'country',
        'district',
        'upozila',
        'village',
        'zip',
        'road_no',
        'house_no',

        // business type 
        // 'business_type', // Corporation, LLC, Sole Provider, Partnership, Other

        // has many reference
        'ref_to_company',
        'ref_name',
        'ref_contact',



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
    // MODEL BOOT //
    ///////////////
    protected static function boot()
    {
        parent::boot();
        // static::observe(ShopObserver::class);

        /**
         * if model inserte
         */
        static::saving(function ($model) {
            $model->status = 'Pending';
        });

        /**
         * if model saving and have status = 1
         */
        static::updating(function ($model) {
            if ($model->isDirty('status') && $model->status == 'Active') {
                $model->is_rejected = 0;
                $model->rejected_for = null;

                /**
                 * null deatline at vendor_has_document
                 */
                $model->documents()->update(['deadline' => null]);
            }

            /**
             * if rejected
             */
            if ($model->isDirty('is_rejected')) {
                $model->is_rejected = 1;
                $model->status = "Pending";
                // $model->rejected_for = $request;
            }
        });
    }


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
    // RELATION //
    ///////////////


    /**
     * model belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * model has document
     * vendor_has_document table
     */
    public function documents()
    {
        return $this->hasOne(vendor_has_document::class);
    }
}
