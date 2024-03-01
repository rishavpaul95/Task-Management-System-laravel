<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class DashController extends Controller
{
    public function index() {
        $categories = Categories::all();
        $selectedCategory = request('categoryFilter', 'all');
        $data = compact('categories', 'selectedCategory');

        return view('dash')->with($data);
    }


}
