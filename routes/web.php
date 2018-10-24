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

Route::get('/migrate', function() {
    \Artisan::call('migrate:refresh',['--seed' => ' ']);
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

	/******update delete edit view user******/
	Route::get('/admin/users', 'Admin\Users\AdminUsersController@index');
	Route::get('/admin/user/edit/{user_id?}', 'Admin\Users\AdminUsersController@editUser');
	Route::post('/admin/user/update/{user_id?}', 'Admin\Users\AdminUsersController@updateUser');
	Route::get('/admin/user/delete/{user_id?}', 'Admin\Users\AdminUsersController@deleteUser');

	/******update delete edit view questions******/
	Route::get('/admin/questions', 'Admin\Questions\AdminQuestionsController@index');
	Route::post('/admin/save/question', 'Admin\Questions\AdminQuestionsController@save');
	Route::get('/admin/edit/question/{question_id?}', 'Admin\Questions\AdminQuestionsController@edit');
	Route::post('/admin/update/question/{question_id?}', 'Admin\Questions\AdminQuestionsController@update');
	Route::get('/admin/delete/question/{question_id?}', 'Admin\Questions\AdminQuestionsController@delete');

	/******update delete edit view terms******/
	Route::get('/admin/terms', 'Admin\Terms\AdminTermsController@index');
	Route::post('/admin/save/term', 'Admin\Terms\AdminTermsController@save');
	Route::get('/admin/edit/term/{term_id?}', 'Admin\Terms\AdminTermsController@edit');
	Route::post('/admin/update/term/{term_id?}', 'Admin\Terms\AdminTermsController@update');
	Route::get('/admin/delete/term/{term_id?}', 'Admin\Terms\AdminTermsController@delete');

	/******update delete edit view Features******/
	Route::get('/admin/features', 'Admin\Features\AdminFeaturesController@index');
	Route::post('/admin/save/feature', 'Admin\Features\AdminFeaturesController@save');
	Route::get('/admin/edit/feature/{feature_id?}', 'Admin\Features\AdminFeaturesController@edit');
	Route::post('/admin/update/feature/{feature_id?}', 'Admin\Features\AdminFeaturesController@update');
	Route::get('/admin/delete/feature/{feature_id?}', 'Admin\Features\AdminFeaturesController@delete');

	/******update delete edit view documents******/
	Route::get('/admin/documents', 'Admin\Documents\AdminDocumentsController@index');
	Route::post('/admin/save/document', 'Admin\Documents\AdminDocumentsController@save');
	Route::get('/admin/edit/document/{document_id?}', 'Admin\Documents\AdminDocumentsController@edit');
	Route::post('/admin/update/document/{document_id?}', 'Admin\Documents\AdminDocumentsController@update');
	Route::get('/admin/delete/document/{document_id?}', 'Admin\Documents\AdminDocumentsController@delete');

	/******update delete edit view packages******/
	Route::get('/admin/packages', 'Admin\Packages\AdminPackagesController@index');
	Route::get('/admin/add/package', 'Admin\Packages\AdminPackagesController@add');
	Route::post('/admin/save/package', 'Admin\Packages\AdminPackagesController@save');
	Route::get('/admin/edit/package/{package_id?}', 'Admin\Packages\AdminPackagesController@edit');
	Route::post('/admin/update/package/{package_id?}', 'Admin\Packages\AdminPackagesController@update');
	Route::get('/admin/delete/package/{package_id?}', 'Admin\Packages\AdminPackagesController@delete');

});