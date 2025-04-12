<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path',
        'profile_photo_url',
        'coin',
        'reference',
        'reference_accepted_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    /**
     * give user default 'user' role 
     * when model is created
     */
    protected static function boot(): void
    {
        parent::boot();
        static::created(function (User $user) {
            $user->syncRoles(['user']);
        });
    }


    /**
     * Determined the user hold the specific permissions
     */
    public function ableTo($permission)
    {
        return $this->permisions()->contains($permission);
    }

    protected function permisions()
    {
        return $this->getPermissionNames();
    }

    //////////////// 
    // Relations //
    ///////////////

    public function requestsToBeVendor()
    {
        return $this->hasMany(vendor::class);
    }

    public function isVendor()
    {
        return $this->hasOne(vendor::class)->latest();
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function category()
    {
        return $this->hasMany(category::class);
    }

    public function myOrder()
    {
        return $this->hasMany(Order::class);
    }
}
