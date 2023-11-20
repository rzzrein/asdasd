<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::name('api.v1.')
->namespace('Api')
->prefix('v1')
->group(function () {
    // Route::get('/', 'ApiController@index')->name('index');
    // Route::post('/auth/login', 'AuthController@login')->name('auth.login');
    // Route::post('/auth/signup', 'AuthController@signup')->name('auth.signup');
    // Route::get('/roles/get-roles', 'RoleController@getRoles')->name('roles.getroles');

    // Route::post('/auth/req_reset', 'AuthController@req_reset')->name('auth.req_reset');
    // Route::post('/auth/reset', 'AuthController@reset')->name('auth.reset');
    // Route::middleware('auth:sanctum')->group(function () {
    //     Route::post('/auth/logout', 'AuthController@logout')->name('auth.logout');
    //     Route::get('/users/get-profile', 'UserController@getProfile')->name('users.getprofile');
    //     Route::post('/users/update-profile', 'UserController@updateProfile')->name('users.updateprofile');
    //     Route::post('/users/update-avatar', 'UserController@updateAvatar')->name('users.updateavatar');
    // });    
});