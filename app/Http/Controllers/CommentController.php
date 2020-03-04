<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private function checkCommentExist($comment_id)
    {
        // Check if comment exists
        $comment = Comment::find($comment_id);
        if (isset($comment)) {
            return $comment;
        }
        else {
            abort(404);
        }
    }

    private function checkCommentBelongs($comment_id)
    {
        // Check if comment exists
        $comment = $this->checkCommentExist($comment_id);
        // Check if comment belongs to auth user
        $user_id = auth()->user()->id;

        if ($comment->user->id == $user_id) {
            return $comment;
        }
        else {
            abort(403, 'Unauthorized action');
        }
    }

    public function store(Request $request)
    {
        $fields = $request->input('comment');
        $fillable = ['blog_id', 'parent_id', 'comment'];
        
        if ($request->method() == 'PATCH') {
            $comment_id = $request->input('comment_id');
            // Fetch comment
            $comment = $this->checkCommentBelongs($comment_id);
        }
        else {
            // Create new comment
            $comment = new Comment;
            $comment['user_id'] = auth()->user()->id;
        }

        foreach ($fields as $field => $value) {
            // Error handling
            if (in_array($field, $fillable)) {
                $comment->$field = $value;
            }
            continue;
        }
        // Add / Update comment in db
        $comment->save();
        return back();
    }

    public function getForm(Request $request)
    {     
        $comment_id = $request->comment_id ?? null;

        // Editing
        if (isset($comment_id)) {
            $comment = $this->checkCommentBelongs($comment_id);
        }
        // Creating
        else {
            $blog_id = $request->blog_id;
            $parent_id = $request->parent_id;

            $comment = new Comment;
            $comment->blog_id = $blog_id;
            $comment->parent_id = $parent_id;
        }
        $returnData = [
            'comment' => $comment
        ];

        return view('comments.form', $returnData);
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
