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

    // User Register
    Route::get('/register','HomeController@register')->name('register');
    Route::post('/register','HomeController@register_post')->name('register.post');

    // User Change Lang
    Route::get('/lang/{lang}','HomeController@lang')->name('lang');

    Route::get('/','HomeController@site')->name('site');


    // User Home
    Route::group(['middleware' => 'auth'],function () {
        // Home Page
        Route::get('/home','HomeController@index')->name('home');
        // Profile
        Route::get('/profile','HomeController@profile')->name('profile');
        Route::post('/profile','HomeController@profilePost')->name('profile.post');
        // Messages
        Route::post('/board/send-message','HomeController@boardMessageSend')->name('board.message.send');
        Route::post('/board/response-messages','HomeController@boardResponseMessages')->name('board.response.messages');
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

        // Boards (view Board)
        Route::get('/board/{id}/{name}','BoardController@board')->name('board.index');
        Route::post('/board/store','BoardController@store')->name('board.store');

        // Boards Very Small Board ( Add )
        Route::post('board/very-small-board/add','BoardController@verySmallBoardAdd')->name('board.very.small.board.add');
        // Boards Very Small Board ( Remove )
        Route::post('board/very-small-board/remove','BoardController@verySmallBoardRemove')->name('board.very.small.board.remove');
        // Boards VerySmall Board ( Change )
        Route::post('board/very/small-board/Change','BoardController@verySmallBoardChange')->name('board.very.small.board.change');
        // Boards VerySmall Board ( Update )
        Route::post('board/very/small-board/Update','BoardController@verySmallBoardUpdate')->name('board.very.small.board.update');
        // Boards VerySmall Board ( Comments )
        Route::post('board/very/small-board/Comments','BoardController@verySmallBoardComments')->name('board.very.small.board.comments');
        // Boards VerySmall Board ( Information )
        Route::post('board/very/small-board/Info','BoardController@verySmallBoardInfo')->name('board.very.small.board.info');
        // Boards VerySmall Board ( Files )
        Route::post('board/very-small-board/Files','BoardController@verySmallBoardFiles')->name('board.very.small.board.files');
        // Boards Small Board ( Add )
        Route::post('board/small-board/Add','BoardController@smallBoardAdd')->name('board.small.board.add');
        // Boards Small Board ( Change )
        Route::post('board/small-board/change','BoardController@smallBoardChange')->name('board.small.board.change');
        // Boards Small Board ( Remove )
        Route::post('board/small-board/remove','BoardController@smallBoardRemove')->name('board.small.board.remove');
        Route::post('board/send-invitation','BoardController@sendInvitation')->name('board.send_invitation');
        Route::post('board/assign-user','BoardController@assignUser')->name('board.assign_user');
        Route::post('board/assign-user-next','BoardController@assignUserNext')->name('board.assign_user_next');

        // Boards Logs
        Route::post('board/logs','BoardController@boardLogs')->name('board.logs');
    });


    Route::get('board/accept-invitation','BoardController@acceptInvitation')->name('board.accept_invitation');
    Route::get('boards/all','BoardController@boards')->name('board.boards.all');
    Route::post('board/users-permissions-get','BoardController@usersPermissionsGet')->name('board.users.permissions.get');
    Route::post('board/users-permissions-update','BoardController@usersPermissionsUpdate')->name('board.users.permissions.update');

});
