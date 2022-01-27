<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CompanyController;

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
    Route::get('getCompany', 'CompanyController@getCompany');
    

Route::middleware(['auth:api'])->group(function () {
    // User Update and related activity
    
       Route::get('details', 'AuthController@details');
       Route::get('logout', 'AuthController@logout');

    
       // Company Users Functions

       Route::post('CreateUsers', 'CompanyController@CreateUsers');
       Route::put('UpdateCompany/{id}', 'CompanyController@UpdateCompany');
       Route::delete('destroy/{id}', 'CompanyController@destroy');
       Route::post('store', 'CompanyController@store');

       // Roles

       Route::post('storee', 'RoleController@store');
       Route::get('show', 'RoleController@show');
       Route::put('{roles}/attach', 'RoleController@attach');


       Route::put('{roles}/detach', 'RoleController@detach');
       Route::post('{roles}/delete', 'RoleController@delete');


      
   });       

});