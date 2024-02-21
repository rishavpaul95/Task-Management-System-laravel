<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function show($name = null)
    {
        $demo = '<button type="button" class="btn btn-success">Success</button> ';
        $data = compact('name', 'demo');
        return view('demo')->with($data);
    }
}
