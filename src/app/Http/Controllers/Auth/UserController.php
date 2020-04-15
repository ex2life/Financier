<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('auth.profile')->with([
            'user' => $user,
            'socialIdent' => $user->socialIdent
        ]);
    }

    public function update(Request $request)
    {
        if ($user = Auth::user()->email == $request->email)
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
            ]);
        else {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
        }
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }
        $user = Auth::user();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->save();
        return redirect(route("profile"))->with('status','Сохранено успешно.');
    }
}
