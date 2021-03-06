<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\User;
use App\Like;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Foreach_;

class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Return like info (if liked) on blog
    public function getLike($blogId)
    {
        $userId = Auth::id();
        $like = Like::where('blog_id', $blogId)
            ->where('user_id', $userId);
        return $like;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function create()
    {
        // View add blog form
        return view('addBlog');
    }

    public function store(Request $request)
    {
        // Accept user request and add blog
        $fields = $request->input('blog');
        $blog = new Blog;
     
        foreach ($fields as $field => $value) {
            $blog->$field = $value;
        }
     
        // Add blog info to db
        $user = User::find(Auth::id());
        $user->blogs()->save($blog);

        return redirect()->route('home');
    }

    public function show($blogId)
    {
        // Grab the blog
        $blog = Blog::find($blogId);
        if (isset($blog)) {
            // Check if current user liked this blog
            $liked = $this->getLike($blogId)->exists();
            // View blog
            return view('blog', 
                [
                    'blog' => $blog, 
                    'liked' => $liked
                ]);
        }
        else {
            return abort(404);
        }
    }

    public function like(Request $request)
    {
        $blogId = $request->input('blogId');
        $userId = Auth::id();

        // If already liked, dislike else like
        $like = $this->getLike($blogId);
        
        if ($like->exists()) {
            // dislike
            $like->delete();
        } else {
            // like
            $like = new Like;
            $like->blog_id = $blogId;
            $like->user_id = $userId;
            $like->save();

            // Notify blog's author
            // TODO
        }

        return redirect("/blogs/$blogId");
        
    }
}
