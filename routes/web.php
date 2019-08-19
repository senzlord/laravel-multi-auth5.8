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

Route::get('/', function () {
    return view('layouts.app');
});

Route::prefix('acadmin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
});

Route::prefix('u')->group(function() {
    Auth::routes(['verify' => true]);
    Route::group(['middleware' => ['verified']], function () {
        Route::get('/dashboard', 'DashboardController@index')->name('user.dashboard');
    });
});

Route::group(['middleware' => ['verified']], function () {
    Route::get('/', 'DashboardController@index')->name('user.dashboard');
});
//User Must Verify Before Using Any Feature.

