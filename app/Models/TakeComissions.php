<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TakeComissions extends Model
{
    use SoftDeletes;
    //

    /**
     * has multipe distrubute comissions 
     */
    public function distributes()
    {
        return $this->hasMany(DistributeComissions::class, 'parent_id', 'id');
    }
}
