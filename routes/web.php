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
    Route::get('/user/user', 'UserController@userTes')->name('user.userTes');


    Route::post('/usertable', 'UserController@datatable')->name('user.datatable');
    Route::post('/user', 'UserController@store')->name('user.store');
    Route::get('/user/{user}/edit', 'UserController@edit')->name('user.edit');
    Route::patch('/user/{user}/update', 'UserController@update')->name('user.update');
    Route::delete('/user/{user}/delete', 'UserController@delete')->name('user.delete');

    //User trash
    Route::get('/usertrash', 'UserController@trash')->name('user.trash');
    Route::post('/usertrashtable', 'UserController@trashedDatatable')->name('user.trashedTable');
    Route::post('/usertrash/{user}/restore', 'UserController@restore')->name('user.restore');
    Route::delete('/usertrash/{user}/destroy', 'UserController@destroy')->name('user.destroy');

    //Activity
    Route::get('/activity', 'ActivityController@index')->name('act');
    Route::post('/activity/data', 'ActivityController@datatable')->name('act.data');
    Route::get('/activity/{activity}/show', 'ActivityController@show')->name('act.show');


    Route::get('/user/{user}/tes', 'UserController@tes')->name('user.tes');

    //Protected Page
    Route::get('/adminpage', function () {
        return view('protectedPage.admin', ['title' => 'Halaman Admin', 'page' => 'adminpage']);
    })->name('protected.admin');
});

Route::group(['middleware' => ['auth', 'role:user']], function () {


    Route::get('/userpage', function () {
        return view('protectedPage.user', ['title' => 'Halaman User', 'page' => 'userpage']);
    })->name('protected.user');
});
