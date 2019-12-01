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
    Route::resource('availability', 'AvailabilityController')->except(['show']);
    Route::resource('duration', 'DurationController')->except(['show']);
    Route::resource('cruiseships', 'CruiseshipsController')->except(['show']);
    Route::resource('excursions', 'ExcursionsController')->except(['show']);
    Route::resource('packages', 'PackagesController')->except(['show']);
    Route::resource('users', 'UsersController')->except(['show']);
    Route::resource('inquiries', 'InquiriesController')->except(['show', 'create', 'store']);
    Route::resource('homeslider', 'HomesliderController')->except(['show']);
    Route::post('homeslider/order', 'HomesliderController@order')->name('homeslider.order');

    Route::post('images', 'ImagesController@store')->name('images.store');
});

Auth::routes(['register' => false]);

Route::get('/', 'HomeController@setLocale');

Route::group(['prefix' => '{locale}',
              'where' => ['locale' => '[a-zA-Z]{2}'],
              'middleware' => 'setlocale'], function() {

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/package/{name}_{id}.html', 'ProductController@showPackage')
        ->name('package')
        ->where(['id' => '[0-9]+']);

    Route::get('/excursion/{name}_{id}.html', 'ProductController@showExcursion')
        ->name('excursion')
        ->where(['id' => '[0-9]+']);

    Route::get('/cruise/{name}_{id}.html', 'ProductController@showCruiseship')
        ->name('cruise')
        ->where(['id' => '[0-9]+']);
});

Route::group(['prefix' => 'api', 'as' => 'api.'], function() {
  Route::group(['prefix' => 'forms', 'as' => 'forms.'], function() {
    Route::post('inquiries', 'InquiriesController@store')->name('inquiries');
  });
});