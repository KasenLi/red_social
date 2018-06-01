<?php

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
    return view('welcome');
});

Route::get('profile/{name}', [
	'uses'	=>	'HomeController@viewUser',
	'as'	=>	'front.view.user'
]);

Route::resource('posts', 'PostsController');

Route::resource('comments', 'CommentsController');

Route::get('posts/{id}/destroy', [
	'uses'	=>	'PostsController@destroy',
	'as'	=>	'posts.destroy'
]);

Route::group(['prefix' => 'admin', 'middleware' => ['auth'] ], function(){
	Route::get('/', function() {
		return view('welcome');
	});
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('post/{id}',[
	'uses'	=>	'HomeController@like',
	'as'	=>	'post.update.like'
]);

Route::post('post/{id}/comment', [
	'uses' 	=>	'HomeController@comment',
	'as'	=>	'post.comment'
]);

Route::get('comment/{id}', [
	'uses'	=>	'HomeController@comment_like',
	'as'	=>	'comment.like'
]);

Route::get('profile/{name}', [
	'uses'	=>	'ProfileController@index',
	'as'	=>	'profile.index'
]);