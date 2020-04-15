<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    /**
     * Get the user that owns Social Ident.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
