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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Admin

Route::group(['prefix' => 'admin'], function () {
    Route::get('/home', 'AdminController@index')->name('admin.home');

    Route::group(['namespace' => 'AuthAdmin'], function () {
        Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
        Route::post('login', 'LoginController@login')->name('admin.login');
        Route::get('register', 'RegisterController@showRegisterForm')->name('admin.register');
        Route::post('register', 'RegisterController@register')->name('admin.register');
        Route::post('logout', 'loginController@logout')->name('admin.logout');
    });
});
