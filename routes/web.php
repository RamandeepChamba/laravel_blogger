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
Route::match(['post', 'patch'], '/blogs', 'BlogController@store')
    ->name('blogs.store');
Route::get('/blogs/{blog_id}', 'BlogController@show')
    ->name('blogs.show');
Route::post('/blogs/like', 'BlogController@like')
    ->name('blogs.like');
Route::get('/blogs/{blog_id}/edit', 'BlogController@edit')
    ->name('blogs.edit');
Route::get('/blogs/delete/{blog_id}', 'BlogController@delete')
    ->name('blogs.delete');
Route::match(['post', 'patch'], '/comments', 'CommentController@store')
    ->name('comments.store');
Route::match(['post', 'patch'], '/comments/getForm', 'CommentController@getForm')
    ->name('comments.create');
Route::post('/comments/like', 'CommentController@like')
    ->name('comments.like');
Route::get('/comments/delete/{comment_id}', 'CommentController@delete')
    ->name('comments.delete');