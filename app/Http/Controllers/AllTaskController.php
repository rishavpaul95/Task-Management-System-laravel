<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Http\Request;

class AllTaskController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        $users = User::all();

        $selectedCategory = request('categoryFilter', 'all');
        $currentUser = auth()->user();

        $tasksQuery = Tasks::query();

        if ($selectedCategory !== 'all') {
            $tasksQuery->where('category_id', $selectedCategory);
        }

        // Get the tasks based on the query
        $tasks = $tasksQuery->get();

        $data = compact('tasks', 'currentUser','categories', 'selectedCategory', 'users');

        return view('alltask')->with($data);
    }

}
