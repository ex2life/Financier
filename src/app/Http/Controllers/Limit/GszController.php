<?php

namespace App\Http\Controllers\Limit;

use App\Gsz;
use App\Http\Controllers\Controller;
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
    // Удалить GSZ
    //---------------------------------------------------------------------
    public function gsz_delete($id)
    {

        $gsz = Gsz::where('id', '=', $id)->first();
        if ($gsz->user_id !== Auth::user()->id) abort(404);
        $gsz->company()->delete();
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
