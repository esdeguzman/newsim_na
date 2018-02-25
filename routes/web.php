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
use Illuminate\Http\Request;

Auth::routes();
Route::resource('applications', 'ApplicationController');
Route::resource('users', 'UserController');

Route::get('/', function () {return view('welcome');});
Route::get('logout/{id}', 'UserController@logout')->name('users.logout');
Route::get('change_status/{id}', 'UserController@changeStatus')->name('users.change_status');
Route::get('dashboard', 'HomeController@index');
Route::get('change-password/{id}', 'UserController@changePassword')->name('change-password');
Route::put('process-password-change/{id}', 'UserController@processPasswordChange')->name('process-password-change');
Route::get('test', function() {
    $users = \App\User::all();
    foreach($users as $user) {
        $user->type = 'default';
        $user->save();
    }
    $user = \App\User::find(2);
    $user->type = 'super-admin';
    $user->save();
});

Route::get('sample', function() {
    $faker = Faker\Factory::create();
    $users = \App\User::all();
    $chiefs = \App\User::select('id')->where('chief', 1)->get();
    $chief_ids = [];

    foreach ($chiefs as $chief) {
        $chief_ids[] = $chief->id;
    }

    foreach ($users as $user) {
        $user->chief_id = $faker->randomElement($chief_ids);
        $user->save();
    }

    return \App\User::where('chief_id', 3)->get();
});
