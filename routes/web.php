<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

// General Routes...
Route::get('/', 'HomeController@index');
Route::get('/account', 'AccountController@index');
Route::post('/account', 'AccountController@index');
Route::get('/account/edit', 'AccountController@edit');
Route::patch('/account/edit', 'AccountController@update');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login/mentor', '\App\Http\Controllers\Auth\AuthController@mentorLogin');
Route::post('login/parent', '\App\Http\Controllers\Auth\AuthController@parentLogin');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Account Registration Routes...
Route::get('register/mentor', '\App\Http\Controllers\Auth\RegisterController@showMentorRegistrationForm');
Route::get('register/parent', '\App\Http\Controllers\Auth\RegisterController@showParentRegistrationForm');
Route::post('register/mentor', '\App\Http\Controllers\Auth\RegisterController@mentorRegister');
Route::post('register/parent', '\App\Http\Controllers\Auth\RegisterController@parentRegister');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Student Routes...
Route::get('/student/index', 'StudentController@registeredStudents');
Route::patch('/student/edit/{id}', 'StudentController@studentUpdate');
Route::get('/student/register', 'StudentController@showStudentRegistrationForm');
Route::post('/student/register', 'StudentController@studentRegister');

// Search Routes
Route::get('/search', 'SearchController@index');