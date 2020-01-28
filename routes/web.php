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

use \App\{Post, PostImage};

Route::get('/', function () {
    $name = 'Anderson';
    return view('welcome', ['name' => $name]);
});


Route::get('sub', function () {
    $posts = Post::addSelect([
        'thumb' => PostImage::select('image')
                            ->whereColumn('post_id', 'posts.id')
                            ->limit(1)
    ])->get();
    return $posts;
});


Route::get('collection', function () {
    $posts = Post::all();

    foreach ($posts as $post){
        print $post->title.' - '. $post->description.'<br/>';
    }
});

Route::get('lazy-collection', function () {
    $posts = Post::cursor();

    foreach ($posts as $post){
        print $post->title.' - '. $post->description.'<br/>';
    }
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
