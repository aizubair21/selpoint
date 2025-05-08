<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reseller_resel_product extends Model
{
    protected $fillable =
    [
        'user_id',
        'belongs_to',
        'product_id',
    ];
}
