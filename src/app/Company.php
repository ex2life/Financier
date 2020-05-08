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
        $date_calc_limit = $this->gsz->date_calc_limit;
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


    //КОЭФФИЦЕНТЫ
    public function k1($credit = false)
    {
        $balance_dates = $this->actual_balance_dates();
        $ds_id = $this->findArticleIdByCode('1250');
        $vcb_id = $this->findArticleIdByCode('1240');
        $k1 = $balance_dates->avg(function ($balance_date) use ($ds_id, $vcb_id, $credit) {
            $ds = $this->findResultValueByDateAndArticleId($balance_date, $ds_id);
            $vcb = $this->findResultValueByDateAndArticleId($balance_date, $vcb_id);
            return ($ds + $vcb) / ($this->ko($credit, $balance_date));
        });
        return round($k1, 2, PHP_ROUND_HALF_UP);
    }

    public function k2($credit = false)
    {
        $balance_dates = $this->actual_balance_dates();
        $ds_id = $this->findArticleIdByCode('1250');
        $vcb_id = $this->findArticleIdByCode('1240');
        $po_id = $this->findArticleIdByCode('1260');
        $k1 = $balance_dates->avg(function ($balance_date) use ($ds_id, $vcb_id, $po_id, $credit) {
            $ds = $this->findResultValueByDateAndArticleId($balance_date, $ds_id);
            $vcb = $this->findResultValueByDateAndArticleId($balance_date, $vcb_id);
            $po = $this->findResultValueByDateAndArticleId($balance_date, $po_id);
            return ($ds + $vcb + $po) / ($this->ko($credit, $balance_date));
        });
        return round($k1, 2, PHP_ROUND_HALF_UP);
    }

    public function k3($credit = false)
    {
        $balance_dates = $this->actual_balance_dates();
        $razdel_id = $this->findArticleIdByCode('12');
        $k1 = $balance_dates->avg(function ($balance_date) use ($razdel_id, $credit) {
            $razdel = BalanceResult::wherebalance_date_id($balance_date->id)->wherebalance_article_id($razdel_id)->first();
            $sum1200 = $balance_date->get_Razdel_Sum($razdel)->value;
            return ($sum1200) / ($this->ko($credit, $balance_date));
        });
        return round($k1, 2, PHP_ROUND_HALF_UP);
    }

    public function k4($credit = false)
    {
        $balance_dates = $this->actual_balance_dates();
        $razdel3_id = $this->findArticleIdByCode('13');
        $razdel4_id = $this->findArticleIdByCode('14');
        $razdel5_id = $this->findArticleIdByCode('15');
        $k1 = $balance_dates->avg(function ($balance_date) use ($razdel3_id, $razdel4_id, $razdel5_id, $credit) {
            $razdel3 = BalanceResult::wherebalance_date_id($balance_date->id)->wherebalance_article_id($razdel3_id)->first();
            $razdel4 = BalanceResult::wherebalance_date_id($balance_date->id)->wherebalance_article_id($razdel4_id)->first();
            $razdel5 = BalanceResult::wherebalance_date_id($balance_date->id)->wherebalance_article_id($razdel5_id)->first();
            $v1300 = $balance_date->get_Razdel_Sum($razdel3)->value;
            $v1400 = $balance_date->get_Razdel_Sum($razdel4)->value;
            $v1500 = $balance_date->get_Razdel_Sum($razdel5)->value;
            if ($credit) {
                $gsz = $this->gsz;
                $v1300 = $v1300 + $gsz->credit_info->sum / count($gsz->company_work6Month());
            }
            if ($v1300 == 0) $v1300++;
            return ($v1400 + $v1500) / $v1300;
        });
        return round($k1, 2, PHP_ROUND_HALF_UP);
    }

    public function k5($credit = false)
    {
        $balance_dates = $this->actual_balance_dates();
        $pp_id = FinanceReportArticle::wherecode('2200')->first()->id;
        $vp_id = FinanceReportArticle::wherecode('2110')->first()->id;
        $k5 = $balance_dates->avg(function ($balance_date) use ($pp_id, $vp_id) {
            $pp = FinanceReportResult::wherebalance_date_id($balance_date->id)->wherefinance_report_article_id($pp_id)->first()->value;
            $vp = FinanceReportResult::wherebalance_date_id($balance_date->id)->wherefinance_report_article_id($vp_id)->first()->value;

            if ($vp == 0) $vp++;
            return $pp / $vp;
        });
        return round($k5, 2, PHP_ROUND_HALF_UP);
    }

    public function k5_status()
    {
        $balance_dates = $this->actual_balance_dates();
        $pp_id = FinanceReportArticle::wherecode('2200')->first()->id;
        $vp_id = FinanceReportArticle::wherecode('2110')->first()->id;
        $k1 = $balance_dates->sortBy('date')->reduce(function ($carry, $balance_date) use ($pp_id, $vp_id) {
            $pp = FinanceReportResult::wherebalance_date_id($balance_date->id)->wherefinance_report_article_id($pp_id)->first()->value;
            $vp = FinanceReportResult::wherebalance_date_id($balance_date->id)->wherefinance_report_article_id($vp_id)->first()->value;

            if ($vp == 0) $vp++;
            $k5 = $pp / $vp;
            if ($k5 > $carry['k']) $carry['status'] = true;
            else $carry['status'] = false;
            $carry['k'] = $k5;
            return $carry;
        }, [
            'status' => false,
            'k' => -999999999,
        ]);
        return $k1['status'];
    }

    public function class_company($credit = false)
    {
        $balance_dates = $this->actual_balance_dates();
        $s1200_id = $this->findArticleIdByCode('12');
        $s1300_id = $this->findArticleIdByCode('13');
        $s1400_id = $this->findArticleIdByCode('14');
        $s1500_id = $this->findArticleIdByCode('15');
        $ss2110_id = FinanceReportArticle::wherecode('2110')->first()->id;
        $ss2300_id = FinanceReportArticle::wherecode('2300')->first()->id;
        $ss2400_id = FinanceReportArticle::wherecode('2400')->first()->id;
        $x1 = $balance_dates->avg(function ($balance_date) use ($s1200_id,$s1500_id, $credit) {
            $v1200 = BalanceResult::wherebalance_date_id($balance_date->id)->wherebalance_article_id($s1200_id)->first();
            $v1500 = BalanceResult::wherebalance_date_id($balance_date->id)->wherebalance_article_id($s1500_id)->first();
            $v1200 = $balance_date->get_Razdel_Sum($v1200)->value;
            $v1500 = $balance_date->get_Razdel_Sum($v1500)->value;
            $v1600 = $balance_date->get_Balance_Active_Sum()->value;
            if ($v1600==0) $v1600++;
            if ($credit) {
                $gsz = $this->gsz;
                $v1500 = $v1500 + $gsz->credit_info->sum / count($gsz->company_work6Month());
            }
            return ($v1200 - $v1500) / ($v1600);
        });
        $x2 = $balance_dates->avg(function ($balance_date) use ($ss2400_id, $credit) {
            $ss2400 = FinanceReportResult::wherebalance_date_id($balance_date->id)->wherefinance_report_article_id($ss2400_id)->first()->value;
            $v1600 = $balance_date->get_Balance_Active_Sum()->value;
            if ($v1600==0) $v1600++;
            return $ss2400 / $v1600;
        });
        $x3 = $balance_dates->avg(function ($balance_date) use ($ss2300_id, $credit) {
            $ss2300 = FinanceReportResult::wherebalance_date_id($balance_date->id)->wherefinance_report_article_id($ss2300_id)->first()->value;
            $v1600 = $balance_date->get_Balance_Active_Sum()->value;
            if ($v1600==0) $v1600++;
            return $ss2300 / $v1600;
        });
        $x4 = $balance_dates->avg(function ($balance_date) use ($s1300_id,$s1400_id,$s1500_id, $credit) {
            $v1300 = BalanceResult::wherebalance_date_id($balance_date->id)->wherebalance_article_id($s1300_id)->first();
            $v1400 = BalanceResult::wherebalance_date_id($balance_date->id)->wherebalance_article_id($s1400_id)->first();
            $v1500 = BalanceResult::wherebalance_date_id($balance_date->id)->wherebalance_article_id($s1500_id)->first();
            $v1300 = $balance_date->get_Razdel_Sum($v1300)->value;
            $v1400 = $balance_date->get_Razdel_Sum($v1400)->value;
            $v1500 = $balance_date->get_Razdel_Sum($v1500)->value;
            if ($credit) {
                $gsz = $this->gsz;
                $v1500 = $v1500 + $gsz->credit_info->sum / count($gsz->company_work6Month());
            }
            if ($v1400+$v1500==0) $v1500++;
            return ($v1300) / ($v1400+$v1500);
        });
        $x5 = $balance_dates->avg(function ($balance_date) use ($ss2110_id, $credit) {
            $ss2110 = FinanceReportResult::wherebalance_date_id($balance_date->id)->wherefinance_report_article_id($ss2110_id)->first()->value;
            $v1600 = $balance_date->get_Balance_Active_Sum()->value;
            if ($v1600==0) $v1600++;
            return $ss2110 / $v1600;
        });
        $class = $x1*0.717+$x2*0.847+$x3*3.107+$x4*0.420+$x5*0.998;
        return round($class, 2, PHP_ROUND_HALF_UP);
    }

    public function findArticleIdByCode($code)
    {
        return BalanceArticle::wherecode($code)->first()->id;
    }

    public function findResultValueByDateAndArticleId($balance_date, $balance_article_id)
    {
        return BalanceResult::wherebalance_date_id($balance_date->id)->wherebalance_article_id($balance_article_id)->first()->value;
    }

    public function ko($credit, $balance_date)
    {
        $ko1_id = $this->findArticleIdByCode('1510');
        $ko2_id = $this->findArticleIdByCode('1520');
        $ko5_id = $this->findArticleIdByCode('1550');
        $ko1 = $this->findResultValueByDateAndArticleId($balance_date, $ko1_id);
        $ko2 = $this->findResultValueByDateAndArticleId($balance_date, $ko2_id);
        $ko5 = $this->findResultValueByDateAndArticleId($balance_date, $ko5_id);
        $ko = $ko1 + $ko2 + $ko5;
        if ($credit) {
            $gsz = $this->gsz;
            $ko = $ko + ($gsz->credit_info->sum*($gsz->credit_info->stavka/100+1)) / count($gsz->company_work6Month());
        }
        if ($ko == 0) $ko++;
        return $ko;
    }
}
