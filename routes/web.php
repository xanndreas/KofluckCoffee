<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Product Categories
    Route::delete('product-categories/destroy', 'ProductCategoriesController@massDestroy')->name('product-categories.massDestroy');
    Route::resource('product-categories', 'ProductCategoriesController');

    // Product Stuffs
    Route::delete('product-stuffs/destroy', 'ProductStuffController@massDestroy')->name('product-stuffs.massDestroy');
    Route::post('product-stuffs/media', 'ProductStuffController@storeMedia')->name('product-stuffs.storeMedia');
    Route::post('product-stuffs/ckmedia', 'ProductStuffController@storeCKEditorImages')->name('product-stuffs.storeCKEditorImages');
    Route::resource('product-stuffs', 'ProductStuffController');

    // Outlets
    Route::delete('outlets/destroy', 'OutletsController@massDestroy')->name('outlets.massDestroy');
    Route::post('outlets/media', 'OutletsController@storeMedia')->name('outlets.storeMedia');
    Route::post('outlets/ckmedia', 'OutletsController@storeCKEditorImages')->name('outlets.storeCKEditorImages');
    Route::resource('outlets', 'OutletsController');

    // Training Categories
    Route::delete('training-categories/destroy', 'TrainingCategoriesController@massDestroy')->name('training-categories.massDestroy');
    Route::resource('training-categories', 'TrainingCategoriesController');

    // Training Classes
    Route::delete('training-classes/destroy', 'TrainingClassController@massDestroy')->name('training-classes.massDestroy');
    Route::post('training-classes/media', 'TrainingClassController@storeMedia')->name('training-classes.storeMedia');
    Route::post('training-classes/ckmedia', 'TrainingClassController@storeCKEditorImages')->name('training-classes.storeCKEditorImages');
    Route::resource('training-classes', 'TrainingClassController');

    // Training Candidates
    Route::delete('training-candidates/destroy', 'TrainingCandidateController@massDestroy')->name('training-candidates.massDestroy');
    Route::resource('training-candidates', 'TrainingCandidateController');

    // Galleries
    Route::delete('galleries/destroy', 'GalleriesController@massDestroy')->name('galleries.massDestroy');
    Route::post('galleries/media', 'GalleriesController@storeMedia')->name('galleries.storeMedia');
    Route::post('galleries/ckmedia', 'GalleriesController@storeCKEditorImages')->name('galleries.storeCKEditorImages');
    Route::resource('galleries', 'GalleriesController');

    // Transaksis
    Route::delete('transaksis/destroy', 'TransaksiController@massDestroy')->name('transaksis.massDestroy');
    Route::resource('transaksis', 'TransaksiController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }
});