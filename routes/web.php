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

    Route::resource('currencies', 'CurrenciesController')->except(['show']);
    Route::post('currencies/order', 'CurrenciesController@order')->name('currency.order');    
    Route::resource('third-parties', 'ThirdPartiesController')->except(['show']);
    Route::post('homeslider/order', 'HomesliderController@order')->name('homeslider.order');
    Route::resource('pages', 'PagesController')->except(['show']);
    Route::post('pages/order', 'PagesController@order')->name('pages.order');

    Route::post('images', 'ImagesController@store')->name('images.store');
});

Auth::routes(['register' => false]);

Route::get('/', 'HomeController@setLocale')->name('cleanHome');
Route::get('/currency/{iso}', 'HomeController@setCurrency')->name('setCurrency');;

Route::group(['prefix' => '{locale}',
              'where' => ['locale' => '[a-zA-Z]{2}'],
              'middleware' => 'setlocale'], function() {

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/package/{name}_{id}.html', 'PackagesController@show')
        ->name('package')
        ->where(['id' => '[0-9]+']);

    Route::get('/packages/{name}.html', 'PackagesController@list')
        ->name('packages');

    Route::get('/excursion/{name}_{id}.html', 'ExcursionsController@show')
        ->name('excursion')
        ->where(['id' => '[0-9]+']);

    Route::get('/excursions/{name}.html', 'ExcursionsController@list')
        ->name('excursions');        

    Route::get('/cruise/{name}_{id}.html', 'CruiseshipsController@show')
        ->name('cruise')
        ->where(['id' => '[0-9]+']);

    Route::get('/cruiseships/{name}.html', 'CruiseshipsController@list')
        ->name('cruiseships');       
        
    Route::get('/pages/{slug}.html', 'PagesController@show')
        ->name('pages');
        
    Route::post('/search.html', 'SearchController@show')
        ->name('search');    

});

Route::group(['prefix' => 'api', 'as' => 'api.'], function() {
  Route::group(['prefix' => 'forms', 'as' => 'forms.'], function() {
    Route::post('inquiries', 'InquiriesController@store')->name('inquiries');
    Route::post('contact', 'ContactController@store')->name('contact');
  });
});