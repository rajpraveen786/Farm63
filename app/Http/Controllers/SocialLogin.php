<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;

class SocialLogin extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    /**
     * Obtain the user information from Social Logged in.
     * @param $social
     * @return Response
     */
    public function Callback($provider)
    {
        $userSocial =   Socialite::driver($provider)->user();
        $users= User::where(['email' => $userSocial->user['email']])->first();
        if (!Auth::check() && $users) {
            Auth::loginUsingId($users->id);
            return redirect('/profile');
        }
        return redirect('/register');
    }
}
