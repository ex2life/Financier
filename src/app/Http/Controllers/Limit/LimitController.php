<?php

namespace App\Http\Controllers\Limit;

use App\BalanceDate;
use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LimitController extends Controller
{
    //---------------------------------------------------------------------
    // Страница меню
    //---------------------------------------------------------------------
    public function limit_list()
    {
        return view('limit.list');
    }

    //---------------------------------------------------------------------
    // Страница с балансом
    //---------------------------------------------------------------------
    public function company_balance($id)
    {
        $company = Company::where('id', '=', $id)->first();
        return view('limit.company_balance',
            ['company' => $company, 'balance_dates' => $company->actual_balance_dates()]);
    }

    //---------------------------------------------------------------------
    // Страница c финансовыми результатами
    //---------------------------------------------------------------------
    public function company_finance_result($id)
    {
        $company = Company::where('id', '=', $id)->first();
        if ($company->user_id !== Auth::user()->id) abort(404);
        return view('limit.company_finance_result',
            ['company' => $company, 'balance_dates' => $company->actual_balance_dates()]);
    }

    //---------------------------------------------------------------------
    // Данные кредитов
    //---------------------------------------------------------------------
    public function credit_info()
    {
        return view('limit.gsz_credit_info',
            ['gszs' => Auth::user()->gsz]);
    }

    //---------------------------------------------------------------------
    // Сохранение баланса
    //---------------------------------------------------------------------
    public function save_balance(Request $request, $id)
    {
        $balance_date = BalanceDate::where('id', '=', $id)->first();
        $results = $balance_date->balance_results;
        foreach ($request->all() as $code => $value) {
            $result = $results
                ->first(function ($result) use ($code) {
                    return
                        ($result->balance_article->code == $code);
                });
            if (isset($result)){
                $result->value=$value;
                $result->save();
            }
        }
        return redirect(route('company_balance', ['id' => $balance_date->company->id]));
    }

    //---------------------------------------------------------------------
    // Сохранение финансового результата
    //---------------------------------------------------------------------
    public function save_finance_result(Request $request, $id)
    {
        $balance_date = BalanceDate::where('id', '=', $id)->first();
        $results = $balance_date->finance_report_results;
        foreach ($request->all() as $code => $value) {
            $result = $results
                ->first(function ($result) use ($code) {
                    return
                        ($result->finance_report_article->code == $code);
                });
            if (isset($result)){
                $result->value=$value;
                $result->save();
            }
        }
        return redirect(route('company_finance_result', ['id' => $balance_date->company->id]));
    }


}
