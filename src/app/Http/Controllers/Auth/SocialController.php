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
     *
     */
    public function redirectToSocial($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Удаление данных авторизации
     */
    public function DelSocial($provider)
    {
        if(\Auth::check()) {
            $user_auth = Auth::user();
            $socialIdent=$user_auth->socialIdent;
            if ($provider=='google') $socialIdent->google=Null;
            if ($provider=='twitter') $socialIdent->twitter=Null;
            if ($provider=='facebook') $socialIdent->facebook=Null;
            if ($provider=='vkontakte') $socialIdent->vkontakte=Null;
            $user_auth->socialIdent()->save($socialIdent);
            return redirect(route("profile"))->with('status','Удалено успешно.');
        }
    }

    /**
     * Обработка Callback
     */
    public function handleCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
            $findSocialIdent = SocialIdent::where($provider, $user->id)->first();
            if(\Auth::check()) {
                if ($findSocialIdent){
                    return redirect(route("profile"))->with('status_error','Вход через эту социальную сеть добавлен в другом аккаунте.');
                }
                $user_auth = Auth::user();
                $socialIdent=$user_auth->socialIdent;
                if ($provider=='google') $socialIdent->google=$user->id;
                if ($provider=='twitter') $socialIdent->twitter=$user->id;
                if ($provider=='facebook') $socialIdent->facebook=$user->id;
                if ($provider=='vkontakte') $socialIdent->vkontakte=$user->id;
                $user_auth->socialIdent()->save($socialIdent);
                return redirect(route("profile"))->with('status','Добавлено успешно.');
            }


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
