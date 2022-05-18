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

Route::get('/', 'PostsController@index');

Route::get('/signup', 'Auth\RegisterController@showRegistrationForm');
Route::post('/signup', 'Auth\RegisterController@register');
Route::get('/edit', 'PostsController@showEdit');
Route::post('/edit', 'PostsController@edit');

Route::get('/login', 'Auth\LoginController@showLoginForm');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => '/users/{id}'], function () {
        Route::post('/follow', 'UserFollowController@store');
        Route::post('/unfollow', 'UserFollowController@destroy');
        Route::get('/followings', 'UsersController@followings');
        Route::get('/followers', 'UsersController@followers');
        
        Route::get('/favorites', 'UsersController@favorites');
    });
    
    Route::post('/posts/favorite', 'FavoritesController@store');
    Route::post('/posts/unfavorite', 'FavoritesController@delete');
    
    Route::get('/users/index', 'UsersController@index');
    Route::get('/users/show/{id}', 'UsersController@show');
    
    Route::get('/posts/create', 'PostsController@create');
    Route::post('/posts/destroy', 'PostsController@destroy');
    Route::post('/posts/store', 'PostsController@store');
    
    Route::get('/posts/show/{id}', 'PostsController@showPost');
    
});