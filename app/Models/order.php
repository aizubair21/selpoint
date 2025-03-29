<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'size',
        'name',
        'location',
        'number',
        'total',
        'status',
        'road_no',
        'house_no',
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

    // public function cartOrders()
    // {
    //     return $this->hasMany(CartOrder::class);
    // }

    // public function comissions()
    // {
    //     return $this->hasMany(ComissionTracking::class);
    // }

    // public function scopeAccepted($query)
    // {
    //     return $query->where('status', 'Confirm');
    // }
}
