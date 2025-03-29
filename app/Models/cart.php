<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['product_id', 'user_id'];

    public function product()
    {
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
}
