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

Route::namespace('API')->group(function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('store', 'ClientController@store');
    Route::get('getClient', 'ClientController@getClient');
   
Route::middleware(['auth:api'])->group(function () {
    // User Update and related activity
    
       Route::get('details', 'AuthController@details');
       Route::get('logout', 'AuthController@logout');

       // Cleints Users CRUD Functions

       Route::post('CreateUsers', 'ClientController@CreateUsers');
       Route::get('getUser', 'ClientController@getUser');
       Route::get('UpdateClientUser/{id}', 'ClientController@UpdateClientUser');
       });
   });       

