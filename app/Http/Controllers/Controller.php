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

        $categories = Categories::all();
        $selectedCategory = request('categoryFilter', 'all');
        $data = compact('categories', 'selectedCategory');

        return view('welcome')->with($data);
    }


    use AuthorizesRequests, ValidatesRequests;
}
