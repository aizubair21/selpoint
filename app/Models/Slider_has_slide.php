<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider_has_slide extends Model
{
    protected $table = 'slider_has_slides';
    protected $fillable = [
        'slider_id',
        'main_title',
        'subtitle',
        'description',
        'image',
        'status',
        'action_type',
        'action_url',
        'action_target',
    ];
}
