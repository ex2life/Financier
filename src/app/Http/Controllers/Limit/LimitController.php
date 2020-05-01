<?php

namespace App\Http\Controllers\Limit;

use App\BalanceDate;
use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
    // Страница меню
    //---------------------------------------------------------------------
    public function company_balance($id)
    {
        $company = Company::where('id', '=', $id)->first();
        return view('limit.company_balance',
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


}
