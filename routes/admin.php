<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
Route::group(['prefix' => 'admin'], function () {
    Config::set('auth.defines', 'admin:admin');
    Route::get('login', 'Admin\AdminController@login')->name('admin.login');
    Route::post('login', 'Admin\AdminController@dologin')->name('admin.dologin');
    Route::get('reset/password', 'Admin\AdminController@forgetPassword')->name('admin.forget.password');
    Route::group(['middleware' => 'admin:admin'], function () {

        Route::get('/', function () {

            return view('admin.home');
        })->name('admin.dashboard');
        Route::get('logout','Admin\AdminController@logout')->name('admin.logout');
    });
});
