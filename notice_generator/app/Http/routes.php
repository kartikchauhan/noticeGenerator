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

Route::get('home', 'HomeController@homePage');
Route::post('home', 'HomeController@categorizeNotices');


Route::auth();

// changing name of HomeController to AdminController
Route::get('/admin/login', 'AdminController@showLoginForm');
Route::post('/admin/login', 'AdminController@login');
Route::get('/admin/dashboard', 'AdminController@dashboard');
// Route::get('/admin', 'AdminController@dashboard');
Route::post('/admin', 'AdminController@categorizeNotice');
Route::post('/save', 'AdminController@saveNotice');

Route::get('/admin/logout', 'AdminController@logout');

// code for multiAuth

// Route::group(['middleware' => ['web']], function () {
//     //Login Routes...
//     Route::get('/student/login','studentAuth\StudentAuthController@showLoginForm');
//     Route::post('/student/login','studentAuth\StudentAuthController@login');
//     Route::get('/student/logout','studentAuth\StudentAuthController@logout');

//     // Registration Routes...
//     Route::get('student/register', 'studentAuth\StudentAuthController@showRegistrationForm');
//     Route::post('student/register', 'studentAuth\StudentAuthController@register');

//     Route::get('/student', 'StudentController@index');

// });  


// following routes are for the project till changes were made for multiauth

Route::get('/student/login', 'StudentController@showLoginForm');
Route::post('/student/login', 'StudentController@login');
Route::get('/student/dashboard', 'StudentController@dashboard');

Route::get('/student/register', 'StudentController@showRegistrationForm');
Route::post('/student/register', 'StudentController@register');

Route::get('/student/logout', 'StudentController@logout');

Route::get('search', 'SearchController@search');
Route::post('search', 'SearchController@getNames');