<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        return $this->belongsTo('App\Gsz');
    }

    /**
     * Get the opf this company.
     */
    public function opf()
    {
        return $this->belongsTo('App\Opf');
    }

    /**
     * Get the sno this company.
     */
    public function sno()
    {
        return $this->belongsTo('App\Sno');
    }

    /**
     * Get the balance_dates associated with the company.
     */
    public function balance_dates()
    {
        return $this->hasMany('App\BalanceDate');
    }

    /**
     * Даты баланса актуальные в данный момент
     */
    public function actual_balance_dates()
    {
        $date_calc_limit=$this->gsz->date_calc_limit;
        return $this->balance_dates->filter(function ($balance_date) use ($date_calc_limit) {
            return $balance_date->date_calc_limit == $date_calc_limit;
        });
    }

    public function monthWork()
    {
        $date1 = Carbon::parse($this->date_begin_work);
        $date2 = Carbon::now();
        return $date1->diffInMonths($date2);
    }

    public function work6Month()
    {
        return ($this->monthWork() >= 6);
    }


    protected static function boot()
    {
        parent::boot();
        Company::created(function ($model) {
            $date_calc_limit = $model->gsz->date_calc_limit;
            $date = Carbon::parse($date_calc_limit->date);
            if ($model->opf->is_corporation) {
                //Для организации даты определения баланса: {Начало_текущего_квартала - 6 месяцев, Начало_текущего_квартала - 3 месяца, Начало_текущего_квартала }
                $date->firstOfQuarter();
            } else {
                //Для ИП даты определения баланса: {Дата_расчета_лимита - 6 месяцев, Дата_расчета_лимита - 3 месяцеа, Дата_расчета_лимита }
                $date->firstOfMonth();
            };
            for ($i = 1; $i <= 3; $i++) {
                BalanceDate::updateOrcreate(['date_balance' => $date, 'company_id' => $model->id], ['date_calc_limit_id' => $date_calc_limit->id]);
                $date = $date->subMonth(3);
            }
        });
    }
}
