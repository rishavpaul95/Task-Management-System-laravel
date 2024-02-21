<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()

    {
        $tasks = Tasks::all();
        $data =compact('tasks');
        return view('tasks')->with($data);

    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'topic' => 'required|string', // Add validation for the 'topic' field
            'status' => 'required|in:Completed,Active,Inactive', // Add validation for the 'status' field
        ]);

        $task = new Tasks;
        $task->date = $request->input('date');
        $task->topic = $request->input('topic');
        $task->status = $request->input('status');

        $task->save();

        return redirect('/tasks');
    }


}
