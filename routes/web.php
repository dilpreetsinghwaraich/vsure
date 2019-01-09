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
    return Redirect::back();
});

Route::get('/', 'Home\HomeController@home');
Route::get('/blog', 'Blog\BlogController@blog');
Route::post('/contact/us/submit', 'Contact\ContactController@contactUsSubmit');
Route::post('/phone/otp/send/varification', 'Contact\ContactController@phoneOtpSendVarification');
Route::post('/submit/service/enquery', 'Contact\ContactController@enquerySubmit');
Route::post('/email/subscribe', 'Contact\ContactController@emailSubscribe');

Route::get('/service/{service_slug?}', 'Service\ServiceController@partnershipFirmRegistration');

Route::get('auth/register','Auth\RegisterController@registerForm');
Route::post('auth/register','Auth\RegisterController@create');
Route::post('/auth/login', 'Auth\LoginController@loginAccess');
Route::post('/auth/forgot/password', 'Auth\ForgotPasswordController@forgotPassword');
Route::get('/auth/logout', 'Auth\LoginController@logout');
Route::get('/auth/reset/forgot/password/{activation_key?}', 'Auth\ForgotPasswordController@resetForgotPassword');
Route::post('/auth/reset/forgot/password/{activation_key?}', 'Auth\ForgotPasswordController@updateForgotPassword');
Route::get('/getStatesByCountryID/{country_id?}', function ($country_id = 0){
	echo Helper::getStatesByCountryID($country_id);
	die;
});
Route::get('/getCitiesByStateID/{state_id?}', function ($state_id = 0){
	echo Helper::getCitiesByStateID($state_id);
	die;
});
Route::get('varify/email/link/{key?}', 'Profile\ProfileController@varifyEmailLinkWithKey'); 
Route::group(['middleware' => 'userToken'], function () {
	Route::get('/my-account', 'Dashboard\DashboardController@dashboard');

	Route::get('/my-profile', 'Profile\ProfileController@profile');
	Route::post('update/profile/image','Profile\ProfileController@updateProfileImage');
	Route::get('/edit/profile', 'Profile\ProfileController@editProfile');
	Route::post('/update/profile', 'Profile\ProfileController@updateProfile');
	Route::get('getStateCity/{state?}', 'Profile\ProfileController@getStateCity'); 
	Route::post('varify/email', 'Profile\ProfileController@varifyEmail');

	Route::get('/my-order', 'Orders\OrdersController@orders');
	Route::get('/order/view/{invoice_id?}', 'Orders\OrdersController@invoice');
	Route::get('/generate/print/{invoice_id?}', 'Orders\OrdersController@print');
	Route::get('/generate/pdf/{invoice_id?}', 'Orders\OrdersController@pdf');
	Route::get('/view/order/invoice/{invoice_id?}', 'Orders\OrdersController@invoice');

	Route::get('/my-service-request', 'ServiceRequest\ServiceRequestController@serviceRequest');
	Route::get('/help/desk/ticket/{ticket?}', 'ServiceRequest\ServiceRequestController@index');
	Route::get('/view/help/desk/ticket/{ticket?}', 'ServiceRequest\ServiceRequestController@view');
	Route::post('/submit/help/desk/ticket/{ticket?}', 'ServiceRequest\ServiceRequestController@update');

	Route::get('/my-documents', 'Document\DocumentController@document');
	Route::post('/user/upload/document', 'Document\DocumentController@uploadDocument');
	Route::get('/user/delete/uploaded/document/{u_document_id?}', 'Document\DocumentController@delete');

	Route::get('/my-notifications', 'Notifications\NotificationsController@notifications');
	Route::post('/send/notification', 'Notifications\NotificationsController@save');

	Route::get('/my-deliverable', 'Deliverable\DeliverableController@deliverable');
	Route::get('/user/view/deliverable/{ticket?}', 'Deliverable\DeliverableController@viewDeliverable');

	Route::get('select/service/packages/{ticket?}', 'Checkout\CheckoutController@servicePackages');
	Route::get('checkout/{package_id?}', 'Checkout\CheckoutController@checkout');
	Route::post('complete/order/{package_id?}', 'Checkout\CheckoutController@completeOrder');

	Route::get('checkout/invoice/{invoice_id?}', 'Checkout\CheckoutController@checkoutInvoive');
	Route::post('payment/{invoice_id?}', 'Razorpay\RazorpayController@payment')->name('payment');

	Route::get('paypal/{invoice_id?}', 'Paypal\PaypalController@postPaymentWithPaypal');
	Route::get('paypal/checkout/completed/{invoice_id?}', 'Paypal\PaypalController@completed');
	Route::get('paypal/checkout/cancel/{invoice_id?}', 'Paypal\PaypalController@cancelled');
	Route::get('webhook/paypal/ipn/{invoice_id?}', 'Paypal\PaypalController@webhook');
});

