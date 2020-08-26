<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

// Route::get('/', 'HomeController@index')->name('home');
Route::get('/', 'DashboardController@index')->name('dashboard');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin', function () {
        return "Halaman Admin";
    });
});

Route::group(['middleware' => ['auth', 'role:user']], function () {
    Route::get('/user', function () {
        return "Halaman User";
    });
});
