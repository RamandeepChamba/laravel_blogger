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
            <h5>Comments <span>{{ count($blog->comments) }}</span></h5>

            <!-- Comment Form -->
            @include('comments.form', ['blog_id' => $blog->id, 'commentForm' => 1])

            <!-- Comments -->
            <ul id="comments">
                @include('comments.show', 
                    [
                        'comments' => $blog->comments,
                        'blog_id' => $blog->id
                    ])
            </ul>
        </div>
    </div>
</div>
@endsection
