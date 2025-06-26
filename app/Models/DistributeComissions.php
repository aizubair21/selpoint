<?php

namespace App\Models;

use App\Http\Controllers\UserWalletController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DistributeComissions extends Model
{
    // use SoftDeletes;
    //

    protected static function booted()
    {
        static::updated(function ($distributeComissions) {
            $takeCom = $distributeComissions->take;

            if ($takeCom->distributes->where('confirmed', true)->count() == 0) {
                $takeCom->update(['confirmed' => false]);
            }

            if ($distributeComissions->isDirty('confirmed')) {
                try {
                    //code...
                    if ($distributeComissions->confirmed == true) {
                        UserWalletController::add($distributeComissions->user_id, $distributeComissions->amount);
                    } elseif ($distributeComissions->confirmed == false) {
                        UserWalletController::remove($distributeComissions->user_id, $distributeComissions->amount);
                    }
                } catch (\Throwable $th) {
                    // $distributeComissions->confirmed = false;
                    // $distributeComissions->save();
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
        return $query->where(['confirmed' => 1]);
    }


    /**
     * relationship
     */
    public function take()
    {
        return $this->belongsTo(TakeComissions::class);
    }
}
