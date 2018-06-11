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

use App\Models\Error as Error;
use App\Models\Post as Post;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// error posts
Route::prefix('post')->group(function () {
    Route::get('/list', 'Admin\PostController@index')->name(Post::ROUTE_LIST_POST);
    Route::get('/add', 'Admin\PostController@add')->name(Post::ROUTE_ADD_POST);
    Route::post('/save', 'Admin\PostController@save')->name(Post::ROUTE_SAVE_POST);
    Route::get('/edit/{id?}', 'Admin\PostController@edit')->name(Post::ROUTE_EDIT_POST);
});

// error routers
Route::prefix('error')->group(function () {
    Route::get('/404', 'Error\ErrorController@page404')->name(Error::ERROR_404);
    Route::get('/403', 'Error\ErrorController@page403')->name(Error::ERROR_403);
    Route::get('/500', 'Error\ErrorController@page500')->name(Error::ERROR_500);
});
