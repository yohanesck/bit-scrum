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
Route::middleware(['cors'])->group(function () {
    Route::get('/employees', 'EmployeeController@index');
    Route::get('/building/{building}/floor/{floor}/employee', 'EmployeeController@getEmployeeByFloorBuilding');
    Route::get('/building/{building}/floor/{floor}/seat', 'SeatController@getDataSeatByFloor');
    Route::get('/employee/{employee}/coordinate', 'EmployeeController@getEmployeeCoordinate');
    Route::get('/employee/{employee}', 'EmployeeController@show');
    Route::get('/employee', 'EmployeeController@getByName');
    Route::get('/floor', 'SeatController@getFloor');
});
