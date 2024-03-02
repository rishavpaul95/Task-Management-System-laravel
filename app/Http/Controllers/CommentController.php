<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tasks;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $taskId)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $task = Tasks::findOrFail($taskId);

        // Create a new comment instance
        $comment = new Comment();
        $comment->comment = $request->input('comment');
        $comment->user_id = auth()->user()->id;
        $comment->task_id = $taskId;

        $comment->save();

        return redirect()->back()->with('success', 'Comment posted successfully.');
    }
}
