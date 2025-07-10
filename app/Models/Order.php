<?php

namespace App\Models;

use App\Events\ProductComissions;
use App\Http\Controllers\ProductComissionController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id', // the user, who made the order
        'user_type', // user / reseller
        'belongs_to', // vendor or reseller id
        'belongs_to_type', // 1: vendor, 2: reseller
        // 'product_id',
        // 'size',
        // 'name',
        // 'price',
        'quantity',
        'number',
        'total',
        'status',
        'area_condition',
        'district',
        'upozila',
        'location',
        'road_no',
        'house_no',
        'shipping',
        'delevery',
        // 'buying_price'
    ];


    protected static function booted(): void
    {
        parent::booted();
        // static::created(function (Order $order) {
        //     logger("Order Model Booted $order->id");
        //     ProductComissionController::dispatchProductComissionsListeners($order->id);
        // });
    }


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
        return $this->belongsTo(Product::class, 'product_id');
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


    public function comissionsInfo()
    {
        return $this->hasMany(TakeComissions::class);
    }

    public function comissionsDistributor()
    {
        return $this->hasMany(DistributeComissions::class);
    }

    public function resellerProfit()
    {
        return $this->hasMany(ResellerResellProfits::class);
    }
}
