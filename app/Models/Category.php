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
        'belongs_to', // parent category ID
        'description',
        'status',
    ];
    // relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function parent()
    {
        return $this->belongsTo(Category::class, 'belongs_to');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'belongs_to');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
