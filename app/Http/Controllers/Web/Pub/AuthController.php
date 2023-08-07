<?php

namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Throwable;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('Pub.account-login');
    }

    public function register(): View
    {
        return view('Pub.account-register');
    }

    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback(): \Illuminate\Http\RedirectResponse | string
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::query()->firstOrCreate([
                'email' => $googleUser->getEmail()
            ]);

            $token = $user->createToken('PersonalAccessToken')->accessToken;

            return redirect()->route('home')
                ->with('success', "Welcome " . $googleUser->getName())
                ->withCookie('Token', $token, 60)
                ->withCookie('User', $googleUser->getEmail());

        } catch (Throwable $throwable) {
            return $throwable->getMessage();
        }
    }

}
