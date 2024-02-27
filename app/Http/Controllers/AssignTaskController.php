<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssignTaskController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        $users = User::all();

        $selectedCategory = request('categoryFilter', 'all');


        $tasksQuery = Tasks::query();

        if ($selectedCategory !== 'all') {
            $tasksQuery->where('category_id', $selectedCategory);
        }

        // Get the tasks based on the query
        $tasks = $tasksQuery->get();

        $data = compact('tasks', 'categories', 'selectedCategory', 'users');

        return view('adminassigntask')->with($data);
    }


    public function store(Request $request)
    {
        if (auth()->check()) {
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
            $task->user_id = $request->input('assigneduser'); //
            $task->category_id = $request->input('category');

            if ($request->hasFile('taskimage')) {
                $imagePath = $request->file('taskimage')->store('taskimage', 'public');
                $task->taskimage = $imagePath;
            }

            $task->assigned_by = auth()->user()->id;
            $task->save();

            return redirect('/admin/assigntask');
        } else {
            return redirect('/login')->with('error', 'You must be logged in to perform this action.');
        }
    }

    public function edit(Request $request, $id)
    {
        $task = Tasks::find($id);

        if (!$task) {
            return redirect('/admin/assigntask')->with('error', 'Task not found');
        }

        $request->validate([
            'date' => 'required|date',
            'topic' => 'required|string',
            'status' => 'required|in:Completed,Active,Inactive',
            'category' => 'required|exists:categories,id',
            'taskimage' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $task->date = $request->input('date');
        $task->topic = $request->input('topic');
        $task->status = $request->input('status');
        $task->category_id = $request->input('category');


        if ($request->hasFile('taskimage')) {

            if ($task->taskimage) {
                Storage::disk('public')->delete($task->taskimage);
            }


            $imagePath = $request->file('taskimage')->store('taskimage', 'public');
            $task->taskimage = $imagePath;
        }

        $task->save();

        return redirect('/admin/assigntask')->with('success', 'Task updated successfully');
    }

    public function delete($id)
    {
        $task = Tasks::find($id);
        if ($task) {
            $task->delete();
        }
        return redirect()->back();
    }


}
