<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use SoftDeletes;
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
        'belongs_to_type', // vendor or reseller
        'thumbnail',
        'offer_type',
        'unit',
        'status', // 
        'display_at_home'
    ];


    public function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime'
        ];
    }


    /**
     * give user default 'user' role 
     * when model is created
     */
    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (Product $product) {
            $product->user_id = Auth::id();
            $product->status = 'Active';
        });

        static::created(function (Product $product) {
            product_has_attribute::create(
                [
                    'product_id' => $product->id,
                ]
            );
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault([
            'id' => 0,
            'name' => "Category Not Found!",
        ]);
    }

    //////////////// 
    // SCOPE //
    ///////////////
    public function scopeActive($query)
    {
        return $query->where(['status' => 'Active']);
    }

    public function scopeDraft($query)
    {
        return $query->where(['status' => 'Draft']);
    }

    public function scopeReseller($query)
    {
        return $query->where(['belongs_to_type' => 'reseller']);
    }
    // public function scopeDisabled($query)
    // {
    //     return $query->where(['status' => 'Disabled']);
    // }

    // public function comissions()
    // {
    //     return $this->hasMany(ComissionTracking::class);
    // }
    public function attr()
    {
        return $this->hasOne(product_has_attribute::class);
    }
    public function showcase()
    {
        return $this->hasMany(product_has_image::class);
    }

    /**
     * Product has many order
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
