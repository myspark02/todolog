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

Route::get('/', 'WelcomeController@index');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('login/github', 'Auth\LoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');
Route::group(['middleware' => 'auth'], function(){
	Route::resource('project', 'ProjectController');	
	Route::resource('project.task', 'ProjectTaskController');
	Route::resource('task', 'TaskController', ['only'=>['index', 'show']]);
});

