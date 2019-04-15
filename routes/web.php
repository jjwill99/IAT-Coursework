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
//User home page
Route::get('/home', 'HomeController@index')->name('home');
//User's requests page
Route::get('/requests', 'RequestController@index')->name('requests');
//User's page to see all animals available for adoption
Route::get('/adopt', 'HomeController@animals')->name('adopt');
//User's page to see information about a specific animal
Route::get('/information/{id}', 'HomeController@showAnimal')->name('information');
//User's page to see information about a specific animal
Route::get('/info/{id}', [ 'as' => 'info', 'uses' => 'RequestController@showAnimal']);

Route::resource('home', 'HomeController');

Route::resource('requested', 'RequestController');

Route::middleware(['auth', 'admin'])->group(function(){
	//Admin home page
	Route::get('/admin_home', 'HomeController@admin')->name('admin_home');
	//Admin's access to all animals
	Route::get('/animal', 'AnimalController@index')->name('animal');
	//Admin's page to review pending adoption requests
	Route::get('/review', 'ReviewController@index')->name('review');
	//Admin's page to see all adoption requests
	Route::get('/reviewAll', 'RequestController@admin')->name('reviewAll');
	//Admin's page to see relevant user information
	Route::get('/user', 'UserController@show')->name('user');

	Route::resource('reviews', 'ReviewController');

	Route::resource('animals', 'AnimalController');

	Route::resource('users', 'UserController');
});