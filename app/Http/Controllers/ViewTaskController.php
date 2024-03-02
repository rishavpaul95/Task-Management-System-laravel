<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Comment;
use App\Models\Tasks;
use App\Models\User;

class ViewTaskController extends Controller
{
    public function show($id)
    {

        $categories = Categories::all();
        $task = Tasks::find($id);

        $assignedBy = User::find($task->assigned_by);
        $assignedTo = User::find($task->user_id);

        $comments = Comment::where('task_id', $id)->get();

        $category = $categories->firstWhere('id', $task->category_id);
        $categoryName = $category ? $category->category : 'Unknown Category';


        $data = compact('categories', 'task', 'assignedBy', 'assignedTo', 'categoryName','comments');

        return view('viewtask')->with($data);
    }
}
