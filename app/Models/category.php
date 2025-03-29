<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    // fillable data
    protected $fillable =
    [
        'name',
        'image',
        'user_id',
        'belongs_to',
    ];
}
