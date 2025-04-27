<?php

namespace App\Models;

use App\Livewire\System\Vendors\Vendor\Products;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // fillable data
    protected $fillable =
    [
        'name',
        'image',
        'user_id',
        'belongs_to', // reseller or vendor
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
