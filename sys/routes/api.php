<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
| 
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login','Api\UsersController@login');
Route::post('register','Api\UsersController@register');
Route::post('laporuser','Api\UsersController@laporus');
Route::post('listHistory','Api\HistoryController@listLaporan');

Route::get('detailHistory', 'Api\HistoryController@detail');