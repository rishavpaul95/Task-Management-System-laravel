<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public function index()
    {
        return view('blog');
    }

    public function show($slug)
    {
        $path = resource_path("posts/{$slug}.html");

        if (!File::exists($path)) {
            return redirect("/blog");
        }

        $post = file_get_contents($path);

        return view('post', ['post' => $post]);
    }

}
