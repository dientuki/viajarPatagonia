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

// Admin
Route::group(['namespace' => 'Admin',
              'prefix' => 'admin',
              'middleware' => ['auth',],
              'as' => 'admin::'], function() {

    // Dashboard
    Route::get('dashboard.html', ['uses' => 'ShowDashboard', 'as' => 'dashboard']);
});

// Login
Route::group(['prefix' => 'user',
              'middleware' => ['web'],
              'as' => 'user::'], function() {

    // Login Routes...
    Route::get('login.html', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login.html', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

    // Password Reset Routes...
    Route::get('password/reset.html', ['as' => 'password.reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
    Route::get('password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
    Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'Auth\ResetPasswordController@reset']);
});