<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id', // the user, who made the order
        'user_type',
        'belongs_to', // vendor or reseller id
        'belongs_to_type', // 1: vendor, 2: reseller
        'product_id',
        'size',
        'name',
        'price',
        'quantity',
        'location',
        'number',
        'total',
        'status',
        'road_no',
        'house_no',
        'shipping',
        'buying_price'
    ];

    public function user()
    {
        // return $this->belongsTo(User::class, 'user_id');
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'name' => "user not found",
            'email' => "user not found",
            'password' => "user not found",
            'coin' => 0,
            'reference' => 0,

        ]);
    }

    public function scopeConfirm($query)
    {
        return $query->where('status', 'Confirmed');
    }

    public function product()
    {
        // return $this->belongsTo(Product::class, 'product_id');
        return $this->belongsTo(Product::class, 'product_id')->withDefault([
            'id' => 0,
            'name' => 'Product Not Found',
            'title' => 'Product Not Found',
            'slug' => 'product-not-found',
            'description' => 'Product Not Found',
            'price_in_usd' => 0,
            'price_in_bdt' => 0,
            'discount' => 0,
            'buying_price' => 0,
            'category_id' => 0,
            'image' => 'product-not-found.jpg',
            'offer_type' => 'no',
            'unit' => '0',
            'price_type' => 'bdt'
        ]);
    }

    public function cartOrders()
    {
        return $this->hasMany(CartOrder::class);
    }

    // public function comissions()
    // {
    //     return $this->hasMany(ComissionTracking::class);
    // }

    // public function scopeAccepted($query)
    // {
    //     return $query->where('status', 'Confirm');
    // }
}
