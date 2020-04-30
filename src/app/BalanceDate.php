<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BalanceDate extends Model
{
    /**
     * Get the gsz that owns company.
     */
    public function date_calc_limit()
    {
        return $this->belongsTo('App\DateCalcLimit');
    }

    /**
     * Get the result associated with the balance
     */
    public function balance_results()
    {
        return $this->hasMany('App\BalanceResult');
    }

    protected static function boot()
    {
        parent::boot();
        BalanceDate::created(function ($model) {
            BalanceArticle::all()->each(function ($article, $key) use ($model) {
                $result = new BalanceResult();
                $result->balance_date()->associate($model);
                $result->balance_article()->associate($article);
                $result->save();
            });
        });
    }

    protected $fillable = ['date_balance', 'company_id', 'date_calc_limit_id'];


    //Отрисовки балансов

    //Основные секции балансов
    public function get_Corporation_Balance_Part($balance_part)
    {
        return $this->balance_results
            ->filter(function ($balance_result) use ($balance_part) {
                return ($balance_result->balance_article->is_section == True) and ($balance_result->balance_article->balance_part == $balance_part);
            })
            ->sortBy(function ($section) {
                return $section->balance_article->code;
            }, SORT_STRING);
    }


    //Дочерние блоки основных секций балансов
    public function get_Child_Corporation_Balance_Section($parent_result)
    {
        return $this->balance_results
            ->filter(function ($balance_result) use ($parent_result) {
                return
                    ($balance_result->balance_article->is_section == False) and
                    ($balance_result->balance_article->is_sum_section == False) and
                    ($balance_result->balance_article->section_code == $parent_result->balance_article->code);
            })
            ->sortBy(function ($childs) {
                return $childs->balance_article->code;
            }, SORT_STRING);
    }

    //Сумма составной статьи
    public function get_sum_parent($parent_result)
    {
        return $this->balance_results
            ->filter(function ($balance_result) use ($parent_result) {
                return
                    ($balance_result->balance_article->parent_code == $parent_result->balance_article->code);
            })
            ->sum('value');
    }


    public function get_Corporation_Balance_Active()
    {
        return $this->get_Corporation_Balance_Part(True);
    }

    public function get_Corporation_Balance_Passiv()
    {
        return $this->get_Corporation_Balance_Part(False);

    }


    public function Balance_Part_Sum($balance_part)
    {
        $balance_sum = $this->balance_results
            ->first(function ($balance_result) use ($balance_part) {
                return
                    ($balance_result->balance_article->is_sum_part == True) and
                    ($balance_result->balance_article->balance_part == $balance_part);
            });
        $balance_sum->value = $this->balance_results
            ->filter(function ($balance_result) use ($balance_part) {
                return
                    ($balance_result->balance_article->is_section == False) and
                    ($balance_result->balance_article->is_sum_section == False) and
                    ($balance_result->balance_article->is_sum_part == False) and
                    ($balance_result->balance_article->has_children == False) and
                    ($balance_result->balance_article->balance_part == $balance_part);
            })
            ->sum('value');
        return $balance_sum;
    }

    public function get_Balance_Active_Sum()
    {
        return $this->Balance_Part_Sum(True);
    }

    public function get_Balance_Passiv_Sum()
    {
        return $this->Balance_Part_Sum(False);

    }

    public function get_Razdel_Sum($razdel)
    {
        $razdel_sum = $this->balance_results
            ->first(function ($balance_result) use ($razdel) {
                return
                    ($balance_result->balance_article->is_sum_section == True) and
                    ($balance_result->balance_article->section_code == $razdel->balance_article->code);
            });
        $razdel_sum->value= $this->balance_results
            ->filter(function ($balance_result) use ($razdel) {
                return
                    ($balance_result->balance_article->has_children == False) and
                    ($balance_result->balance_article->is_section == False) and
                    ($balance_result->balance_article->is_sum_section == False) and
                    ($balance_result->balance_article->is_sum_part == False) and
                    ($balance_result->balance_article->section_code == $razdel->balance_article->code);
            })
            ->sum('value');
        return $razdel_sum;
    }
}
