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

Route::group(['prefix' => 'admin','as' => 'admin.'], function () {

    // Admin Login
    Route::get('/login','HomeController@login')->name('login');
    Route::post('/login','HomeController@login_post')->name('login.post');

    // Admin Change Lang
    Route::get('/lang/{lang}','HomeController@lang')->name('lang');

    // Admin Home
    Route::group(['middleware' => 'admin.auth'],function () {
        // Home Page
        Route::get('/','HomeController@index')->name('home');

        // Admin Logout
        Route::get('/logout','HomeController@logout')->name('logout');

        // Packages
        Route::resource('packages','PackageController');

        // Users
        Route::resource('users','UserController');

        // Roles
        Route::resource('roles','RoleController')->only(['index']);

        // Read Permissions
        Route::get('roles/{id}/permissions','PermissionController@index')->name('permissions.index');

        // Show All Related Permissions
        Route::get('permissions','PermissionController@all_index')->name('permissions.all');

        // Store Permissions
        Route::get('roles/permissions','PermissionController@create')->name('permissions.create');
        Route::post('roles/permissions','PermissionController@store')->name('permissions.store');

        // Store Related Permissions
        Route::get('roles/permissions/{id}','PermissionController@create_related')->name('permissions.create_related');
        Route::post('roles/related/permissions','PermissionController@store_related')->name('permissions.store_related');

        // Destroy Permissions
        Route::delete('roles/permissions/{id}/destroy','PermissionController@destroy')->name('permissions.destroy');
    });




});
