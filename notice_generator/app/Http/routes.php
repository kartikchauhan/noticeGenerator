<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::auth();

Route::get('/home', 'HomeController@index');
Route::post('/home', 'HomeController@categorizeNotice');
Route::post('/save', 'HomeController@saveNotice');

Route::get('/student/login', 'StudentController@showLoginForm');
Route::post('/student/login', 'StudentController@login');

Route::get('/student/register', 'StudentController@showRegistrationForm');
Route::post('/student/register', 'StudentController@register');

// Route::get('search', 'SearchController@search');
// Route::post('search', 'SearchController@getNames');