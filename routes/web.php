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

Route::get('/tasks', 'TaskController@index')->name('tasks.index');
Route::post('/tasks', 'TaskController@store')->name('tasks');
Route::delete('/tasks/{id}', 'TaskController@delete');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


