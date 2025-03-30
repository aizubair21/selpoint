<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    //
    protected $fillable = [
        'name',
        'image',
        'status',
        'placement',
    ];



    /**
     * slideer has multiple slides
     */
    // public function slides()
    // {
    //     return $this->hasMany(slider_has_slides::class);
    // }
}
