@extends('layouts.app')

@section('title', 'Add Blog')

@section('content')
<div class="container">
    <h2>Add Blog</h2>
    <!-- NOTE: Bootstrap(Aesthetics) this -->
    <form action="/blogs" method="POST">
        @csrf
        <input type="text" name="blog[title]" placeholder="Title" 
            maxlength="50" required>
        <input type="text" name="blog[description]" placeholder="Description" 
            maxlength="100" required>
        <br>
        <!-- Add Blog tool here (insert images, heading etc) -->
        <textarea name="blog[content]" cols="30" rows="10" 
            placeholder="Blog content here" required></textarea>
        <br>
        <button type="submit">Add</button>
    </form>
</div>
@endsection
