<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\SocialIdent;
use App\User;
use Socialite;
use Auth;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $findSocialIdent = SocialIdent::where('google', $user->id)->first();

            if($findSocialIdent){
                //Токен найден, авторизуем пользователя
                $finduser=$findSocialIdent->user;
                Auth::login($finduser);
                return redirect('/');
            }
            else {
                //Токен не найден, отправляем на регистрацию
                return redirect('/register')
                    ->with('social_id', $user->id.'@google')
                    ->with('name', $user->name)
                    ->with('nickname',strstr($user->email, '@', true))
                    ->with('email', $user->email);
            }



        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
