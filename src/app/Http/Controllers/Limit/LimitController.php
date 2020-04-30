<?php

namespace App\Http\Controllers\Limit;

use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $company=Company::where('id', '=', $id)->first();
        return view('limit.company_balance',
            ['company' => $company, 'balance_dates'=>$company->actual_balance_dates()]);
    }


}