Route::get('/admin/login', 'Admin\Auth\LoginController@login');
Route::post('/admin/login', 'Admin\Auth\LoginController@loginAccess');

Route::group(['middleware' => 'editorToken'], function () {

	Route::get('/admin/dashboard', 'Admin\Home\AdminDashboardController@home');
	Route::get('/admin/logout', 'Admin\Auth\LoginController@logout');

	/******update delete edit view post******/
	Route::get('/admin/media', 'Admin\Media\AdminMediaController@index');
	Route::post('/admin/save/media', 'Admin\Media\AdminMediaController@save');
	Route::get('/admin/view/media/{post_id?}', 'Admin\Media\AdminMediaController@view');
	Route::get('/admin/delete/media/{post_id?}', 'Admin\Media\AdminMediaController@delete');

	/******update delete edit view post******/
	Route::get('/admin/posts', 'Admin\Post\AdminPostController@index');
	Route::get('/admin/add/post', 'Admin\Post\AdminPostController@add');
	Route::post('/admin/save/post', 'Admin\Post\AdminPostController@save');
	Route::get('/admin/edit/post/{post_id?}', 'Admin\Post\AdminPostController@edit');
	Route::post('/admin/update/post/{post_id?}', 'Admin\Post\AdminPostController@update');
	Route::get('/admin/delete/post/{post_id?}', 'Admin\Post\AdminPostController@delete');

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

	/******update delete edit view ProccessResults******/
	Route::get('/admin/process/results', 'Admin\ProcessResults\AdminProcessResultsController@index');
	Route::post('/admin/save/process/result', 'Admin\ProcessResults\AdminProcessResultsController@save');
	Route::get('/admin/edit/process/result/{process_id?}', 'Admin\ProcessResults\AdminProcessResultsController@edit');
	Route::post('/admin/update/process/result/{process_id?}', 'Admin\ProcessResults\AdminProcessResultsController@update');
	Route::get('/admin/delete/process/result/{process_id?}', 'Admin\ProcessResults\AdminProcessResultsController@delete');
	Route::get('/admin/clone/process/result/{process_id?}', 'Admin\ProcessResults\AdminProcessResultsController@clone');

	/******update delete edit view documents******/
	Route::get('/admin/documents', 'Admin\Documents\AdminDocumentsController@index');
	Route::post('/admin/save/document', 'Admin\Documents\AdminDocumentsController@save');
	Route::get('/admin/edit/document/{document_id?}', 'Admin\Documents\AdminDocumentsController@edit');
	Route::post('/admin/update/document/{document_id?}', 'Admin\Documents\AdminDocumentsController@update');
	Route::get('/admin/delete/document/{document_id?}', 'Admin\Documents\AdminDocumentsController@delete');
	Route::get('/admin/clone/document/{document_id?}', 'Admin\Documents\AdminDocumentsController@clone');

	/******update delete edit view packages******/
	Route::get('/admin/packages', 'Admin\Packages\AdminPackagesController@index');
	Route::get('/admin/add/package', 'Admin\Packages\AdminPackagesController@add');
	Route::post('/admin/save/package', 'Admin\Packages\AdminPackagesController@save');
	Route::get('/admin/edit/package/{package_id?}', 'Admin\Packages\AdminPackagesController@edit');
	Route::post('/admin/update/package/{package_id?}', 'Admin\Packages\AdminPackagesController@update');
	Route::get('/admin/delete/package/{package_id?}', 'Admin\Packages\AdminPackagesController@delete');
	Route::get('/admin/clone/package/{package_id?}', 'Admin\Packages\AdminPackagesController@clone');

	/******update delete edit view Services******/
	Route::get('/admin/services', 'Admin\Services\AdminServicesController@index');
	Route::get('/admin/add/service', 'Admin\Services\AdminServicesController@add');

	Route::get('/admin/get/service/remote/package', 'Admin\Services\AdminServicesController@getServiceRemotePackage');
	Route::get('/admin/get/service/remote/question', 'Admin\Services\AdminServicesController@getServiceRemoteQuestion');
	Route::get('/admin/get/service/remote/feature', 'Admin\Services\AdminServicesController@getServiceRemoteFeature');
	Route::get('/admin/get/service/remote/document', 'Admin\Services\AdminServicesController@getServiceRemoteDocument');
	Route::get('/admin/get/service/remote/process/results', 'Admin\Services\AdminServicesController@getServiceRemoteProcessResults');
	
	Route::post('/admin/save/service', 'Admin\Services\AdminServicesController@save');
	Route::get('/admin/edit/service/{service_id?}', 'Admin\Services\AdminServicesController@edit');
	Route::post('/admin/update/service/{service_id?}', 'Admin\Services\AdminServicesController@update');
	Route::get('/admin/clone/service/{service_id?}', 'Admin\Services\AdminServicesController@clone');
	Route::get('/admin/delete/service/{service_id?}', 'Admin\Services\AdminServicesController@delete');
	
});
Route::group(['middleware' => 'adminToken'], function () {	

	/******update delete edit view page******/
	Route::get('/admin/pages', 'Admin\Page\AdminPageController@index');
	Route::get('/admin/add/page', 'Admin\Page\AdminPageController@add');
	Route::post('/admin/save/page', 'Admin\Page\AdminPageController@save');
	Route::get('/admin/edit/page/{post_id?}', 'Admin\Page\AdminPageController@edit');
	Route::post('/admin/update/page/{post_id?}', 'Admin\Page\AdminPageController@update');
	Route::get('/admin/delete/page/{post_id?}', 'Admin\Page\AdminPageController@delete');

	/******update delete edit view Inbox******/
	Route::get('/admin/inboxs', 'Admin\NotificationInbox\AdminNotificationInboxController@index');
	Route::get('/admin/get/inbox/remote/user', 'Admin\NotificationInbox\AdminNotificationInboxController@getInboxRemoteUser');
	Route::post('/admin/send/notification', 'Admin\NotificationInbox\AdminNotificationInboxController@save');
	Route::get('/admin/view/inbox/{uuid?}', 'Admin\NotificationInbox\AdminNotificationInboxController@view');
	Route::get('/admin/delete/inbox/{uuid?}', 'Admin\NotificationInbox\AdminNotificationInboxController@delete');


	/******Contact Form Request Menu Route******/
	Route::get('/admin/contact/request', 'Admin\NotificationInbox\AdminNotificationInboxController@contactRequest');

	/******Contact Form Request Menu Route******/
	Route::get('/admin/service/requests', 'Admin\ServiceRequest\AdminServiceRequestController@index');
	Route::get('/admin/view/service/request/{ticket?}', 'Admin\ServiceRequest\AdminServiceRequestController@view');
	Route::get('/admin/delete/service/request/{ticket?}', 'Admin\ServiceRequest\AdminServiceRequestController@delete');
	Route::get('/admin/submit/service/request/deliverable/{ticket?}', 'Admin\ServiceRequest\AdminServiceRequestController@submitDeliverable');
	Route::post('/admin/submit/service/request/deliverable/{ticket?}', 'Admin\ServiceRequest\AdminServiceRequestController@insertDeliverable');
	Route::get('/admin/delete/service/request/deliverable/{deliverable_id?}', 'Admin\ServiceRequest\AdminServiceRequestController@deleteDeliverable');

	/******Contact Form Request Menu Route******/
	Route::get('/admin/service/forms', 'Admin\ServiceForm\AdminServiceFormController@index');
	Route::get('/admin/edit/form/service/{service_id?}', 'Admin\ServiceForm\AdminServiceFormController@editView');
	Route::post('/admin/update/form/service/{service_id?}', 'Admin\ServiceForm\AdminServiceFormController@updateForm');
	Route::get('/admin/get/form/field/{fieldKey?}', 'Admin\ServiceForm\AdminServiceFormController@getFormField');
	Route::post('/admin/clone/form/service/{service_id?}', 'Admin\ServiceForm\AdminServiceFormController@clone');
	Route::get('/admin/delete/form/service/{service_id?}', 'Admin\ServiceForm\AdminServiceFormController@delete');

	/******update delete edit view post/page******/
	Route::get('/admin/menus', 'Admin\Menu\AdminMenuController@index');
	Route::post('/admin/save/menu', 'Admin\Menu\AdminMenuController@save');
	Route::get('/admin/edit/menu/{post_id?}', 'Admin\Menu\AdminMenuController@edit');
	Route::post('/admin/update/menu/{post_id?}', 'Admin\Menu\AdminMenuController@update');
	Route::get('/admin/delete/menu/{post_id?}', 'Admin\Menu\AdminMenuController@delete');

	/******update delete edit view user******/
	Route::get('/admin/users', 'Admin\Users\AdminUsersController@index');
	Route::get('/admin/user/edit/{user_id?}', 'Admin\Users\AdminUsersController@editUser');
	Route::post('/admin/user/update/{user_id?}', 'Admin\Users\AdminUsersController@updateUser');
	Route::get('/admin/user/delete/{user_id?}', 'Admin\Users\AdminUsersController@deleteUser');
	Route::get('/admin/get/user/document/details/{user_id?}', 'Admin\Users\AdminUsersController@document');

	/******update delete edit view packages******/
	Route::get('/admin/orders', 'Admin\Orders\AdminOrdersController@index');
	Route::get('/admin/edit/order/{order_id?}', 'Admin\Orders\AdminOrdersController@edit');
	Route::get('/admin/delete/order/{order_id?}', 'Admin\Orders\AdminOrdersController@delete');
	Route::post('/admin/update/order/{order_id?}', 'Admin\Orders\AdminOrdersController@update');
	Route::get('/admin/generate/print/{order_id?}', 'Admin\Orders\AdminOrdersController@print');
	Route::get('/admin/generate/pdf/{order_id?}', 'Admin\Orders\AdminOrdersController@pdf');
	Route::get('/admin/order/send/invoice/mail/{order_id?}', 'Admin\Orders\AdminOrdersController@sendOrderInvoiceMail');

	/******update delete edit view post******/
	Route::get('/admin/sliders', 'Admin\Slider\AdminSliderController@index');
	Route::get('/admin/add/slider', 'Admin\Slider\AdminSliderController@add');
	Route::post('/admin/save/slider', 'Admin\Slider\AdminSliderController@save');
	Route::get('/admin/edit/slider/{post_id?}', 'Admin\Slider\AdminSliderController@edit');
	Route::post('/admin/update/slider/{post_id?}', 'Admin\Slider\AdminSliderController@update');
	Route::get('/admin/delete/slider/{post_id?}', 'Admin\Slider\AdminSliderController@delete');

});
Route::get('/thank-you', function(){
	$data = [];
	$data['title'] = 'Thank You';
    $data['view'] = 'Pages.Success';
	return view('Includes.commonTemplate',$data);
});
Route::get('/cancel', function(){
	$data = [];
	$data['title'] = 'Thank You';
    $data['view'] = 'Pages.Error';
	return view('Includes.commonTemplate',$data);
});
Route::post('/post/save/comment', 'Comments\CommentsController@save');
Route::get('/{slug?}', 'Home\HomeController@singlePage');