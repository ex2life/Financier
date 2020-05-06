<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinanceReportResult extends Model
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
    public function finance_report_article()
    {
        return $this->belongsTo('App\FinanceReportArticle');
    }
}
