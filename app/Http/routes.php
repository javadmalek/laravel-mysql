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

Route::auth();

// Public routing
Route::get('/', 'HomeController@welcome');
Route::get('/home', 'HomeController@index');

// Purchaser routing
Route::group(['prefix' => 'purchaser'], function () {
    Route::get('/', 'Purchaser\DashboardController@index');

    Route::get('/companies', 'Purchaser\ProfileController@index');
    Route::get('/companies/edit', 'Purchaser\ProfileController@edit');
    Route::resource('/companies', 'Purchaser\ProfileController');

    Route::resource('/channels', 'Purchaser\ChannelController');
    Route::get('/channels/{_channel_id}/rfqs/create', 'Purchaser\RfqController@create');
    Route::get('/channels/{_channel_id}/rfqs/store', 'Purchaser\RfqController@store');
    Route::get('/channels/{_channel_id}/rfqs/edit/{id}', 'Purchaser\RfqController@edit');
    Route::get('/channels/{_channel_id}/rfqs/update/{id}', 'Purchaser\RfqController@update');
});

// Salesperson routing
Route::get('/salesperson', 'Salesperson\DashboardController@index');
