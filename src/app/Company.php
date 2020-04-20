<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * Get the user that owns company.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the gsz that owns company.
     */
    public function gsz()
    {
        return $this->belongsTo('App\GSZ');
    }

    /**
     * Get the opf this company.
     */
    public function opf()
    {
        return $this->belongsTo('App\OPF');
    }

    /**
     * Get the sno this company.
     */
    public function sno()
    {
        return $this->belongsTo('App\SNO');
    }
}
