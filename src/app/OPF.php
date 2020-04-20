<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OPF extends Model
{
    /**
     * Get the company associated with the opf.
     */
    public function company()
    {
        return $this->hasMany('App\Company');
    }
}
