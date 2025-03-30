<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    //
    protected $fillable = [
        'id',
        'user_id', // id of user
        'phone', // phone number
        'pay_by', // bank name, or wallet name, or mobile banking
        'pay_to', // deails of payment method
        'amount', // amount in taka
        'is_rejected', // 
        'reject_for', // 
        'seen_by_admin', // 0 = not seen, 1 = seen
        'status', // 0 pending, 1 confirmed, 2 rejected

    ];


    /**
     * scope to bind is rejected field
     */
    public function scopeNotRejected($query)
    {
        return $query->whereNull('is_rejected');
    }

    /**
     * scope to bind is rejected field
     */
    public function scopeRejected($query)
    {
        return $query->wherNotNull('is_rejected');
    }

    /**
     * scope to bind is rejected field
     */
    public function scopeAccepted($query)
    {
        return $query->whereNull('is_rejected')->where('status', 1);
    }

    /**
     * scope to bind is rejected field
     */
    public function scopePending($query)
    {
        return $query->whereNull('is_rejected')->where('status', 0);
    }


    /**
     * scope to bind is rejected field
     */
    // public function scopeAuth($query)
    // {
    //     return $query->where('user_id', auth()->user()->id());
    // }


    /**
     * method define relation to user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 
     */
    // public function transactions()
    // {
    //     return $this->belongsTo(withdraw_transactions::class, 'id', 'withdraw_id');
    // }
}
