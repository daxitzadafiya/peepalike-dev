<?php

use App\Http\Controllers\SocialShareButtonsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
//
// new code ====================================
Route::get('/', 'FrontendController@indx')->name('index');
Route::get('/', 'FrontendController@index')->name('index');
Route::get('/events/{type?}/{page?}', 'FrontendController@events')->name('events');
Route::get('/about', 'FrontendController@about')->name('about');
Route::get('/blogs', 'FrontendController@blogs')->name('blogs');
Route::get('/blogs/details/{id}', 'FrontendController@blogsDetails')->name('blogsDetails');
Route::post('/blogs/views/{id}', 'FrontendController@blogViewsHandle')->name('blogViews');
Route::get('/faq', 'FrontendController@faqPage')->name('faqPage');
Route::get('/contact', 'FrontendController@contact')->name('contactUs');
Route::get('/event/details/{eventId}', 'FrontendController@eventDetails')->name('eventDetails');
// old code------------
Route::get('/career/admin','FrontendController@careerManager')->name('career-manager');
Route::get('/career/jobs/list','FrontendController@jobsList')->name('jobs-list');
Route::get('/career/jobs/view','FrontendController@jobsView')->name('jobs-view');
Route::get('about-us', 'FrontendController@aboutUs')->name('about');
Route::get('help', 'FrontendController@help')->name('help');
Route::get('contact-us', 'FrontendController@contactUs')->name('contact');
// Route::get('faq', 'FrontendController@faq')->name('faq');
Route::get('terms-and-conditions', 'FrontendController@termsAndConditions')->name('terms');
Route::get('trust-safety', 'FrontendController@trustSafety')->name('trust');
Route::get('sign-up-user', 'FrontendController@userSignUp')->name('user.register');
Route::get('sign-up-provider', 'FrontendController@providerSignUp')->name('provider.register');
Route::get('sign-in', 'FrontendController@signIn')->name('login');
Route::get('login-provider', 'FrontendController@providerLogin')->name('provider.login');
Route::get('login-user', 'FrontendController@userLogin')->name('user.login');
Route::get('how-it-works', 'FrontendController@howItWorks')->name('how-it-works');
Route::get('legal', 'FrontendController@legal')->name('legal');
Route::get('privacy-policy', 'FrontendController@privacy')->name('privacy');
Route::get('/career/admin/jobs','FrontendController@modifyJobs')->name('career-manager-modify-jobs');
Route::get('/career/admin/companies','FrontendController@modifyCompanies')->name('career-manager-modify-companies');

//2020
Route::get('verify-account/{type}/{token}', 'FrontendAuthController@verifyAccount')->name('verify-account');
Route::post('forget-password', 'FrontendAuthController@forgetPassword')->name('forget-password');
Route::get('reset-password/{type}/{token}', 'FrontendAuthController@resetPasswordForm')->name('reset-password');
Route::post('reset-password-save', 'FrontendAuthController@resetPasswordSave')->name('reset-password-save');
//End 2020
Route::post('/career/admin/jobs','FrontendController@modifyJobs')->name('career-manager-modify-jobs');
Route::post('/career/admin/companies','FrontendController@modifyCompanies')->name('career-manager-modify-companies');
Route::post('/career/admin','FrontendController@careerManager')->name('career-manager-post');
Route::post('users', 'FrontendAuthController@userSignup')->name('user.signup');
Route::post('providers', 'FrontendAuthController@providerSignup')->name('provider.signup');
Route::post('users-login', 'FrontendAuthController@userLogin')->name('users.login');
Route::post('providers-login', 'FrontendAuthController@providerLogin')->name('providers.login');
Route::post('verify-otp', 'FrontendAuthController@verifyOtp')->name('verify.otp');

// Route::group(['middleware' => 'user-auth'], function () {
//     Route::get('users/dashboard', 'UserAuthController@dashboard')->name('users.dashboard');
//     Route::post('users/change-password', 'UserAuthController@changePassword')->name('users.change-password');
//     Route::post('users/update', 'UserAuthController@updateProfile')->name('users.update');
//     Route::post('users/update-profile', 'UserAuthController@uploadProfileImage')->name('users.update-profile');
//     Route::get('users/logout', 'UserAuthController@logout')->name('users.logout');
// });

