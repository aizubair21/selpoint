<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

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

        'area_condition', // inside dhaka or outside
        'targeted_area',

        'fixed_amount',
        'commission',
        'is_rejected',
        'rejected_for',
        'doc_1',
        'doc_2',
        'doc_3',
        'doc_4',

        'country',
        'district',
        'upozila',
        'village',

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
    // attributes //
    ///////////////
    protected function country(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Str::title($value), // uppercase the world
        );
    }

    protected function district(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Str::title($value), // uppercase the world
        );
    }

    protected function current_address(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Str::title($value), // uppercase the world
        );
    }

    protected function targeted_area(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Str::title($value), // uppercase the world
        );
    }

    protected function upozila(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Str::title($value), // uppercase the world
        );
    }

    protected function village(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Str::title($value), // uppercase the world
        );
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
