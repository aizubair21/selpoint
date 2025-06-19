<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_has_refs extends Model
{
    // 
    protected $fillable =
    [
        'user_id',
        'ref',
        'status',
    ];

    protected $hidden =
    [
        'id',
        'user_id',
        'status',
        'created_at',
        'updated_at',
    ];

    /**
     * @return owner_of_ref
     */
    public function owner()
    {
        // return $this->belongsTo(User::class, 'user_id', 'id');
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault([
            'name' => "user not found",
            'email' => "user not found",
            'password' => "user not found",
            'coin' => 0,
            'reference' => null,

        ]);
    }

    /**
     * @return User
     * user that use this refer code
     */
    public function myReffUser()
    {
        return $this->hasMany(User::class, 'reff', 'reference');
    }
}
