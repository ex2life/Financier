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

    public function uploadAvatar(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image=imagecreatefromstring (file_get_contents($file));
            $size = min(imagesx($image), imagesy($image));
            $image = imagecrop($image, ['x' => 0, 'y' => 0, 'width' => $size, 'height' => $size]);
            $avatar = Auth::user()->avatar;
            $avatar_path = $avatar->path;
            $name = (md5(rand(0, 99999999999) . auth()->user()->id)) . '.jpg';
            imagejpeg($image, public_path() . '/images/profile_images/'. $name);
            #$file->move(public_path() . '/images/profile_images/', $name);
            $avatar->path = '/images/profile_images/' . $name;
            $avatar->save();
            Auth::user()->avatar()->save($avatar);
            if (file_exists(public_path() . $avatar_path)) {
                if($avatar_path!=='images/default.png')
                {
                    unlink(public_path() . $avatar_path);
                }
            } else {
                // File not found.
            }
        }
        return redirect('/profile');

    }
}
