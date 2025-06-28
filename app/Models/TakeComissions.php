<?php

namespace App\Models;

use App\Events\ProductComissions;
use App\Http\Controllers\UserWalletController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TakeComissions extends Model
{
    // use SoftDeletes;
    //

    protected static function booted()
    {
        // static::created(function ($takeComissions) {
        //     ProductComissions::dispatch($takeComissions->id);
        // });

        static::updated(function ($takeComissions) {
            if ($takeComissions->isDirty('confirmed') && $takeComissions->confirmed == true) {
                UserWalletController::remove($takeComissions->user_id, $takeComissions->take_comission);
                $dct = DistributeComissions::query()->where(['parent_id' => $takeComissions->id])->pending()->get();
                foreach ($dct as $dcti) {
                    $dcti->confirmed = true;
                    $dcti->save();
                }
            } elseif ($takeComissions->isDirty('confirmed') && $takeComissions->confirmed == false) {
                UserWalletController::add($takeComissions->user_id, $takeComissions->take_comission);
                $dc = DistributeComissions::query()->where(['parent_id' => $takeComissions->id])->confirmed()->get();
                foreach ($dc as $dci) {
                    $dci->confirmed = false;
                    $dci->save();
                }
            }
        });
    }
    /**
     * scope
     */
    public function scopePending($query)
    {
        return $query->where(['confirmed' => false]);
    }

    public function scopeConfirmed($query)
    {
        return $query->where(['confirmed' => true]);
    }

    /**
     * belogs to user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }




    /**
     * has multipe distrubute comissions 
     */
    public function distributes()
    {
        return $this->hasMany(DistributeComissions::class, 'parent_id', 'id');
    }
}
