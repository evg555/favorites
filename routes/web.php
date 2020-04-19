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

Route::get('/', function() {
    return redirect()->route('favorites.index');
});

Route::get('/favorites', 'FavoriteController@index')->name('favorites.index');
Route::post('/favorites/', 'FavoriteController@store')->name('favorites.store');
Route::get('/favorites/create', 'FavoriteController@create')->name('favorites.create');
Route::get('/favorites/export', 'FavoriteController@export')->name('favorites.export');
Route::get('/favorites/{id}', 'FavoriteController@show')->name('favorites.show');
