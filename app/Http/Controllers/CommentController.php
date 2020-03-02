<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;

        Comment::create($input);

        return back();
    }

    public function getReplyForm(Request $request)
    {
        $blog_id = $request->blog_id;
        $parent_id = $request->parent_id;
        
        return view('comments.form', 
        [
            'blog_id' => $blog_id,
            'parent_id' => $parent_id
        ]);
    }

    private function getLike($comment_id)
    {
        $user_id = auth()->user()->id;
        $like = Like::where('comment_id', $comment_id)
            ->where('user_id', $user_id);
        return $like;
    }

    public function like(Request $request)
    {
        $blog_id = $request->input('blog_id');
        $comment_id = $request->input('comment_id');
        $user_id = auth()->user()->id;

        // If already liked, dislike else like
        $like = $this->getLike($comment_id);
        
        if ($like->exists()) {
            // dislike
            $like->delete();
        } else {
            // like
            $like = new Like;
            $like->blog_id = $blog_id;
            $like->comment_id = $comment_id;
            $like->user_id = $user_id;
            $like->save();

            // Notify comment's author
            // TODO
        }

        return back();
    }

    public function delete($comment_id)
    {
        // Check if comment exists
        $comment = Comment::find($comment_id);
        $user_id = auth()->user()->id;
        
        if (isset($comment)) {
            // Check if comment belongs to user
            if ($comment->user->id == $user_id) {
                // Delete comment and all it's replies and likes
                $comment->delete();
            }
            else {
                abort(403, 'Unauthorized action.');
            }
        }
        else {
            abort(404);
        }

        return back();
    }
}