Route::group(['middleware' => 'provider-auth'], function () {
    Route::get('providers/dashboard', 'ProviderAuthController@dashboard')->name('providers.dashboard');
    Route::post('providers/change-password', 'ProviderAuthController@changePassword')->name('providers.change-password');
    Route::post('providers/update', 'ProviderAuthController@updateProfile')->name('providers.update');
    Route::post('providers/update-profile', 'ProviderAuthController@uploadProfileImage')->name('providers.update-profile');
    Route::post('providers/update-address', 'ProviderAuthController@updateAddress')->name('providers.address-update');
    Route::get('providers/logout', 'ProviderAuthController@logout')->name('providers.logout');
});

// start code by balvant----------------------
Route::get('login-eventuser', 'FrontendController@eventUserLogin')->name('user.eventuser');
Route::post('admin-login', 'EventUserController@eventUserLogin')->name('admin.login');

Route::group(['middleware' => 'admin-auth'], function () {
    Route::get('eventuser/dashboard', 'EventUserController@dashboard')->name('admin.dashboard');
    Route::post('eventuser/change-password', 'EventUserController@changePassword')->name('admin.change-password');
    Route::get('eventuser/logout', 'EventUserController@logout')->name('eventusers.logout');

    Route::get('eventuser/eventList', 'EventUserController@eventList')->name('admin.eventList');
    Route::get('eventuser/addEvent', 'EventUserController@addEvent')->name('admin.addEvent');
    Route::post('eventuser/insertEvent', 'EventUserController@insertEvent')->name('admin.insertEvent');
    Route::get('eventuser/editEvent/{id}', 'EventUserController@editEvent')->name('admin.editEvent');
    Route::post('eventuser/updateEvent', 'EventUserController@updateEvent')->name('admin.updateEvent');
    Route::post('eventuser/deleteEvent', 'EventUserController@deleteEvent')->name('admin.deleteEvent');
    Route::post('eventuser/activeEvent', 'EventUserController@activeEvent')->name('admin.activeEvent');
    Route::post('eventuser/inactiveEvent', 'EventUserController@inactiveEvent')->name('admin.inactiveEvent');

    Route::get('eventuser/hangoutList', 'EventUserController@hangoutList')->name('admin.hangoutList');

    Route::get('eventuser/eventTicket/{id}', 'EventUserController@eventTicket')->name('admin.eventTicket');
    Route::get('eventuser/addTicket/{id}', 'EventUserController@addTicket')->name('admin.addTicket');
    Route::post('eventuser/insertTicket', 'EventUserController@insertTicket')->name('admin.insertTicket');
    Route::get('eventuser/editTicket/{id}', 'EventUserController@editTicket')->name('admin.editTicket');
    Route::post('eventuser/updateTicket', 'EventUserController@updateTicket')->name('admin.updateTicket');
    Route::post('eventuser/deleteTicket', 'EventUserController@deleteTicket')->name('admin.deleteTicket');
    Route::post('eventuser/activeTicket', 'EventUserController@activeTicket')->name('admin.activeTicket');
    Route::post('eventuser/inactiveTicket', 'EventUserController@inactiveTicket')->name('admin.inactiveTicket');

    Route::get('eventuser/eventBenner/{id}', 'EventUserController@eventBenner')->name('admin.eventBenner');
    Route::get('eventuser/addBenner/{id}', 'EventUserController@addBenner')->name('admin.addBenner');
    Route::post('eventuser/insertBenner', 'EventUserController@insertBenner')->name('admin.insertBenner');
    Route::get('eventuser/editBenner/{id}', 'EventUserController@editBenner')->name('admin.editBenner');
    Route::post('eventuser/updateBenner', 'EventUserController@updateBenner')->name('admin.updateBenner');
    Route::post('eventuser/deleteBenner', 'EventUserController@deleteBenner')->name('admin.deleteBenner');

    Route::get('eventuser/usersList', 'EventUserController@usersList')->name('admin.usersList');
    Route::post('eventuser/deleteUser', 'EventUserController@deleteUser')->name('admin.deleteUser');
    Route::post('eventuser/activeUser', 'EventUserController@activeUser')->name('admin.activeUser');
    Route::post('eventuser/inactiveUser', 'EventUserController@inactiveUser')->name('admin.inactiveUser');

    Route::get('eventuser/premiumList', 'EventUserController@premiumList')->name('admin.premiumList');
    Route::get('eventuser/addPremium', 'EventUserController@addPremium')->name('admin.addPremium');
    Route::post('eventuser/insertPremium', 'EventUserController@insertPremium')->name('admin.insertPremium');
    Route::get('eventuser/editPremium/{id}', 'EventUserController@editPremium')->name('admin.editPremium');
    Route::post('eventuser/updatePremium', 'EventUserController@updatePremium')->name('admin.updatePremium');
    Route::post('eventuser/deletePremium', 'EventUserController@deletePremium')->name('admin.deletePremium');
    Route::post('eventuser/activePremium', 'EventUserController@activePremium')->name('admin.activePremium');
    Route::post('eventuser/inactivePremium', 'EventUserController@inactivePremium')->name('admin.inactivePremium');

    Route::get('eventuser/userStatusList', 'EventUserController@userStatusList')->name('admin.userStatusList');
    Route::get('eventuser/editUser/{id}', 'EventUserController@editUser')->name('admin.editUser');
    Route::post('eventuser/updateUser', 'EventUserController@updateUser')->name('admin.updateUser');
    Route::post('eventuser/insertUserStatus', 'EventUserController@insertUserStatus')->name('admin.insertUserStatus');
    Route::post('eventuser/editUserStatus', 'EventUserController@editUserStatus')->name('admin.editUserStatus');
    Route::post('eventuser/updateUserStatus', 'EventUserController@updateUserStatus')->name('admin.updateUserStatus');
    Route::post('eventuser/deleteUserStatus', 'EventUserController@deleteUserStatus')->name('admin.deleteUserStatus');
    Route::get('eventuser/usersProfileList/{id}', 'EventUserController@usersProfileList')->name('admin.usersProfileList');
    Route::post('eventuser/deleteUserProfile', 'EventUserController@deleteUserProfile')->name('admin.deleteUserProfile');

    Route::get('eventuser/categoryList', 'EventUserController@categoryList')->name('admin.categoryList');
    Route::post('eventuser/insertCategory', 'EventUserController@insertCategory')->name('admin.insertCategory');
    Route::post('eventuser/editCategory', 'EventUserController@editCategory')->name('admin.editCategory');
    Route::post('eventuser/updateCategory', 'EventUserController@updateCategory')->name('admin.updateCategory');
    Route::post('eventuser/deleteCategory', 'EventUserController@deleteCategory')->name('admin.deleteCategory');

    Route::get('eventuser/blogList', 'EventUserController@blogList')->name('admin.blogList');
    Route::post('eventuser/insertBlog', 'EventUserController@insertBlog')->name('admin.insertBlog');
    Route::get('eventuser/editBlog/{id}', 'EventUserController@editBlog')->name('admin.editBlog');
    Route::post('eventuser/updateBlog', 'EventUserController@updateBlog')->name('admin.updateBlog');
    Route::post('eventuser/deleteBlog', 'EventUserController@deleteBlog')->name('admin.deleteBlog');

    Route::get('eventuser/event/categoryList', 'EventUserController@eventCategoryList')->name('admin.eventCategoryList');
// *******************************************************************************************************
Route::get('eventuser/event/categoryList', 'EventUserController@eventCategoryList')->name('admin.eventCategoryList');
    Route::post('eventuser/event/insertCategory', 'EventUserController@insertEventCategory')->name('admin.insertEventCategory');
    Route::get('eventuser/event/editCategory/{id}', 'EventUserController@editEventCategory')->name('admin.editEventCategory');
    Route::post('eventuser/event/updateCategory', 'EventUserController@updateEventCategory')->name('admin.updateEventCategory');
    Route::post('eventuser/event/deleteCategory', 'EventUserController@deleteEventCategory')->name('admin.deleteEventCategory');




//////////////////////////////////////**************************************** */






    Route::get('eventuser/blog/categoryList', 'EventUserController@blogCategoryList')->name('admin.blogCategoryList');
    Route::post('eventuser/blog/insertCategory', 'EventUserController@insertBlogCategory')->name('admin.insertBlogCategory');
    Route::get('eventuser/blog/editCategory/{id}', 'EventUserController@editBlogCategory')->name('admin.editBlogCategory');
    Route::post('eventuser/blog/updateCategory', 'EventUserController@updateBlogCategory')->name('admin.updateBlogCategory');
    Route::post('eventuser/blog/deleteCategory', 'EventUserController@deleteBlogCategory')->name('admin.deleteBlogCategory');

    Route::get('eventuser/blog/tagList', 'EventUserController@blogTagList')->name('admin.blogTagList');
    Route::post('eventuser/blog/insertTag', 'EventUserController@insertBlogTag')->name('admin.insertBlogTag');
    Route::get('eventuser/blog/editTag/{id}', 'EventUserController@editBlogTag')->name('admin.editBlogTag');
    Route::post('eventuser/blog/updateTag', 'EventUserController@updateBlogTag')->name('admin.updateBlogTag');
    Route::post('eventuser/blog/deleteTag', 'EventUserController@deleteBlogTag')->name('admin.deleteBlogTag');

    Route::get('eventuser/pushNotificationsList', 'EventUserController@pushNotificationsList')->name('admin.pushNotificationsList');
    Route::post('eventuser/sendPushNotifications', 'EventUserController@sendPushNotifications')->name('admin.sendPushNotifications');

    Route::get('eventuser/transactionsList', 'EventUserController@transactionsList')->name('admin.transactionsList');

    Route::get('eventuser/premiumUsersList', 'EventUserController@premiumUsersList')->name('admin.premiumUsersList');

    Route::get('eventuser/changePassword', 'EventUserController@changePassword')->name('admin.changePassword');
    Route::post('eventuser/postChangePassword', 'EventUserController@postChangePassword')->name('admin.postChangePassword');

    Route::get('eventuser/usersLocations', 'EventUserController@usersLocations')->name('admin.usersLocations');
    Route::get('/eventuser/chat', 'EventUserController@chatView')->name('admin.chat');
    Route::get('/eventuser/user-report', 'EventUserController@userReport')->name('admin.userReport');
    Route::get('/eventuser/admin-tranactions', 'EventUserController@adminTransactions')->name('admin.adminTransactions');
    Route::get('/eventuser/staticPages', 'EventUserController@staticPages')->name('admin.staticPages');
    Route::get('/eventuser/customPush', 'EventUserController@customPush')->name('admin.customPush');

    Route::post('eventuser/getChatUserList', 'EventUserController@getChatUserList')->name('admin.getChatUserList');
    Route::post('eventuser/getUserChat', 'EventUserController@getUserChat')->name('admin.getUserChat');

});

