<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Tasks;
use App\Models\User;
use Auth;
use Request;

class AssignTaskController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        $user = User::all();

        $selectedCategory = request('categoryFilter', 'all');


        $tasksQuery = Tasks::query();

        if ($selectedCategory !== 'all') {
            $tasksQuery->where('category_id', $selectedCategory);
        }

        // Get the tasks based on the query
        $tasks = $tasksQuery->get();

        $data = compact('tasks', 'categories', 'selectedCategory', 'user');

        return view('adminassigntask')->with($data);
    }


    public function store(Request $request)
    {

        if (Auth::check()) {
            $request->validate([
                'date' => 'required|date',
                'topic' => 'required|string',
                'status' => 'required|in:Completed,Active,Inactive',
                'category' => 'required|exists:categories,id',
                'taskimage' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $task = new Tasks;
            $task->date = $request->input('date');
            $task->topic = $request->input('topic');
            $task->status = $request->input('status');
            $task->user_id =  // assign user to give task to
            $task->category_id = $request->input('category');
            if ($request->hasFile('taskimage')) {
                $imagePath = $request->file('taskimage')->store('taskimage', 'public');
                $task->taskimage = $imagePath;
            }
            $task->assigned_by = auth()->user()->id; // assigned by admin
            $task->save();

            return redirect('/admin/assigntask');
        } else {
            return redirect('/login')->with('error', 'You must be logged in to perform this action.');
        }
    }
}
