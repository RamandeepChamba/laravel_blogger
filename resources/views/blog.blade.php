@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>{{ $blog->title }}</h1>
            <hr>
            <p>{{ $blog->content }}</p>
            <hr>
            <a href="#">Like</a>
            <span> 0</span><hr><br>
            <h5>Comments <span>0</span></h5>
            
            <textarea name="comment" cols="30" rows="10"
                placeholder="Add your comment here"></textarea>
            <button>Comment</button>
        </div>
    </div>
</div>
@endsection
