<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        $selectedCategory = request('categoryFilter', 'all');
        $users = User::all();
        $data = compact('categories', 'selectedCategory','users');
        return view('users')->with($data);
    }


}
