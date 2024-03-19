<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $socialiteUser = Socialite::driver($provider)->user();

        $user = User::firstWhere('email', $socialiteUser->getEmail());

        if ($user) {
            Auth::login($user, true);
            return redirect()->to('/')->with('success', 'Welcome back!');
        }

        return redirect()->to('/')->with('error', 'User not found. Please register.');
    }
}
