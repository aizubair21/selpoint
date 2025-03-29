<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_has_refs extends Model
{
    // 
    protected $fillable =
    [
        'user_id',
        'ref',
        'status',
    ];
}
