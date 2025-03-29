<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\category;

class Product extends Model
{
    protected $fillable = [
        'name',
        'title',
        'slug',
        'description',
        'price',
        'discount',
        'buying_price',
        'category_id',
        'user_id',
        'image',
        'offer_type',
        'unit',
        'price_type',
        'status',
        'display_at_home'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault([
            'id' => 0,
            'name' => "Category Not Found!",
        ]);
    }

    // public function comissions()
    // {
    //     return $this->hasMany(ComissionTracking::class);
    // }
    // public function attr()
    // {
    //     return $this->hasOne(product_has_attribute::class);
    // }
    // public function showcase()
    // {
    //     return $this->hasMany(product_has_images::class);
    // }

    /**
     * Product has many order
     */
    // public function orders()
    // {
    //     return $this->hasMany(Order::class);
    // }
}