Route::get("eventuser/getStates/{country_id}",'EventUserController@getStates')->name("admin.getStates");
Route::get("eventuser/getCity/{state_id}",'EventUserController@getCity')->name("admin.getCity");

// end -------------------------------------

Route::post('register/send-otp', 'FrontendAuthController@sendOtp')->name('register.send-otp');
Route::post('register/verify-otp', 'FrontendAuthController@verifyOtp')->name('register.verify-otp');

Route::post('forgot/send-otp', 'FrontendAuthController@sendForgotOtp')->name('forgot.send-otp');
Route::post('forgot/verify-otp', 'FrontendAuthController@verifyResetOtp')->name('forgot.verify-otp');
Route::post('reset-password.request', 'FrontendAuthController@resetPassword')->name('reset-password.request');
Route::get('password-reset/{slug}', 'FrontendAuthController@resetForm')->name('reset-password.form');

Route::get('/clear-cache', function() {

	 #echo config('services.twilio.auth_token');


	 #echo config('services.twilio.auth_token');

	Artisan::call('cache:clear');
    echo 'cache has been cleared';
	// return what you want
});

//https://www.readiwork.com/testsms/test_sandy/+254722175570
//Route::get('/testsms/{body}/{to}',"Controller@sendSms");
Route::post('payment/makepayment',"PaymentController@makePayment");
Route::get('payment/inquiry',"PaymentController@inquiry");

