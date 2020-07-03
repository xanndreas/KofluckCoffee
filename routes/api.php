<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Product Categories
    Route::apiResource('product-categories', 'ProductCategoriesApiController');

    // Product Stuffs
    Route::post('product-stuffs/media', 'ProductStuffApiController@storeMedia')->name('product-stuffs.storeMedia');
    Route::apiResource('product-stuffs', 'ProductStuffApiController');

    // Outlets
    Route::post('outlets/media', 'OutletsApiController@storeMedia')->name('outlets.storeMedia');
    Route::apiResource('outlets', 'OutletsApiController');

    // Training Categories
    Route::apiResource('training-categories', 'TrainingCategoriesApiController');

    // Training Classes
    Route::post('training-classes/media', 'TrainingClassApiController@storeMedia')->name('training-classes.storeMedia');
    Route::apiResource('training-classes', 'TrainingClassApiController');

    // Training Candidates
    Route::apiResource('training-candidates', 'TrainingCandidateApiController');

    // Galleries
    Route::post('galleries/media', 'GalleriesApiController@storeMedia')->name('galleries.storeMedia');
    Route::apiResource('galleries', 'GalleriesApiController');

    // Transaksis
    Route::apiResource('transaksis', 'TransaksiApiController');
});