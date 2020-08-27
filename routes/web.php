<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Route::get('/', 'HomeController@index')->name('home');

route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
});


Route::group(['middleware' => ['auth', 'role:admin']], function () {
    // Route::get('/admin', function () {
    //     return "Halaman Admin";
    // });

    /** Users */
    Route::get('/user', 'UserController@index')->name('user');
    Route::post('/usertable', 'UserController@datatable')->name('user.datatable');
    Route::post('/user', 'UserController@store')->name('user.store');
    Route::get('/user/{user}/edit', 'UserController@edit')->name('user.edit');
    Route::patch('/user/{user}/update', 'UserController@update')->name('user.update');
    Route::get('/user/{user}/tes', 'UserController@tes')->name('user.tes');
});

Route::group(['middleware' => ['auth', 'role:user']], function () {
    // Route::get('/user', function () {
    //     return "Halaman User";
    // });
});
