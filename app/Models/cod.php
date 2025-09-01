<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class cod extends Model
{
    use SoftDeletes; // Use SoftDeletes trait for soft deletion functionality
    
    protected $guarded = []; // Allow mass assignment for all attributes


    // relationships, accessors, or other model methods can be added here as needed
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rider()
    {
        return $this->belongsTo(Rider::class);
    }
}
