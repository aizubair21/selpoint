<?php

namespace App\Models;

use App\Http\Controllers\UserWalletController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TakeComissions extends Model
{
    // use SoftDeletes;
    //


    protected static function booted()
    {
        static::updated(function ($takeComissions) {
            if ($takeComissions->isDirty('confirmed') && $takeComissions->confirmed == true) {
                DistributeComissions::query()->where(['parent_id' => $takeComissions->id])->pending()->update(['confirmed' => true]);
                UserWalletController::remove($takeComissions->user_id, $takeComissions->take_comission);
            } elseif ($takeComissions->isDirty('confirmed') && $takeComissions->confirmed == false) {
                DistributeComissions::query()->where(['parent_id' => $takeComissions->id])->confirmed()->update(['confirmed' => false]);
                UserWalletController::add($takeComissions->user_id, $takeComissions->take_comission);
            }
        });
    }

    /**
     * has multipe distrubute comissions 
     */
    public function distributes()
    {
        return $this->hasMany(DistributeComissions::class, 'parent_id', 'id');
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
}
