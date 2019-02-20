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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {
    
    // dataTables USERS ROUTE
    Route::get('downloadExcel/{type}', 'UserController@downloadExcel');
    Route::get('/users/displaydata', 'UserController@create');
    Route::get('index', 'UserController@index');
    Route::resource('users', 'UserController');

    //POST ROUTE
    Route::get('postExcel/{type}', 'PostController@postExcel');
    Route::get('posts/guide', 'PostController@guide');
    Route::resource('posts', 'PostController');
});
