<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashController extends Controller
{
    public function index()
    {


        $categories = Categories::where('company_id', Auth::user()->company_id)->get();
        $selectedCategory = request('categoryFilter', 'all');

        $users = User::where('company_id', Auth::user()->company_id)->count();
        $tasks = Tasks::where('company_id', Auth::user()->company_id)->count();
        $mytasks = Tasks::where('company_id', Auth::user()->company_id)
            ->where('user_id', Auth::user()->id)->count();

        $pendingtasks = Tasks::where('company_id', Auth::user()->company_id)
            ->where('user_id', Auth::user()->id)
            ->whereIn('status', ['Active', 'Pending'])->count();


        $data = compact('categories', 'selectedCategory', 'users', 'tasks', 'mytasks', 'pendingtasks');

        return view('dash')->with($data);
    }
}
