<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => 'auth', 'prefix' => 'abl'], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::get('change-password', 'AuthController@changePasswordForm')->name('change-password');
        Route::post('update-password', 'AuthController@updatePassword')->name('update-password');
    });

    Route::group(['middleware' => 'root', 'prefix' => 'root'], function () {
        Route::resource('users', 'UserController');
        Route::put('/{id}/toggle-user-status', 'UserController@toggleUserStatus')->name('toggle-user-status');
    });

    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::group(['prefix' => 'feature'], function () {
        Route::get('/{name}/show', 'FeatureController@show')->name('feature-detail');
        Route::get('/{name}/treatments', 'FeatureController@showTreatments')->name('feature-treatments');
        Route::get('/{name}/activation', 'FeatureController@featureActivation')->name('feature-activation');
        Route::get('/{name}/overrides', 'FeatureController@featureOverrides')->name('feature-overrides');

        Route::post('/{name}/overrides', 'FeatureController@addFeatureOverride')->name('add-override');
        Route::delete('/{name}/override/{value}', 'FeatureController@deleteFeatureOverride')->name('delete-override');

        Route::get('/', 'FeatureController@index')->name('features');
        Route::get('/create', 'FeatureController@create')->name('create-feature');
        Route::post('/store', 'FeatureController@store')->name('store-feature');
        Route::put('/{name}/update', 'FeatureController@update')->name('update-feature');

        Route::post('/{name}/treatment', 'FeatureController@addTreatment')->name('add-treatment');
        Route::put('/{name}/treatment/{treatment}', 'FeatureController@updateTreatment')->name('update-treatment');

        Route::post('/{name}/application/activate', 'FeatureController@activateApplication')->name('activate-application');

        Route::get('/{name}/stage/{stage}/application/{application}/activate', 'FeatureController@modifyAllocation')->name('modify-allocations');
        Route::put('/{name}/stage/{stage}/application/{application}/activate', 'FeatureController@updateAllocations')->name('update-allocations');
        Route::put('/{name}/stage/{stage}/application/{application}/toggle', 'FeatureController@toggleOverrides')->name('toggle-overrides');
        Route::put('/{name}/stage/{stage}/application/{application}/pause', 'FeatureController@pauseFeature')->name('pause-feature');
        Route::put('/{name}/stage/{stage}/application/{application}/play', 'FeatureController@playFeature')->name('play-feature');
    });

    Route::group(['prefix' => 'application'], function () {
        Route::get('/', 'ApplicationController@index')->name('applications');

        Route::get('/{id}/edit', 'ApplicationController@showUpdateForm')->name('edit-application');
        Route::post('/{id}/update', 'ApplicationController@update')->name('update-application');

        Route::get('/create', 'ApplicationController@create')->name('create-application');
        Route::post('/create', 'ApplicationController@store')->name('store-application');
    });

    Route::group(['prefix' => 'setting'], function () {
        Route::get('/', 'SettingController@index')->name('ab-lab-setting');
    });

});


require __DIR__ . '/auth.php';
