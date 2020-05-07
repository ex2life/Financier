<?php

namespace App\Http\Controllers\Limit;

use App\BalanceArticle;
use App\BalanceDate;
use App\BalanceResult;
use App\Company;
use App\FinanceReportArticle;
use App\FinanceReportResult;
use App\Gsz;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
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

    //---------------------------------------------------------------------
    // Изменение данных о кредите
    //---------------------------------------------------------------------
    public function credit_info_edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'sum' => 'required|numeric|gt:0',
            'stavka' => 'required|numeric|gt:0|lte:100',
            'month' => 'required|numeric|gt:0',
    ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with("gsz_id", $id)
                ->with("modal", true)
                ->withInput()
                ->withErrors($validator->errors());
        }
        $gsz = Gsz::where('id', '=', $id)->first();
        if ($gsz->user_id !== Auth::user()->id) abort(404);
        $credit_info=$gsz->credit_info;
        $credit_info->sum=$request->sum;
        $credit_info->month=$request->month;
        $credit_info->stavka=$request->stavka;
        $credit_info->save();

        return redirect(route('credit_info'))->with('status', 'Данные изменены успешно');
    }


}
