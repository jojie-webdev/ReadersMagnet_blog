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
    //SEND THANK YOU EMAIL 
    Route::get('postExcel/{type}', 'PostController@postExcel');
    Route::get('posts/guide', 'PostController@guide');
    Route::post('posts/posted/{id}', 'PostController@posted');
    Route::resource('posts', 'PostController');

    //SEND EMAIL 
    Route::get('contact/form/{id}/{username}/{email}', 'ContactController@showForm')->name('contact.show');
    Route::post('contact', 'ContactController@sendEmail')->name('contact.send');

    //FILTER
    Route::get('search', 'SearchController@index');
});



