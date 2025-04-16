<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reseller_has_document extends Model
{
    protected $guraded;



    //////////////// 
    // RELATION //
    ///////////////
    public function resellerRequest()
    {
        return $this->belongsTo(reseller::class, 'reseller_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
