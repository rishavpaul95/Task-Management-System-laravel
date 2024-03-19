<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Categories;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public function index()
    {

        if (Auth::check()) {
            $categories = Categories::where('company_id', Auth::user()->company_id)->get();
            $selectedCategory = request('categoryFilter', 'all');
            $data = compact('categories', 'selectedCategory');
            return view('blog')->with($data);
        } else {
            return view('blog');
        }
    }

    public function show($slug)
    {
        $path = resource_path("posts/{$slug}.html");

        if (!File::exists($path)) {
            return redirect("/blog");
        }

        $categories = Categories::all();
        $selectedCategory = request('categoryFilter', 'all');

        $post = file_get_contents($path);
        $data = compact('categories', 'selectedCategory', 'post');
        return view('post')->with($data);
    }
}
