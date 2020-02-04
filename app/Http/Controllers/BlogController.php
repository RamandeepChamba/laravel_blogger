<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\User;
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

    public function show($blog)
    {
        // Grab the blog
        $blog = Blog::find($blog);
        if (isset($blog)) {
            // View blog
            return view('blog', ['blog' => $blog]);
        }
        else {
            return abort(404);
        }
    }
}
