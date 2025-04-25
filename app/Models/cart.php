<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;
    protected $fillable = ['product_id', 'user_id', 'user_type', 'belongs_to', 'belongs_to_type'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->withDefault([

            'id' => 0,
            'name' => 'Product Not Found',
            'title' => 'Product Not Found',
            'slug' => 'product-not-found',
            'description' => 'Product Not Found',
            'price' => 0,
            'discount' => 0,
            'buying_price' => 0,
            'category_id' => 0,
            'image' => 'product-not-found.jpg',
            'offer_type' => 'no',
            'unit' => '0',

        ]);
    }
}
