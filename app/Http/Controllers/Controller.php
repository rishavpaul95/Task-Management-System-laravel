<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    public function index(){
        return view('home');
    }
    public function logout() {
        Auth::logout();
        return redirect( '/home' );
    }

    use AuthorizesRequests, ValidatesRequests;
}
