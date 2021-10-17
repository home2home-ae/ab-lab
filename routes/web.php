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
    return view('welcome');
});

Route::get('/test', function () {

    $model = \App\Models\Feature::first();


    $job = new \App\Jobs\RefreshFeatureInfoToRedisJob($model);

    $data = $job->handle();

    dd($data);

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

    Route::get('/feature/{name}/show', 'FeatureController@show')->name('feature-detail');
    Route::get('/feature/{name}/treatments', 'FeatureController@showTreatments')->name('feature-treatments');
    Route::get('/feature/{name}/activation', 'FeatureController@featureActivation')->name('feature-activation');
    Route::get('/feature/{name}/overrides', 'FeatureController@featureOverrides')->name('feature-overrides');

    Route::post('/feature/{name}/overrides', 'FeatureController@addFeatureOverride')->name('add-override');
    Route::delete('/feature/{name}/override/{value}', 'FeatureController@deleteFeatureOverride')->name('delete-override');

    Route::get('/features', 'FeatureController@index')->name('features');
    Route::get('/feature/create', 'FeatureController@create')->name('create-feature');
    Route::post('/feature/store', 'FeatureController@store')->name('store-feature');
    Route::put('/feature/{name}/update', 'FeatureController@update')->name('update-feature');

    Route::post('/feature/{name}/treatment', 'FeatureController@addTreatment')->name('add-treatment');
    Route::put('/feature/{name}/treatment/{treatment}', 'FeatureController@updateTreatment')->name('update-treatment');

    Route::post('/feature/{name}/application/activate', 'FeatureController@activateApplication')->name('activate-application');

    Route::get('/feature/{name}/stage/{stage}/application/{application}/activate', 'FeatureController@modifyAllocation')->name('modify-allocations');
    Route::put('/feature/{name}/stage/{stage}/application/{application}/activate', 'FeatureController@updateAllocations')->name('update-allocations');
});


require __DIR__ . '/auth.php';
