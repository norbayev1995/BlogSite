<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $post = Post::find($id);
        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);
        return redirect()->back();
    }

    public function destroy($id)
    {

        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->back();
    }
}
