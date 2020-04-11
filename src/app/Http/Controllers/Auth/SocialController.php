<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\SocialIdent;
use App\User;
use Socialite;
use Auth;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToSocial($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleCallback($provider)
    {
        try {

            $user = Socialite::driver($provider)->user();

            $findSocialIdent = SocialIdent::where($provider, $user->id)->first();

            if($findSocialIdent){
                //Токен найден, авторизуем пользователя
                $finduser=$findSocialIdent->user;
                Auth::login($finduser);
                return redirect('/');
            }
            else {
                //Токен не найден, отправляем на регистрацию
                return redirect('/register')
                    ->with('social_id', $user->id.'@'.$provider)
                    ->with('name', $user->name)
                    ->with('nickname',strstr($user->email, '@', true))
                    ->with('email', $user->email);
            }



        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
