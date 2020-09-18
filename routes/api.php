<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', 'authController@login');
Route::post('register', 'authController@register');
Route::resource('aset', 'asetController');
Route::get('all', 'asetController@index');
Route::get('all/{id}', 'asetController@show');
Route::post('new', 'asetController@store');
Route::post('update', 'asetController@update');
Route::post('del/{id}', 'asetController@destroy');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('logout', 'authController@logout');
}); 

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
