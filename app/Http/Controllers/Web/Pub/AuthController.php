<?php

namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login()
    {
        return view('Pub.account-login');
    }

    public function register()
    {
        return view('Pub.account-register');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::query()->firstOrCreate([
            'email' => $googleUser->getEmail()
        ]);

        $token = $user->createToken('PersonalAccessToken')->accessToken;


        return redirect()->route('home')->with('success', "Welcome " . $user->name)->withCookie('Token', $token, 60);
    }

}
