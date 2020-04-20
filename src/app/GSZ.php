<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GSZ extends Model
{
    /**
     * Get the user that owns gsz.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the company associated with the gsz.
     */
    public function company()
    {
        return $this->hasMany('App\Company');
    }
}
