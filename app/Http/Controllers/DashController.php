<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashController extends Controller
{
    public function index() {


        $categories = Categories::where('company_id', Auth::user()->company_id)->get();
        $selectedCategory = request('categoryFilter', 'all');
        $data = compact('categories', 'selectedCategory');

        return view('dash')->with($data);
    }


}
