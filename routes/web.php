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

// Route::get('/', 'Auth\LoginController@authenticate');
Route::get('/home', 'HomeController@index');

Route::get('/teacher', 'TeacherController@index');
Route::get('teacher/reserveRoom', 'TeacherController@reserveRoom');
Route::get('teacher/cancelReservation/{reservationID}', 'TeacherController@cancelReservation');
Route::get('teacher/editReservation/{reservationID}', 'TeacherController@editReservation');
Route::get('teacher/processEditReservation/{reservationID}', 'TeacherController@processEditReservation');
Route::post('teacher/checkReservationConflict', 'TeacherController@checkReservationConflict');

Route::get('/collegeSecretary', 'CollegeSecretaryController@dashboard');
Route::get('/collegeSecretary/set_declined/{id}', 'CollegeSecretaryController@set_declined');
Route::get('/collegeSecretary/set_approved/{id}', 'CollegeSecretaryController@set_approved');
Route::post('/collegeSecretary/add_teacher', 'CollegeSecretaryController@add_teacher');
Route::get('/collegeSecretary/add_regular_schedule', 'CollegeSecretaryController@addRegularSchedule');
Route::post('/collegeSecretary/process_add_regular_schedule','CollegeSecretaryController@processAddRegularSchedule');

Route::get('/dean', 'DeanController@dashboard');
Route::get('/dean/set_approved/{id}', 'DeanController@set_approved');
Route::get('/dean/set_declined/{id}', 'DeanController@set_declined');
