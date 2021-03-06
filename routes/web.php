<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();
// Dashboard
Route::get('/', 'HomeController@index')->name('home');
// My Profile
Route::get('/profile/{user}', 'HomeController@myProfile')->name('profile');
Route::get('/profile/edit/{user}', 'HomeController@edit')->name('profile.edit');
Route::post('/profile/follow/{user}', 'HomeController@follow')->name('profile.follow');
Route::patch('/profile/update/{user}', 'HomeController@update')->name('profile.update');
// Posts
Route::get('/posts', 'PostController@index')->name('posts');
Route::get('/posts/create', 'PostController@create')->name('posts.create');
Route::get('/posts/edit/{post}', 'PostController@edit')->name('posts.edit');
Route::get('/posts/show/{post}', 'PostController@show')->name('posts.show');
Route::patch('/posts/edit/{post}', 'PostController@update')->name('posts.update');
Route::post('/posts', 'PostController@store')->name('posts.store');
Route::delete('/posts/delete/{post}', 'PostController@destroy')->name('posts.delete');
// Like
Route::post('/posts/like/{post}', 'PostController@like')->name('posts.like');
// Comment
Route::post('/comments/{post}', 'CommentController@store')->name('comments.store');
Route::delete('/comments/delete/{comment}', 'CommentController@destroy')->name('comments.delete');
Route::post('/comments/like/{comment}', 'CommentController@like')->name('comments.like');

// File Manager Test (WYSIWYG)
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
  \UniSharp\LaravelFilemanager\Lfm::routes();
});