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

    //КОЭФФИЦЕНТЫ
    public function k1($credit=false)
    {
        return $this->company_work6Month()->avg(function ($company) use($credit) {
            return $company->k1($credit);
        });

    }
    public function k2($credit=false)
    {
        return $this->company_work6Month()->avg(function ($company) use($credit) {
            return $company->k2($credit);
        });
    }
    public function k3($credit=false)
    {
        return $this->company_work6Month()->avg(function ($company) use($credit) {
            return $company->k3($credit);
        });
    }
    public function k4($credit=false)
    {
        return $this->company_work6Month()->avg(function ($company) use($credit) {
            return $company->k4($credit);
        });
    }
    public function k5($credit=false)
    {
        return $this->company_work6Month()->avg(function ($company) use($credit) {
            return $company->k5($credit);
        });
    }
    public function k5_status($credit=false)
    {
        return $this->company_work6Month()->avg(function ($company) use($credit) {
            return $company->k5_status($credit);
        });
    }

    public function class_company($credit = false)
    {
        return $this->company_work6Month()->avg(function ($company) use ($credit) {
            return $company->class_company($credit);
        });

    }


    //Вероятность получения кредита в процентах
    public function credit_ver()
    {
        $class_company=$this->class_company(true);
        $class_company--;
        $ver=$class_company/2.5*100;
        if ($this->credit_info->sum>$this->max_n12()) $ver=0;
        if ($ver<0) $ver=0;
        if ($ver>100) $ver=100;
        return $ver;
    }

    //максимальная сумма кредита по нормативу Н12
    public function max_n12()
    {
        $obj_company=new Company();
        $razdel3_id = $obj_company->findArticleIdByCode('13');
        $sub_srd=$this->company_work6Month()->sum(function ($company) use ($razdel3_id){
            $balance_date=$company->actual_balance_dates()->sortBy('date')->last();
            $razdel3 = BalanceResult::wherebalance_date_id($balance_date->id)->wherebalance_article_id($razdel3_id)->first();
            $v1300 = $balance_date->get_Razdel_Sum($razdel3)->value;
            return $v1300;
        });
        $s1410_id = $obj_company->findArticleIdByCode('1410');
        $s1510_id = $obj_company->findArticleIdByCode('1510');
        $crd_srd=$this->company_work6Month()->sum(function ($company) use ($s1410_id, $s1510_id, $obj_company){
            $balance_date=$company->actual_balance_dates()->sortBy('date')->last();
            $s1410 = $obj_company->findResultValueByDateAndArticleId($balance_date, $s1410_id);
            $s1510 = $obj_company->findResultValueByDateAndArticleId($balance_date, $s1510_id);
            return $s1410+$s1510;
        });
        $max=$sub_srd*0.2-$crd_srd;
        if ($max<0) $max=0;
        return $max;
    }
}
