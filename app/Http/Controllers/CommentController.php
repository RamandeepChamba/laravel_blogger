<?php

namespace App\Http\Controllers;

use App\Comment;
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
}
