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

// Admin
Route::group(['namespace' => 'Admin',
              'prefix' => 'admin',
              'middleware' => ['auth', 'setadminlocale'],
              'as' => 'admin.'], function() {

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

Route::get('/', 'HomeController@setLocale');

Route::group(['prefix' => '{locale}',
              'where' => ['locale' => '[a-zA-Z]{2}'],
              'middleware' => 'setlocale'], function() {

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/package/{name}_{id}.html', 'PackageController@show')
        ->name('package')
        ->where(['id' => '[0-9]+']);

    Route::get('/excursion/{name}_{id}.html', 'ExcursionController@show')
        ->name('excursion')
        ->where(['id' => '[0-9]+']);

    Route::get('/cruise/{name}_{id}.html', 'CruiseshipsController@show')
        ->name('cruise')
        ->where(['id' => '[0-9]+']);
});

Route::group(['prefix' => 'api', 'as' => 'api.'], function() {
  Route::group(['prefix' => 'forms', 'as' => 'forms.'], function() {
    Route::post('inquiries', 'InquiriesController@store')->name('inquiries');
  });
});

Route::get('/images/{id}/{image}', 'ImagesController@getClientHint')->name('images');