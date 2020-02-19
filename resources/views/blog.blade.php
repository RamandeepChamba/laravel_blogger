@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <!-- Blog -->
            <h1>{{ $blog->title }}</h1>
            <hr>
            <p>{{ $blog->content }}</p>
            <hr>

            <!-- Like blog -->
            <form action="/blogs/like" method="POST" name="like">
                @csrf
                <input type="text" name="blogId" 
                    value="{{ $blog->id }}" hidden>
                <button type="submit">{{ $liked ? 'Dislike' : 'Like' }}</button>
                <span> {{ count($blog->likes) }}</span>
            </form>
            
            <hr>
            <h5>Comments <span>0</span></h5>

            <!-- Comment Form -->
            @include('blogs.commentForm', ['blog_id' => $blog->id])

            <!-- Comments -->
            <ul id="comments">
                @include('blogs.commentsDisplay', 
                    [
                        'comments' => $blog->comments,
                        'blog_id' => $blog->id
                    ])
            </ul>
        </div>
    </div>
</div>
@endsection
