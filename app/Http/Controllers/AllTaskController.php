<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AllTaskController extends Controller
{


    public function index()
    {
        session(['backUrl' => url()->previous()]);
        $categories = Categories::where('company_id', Auth::user()->company_id)->get();
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'super-admin');
        })->get();

        $selectedCategory = request('categoryFilter', 'all');
        $currentUser = auth()->user();

        $tasksQuery = Tasks::query();

        if ($selectedCategory !== 'all') {
            $tasksQuery->where('category_id', $selectedCategory);
        }

        // Eager load the 'comments' relationship to avoid the N+1 problem
        $tasks = $tasksQuery->where('company_id', Auth::user()->company_id)
        ->with('comments')->get();


        $data = compact('tasks', 'currentUser', 'categories', 'selectedCategory', 'users');

        return view('alltask')->with($data);
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
                Storage::disk()->delete($task->taskimage);
            }


            $imagePath = $request->file('taskimage')->store('taskimage');
            $task->taskimage = $imagePath;
        }

        $task->save();

        return redirect('/alltask')->with('success', 'Task updated successfully');
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
