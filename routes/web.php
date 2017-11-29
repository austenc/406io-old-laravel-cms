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

Route::get('/', 'HomeController@index');
Auth::routes();
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

// Pages
Route::resource('pages', 'PageController')->middleware('auth');
Route::post('pages/{page}/publish', 'PageController@publish')
	->name('pages.publish')->middleware('auth');
Route::post('pages/{page}/unpublish', 'PageController@unpublish')
	->name('pages.unpublish')->middleware('auth');

Route::get('/{slug}', 'PageController@display');
