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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

// Admin
Route::group(['namespace' => 'Admin',
              'prefix' => 'admin',
              'middleware' => ['auth'],
              'as' => 'admin.'], function() {

    App::setLocale('es');

    // Dashboard
    Route::get('dashboard.html', ['uses' => 'ShowDashboard', 'as' => 'dashboard']);

    Route::resource('regions', 'RegionsController')->except(['show']);
    Route::resource('destinations', 'DestinationsController')->except(['show']);
    Route::resource('currencies', 'CurrenciesController')->except(['show']);
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');