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

Route::get('/','PostsController@index');

Route::resource('categories','CategoriesController');

Route::get('about','PagesController@about');

Route::put('listCat/{id}', ['as' => 'listCat', 'uses' => 'CategoriesController@doDelete']);

Route::get('listCat', ['as' => 'listCat', 'uses' => 'CategoriesController@listCat']);

Route::get('categories_show', ['as' => 'categories_show', 'uses' => 'CategoriesController@listCat']);

Route::get('category/{id}', 'CategoriesController@catLists');

Route::resource('posts','PostsController');

Route::put('dashboard/{id}', ['as' => 'dashboard', 'uses' => 'PostsController@doDelete']);

Route::get('/dashboard', 'DashboardController@index');

Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'PostsController@showLoop']);

Route::get('/navbar', ['as' => 'navbar', 'uses' => 'PostsController@showLooppp']);

Auth::routes();

Route::get('/login/{service}','LoginController@redirectToProvider');

Route::get('/login/{service}/redirect','LoginController@handleProviderCallback');

/*Route::get('/login/github','LoginController@github');

Route::get('/login/github/redirect','LoginController@githubRedirect');

Route::get('/login/google','LoginController@google');

Route::get('/login/google/redirect','LoginController@googleRedirect');*/
