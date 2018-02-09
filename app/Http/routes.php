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
Route::get('/', 'Auth\AuthController@getLogin');
Route::get('/home', 'Auth\AuthController@getLogin');

// Purchaser routing
Route::group(['prefix' => 'purchaser'], function () {
    Route::get('/', 'Purchaser\DashboardController@index');

    // Company's profile actions
    Route::get('/companies', 'Purchaser\ProfileController@index');
    Route::get('/companies/edit', 'Purchaser\ProfileController@edit');
    Route::get('/companies/offersin', 'Purchaser\ProfileController@offersIn');
    Route::post('/companies/offersin/filter', 'Purchaser\ProfileController@filterOffersIn');
    Route::post('/companies/catalogs/filter', 'Purchaser\CompanyCatalogController@filter');
    Route::resource('/companies/catalogs', 'Purchaser\CompanyCatalogController');
    Route::group(['prefix' => '/companies/circles'], function (){
        Route::get('/', 'Purchaser\CircleController@index');
        Route::post('/filter', 'Purchaser\CircleController@filter');
        Route::get('/{_circle_id}/status/{_status}', 'Purchaser\CircleController@status');
        Route::get('/request/{_dst_company_id}', 'Purchaser\CircleController@request');
        Route::get('/request/', 'Purchaser\CircleController@receivedRequets');
    });
    Route::resource('/companies', 'Purchaser\ProfileController');

    // RFQ's actions
    Route::get('/channels/rfqs', 'Purchaser\ChannelController@showall');
    Route::post('/channels/rfqs/filter', 'Purchaser\ChannelController@filterShowall');
    Route::resource('/channels', 'Purchaser\ChannelController');
    Route::post('/channels/filter/{_channel_id}', 'Purchaser\ChannelController@filterRfqs');
    Route::post('/channels/filter/', 'Purchaser\ChannelController@filter');
    Route::resource('/channels/{_channel_id}/variables', 'Purchaser\ChannelVariableController');
    Route::post('/channels/{_channel_id}/{_rfq_id}/seemore', 'Purchaser\RfqController@seemore');
    Route::post('/channels/{_channel_id}/{_rfq_id}/{_offer_id}/{_deal_id}', 'Purchaser\RfqController@terminateDeal');
    Route::get('/channels/{_channel_id}/rfqs/{_rfq_id}/offers/{_offer_id}/status/{_status}', 'Purchaser\RfqController@status');
    Route::post('/channels/{_channel_id}/rfqs/{_rfq_id}/offers/{_offer_id}/status', 'Purchaser\RfqController@status1By1');
    Route::post('/channels/{_channel_id}/rfqs/{_rfq_id}/offers/{_offer_id}/invoice', 'Purchaser\RfqController@invoice');

    Route::post('/channels/{_channel_id}/rfqs/{_rfq_id}/specifications/store', 'Purchaser\RfqSpecificationController@store');
    Route::resource('/channels/{_channel_id}/rfqs/{_rfq_id}/specifications', 'Purchaser\RfqSpecificationController');
    Route::post('/channels/{_channel_id}/{_rfq_id}/duplicate', 'Purchaser\RfqController@duplicate');
    Route::post('/channels/{_channel_id}/{_rfq_id}/cancel', 'Purchaser\RfqController@cancel');
    Route::post('/channels/{_channel_id}/{_rfq_id}/extend', 'Purchaser\RfqController@extend');
    Route::post('/channels/{_channel_id}/{_rfq_id}/publish', 'Purchaser\RfqController@publish');
    Route::resource('/channels/{_channel_id}/rfqs', 'Purchaser\RfqController');

    Route::group(['prefix' => 'messages'], function () {
        Route::get('/compose', 'Purchaser\MessageController@compose');
        Route::post('/compose/send', 'Purchaser\MessageController@sendViaCompose');
        Route::post('/{_channel_id}/{_rfq_id}/{_offer_id}/{_receiver_id}/send', 'Purchaser\MessageController@sendViaRfq');
        Route::post('/{_channel_id}/{_rfq_id}/sendInvitation', 'Purchaser\MessageController@sendInvitation');
        Route::get('/inbox', 'Purchaser\MessageController@inbox');
        Route::get('/outbox', 'Purchaser\MessageController@outbox');
        Route::delete('/{_dir}/{id}', 'Purchaser\MessageController@delete');
        Route::get('/{_dir}/{_message_id}/show', 'Purchaser\MessageController@show');
    });
});

// Supplier routing
Route::group(['prefix' => 'supplier'], function () {
    Route::get('/', 'Supplier\DashboardController@index');

    Route::get('/companies', 'Supplier\ProfileController@index');
    Route::get('/companies/edit', 'Supplier\ProfileController@edit');
    Route::post('/companies/offersout/filter', 'Supplier\ProfileController@filterOffersOut');
    Route::get('/companies/offersout', 'Supplier\ProfileController@offersOut');

    Route::post('/companies/catalogs/filter', 'Supplier\CompanyCatalogController@filter');
    Route::resource('/companies/catalogs', 'Supplier\CompanyCatalogController');
    Route::group(['prefix' => '/companies/circles'], function ()
    {
        Route::get('/', 'Supplier\CircleController@index');
        Route::post('/filter', 'Supplier\CircleController@filter');
        Route::get('/{_circle_id}/status/{_status}', 'Supplier\CircleController@status');
        Route::get('/request/{_dst_company_id}', 'Supplier\CircleController@request');
        Route::get('/request/', 'Supplier\CircleController@receivedRequets');

    });
    Route::resource('/companies', 'Supplier\ProfileController');

    Route::group(['prefix' => 'channels'], function () {

        Route::get('/rfqs', 'Supplier\ChannelController@showall');
        Route::post('/rfqs/filter', 'Supplier\ChannelController@filterShowall');
        Route::get('/', 'Supplier\ChannelController@index');
        Route::post('/filter/', 'Supplier\ChannelController@filter');
        Route::get('/{id}', 'Supplier\ChannelController@show');

        Route::post('/{_channel_id}/{_rfq_id}/{_offer_id}/{_deal_id}', 'Supplier\RfqController@terminateDeal');
        Route::get('/{_channel_id}/rfqs/{_rfq_id}/offers/{_offer_id}/status/{_status}', 'Supplier\RfqController@status');
        Route::resource('/{_channel_id}/{_rfq_id}/offers', 'Supplier\RfqOfferController');
        Route::get('/{_channel_id}/{id}', 'Supplier\RfqController@show');
    });

    Route::group(['prefix' => 'messages'], function () {
        Route::get('/compose', 'Supplier\MessageController@compose');
        Route::post('/compose/send', 'Supplier\MessageController@sendViaCompose');
        Route::post('/{_channel_id}/{_rfq_id}/{_offer_id}/{_receiver_id}/send', 'Supplier\MessageController@sendViaRfq');

        // inbox and outbox could be merged together like _dir
        Route::get('/inbox', 'Supplier\MessageController@inbox');
        Route::get('/outbox', 'Supplier\MessageController@outbox');
        Route::delete('/{_dir}/{id}', 'Supplier\MessageController@delete');
        Route::get('/{_dir}/{_message_id}/show', 'Supplier\MessageController@show');
    });


});


//Route::get('/chat/fire', function () {
//    event(new App\Events\MessageSendEvent);
//    return "event fired";
//});

//Route::get('/chat/test', function () {
//    return view('chat.test');
//});