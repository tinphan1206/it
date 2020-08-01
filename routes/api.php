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

Route::group(['prefix' => 'g8'], function(){
   Route::get('groups', 'Api\ApiController@groups');

   Route::post('add', 'Api\ApiController@add');
   Route::post('update', 'Api\ApiController@update');
   Route::post('delete', 'Api\ApiController@delete');

   Route::post('login', 'Api\ApiController@login');
   Route::post('logout', 'Api\ApiController@logout');
});
