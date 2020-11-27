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

Route::post('/auth/client' , 'Api\V1\Mobile\Client\ClientAuthController@login');
