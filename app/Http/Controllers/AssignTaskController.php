<?php

namespace App\Http\Controllers;

use App\Mail\AssignTaskMail;
use App\Models\Categories;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class AssignTaskController extends Controller
{

    public function index()
    {

        session(['backUrl' => url()->previous()]);
        $categories = Categories::all();
        $users = User::all();

        $selectedCategory = request('categoryFilter', 'all');
        $currentUser = auth()->user();


        $tasksQuery = Tasks::where('assigned_by', $currentUser->id)
                        ->where('user_id', '!=', $currentUser->id);

        if ($selectedCategory !== 'all') {
            $tasksQuery->where('category_id', $selectedCategory);
        }

        //task based on querry // reminder! eager load comments
        $tasks = $tasksQuery->with('comments')->get();

        $data = compact('tasks','currentUser', 'categories', 'selectedCategory', 'users');

        return view('assigntask')->with($data);
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
            $task->user_id = $request->input('assigneduser'); //assigned user
            $task->category_id = $request->input('category');

            if ($request->hasFile('taskimage')) {
                $imagePath = $request->file('taskimage')->store('taskimage');
                $task->taskimage = $imagePath;
            }

            $task->assigned_by = auth()->user()->id;
            $task->save();

            // Send email to the assigned user
            $assignedUser = User::find($task->user_id);
            $assignedProject = Categories::find($task->category_id);
            $assignedbyname = auth()->user()->name;

            if ($assignedUser) {
                $subject = 'You have been assigned a Task';
                $body = "You have been assigned a task with the following details:\n\n"
                    . "Due Date: {$task->date}\n"
                    . "Topic: {$task->topic}\n"
                    . "Assigned By: {$assignedbyname}\n"
                    . "Under Project: {$assignedProject->category}\n";

                Mail::to($assignedUser->email)->send(new AssignTaskMail($subject, $body));
            }

            return redirect('/assigntask');
        } else {
            return redirect('/login')->with('error', 'You must be logged in to perform this action.');
        }
    }

    public function edit(Request $request, $id)
    {
        $task = Tasks::find($id);

        if (!$task) {
            return redirect('assigntask')->with('error', 'Task not found');
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
                Storage::disk()->delete($task->taskimage);
            }


            $imagePath = $request->file('taskimage')->store('taskimage');
            $task->taskimage = $imagePath;
        }

        $task->save();

        return redirect('/assigntask')->with('success', 'Task updated successfully');
    }

    public function delete($id)
    {
        $task = Tasks::find($id);
        if ($task) {
            if ($task->taskimage) {
                Storage::disk('public')->delete($task->taskimage);
            }
            $task->delete();

        }
        return redirect()->back();
    }
}
