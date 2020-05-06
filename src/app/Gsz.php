<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Gsz extends Model
{
    /**
     * Get the user that owns gsz.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the avatar associated with the user.
     */
    public function credit_info()
    {
        return $this->hasOne('App\CreditInfo');
    }

    /**
     * Get the company associated with the gsz.
     */
    public function company()
    {
        return $this->hasMany('App\Company');
    }

    /**
     * Get the company associated with the gsz.
     */
    public function company_work6Month()
    {
        return $this->company->filter(function ($item) {
            return $item->work6Month();
        });
    }

    /**
     * Get the date calc limit associated with the user.
     */
    public function date_calc_limit()
    {
        return $this->hasOne('App\DateCalcLimit');
    }

    /**
     * Дата начала деятельности ГСЗ, минимальная из компаний
     */
    public function date_begin_work()
    {   return $this->company->reduce(function ($A, $B) {
            return $A < $B->date_begin_work ? $A : $B->date_begin_work;
        },Carbon::tomorrow());
    }

    protected static function boot()
    {
        parent::boot();
        Gsz::saved(function ($model) {
            $date_calc_limit=new DateCalcLimit(['date'=>Carbon::now()]);
            $date_calc_limit->gsz()->associate($model);
            $date_calc_limit->save();
            $credit_info=new CreditInfo();
            $credit_info->gsz()->associate($model);
            $credit_info->save();
        });
    }
}
