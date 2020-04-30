<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class DateCalcLimit extends Model
{
    /**
     * Get the gsz that owns date
     */
    public function gsz()
    {
        return $this->belongsTo('App\Gsz');
    }


    /**
     * Get the balance_dates associated with the date calc limit.
     */
    public function balance_dates()
    {
        return $this->hasMany('App\BalanceDate');
    }

    protected $fillable = ['date'];

    protected static function boot()
    {
        parent::boot();
        DateCalcLimit::saved(function ($model) {
            $companies=$model->gsz->company;
            foreach ($companies as $company){
                $date=Carbon::parse($model->date);
                if ($company->opf->is_corporation) {
                    //Для организации даты определения баланса: {Начало_текущего_квартала - 6 месяцев, Начало_текущего_квартала - 3 месяца, Начало_текущего_квартала }
                    $date->firstOfQuarter();
                } else {
                    //Для ИП даты определения баланса: {Дата_расчета_лимита - 6 месяцев, Дата_расчета_лимита - 3 месяцеа, Дата_расчета_лимита }
                    $date->firstOfMonth();
                };
                for ($i = 1; $i <= 3; $i++) {
                    BalanceDate::updateOrcreate(['date_balance' => $date, 'company_id' => $company->id], ['date_calc_limit_id' => $model->id]);
                    $date=$date->subMonth(3);
                }
            }

        });
    }
}
