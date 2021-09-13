<?php

use Illuminate\Http\Request;

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

/**
 * New Api's
 * Created by VDM
 */
Route::post('signup','UserController@store');
Route::post('verify-signup-otp','UserController@verifySignupOtp');
Route::post('resend-signup-otp','UserController@resendSignupOtp');
Route::post('userlogin','UserController@login');
Route::post('forgot-password','PasswordResetController@requestPasswordReset');
Route::post('check-otp','PasswordResetController@checkOtp');
Route::post('reset-password','PasswordResetController@resetPassword');

Route::post('send-otp','UserController@sendOtp');
Route::post('verify-otp','UserController@verifyOtp');

Route::post('send-otp-test','FrontendAuthController@sendForgotOtp');

//Route::post('userlogin','UserController@userlogin');
//Route::post('signup','UserController@signup');
Route::post('sociallogin','UserController@sociallogin');
Route::post('forgotpassword','UserController@forgot_password');
Route::post('forgotpasswordotpcheck','UserController@otpcheck');
Route::post('resetpassword','UserController@resetpassword');
Route::get('appsettings','UserController@appsettings');
Route::get('about','UserController@about');
Route::get('faq','UserController@faq');
Route::get('termsandconditions','UserController@termsandconditions');
Route::post('basicemail','UserController@basic_email');


Route::post('updatedevicetoken','UserController@updatedevicetoken')->middleware('auth:api');
Route::post('addaddress','UserController@addaddress')->middleware('auth:api');
Route::post('listaddress','UserController@viewaddress')->middleware('auth:api');
Route::post('updateaddress','UserController@updateaddress');
//Route::get('homedashboard','UserController@dashboard');
Route::get('homedashboard','UserController@dashboard')->middleware('auth:api');
Route::post('list_subcategory','UserController@list_subcategory');
Route::get('viewprofile','UserController@viewprofile')->middleware('auth:api');
Route::post('updateprofile','UserController@updateprofile')->middleware('auth:api');
Route::post('changepassword','UserController@changepassword')->middleware('auth:api');
Route::post('listprovider','UserController@listprovider')->middleware('auth:api');
Route::post('newbooking','UserController@newbooking')->middleware('auth:api');
Route::get('view_bookings','UserController@view_bookings')->middleware('auth:api');
Route::post('getproviderlocation','UserController@getproviderlocation')->middleware('auth:api');
Route::post('paidstatus','UserController@paidstatus')->middleware('auth:api');
Route::post('review','UserController@review_feedback')->middleware('auth:api');
Route::post('pay','UserController@payment_method')->middleware('auth:api');
Route::post('cancelbyuser','UserController@cancelbyuser')->middleware('auth:api');
Route::post('deleteaddress','UserController@deleteaddress')->middleware('auth:api');
Route::get('list_payment_methods','UserController@list_payment_methods')->middleware('auth:api');
Route::get('fcmtest','UserController@fcmtest');
Route::post('stripe','UserController@postPaymentWithStripe')->middleware('auth:api');
Route::post('charge','UserController@charge')->middleware('auth:api');
Route::post('ephemeral_keys','UserController@ephemeral_keys')->middleware('auth:api');
Route::post('logout','UserController@logout')->middleware('auth:api');
Route::post('cancel_request','UserController@cancel_request')->middleware('auth:api');

Route::post('reportuser','UserController@reportuser');

Route::post('listprovidertest','UserController@listprovidertest')->middleware('auth:api');


Route::post('couponverify','UserController@couponverify');
Route::post('couponremove','UserController@couponremove');
Route::post('invoicepdf','UserController@pdfgenerator');



Route::post('addmoney','UserController@addmoneywallet')->middleware('auth:api');
Route::post('wallettransaction','UserController@wallettransction')->middleware('auth:api');

Route::post('startjobendjobdetails','UserController@startjobendjobdetails');

Route::post('send-support-mail',"SupportController@store");
Route::post('emergency-contacts-add',"EmergencyContactController@store");
Route::post('emergency-contacts-list',"EmergencyContactController@listcontact");
Route::post('emergency-contacts-delete',"EmergencyContactController@delete");

Route::post('testsms','UserController@testsms');


//peepalike

Route::post('getparties',"PartiesController@lists");


//Route::get('emergency-contacts1',"EmergencyContactController@test");


// Event api list-----------------------------------------------------------

Route::post('user_login','UserController@user_login');
Route::post('plan_list','UserController@plan_list');
Route::post('logOut','UserController@logOut');
Route::post('add_profile','UserController@add_profile');

Route::post('user_sendotp','UserController@user_sendotp');
Route::post('user_verifyotp','UserController@user_verifyotp');

Route::get('view_profile','UserController@view_profile')->middleware('auth:api');
Route::post('update_profile','UserController@update_profile')->middleware('auth:api');

