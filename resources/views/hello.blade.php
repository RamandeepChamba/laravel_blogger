@extends('layouts.app')

@section('title', 'Hello')

@section('content')
    <div class="title m-b-md">
        Hello {{ $name }}
    </div>
@endsection