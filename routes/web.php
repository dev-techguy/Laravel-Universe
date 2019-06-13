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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/**
 * -------------------------
 * User Routes Start here
 * -------------------------
 */
Route::group([
    'prefix' => '/',
], function () {
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('logout', 'HomeController@logout')->name('user.logout');

    /**
     * ------------------------
     * start of notifications
     * routes for user
     * -------------------------
     */
    Route::group([
        'prefix' => 'mailbox',
    ], function () {
        Route::get('view', [
            'uses' => 'HomeController@latestMailBox',
            'as' => 'user.latest.mailbox',
        ]);
        Route::get('read/{id}', [
            'uses' => 'HomeController@readMailBox',
            'as' => 'user.read.mailbox',
        ]);
        Route::post('delete/single', [
            'uses' => 'HomeController@deleteSingleMail',
            'as' => 'user.delete.single.mailbox',
        ]);
        Route::get('all', [
            'uses' => 'HomeController@allMailBox',
            'as' => 'user.all.mailbox',
        ]);
        Route::get('delete/all', [
            'uses' => 'HomeController@deleteAllMails',
            'as' => 'user.delete.all.mailbox',
        ]);
    });
    /**
     * ----------------------------------
     * End of system notifications routes
     * ----------------------------------
     */
});
/**
 * -------------------------
 * End Of User Routes Start here
 * -------------------------
 */

/**
 * ---------------------------------
 * System admin routes start here
 * --------------------------------
 */
Route::group([
    'prefix' => 'sys/admin',
], function () {
    // Admin auth routes
    Route::group([
        'namespace' => 'Auth',
    ], function () {
        // Show the login page
        Route::get('/', 'LoginController@getAdminLoginPage');

        // Process the admin login request
        Route::post('/', [
            'uses' => 'LoginController@authenticateAdmin',
            'as' => 'admin.login',
        ]);
    });

    /**
     * admin functions
     */
    Route::get('/home', [
        'uses' => 'AdminController@adminDashBoard',
        'as' => 'admin.home',
    ]);
    Route::get('/profile', [
        'uses' => 'AdminController@adminProfile',
        'as' => 'admin.profile',
    ]);

    //change password for admin
    Route::get('/password', [
        'uses' => 'AdminController@passwordPage',
        'as' => 'admin.password',
    ]);
    Route::post('/password', [
        'uses' => 'AdminController@changePassword',
        'as' => 'admin.password',
    ]);

    //logout admin
    Route::get('/logout', [
        'uses' => 'AdminController@logout',
        'as' => 'admin.logout',
    ]);


    /**
     * ------------------------
     * start of notifications
     * routes for user
     * -------------------------
     */
    Route::group([
        'prefix' => 'mailbox',
    ], function () {
        Route::get('view', [
            'uses' => 'AdminController@latestMailBox',
            'as' => 'admin.latest.mailbox',
        ]);
        Route::get('read/{id}', [
            'uses' => 'AdminController@readMailBox',
            'as' => 'admin.read.mailbox',
        ]);
        Route::post('delete/single', [
            'uses' => 'AdminController@deleteSingleMail',
            'as' => 'admin.delete.single.mailbox',
        ]);
        Route::get('all', [
            'uses' => 'AdminController@allMailBox',
            'as' => 'admin.all.mailbox',
        ]);
        Route::get('delete/all', [
            'uses' => 'AdminController@deleteAllMails',
            'as' => 'admin.delete.all.mailbox',
        ]);
    });
    /**
     * ----------------------------------
     * End of system notifications routes
     * ----------------------------------
     */
});
/**
 * --------------------------------
 * End of system admin routes
 * -------------------------------
 */
