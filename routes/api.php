<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Bikes
    Route::post('bikes/media', 'BikesApiController@storeMedia')->name('bikes.storeMedia');
    Route::apiResource('bikes', 'BikesApiController');

    // Rentals
    Route::apiResource('rentals', 'RentalsApiController');


});

// CLIENT APIS

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Mobile\Client', 'middleware' => ['auth:api']], function () {



    Route::get('client/rented', 'ClientBikeController@getRentedBikes');
    Route::post('client/rent/{bike}', 'ClientBikeController@rentBike');
    Route::post('client/return/{rental}', 'ClientBikeController@return');
});

Route::post('/v1/client/nearby', 'Api\V1\Mobile\Client\ClientBikeController@getNearbyBikes');
Route::get('/v1/client/bike/{bike}', 'Api\V1\Mobile\Client\ClientBikeController@getBike');

Route::post('/auth/client/login' , 'Api\V1\Mobile\Client\ClientAuthController@login');
Route::post('/auth/client/signup' , 'Api\V1\Mobile\Client\ClientAuthController@signUp');
