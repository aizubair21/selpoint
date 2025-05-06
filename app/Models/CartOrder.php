<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartOrder extends Model
{
    //
    protected $fillable =
    [
        'user_id',
        'user_type',
        'belongs_to',
        'belongs_to_type',
        'order_id',
        'product_id',
        'quantity',
        'buying_price',
        'price', // normal price
        'total', // total multiple with quty
        'size',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(order::class);
    }
}
