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
            'comment' => 'required|string',
        ]);

        $comment = Tasks::findOrFail($taskId);

        $comment = new Comment();
        $comment->comment = $request->input('comment');
        $comment->user_id = auth()->user()->id;
        $comment->task_id = $taskId;

        $comment->save();

        return redirect()->back()->with('success', 'Comment posted successfully.');
    }

    public function delete($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}