Route::post('update_profile_image','UserController@update_profile_image')->middleware('auth:api');
Route::post('user_category_list','UserController@user_category_list')->middleware('auth:api');
Route::post('update_category','UserController@update_category')->middleware('auth:api');

Route::post('category_list','UserController@category_list');

Route::post('userChatHistory','UserController@userChatHistory')->middleware('auth:api');
Route::post('addUserChat','UserController@addUserChat')->middleware('auth:api');

Route::post('groupList','UserController@groupList')->middleware('auth:api');
Route::post('addGroup','UserController@addGroup')->middleware('auth:api');

Route::post('userChatGroupList','UserController@userChatGroupList')->middleware('auth:api');
Route::post('addUserChatGroup','UserController@addUserChatGroup')->middleware('auth:api');

Route::post('todayEventList','UserController@todayEventList')->middleware('auth:api');
Route::post('currentEventList','UserController@currentEventList')->middleware('auth:api');
Route::post('upcomingEventList','UserController@upcomingEventList')->middleware('auth:api');
Route::post('pastEventList','UserController@pastEventList')->middleware('auth:api');
Route::post('trendingEventList','UserController@trendingEventList')->middleware('auth:api');
Route::post('addUserEvent','UserController@addUserEvent')->middleware('auth:api');
Route::post('eventDetail','UserController@eventDetail')->middleware('auth:api');
Route::post('deleteProfileImage','UserController@deleteProfileImage')->middleware('auth:api');
Route::post('updateUserProfileImage','UserController@updateUserProfileImage')->middleware('auth:api');
Route::post('userOnlineStatus','UserController@userOnlineStatus')->middleware('auth:api');

Route::post('userStatusList','UserController@userStatusList')->middleware('auth:api');

Route::post('usersList','UserController@usersList')->middleware('auth:api');
Route::post('usersProfileView','UserController@usersProfileView')->middleware('auth:api');
Route::post('nearByUsersList','UserController@nearByUsersList')->middleware('auth:api');
Route::post('populerUsersList','UserController@populerUsersList')->middleware('auth:api');
Route::post('partyNowUsersList','UserController@partyNowUsersList')->middleware('auth:api');

Route::post('updateUserStatus','UserController@updateUserStatus')->middleware('auth:api');

Route::post('sendUserMeetup','UserController@sendUserMeetup')->middleware('auth:api');
Route::post('userMeetupList','UserController@userMeetupList')->middleware('auth:api');
Route::post('meetupRequestAcceptReject','UserController@meetupRequestAcceptReject')->middleware('auth:api');

Route::post('joinEvent','UserController@joinEvent')->middleware('auth:api');

Route::post('addUserLocation','UserController@addUserLocation')->middleware('auth:api');
Route::post('usersLocationList','UserController@usersLocationList')->middleware('auth:api');
Route::post('deleteUsersLocation','UserController@deleteUsersLocation')->middleware('auth:api');
Route::post('addFavUsersLocation','UserController@addFavUsersLocation')->middleware('auth:api');

Route::post('addUserMeetupGroup','UserController@addUserMeetupGroup')->middleware('auth:api');
Route::post('userMeetupGroupList','UserController@userMeetupGroupList')->middleware('auth:api');
Route::post('myGroupList','UserController@myGroupList')->middleware('auth:api');
Route::post('userMeetupGroupDetails','UserController@userMeetupGroupDetails')->middleware('auth:api');
Route::post('joinUserMeetupGroup','UserController@joinUserMeetupGroup')->middleware('auth:api');
Route::post('groupRequestAcceptReject','UserController@groupRequestAcceptReject')->middleware('auth:api');

Route::post('hangoutUpcomingEvent','UserController@hangoutUpcomingEvent')->middleware('auth:api');
Route::post('hangoutPastEvent','UserController@hangoutPastEvent')->middleware('auth:api');

Route::post('notificationList','UserController@notificationList')->middleware('auth:api');

Route::post('myEventList','UserController@myEventList')->middleware('auth:api');
Route::post('myMeetupUserList','UserController@myMeetupUserList')->middleware('auth:api');

Route::post('addAbuseReport','UserController@addAbuseReport')->middleware('auth:api');
Route::post('getAllChatMessage','UserController@getAllChatMessage')->middleware('auth:api');

Route::post('groupsList','UserController@groupsList')->middleware('auth:api');
Route::post('eventsList','UserController@eventsList')->middleware('auth:api');

Route::post('resetNotificationCount','UserController@resetNotificationCount')->middleware('auth:api');

Route::post('addEvent','UserController@addEvent')->middleware('auth:api');
Route::post('updateEvent','UserController@updateEvent')->middleware('auth:api');
Route::post('deleteEvent','UserController@deleteEvent')->middleware('auth:api');

Route::post('userLatLongUpdate','UserController@userLatLongUpdate')->middleware('auth:api');

Route::get('testsocket','UserController@testsocket');

