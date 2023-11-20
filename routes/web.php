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

Auth::routes(['register' => true, 'verify' => true]);

Route::get('/','Frontend\DashboardController@index')->name('frontend.index');
Route::get('/dumpautoload', 'Frontend\DashboardController@dumpautoload')->name('dumpautoload');


//Verify email changes
Route::get('/email-verify', 'Frontend\Auth\VerificationController@show')->name('verification.notice');
Route::get('/email-verify/resend', 'Frontend\Auth\VerificationController@resend')->name('user.verification.resend');
Route::get('/email-verify/{id}/{hash}', 'Frontend\Auth\VerificationController@verify')->name('verification.verify');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified'], 'namespace' => 'Backend'], function () {
    /**AJAX Router */
	Route::any('ajax/{page}', function ($page) {
    	$app = app();
    	return App::call('App\Http\Controllers\Backend\\'.Str::singular(Str::studly($page)).'Controller@ajax');
	});
    /* Dashboard */
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');

    /* User */
    Route::resource('users', 'UserController', ['as' => 'admin']);
    /* Permission */
    Route::resource('permissions', 'PermissionController', ['as' => 'admin']);
    /**Roles */
    Route::resource('roles', 'RoleController', ['as' => 'admin']);
    /* Profile */
    Route::resource('profile', 'ProfileController', ['as' => 'admin'])->only(['index'])->middleware('password.confirm');
    Route::put('profile/update', 'ProfileController@update', ['as' => 'admin'])->name('admin.profile.update');

    /*article*/
    Route::resource('articles', 'ArticleController', ['as' => 'admin']);
    /*medical record*/
    Route::resource('medical-records', 'MedicalRecordController', ['as' => 'admin']);
});
