<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_tasks extends Model
{
    // fillable data

    protected $fillable =
    [
        'user_id',
        'earn_by',
        'task_type',
        'coin',
        'time',
        'package_id',
        'vip_id',
    ];
}
