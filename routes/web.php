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

// Display and Set Players
Route::get('/','UserController@index');

// Display Scores and REST API of Scores
Route::resource('scores', 'ScoreController');

// REST API of Users
Route::resource('users', 'UserController');
