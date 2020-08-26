<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Route::get('/', 'HomeController@index')->name('home');
Route::get('/', 'DashboardController@index')->name('dashboard');


Route::group(['middleware' => ['auth', 'role:admin']], function () {
    // Route::get('/admin', function () {
    //     return "Halaman Admin";
    // });

    /** Users */
    Route::get('/user', 'UserController@index')->name('user');
    Route::post('/user', 'UserController@store')->name('user.store');

    //ajaxUser
    Route::post('/ajaxuser', 'Ajax\AjaxUserController@index')->name('ajax.userget');
});

Route::group(['middleware' => ['auth', 'role:user']], function () {
    // Route::get('/user', function () {
    //     return "Halaman User";
    // });
});
