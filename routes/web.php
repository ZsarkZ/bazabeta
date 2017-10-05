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


Route::group([ 'middleware' => [ 'web', 'auth' ] ], function (\Illuminate\Routing\Router $router) {
	Route::get('/', 'HomeController@index');

	Route::get('/home', 'HomeController@index')->name('home');

	Route::resource('country', 'CountryController');
	Route::get('/country/{id}/delete', 'CountryController@delete');

	Route::resource('sport', 'SportController');
	Route::get('/sport/{id}/delete', 'SportController@delete');

	Route::resource('team', 'TeamController');
	Route::get('/team/{id}/delete', 'TeamController@delete');

	Route::resource('player', 'PlayerController');
	Route::get('/player/{id}/delete', 'PlayerController@delete');

	Route::resource('tournament', 'TournamentController');
	Route::get('/tournament/{id}/delete', 'TournamentController@delete');

	Route::resource('game', 'GameController');
	Route::get('/game/{id}/delete', 'GameController@delete');
});

Auth::routes();
