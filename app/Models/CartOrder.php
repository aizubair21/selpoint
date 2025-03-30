<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartOrder extends Model
{
    //
    protected $fillable =
    [
        'user_id',
        'order_id',
        'product_id',
        'total',
        'size',
        'buying_price',
    ];
}
