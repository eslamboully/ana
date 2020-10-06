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

Route::group([], function () {

    // User Login
    Route::get('/login','HomeController@login')->name('login');
    Route::post('/login','HomeController@login_post')->name('login.post');

    // User Change Lang
    Route::get('/lang/{lang}','HomeController@lang')->name('lang');

    // User Home
    Route::group(['middleware' => 'auth'],function () {
        // Home Page
        Route::get('/','HomeController@index')->name('home');

        // Personal Very Small Board ( Add )
        Route::post('/very-small-board/add','HomeController@verySmallBoardAdd')->name('very.small.board.add');

        // Personal Very Small Board ( Remove )
        Route::post('/very-small-board/remove','HomeController@verySmallBoardRemove')->name('very.small.board.remove');

        // Personal VerySmall Board ( Change )
        Route::post('/very/small-board/Change','HomeController@verySmallBoardChange')->name('very.small.board.change');

        // Personal VerySmall Board ( Update )
        Route::post('/very/small-board/Update','HomeController@verySmallBoardUpdate')->name('very.small.board.update');

        // Personal VerySmall Board ( Comments )
        Route::post('/very/small-board/Comments','HomeController@verySmallBoardComments')->name('very.small.board.comments');

        // Personal Small Board ( Add )
        Route::post('/small-board/Add','HomeController@smallBoardAdd')->name('small.board.add');

        // Personal Small Board ( Change )
        Route::post('/small-board/change','HomeController@smallBoardChange')->name('small.board.change');

        // Personal Small Board ( Remove )
        Route::post('/small-board/remove','HomeController@smallBoardRemove')->name('small.board.remove');

        // User Logout
        Route::get('/logout','HomeController@logout')->name('logout');

    });




});
