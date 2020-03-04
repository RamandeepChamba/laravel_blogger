<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\User;
use App\Like;
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    private function checkBlogExist($blog_id)
    {
        // Check if blog exists
        $blog = Blog::find($blog_id);
        if (isset($blog)) {
            return $blog;
        }
        else {
            abort(404);
        }
    }

    private function checkBlogBelongs($blog_id)
    {
        // Check if blog exists
        $blog = $this->checkBlogExist($blog_id);
        // Check if blog belongs to auth user
        $user_id = auth()->user()->id;

        if ($blog->user->id == $user_id) {
            return [$blog, $user_id];
        }
        else {
            abort(403, 'Unauthorized action');
        }
    }
    
    public function create()
    {
        // View add blog form
        return view('addBlog');
    }

    public function store(Request $request)
    {
        // Accept user request and add blog
        $blog_id = $request->input('blog_id');
        $fields = $request->input('blog');
        $fillable = ['title', 'description', 'content'];

        if ($request->method() == 'PATCH') {
            // Fetch existing blog
            $blog = $this->checkBlogExist($blog_id);
            // Update blog
        }
        else {
            // Create new blog instance
            $blog = new Blog;
        }
     
        // Bugs: Can update id as well even though not in fillable
        foreach ($fields as $field => $value) {
            if (in_array($field, $fillable)) {
                $blog->$field = $value;
            }
        }
     
        // Add blog info to db
        // Check if user exists
        $user = User::find(auth()->user()->id);
        if (isset($user)) {
            $user->blogs()->save($blog);
        }
        else {
            abort(403, 'Unauthorized action');
        }
        return redirect()->route('home');
    }

    public function show($blog_id)
    {
        // Check if blog exists
        // Grab the blog
        $blog = $this->checkBlogExist($blog_id);
        // View blog
        return view('blog', 
            [
                'blog' => $blog
            ]);
    }

    public function like(Request $request)
    {
        $blog_id = $request->input('blogId');

        // Check if blog exists
        $blog = $this->checkBlogExist($blog_id);
        $user_id = auth()->user()->id;
        // If already liked, dislike else like
        $like = $blog->likes->where('user_id', $user_id)->first();
        
        if ($like) {
            // dislike
            $like->delete();
        } else {
            // like
            $like = new Like;
            $like->blog_id = $blog_id;
            $like->user_id = $user_id;
            $like->save();

            // Notify blog's author
            // TODO
        }

        return redirect("/blogs/$blog_id");
    }

    protected function edit($blog_id)
    {
        // Check if blog belongs to auth user
        [$blog] = $this->checkBlogBelongs($blog_id);
        // Render edit form
        return view('addBlog', [
            'blog' => $blog
        ]);
    }

    protected function delete($blog_id)
    {
        // Check if blog exists
        // Check if blog belongs to user
        [$blog] = $this->checkBlogBelongs($blog_id);
        // Delete blog and all it's comments, likes
        $blog->delete();
        // return back();
        return back();
    }
}
