<?php

namespace App\Http\Controllers;

use App\GSZ;
use App\SocialIdent;
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


}
