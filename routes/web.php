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
Route::get('/collegeSecretary', 'CollegeSecretaryController@dashboard');
Route::get('/collegeSecretary/set_declined/{id}', 'CollegeSecretaryController@set_declined');
Route::get('/collegeSecretary/set_approved/{id}', 'CollegeSecretaryController@set_approved');
Route::get('/reserveRoom', 'HomeController@reserveRoom');