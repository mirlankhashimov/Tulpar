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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::get('countries', 'CountryController@index');
//Route::get('countries/{id}', 'CountryController@show');
//Route::post('countries', 'CountryController@store');
//Route::delete('countries/{id}', 'CountryController@destroy');
//
//Route::get('categories', 'CategoryController@index');
//Route::get('categories/{id}', 'CategoryController@show');
//Route::post('categories', 'CategoryController@store');
//Route::put('categories/{id}', 'CategoryController@update');
//Route::delete('categories/{id}', 'CategoryController@destroy');

Route::apiResource('countries', 'CountryController');
Route::apiResource('categories', 'CategoryController');

