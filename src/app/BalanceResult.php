<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BalanceResult extends Model
{
    /**
     * Get the date balance that owns result.
     */
    public function balance_date()
    {
        return $this->belongsTo('App\BalanceDate');
    }

    /**
     * Get the article the result.
     */
    public function balance_article()
    {
        return $this->belongsTo('App\BalanceArticle');
    }

}
