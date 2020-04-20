<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SNO extends Model
{
    /**
     * Get the company associated with the sno.
     */
    public function company()
    {
        return $this->hasMany('App\Company');
    }
}
