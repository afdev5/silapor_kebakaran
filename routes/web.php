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
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/maps', 'MapsController@index')->name('maps');
Route::get('/mapslapor{id}', 'MapsController@laporan')->name('maps.lapor');
Route::resource('/user', 'UsserController');
Route::resource('/laapor', 'LaporController');
