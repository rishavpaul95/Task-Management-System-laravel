<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()

    {
        $tasks = Tasks::all();
        $data = compact('tasks');
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

    public function delete($id)
    {
        $task = Tasks::find($id);
        if ($task) {
            $task->delete();
        }
        return redirect()->back();
    }

    public function edit(Request $request, $id)
{
    $task = Tasks::find($id);

    if (!$task) {
        return redirect('/tasks')->with('error', 'Task not found');
    }

    $request->validate([
        'date' => 'required|date',
        'topic' => 'required|string',
        'status' => 'required|in:Completed,Active,Inactive',
    ]);

    $task->date = $request->input('date');
    $task->topic = $request->input('topic');
    $task->status = $request->input('status');

    $task->save();

    return redirect('/tasks')->with('success', 'Task updated successfully');
}

}
