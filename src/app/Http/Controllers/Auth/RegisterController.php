<?php

namespace App\Http\Controllers\Auth;

use App\Avatar;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\SocialIdent;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nickname' => ['required', 'string', 'alpha_dash', 'max:25', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $newuser=User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'nickname' => $data['nickname'],
            'password' => Hash::make($data['password']),
        ]);
        $newuser->socialIdent()->save(new SocialIdent());
        $newuser->avatar()->save(new Avatar());
        if (!empty($data['social_id'])){
            $social = explode("@", $data['social_id']);
            $socialIdent=$newuser->socialIdent;
            if ($social[1]=='google') $socialIdent->google=$social[0];
            if ($social[1]=='twitter') $socialIdent->twitter=$social[0];
            if ($social[1]=='facebook') $socialIdent->facebook=$social[0];
            if ($social[1]=='vkontakte') $socialIdent->vkontakte=$social[0];
            $newuser->socialIdent()->save($socialIdent);
        }
        return $newuser;
    }
}
