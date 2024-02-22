<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->tasks;
        $data = compact('tasks');
        return view('tasks')->with($data);
    }

    public function viewtrash()
    {
        $tasks = Auth::user()->tasks()->onlyTrashed()->get();
        $data = compact('tasks');
        return view('task_trash')->with($data);
    }

    public function store(Request $request)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $request->validate([
                'date' => 'required|date',
                'topic' => 'required|string',
                'status' => 'required|in:Completed,Active,Inactive',
                'category' => 'required|exists:categories,id',
            ]);

            $task = new Tasks;
            $task->date = $request->input('date');
            $task->topic = $request->input('topic');
            $task->status = $request->input('status');
            $task->user_id = auth()->user()->id;
            $task->category_id = $request->input('category');
            $task->save();

            return redirect('/tasks');
        } else {
            return redirect('/login')->with('error', 'You must be logged in to perform this action.');
        }
    }
    public function delete($id)
    {
        $task = Auth::user()->tasks()->find($id);
        if ($task) {
            $task->delete();
        }
        return redirect()->back();
    }

    public function restore($id)
    {
        $task = Auth::user()->tasks()->withTrashed()->find($id);
        if ($task) {
            $task->restore();
        }
        return redirect('/tasks/trash');
    }

    public function forceddelete($id)
    {
        $task = Auth::user()->tasks()->withTrashed()->find($id);
        if ($task) {
            $task->forceDelete();
        }
        return redirect('/tasks/trash');
    }

    public function edit(Request $request, $id)
    {
        $task = Auth::user()->tasks()->find($id);

        if (!$task) {
            return redirect('/tasks')->with('error', 'Task not found');
        }

        $request->validate([
            'date' => 'required|date',
            'topic' => 'required|string',
            'status' => 'required|in:Completed,Active,Inactive',
            'category' => 'required|exists:categories,id',
        ]);

        $task->date = $request->input('date');
        $task->topic = $request->input('topic');
        $task->status = $request->input('status');
        $task->user_id = auth()->user()->id;
        $task->category_id = $request->input('category');
        $task->save();

        return redirect('/tasks')->with('success', 'Task updated successfully');
    }




}
