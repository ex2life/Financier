<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditInfo extends Model
{
    /**
     * Get the gsz that owns date
     */
    public function gsz()
    {
        return $this->belongsTo('App\Gsz');
    }
    public function with_stavka()
    {
        return $this->sum*($this->stavka/100+1);
    }


}