Route::get('transaction/notify',"TransactionsController@notify");
Route::get('transaction/lists',"TransactionsController@lists");
Route::post('transaction/detail',"TransactionsController@detail");
Route::post('transaction/byuser',"TransactionsController@byuser");
Route::post('transaction/getbalancebyuser',"TransactionsController@getbalancebyuser");

Route::group(['prefix' => 'user'], function () {
    Route::get('dashboard', 'UserEventController@dashboard')->name('user.dashboard');
    Route::post('change-password', 'UserEventController@changePassword')->name('user.change-password');
    Route::get('logout', 'UserEventController@logout')->name('eventusers.logout');
    Route::get('profile', 'UserEventController@showProfile')->name('user.profile');
    Route::post('store/profile','UserEventController@storeProfile')->name('store.profile');
    Route::get('remove_profile_image/{id}','UserEventController@removeImage')->name('user.remove_profile_image');
    Route::post('update-password/{id}','UserEventController@updatePassword')->name('user.update_password');

// user side event =====================================================

    Route::get('eventList', 'UserEventController@eventList')->name('user.eventList');
    Route::get('addEvent', 'UserEventController@addEvent')->name('user.addEvent');
    Route::post('insertEvent', 'UserEventController@insertEvent')->name('user.insertEvent');
    Route::get('editEvent/{id}', 'UserEventController@editEvent')->name('user.editEvent');
    Route::post('updateEvent', 'UserEventController@updateEvent')->name('user.updateEvent');
    Route::post('deleteEvent', 'UserEventController@deleteEvent')->name('user.deleteEvent');
    Route::post('activeEvent', 'UserEventController@activeEvent')->name('user.activeEvent');
    Route::post('inactiveEvent', 'UserEventController@inactiveEvent')->name('user.inactiveEvent');

    Route::get('eventBenner/{id}', 'UserEventController@eventBenner')->name('user.eventBenner');
    Route::get('addBenner/{id}', 'UserEventController@addBenner')->name('user.addBenner');
    Route::post('insertBenner', 'UserEventController@insertBenner')->name('user.insertBenner');
    Route::get('editBenner/{id}', 'UserEventController@editBenner')->name('user.editBenner');
    Route::post('updateBenner', 'UserEventController@updateBenner')->name('user.updateBenner');
    Route::post('deleteBenner', 'UserEventController@deleteBenner')->name('user.deleteBenner');

    Route::get('eventTicket/{id}', 'UserEventController@eventTicket')->name('user.eventTicket');
    Route::get('addTicket/{id}', 'UserEventController@addTicket')->name('user.addTicket');
    Route::post('insertTicket', 'UserEventController@insertTicket')->name('user.insertTicket');
    Route::get('editTicket/{id}', 'UserEventController@editTicket')->name('user.editTicket');
    Route::post('updateTicket', 'UserEventController@updateTicket')->name('user.updateTicket');
    Route::post('deleteTicket', 'UserEventController@deleteTicket')->name('user.deleteTicket');
    Route::post('activeTicket', 'UserEventController@activeTicket')->name('user.activeTicket');
    Route::post('inactiveTicket', 'UserEventController@inactiveTicket')->name('user.inactiveTicket');


    Route::get('changePassword', 'UserEventController@changePassword')->name('user.changePassword');
    Route::post('postChangePassword', 'UserEventController@postChangePassword')->name('user.postChangePassword');
    Route::post('postsearch','FrontendController@postsearch')->name('postsearch');
});

Route::get('login/facebook', 'Auth\LoginController@redirectToFacebook')->name('login.facebook');
Route::get('login/facebook/callback', 'Auth\LoginController@handleFacebookCallback');

Route::get('login/google', 'Auth\LoginController@redirectToGoogle')->name('login.google');
Route::get('login/google/callback', 'Auth\LoginController@handleGoogleCallback');
Route::get('logout', 'UserEventController@logout')->name('eventusers.logout');
