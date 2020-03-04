@extends('layouts.app')

@section('title', 'Add Blog')

@section('content')
<div class="container">
    <h2>Add Blog</h2>
    <!-- NOTE: Bootstrap(Aesthetics) this -->
    <form action="/blogs" method="POST">
        @csrf
        @if (isset($blog))
            @method('PATCH')
            <input type="text" name="blog_id" value="{{ $blog->id }}" hidden>
        @endif
        <label for="blogTitle">Title</label>
        <input type="text" id="blogTitle" name="blog[title]" value="{{ $blog->title ?? '' }}" 
            placeholder="Title" maxlength="50" required>
        <br>
        <label for="blogDesc">Description</label>
        <input type="text" id="blogDesc" name="blog[description]" value="{{ $blog->description ?? '' }}" 
            placeholder="Description" maxlength="100" required>
        <br>
        <!-- Add Blog tool here (insert images, heading etc) -->
        <label for="blogContent">Content</label>
        <br>
        <textarea id="blogContent" name="blog[content]" cols="30" rows="10"
            placeholder="Blog content here" required>{{ $blog->content ?? '' }}</textarea>
        <br>
        <button type="submit">Add</button>
    </form>
</div>
@endsection
