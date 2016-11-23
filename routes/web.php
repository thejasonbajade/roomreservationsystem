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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/reserveRoom', 'HomeController@reserveRoom');

Route::get('/cancelReservation/{reservationID}', 'HomeController@cancelReservation');

Route::get('/editReservation/{reservationID}', 'HomeController@editReservation');

Route::get('/processEditReservation/{reservationID}', 'HomeController@processEditReservation');

Route::post('/checkReservationConflict', 'HomeController@checkReservationConflict');