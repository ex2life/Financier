<?php

namespace App\Http\Controllers;

use App\GSZ;
use App\OPF;
use App\SNO;
use App\SocialIdent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    // Список GSZ пользователя
    //---------------------------------------------------------------------
    public function gsz_list()
    {
        return view('limit.gsz', ['gszs' => Auth::user()->gsz]);
    }

    //---------------------------------------------------------------------
    // Добавить новую GSZ
    //---------------------------------------------------------------------
    public function gsz_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brief_name' => 'required|string|max:30',
            'full_name' => 'required|string|min:6|max:150',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with("modal", true)
                ->withInput()
                ->withErrors($validator->errors());
        }
        $gsz = new GSZ();
        $gsz->brief_name = $request->brief_name;
        $gsz->full_name = $request->full_name;
        Auth::user()->gsz()->save($gsz);
        return redirect(route('gsz_list'));
    }

    //---------------------------------------------------------------------
    // Список групп, входящих в GSZ
    //---------------------------------------------------------------------
    public function company_list($id)
    {
        $gsz = GSZ::where('id', $id)->first();
        if ($gsz->user_id !== Auth::user()->id) abort(404);
        return view('limit.company',
            ['companies' => $gsz->company,
                'gsz' => $gsz]);
    }

    //---------------------------------------------------------------------
    // Добавить новую компанию
    //---------------------------------------------------------------------
    public function company_add(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name_company' => 'required|string|max:' . $this->column_size('companies', 'name'),
            'opf' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    if (!OPF::where('id', '=', $value)->exists()) {
                        $fail('Организационно-правовая форма должна быть выбрана из имеющихся!');
                    }
                },
            ],
            'sno' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    if (!SNO::where('id', '=', $value)->exists()) {
                        $fail('Система налогооблажения должна быть выбрана из имеющихся!');
                    }
                },
            ],
            'inn' => [
                'required',
                'integer',
                'required_with:opf',
                function ($attribute, $value, $fail) use ($request){
                    $opf = OPF::where('id', '=', $request->opf )->first();
                    if ($opf !== null) {
                        if (strlen(strval($value)) !== $opf->inn_length) {
                            $fail('Длина ИНН для ' . $opf->brief_name . ' должна быть ' . $opf->inn_length);
                        }
                    }
                },
            ],
            'date_registr' => 'required|date|before_or_equal:today',
            'date_begin_work' => 'required|string|before_or_equal:today|after_or_equal:date_registr',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with("modal", true)
                ->withInput()
                ->withErrors($validator->errors());
        }
        return redirect(route('company_list', ['id' => $id]));
    }

    //---------------------------------------------------------------------
    // Размер столбца
    //---------------------------------------------------------------------
    private function column_size(String $table, $column)
    {
        return DB::connection()->getDoctrineColumn($table, $column)->getLength();
    }

}
