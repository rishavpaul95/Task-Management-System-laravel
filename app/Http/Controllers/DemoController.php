<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemoController extends Controller {
    public function show( $name = null ) {
        $demo = '<button type="button" class="btn btn-success">Success</button> ';
        $data = compact( 'name', 'demo' );
        return view( 'demo' )->with( $data );
    }

    public function logout() {
        Auth::logout();
        return redirect( '/home' );
    }
}
