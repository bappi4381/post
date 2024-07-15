<?php

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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/', 'PostController@index')->name('home.index');
        Route::post('/', 'PostController@store')->name('posts.store');
        Route::post('/comment', 'CommentController@store')->name('comments.store');
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
        Route::post('/posts/{post}/like', 'PostController@like')->name('posts.like');

        Route::get('/posts', 'HomeController@index')->name('posts.index');
        

    });
});
