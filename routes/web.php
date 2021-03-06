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
    Route::get('profile', 'HomeController@profile')->name('user.profile');
    Route::get('password', 'HomeController@changePasswordPage')->name('user.change.password');
    Route::post('password', 'HomeController@changePassword')->name('user.change.password');
    Route::get('results', 'HomeController@results')->name('user.results');
    Route::get('print-results', 'HomeController@printResults')->name('user..print.results');
    Route::get('units', 'HomeController@units')->name('user.units');
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

    //Functions
    Route::get('view-programs', 'AdminController@viewPrograms')->name('view.programs');
    Route::get('view-units', 'AdminController@viewUnits')->name('view.units');
    Route::get('all-students', 'AdminController@viewAllStudents')->name('all.students');
    Route::get('verify/{id}', 'AdminController@verify')->name('verify');

    //Marks
    Route::get('one', 'AdminController@semesterOnePage')->name('semester.one');
    Route::post('one', 'AdminController@semesterOneMarks')->name('semester.one');
    Route::get('two', 'AdminController@semesterTwoPage')->name('semester.two');
    Route::post('two', 'AdminController@semesterTwoMarks')->name('semester.two');


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
