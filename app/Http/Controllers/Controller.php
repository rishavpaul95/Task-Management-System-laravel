<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    public function index(){

        if (Auth::check()) {
            $categories = Categories::where('company_id', Auth::user()->company_id)->get();
            $selectedCategory = request('categoryFilter', 'all');
            $data = compact('categories', 'selectedCategory');
            return view('welcome')->with($data);
        }
        else{
            return view('welcome');
        }
    }


    use AuthorizesRequests, ValidatesRequests;
}
