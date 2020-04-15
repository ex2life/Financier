<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect(route("profile"))->with('status', 'Сохранено успешно.');
    }

    public function changePassword(Request $request)
    {

        if (!(Hash::check($request->current_password, Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()
                ->with("topass", "true")
                ->with("status_error", "Ваш введенный текущий пароль не совпадает с сохраненным. Пожалуйста, попробуйте снова.");
        }

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with("topass", "true")
                ->withErrors($validator->errors());
        }

        //Change Password
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()
            ->with("topass", "true")
            ->with("status", "Пароль сменен успешно!");

    }
}
