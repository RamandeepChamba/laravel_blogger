@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
<!--
            <div class="card">
                <div class="card-header">Dashboard</div>  
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>

            </div>
-->

            @forelse ($blogs as $blog)
                <div class="card mb-3">  
                    <div class="card-body">
                        <h3>{{ $blog->title }}</h3>
                        <strong>~ </strong>
                        <a href="/users/{{ $blog->user->id }}">
                            @if(auth()->user()->id == $blog->user->id)
                                You
                            @else
                                {{ $blog->user->name }}
                            @endif
                        </a>
                        <hr>
                        <p>{{ $blog->description }}</p>
                        <!-- View Blog -->
                        <a href="/blogs/{{ $blog->id }}" 
                            class="btn btn-primary">View</a>
                        @if(auth()->user()->id == $blog->user->id)
                            <!-- Delete Blog  -->
                            <a href="/blogs/delete/{{ $blog->id }}" class="btn btn-danger">Delete</a>
                            <!-- Edit Blog  -->
                            <a href="/blogs/{{ $blog->id }}/edit" class="btn btn-secondary">Edit</a>
                        @endif
                    </div>
                </div>
            @empty
                <h3>You have no blogs</h3>
            @endempty
        </div>
    </div>
</div>
@endsection
