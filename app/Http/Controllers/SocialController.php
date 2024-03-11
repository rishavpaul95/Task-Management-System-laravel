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
        $user = Socialite::driver($provider)->user();



        $user = User::firstOrCreate([
            'email' => $user->getEmail()
        ], [
            'name' => $user->getName(),
            'password' => bcrypt('password')
        ]);


        Auth::login($user, true);

        return redirect()->to('/');
    }
}
