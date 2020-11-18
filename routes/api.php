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

Route::get('/', 'UserController@index');

Route::get('/employee/{employee}', 'EmployeeController@show');
Route::get('/employee', 'EmployeeController@showName');
Route::get('/employee?name=', 'EmployeeController@getByName');
