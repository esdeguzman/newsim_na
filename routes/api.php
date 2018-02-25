<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
use Illuminate\Http\Request;

Route::group(['middleware' => ['auth:api']], function () {

    Route::resource('users', 'Api\UserController', [
        'only' => ['index', 'show'],
        'names' => ['index' => 'api.users.index', 'show' => 'api.users.show']
    ]);

    Route::resource('branches', 'Api\BranchController', [
        'only' => ['index', 'show'],
        'names' => ['index' => 'api.branches.index', 'show' => 'api.branches.show']
    ]);

    Route::resource('departments', 'Api\DepartmentController', [
        'only' => ['index', 'show'],
        'names' => ['index' => 'api.departments.index', 'show' => 'api.departments.show']
    ]);

    Route::resource('positions', 'Api\PositionController', [
        'only' => ['index', 'show'],
        'names' => ['index' => 'api.positions.index', 'show' => 'api.positions.show']
    ]);

    Route::group(['prefix' => 'temporary-access'], function () {
        Route::get('grant', 'Api\TemporaryAccess@grant')->name('api.temporary-access.grant');
        Route:: get('revoke', 'Api\TemporaryAccess@revoke')->name('api.temporary-access.revoke');
    });

    Route::get('user', 'Api\UserController@user')->name('api.user.show');

});
