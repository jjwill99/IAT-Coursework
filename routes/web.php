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

Route::get('/', 'PageController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin_home', 'HomeController@admin')->name('admin_home');

Route::get('/animal', 'AnimalController@index')->name('animal');

Route::get('/requests', 'RequestController@index')->name('requests');

Route::get('/review', 'ReviewController@index')->name('review');

Route::get('/user', 'UserController@show')->name('user');

Route::resource('animals', 'AnimalController');

Route::resource('adoptions', 'HomeController');

Route::resource('reviews', 'ReviewController');

Route::resource('users', 'UserController');