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

use \App\Post;
use App\PostImage;

Route::get('/', function () {
    $name = 'Anderson';
    return view('welcome', ['name' => $name]);
});


Route::get('sub', function () {
    $posts = Post::addSelect([
        'image' => PostImage::select('image')->whereColumn('post_id', 'posts')->limit(1)
    ])->get();

    return $posts;
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
