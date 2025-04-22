<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class rider extends Model
{
    // guraded all fillable data
    protected $fillable = [
        'user_id',
        'phone',
        'email',

        'nid',
        'nid_photo_front',
        'nid_photo_back',

        'fixed_address',

        'current_address',

        'area_condition', // inside dhaka or outlide
        'targeted_area',

        'status',
    ];

    // hidden 
    protected $hidden = [
        'id',
        'user_id',
        'created_at',
        'updated_at',
    ];

    //////////////// 
    // boot //
    ///////////////
    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (rider $data) {
            $data->status = 'Pending';
        });
    }


    //////////////// 
    // SCOPE //
    ///////////////
    public function scopeActive($query)
    {
        return $query->where(['status' => 'Active']);
    }

    public function scopePending($query)
    {
        return $query->where(['status' => 'Pending']);
    }
    public function scopeSuspended($query)
    {
        return $query->where(['status' => 'Suspended']);
    }
    public function scopeDisabled($query)
    {
        return $query->where(['status' => 'Disabled']);
    }

    //////////////// 
    // relation //
    ///////////////
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
