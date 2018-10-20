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
Route::get('/cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
     $exitCode = Artisan::call('config:cache');
});
Route::get('/', 'Home\HomeController@home');
Route::get('/about-us', 'Home\HomeController@aboutUs');
Route::get('/contact-us', 'Contact\ContactController@contactUs');
Route::post('/contact/us/submit', 'Contact\ContactController@contactUsSubmit');

Route::get('/service/partnership-firm-registration', 'Service\ServiceController@partnershipFirmRegistration');

Route::get('/admin/login', 'Admin\Auth\LoginController@login');
Route::post('/admin/login', 'Admin\Auth\LoginController@loginAccess');
Route::group(['middleware' => 'adminToken'], function () {
	Route::get('/admin/dashboard', 'Admin\Home\AdminDashboardController@home');
	Route::get('/admin/logout', 'Admin\Auth\LoginController@logout');

	Route::get('/admin/users', 'Admin\Users\AdminUsersController@index');
	Route::get('/admin/user/edit/{user_id?}', 'Admin\Users\AdminUsersController@editUser');
	Route::post('/admin/user/update/{user_id?}', 'Admin\Users\AdminUsersController@updateUser');
	Route::get('/admin/user/delete/{user_id?}', 'Admin\Users\AdminUsersController@deleteUser');

});