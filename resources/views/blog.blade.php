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
                    @if ($blog->likes->contains('user_id', auth()->user()->id))
                        <button type="submit" class="btn btn-warning">
                            Dislike
                    @else
                        <button type="submit" class="btn btn-primary">
                            Like
                    @endif
                        </button>
                <span> {{ count($blog->likes) }}</span>
            </form>
            
            <hr>
            <h5>Comments <span>{{ count($blog->comments) }}</span></h5>

            <!-- Comment Form -->
            @include('comments.form', [
                'comment' => (object) [
                    'blog_id' => $blog->id
                ]
            ])

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
