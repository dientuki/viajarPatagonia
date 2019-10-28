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
    //Route::get('dashboard.html', ['uses' => 'ShowDashboard', 'as' => 'dashboard']);
    Route::get('dashboard.html', ['uses' => 'PackagesController@index', 'as' => 'dashboard']);

    Route::resource('regions', 'RegionsController')->except(['show']);
    Route::resource('destinations', 'DestinationsController')->except(['show']);
    Route::resource('currencies', 'CurrenciesController')->except(['show']);
    Route::resource('languages', 'LanguagesController')->except(['show']);
    Route::resource('cruiseships-types', 'CruiseshipsTypesController')->except(['show']);
    Route::resource('excursions-types', 'ExcursionsTypesController')->except(['show']);
    Route::resource('cruiseships', 'CruiseshipsController')->except(['show']);
    Route::resource('excursions', 'ExcursionsController')->except(['show']);
    Route::resource('packages', 'PackagesController')->except(['show']);

    Route::post('images', 'ImagesController@store')->name('images.store');
});

Auth::routes(['register' => false]);

Route::get('/package/{id}', 'PackageController@show')
  ->name('package')
  ->where(['id' => '[0-9]+']);