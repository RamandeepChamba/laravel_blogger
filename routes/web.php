<?php

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // If user logged in display home page
    if (Auth::check()) {
        return redirect()->route('home');
    }
    // else display welcome page
    else {
        return view('welcome');
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')
    ->name('home');
Route::get('/blogs/create', 'BlogController@create')
    ->name('blogs.create');
Route::post('/blogs', 'BlogController@store')
    ->name('blogs.store');
Route::get('/blogs/{blog}', 'BlogController@show')
    ->name('blogs.show');
Route::post('/blogs/like', 'BlogController@like')
    ->name('blogs.like');
Route::post('/comments', 'CommentController@store')
    ->name('comments.store');
Route::post('/comments/getReplyForm', 'CommentController@getReplyForm')
    ->name('comments.create');
Route::post('/comments/like', 'CommentController@like')
    ->name('comments.like');
Route::get('/comments/delete/{comment_id}', 'CommentController@delete')
    ->name('comments.delete');