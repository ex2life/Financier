<?php

namespace App\Http\Controllers\Limit;

use App\Company;
use App\Gsz;
use App\Http\Controllers\Controller;
use App\Opf;
use App\Sno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{

    //---------------------------------------------------------------------
    // Список компаний, входящих в Gsz
    //---------------------------------------------------------------------
    public function company_list($id)
    {
        $gsz = Gsz::where('id', $id)->first();
        if ($gsz->user_id !== Auth::user()->id) abort(404);
        return view('limit.company',
            ['companies' => $gsz->company,
                'gsz' => $gsz]);
    }

    //---------------------------------------------------------------------
    // Список компаний, входящих в Gsz
    //---------------------------------------------------------------------
    public function company_finance_list($id)
    {
        $gsz = Gsz::where('id', $id)->first();
        if ($gsz->user_id !== Auth::user()->id) abort(404);
        return view('limit.company_finance_list',
            ['companies' => $gsz->company_work6Month(),
                'gsz' => $gsz]);
    }


    //---------------------------------------------------------------------
    // Добавить новую компанию
    //---------------------------------------------------------------------
    public function company_add(Request $request, $id)
    {
        $validator = $this->validator_company($request, '');
        if ($validator->fails()) {
            return redirect()->back()
                ->with("newCompany", true)
                ->withInput()
                ->withErrors($validator->errors());
        }
        $gsz = Gsz::where('id', '=', $id)->first();
        if ($gsz->user_id !== Auth::user()->id) abort(404);
        $company = new Company();
        $company->name = $request->name_company;
        $company->inn = $request->inn;
        $company->date_registr = $request->date_registr;
        $company->date_begin_work = $request->date_begin_work;
        $company->gsz()->associate(Gsz::where('id', '=', $id)->first());
        $company->user()->associate(Auth::user());
        $company->opf()->associate(Opf::where('id', '=', $request->opf)->first());
        $company->sno()->associate(Sno::where('id', '=', $request->sno)->first());
        $company->save();
        if ($company->work6Month()) {
            $status = 'status';
            $status_message='Компания успешно добавлена.';
        }
        else {
            $status = 'status_info';
            $status_message='Компания успешно добавлена, но в расчете учитываться не будет, так как не работает 6 месяцев.';
        }
        return redirect(route('company_list', ['id' => $id]))
            ->with($status, $status_message);
    }

    //---------------------------------------------------------------------
    // Обновить компанию
    //---------------------------------------------------------------------
    public function company_edit(Request $request, $id)
    {
        $validator = $this->validator_company($request, 'edit_');
        if ($validator->fails()) {
            return redirect()->back()
                ->with("company_id", $id)
                ->with("editCompany", true)
                ->withInput()
                ->withErrors($validator->errors());
        }
        $company = Company::where('id', '=', $id)->first();
        if ($company->user_id !== Auth::user()->id) abort(404);
        $company->name = $request->edit_name_company;
        $company->inn = $request->edit_inn;
        $company->date_registr = $request->edit_date_registr;
        $company->date_begin_work = $request->edit_date_begin_work;
        $company->opf()->associate(Opf::where('id', '=', $request->edit_opf)->first());
        $company->sno()->associate(Sno::where('id', '=', $request->edit_sno)->first());
        $company->save();
        if ($company->work6Month()) {
            $status = 'status';
            $status_message='Компания успешно изменена.';
        }
        else {
            $status = 'status_info';
            $status_message='Компания успешно изменена, но в расчете учитываться не будет, так как не работает 6 месяцев.';
        }
        return redirect(route('company_list', ['id' => $company->gsz->id]))
            ->with($status, $status_message);
    }

    //---------------------------------------------------------------------
    // Удалить компанию
    //---------------------------------------------------------------------
    public function company_delete($id)
    {

        $company = Company::where('id', '=', $id)->first();
        if ($company->user_id !== Auth::user()->id) abort(404);
        $gsz = $company->gsz;
        $company->delete();
        return redirect(route('company_list', ['id' => $gsz->id]))
            ->with('status', 'Компания удалена успешно');
    }

    //---------------------------------------------------------------------
    // Размер столбца
    //---------------------------------------------------------------------
    private function column_size(String $table, $column)
    {
        return DB::connection()->getDoctrineColumn($table, $column)->getLength();
    }

    //Валидатор компаний
    public function validator_company(Request $request, String $pref)
    {
        return $validator = Validator::make($request->all(), [
            $pref . 'name_company' => 'required|string|max:' . $this->column_size('companies', 'name'),
            $pref . 'opf' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    if (!Opf::where('id', '=', $value)->exists()) {
                        $fail('Организационно-правовая форма должна быть выбрана из имеющихся!');
                    }
                },
            ],
            $pref . 'sno' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    if (!Sno::where('id', '=', $value)->exists()) {
                        $fail('Система налогооблажения должна быть выбрана из имеющихся!');
                    }
                },
            ],
            //переделаем на string
            $pref . 'inn' => [
                'required',
                'regex:/^[0-9]+$/',
                'required_with:opf',
                function ($attribute, $value, $fail) use ($request, $pref) {
                    $opf = Opf::where('id', '=', $request[$pref . 'opf'])->first();
                    if ($opf !== null) {
                        if (strlen(strval($value)) !== $opf->inn_length) {
                            $fail('Длина ИНН для ' . $opf->brief_name . ' должна быть ' . $opf->inn_length);
                        }
                    }
                },
            ],
            $pref . 'date_registr' => 'required|date|before_or_equal:today',
            $pref . 'date_begin_work' => 'required|string|before_or_equal:today|after_or_equal:' . $pref . 'date_registr',
        ]);
    }
}
