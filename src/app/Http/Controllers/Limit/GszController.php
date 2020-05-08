<?php

namespace App\Http\Controllers\Limit;

use App\DateCalcLimit;
use App\Gsz;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GszController extends Controller
{


    //---------------------------------------------------------------------
    // Список Gsz пользователя
    //---------------------------------------------------------------------
    public function gsz_list()
    {
        return view('limit.gsz', ['gszs' => Auth::user()->gsz]);
    }

    //---------------------------------------------------------------------
    // Список Gsz пользователя
    //---------------------------------------------------------------------
    public function analise_gsz_list()
    {
        return view('analise.gsz', ['gszs' => Auth::user()->gsz,
            ]);
    }

    //---------------------------------------------------------------------
    // Список Gsz пользователя с датами расчета лимитов
    //---------------------------------------------------------------------
    public function gsz_dates()
    {
        return view('limit.gsz_dates', ['gszs' => Auth::user()->gsz]);
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
    // Данные кредитов
    //---------------------------------------------------------------------
    public function credit_limit_list()
    {
        return view('limit.gsz_credit_limit',
            ['gszs' => Auth::user()->gsz]);
    }

    //---------------------------------------------------------------------
    // Добавить новую Gsz
    //---------------------------------------------------------------------
    public function gsz_add(Request $request)
    {
        $validator = $this->validator_gsz($request, '');
        if ($validator->fails()) {
            return redirect()->back()
                ->with("newGsz", true)
                ->withInput()
                ->withErrors($validator->errors());
        }
        $gsz = new Gsz();
        $gsz->brief_name = $request->brief_name;
        $gsz->full_name = $request->full_name;
        $gsz->user()->associate(Auth::user());
        $gsz->save();
        return redirect(route('gsz_list'));
    }

    //---------------------------------------------------------------------
    // Изменить Gsz
    //---------------------------------------------------------------------
    public function gsz_edit(Request $request, $id)
    {
        $validator = $this->validator_gsz($request, 'edit_');
        if ($validator->fails()) {
            return redirect()->back()
                ->with("editGsz", true)
                ->with("gsz_id", $id)
                ->withInput()
                ->withErrors($validator->errors());
        }
        $gsz = Gsz::where('id', '=', $id)->first();
        if ($gsz->user_id !== Auth::user()->id) abort(404);
        $gsz->brief_name = $request->edit_brief_name;
        $gsz->full_name = $request->edit_full_name;
        $gsz->save();
        return redirect(route('gsz_list'))
            ->with('status', 'Изменено успешно');
    }

    //---------------------------------------------------------------------
    // Изменить дату расчета кредитного лимита Gsz
    //---------------------------------------------------------------------
    public function gsz_edit_date(Request $request, $id)
    {
        $gsz = Gsz::where('id', '=', $id)->first();
        $validator = Validator::make($request->all(), [
            'date_calc_limit' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with("modal", true)
                ->with("gsz_id", $id)
                ->withInput()
                ->withErrors($validator->errors());
        }
        if ($gsz->user_id !== Auth::user()->id) abort(404);
        $gsz->date_calc_limit->balance_dates->each(function ($balance_date, $key) {
            $balance_date->date_calc_limit()->dissociate();
            return $balance_date->save();
        });
        $gsz->date_calc_limit->delete();
        $date_calc_limit=new DateCalcLimit(['date'=>$request->date_calc_limit]);
        $date_calc_limit->gsz()->associate($gsz);
        $date_calc_limit->save();
        return redirect()->back()
            ->with('status', 'Изменено успешно');
    }

    //---------------------------------------------------------------------
    // Удалить GSZ
    //---------------------------------------------------------------------
    public function gsz_delete($id)
    {

        $gsz = Gsz::where('id', '=', $id)->first();
        if ($gsz->user_id !== Auth::user()->id) abort(404);
        $gsz->delete();
        return redirect(route('gsz_list'))
            ->with('status', 'Компания удалена успешно');
    }

    //Валидатор GSZ
    public function validator_gsz(Request $request, String $pref)
    {
        return $validator = Validator::make($request->all(), [
            $pref . 'brief_name' => 'required|string|max:30',
            $pref . 'full_name' => 'required|string|min:6|max:150',
        ]);
    }
}
