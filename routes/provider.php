<?php

Route::post('provider_signup','ProviderController@store');
Route::post('providerlogin','ProviderController@login');

Route::post('verify-signup-otp','ProviderController@verifySignupOtp');
Route::post('resend-signup-otp','ProviderController@resendSignupOtp');

//Route::get('listcategory','GeneralApiController@getCategory');
//Route::post('listsubcategory','GeneralApiController@getSubCategory');


/** new providersign **/

Route::post('provider_new','ProviderController@providernewlogin');
Route::post('availability','ProviderController@updateavailability');


//Route::post('sign-up','ProviderController@signup');
//Route::post('providerlogin','ProviderController@providerlogin');
Route::post('forgotpassword','ProviderController@forgot_password');
Route::post('otpcheck','ProviderController@otpcheck');
Route::post('resetpassword','ProviderController@resetpassword');
Route::get('appsettings','ProviderController@appsettings');

Route::get('listcategory','ProviderController@listcategory');
Route::post('elapsetime','ProviderController@elapsetime');
Route::post('listsubcategory','ProviderController@listsubcategory');


Route::post('updatedevicetoken','ProviderController@updatedevicetoken')->middleware('auth:provider');
Route::get('viewprofile','ProviderController@viewprofile')->middleware('auth:provider');
Route::post('updateprofile','ProviderController@updateprofile')->middleware('auth:provider');
Route::get('view_schedules','ProviderController@view_schedules')->middleware('auth:provider');
Route::post('updateschedules','ProviderController@updateschedules')->middleware('auth:provider');
Route::get('view_provider_category','ProviderController@view_provider_category')->middleware('auth:provider');
Route::get('homedashboard','ProviderController@home')->middleware('auth:provider');
Route::post('changepassword','ProviderController@changepassword')->middleware('auth:provider');
Route::post('update_provider_category','ProviderController@update_provider_category')->middleware('auth:provider');
Route::post('update_location','ProviderController@update_location')->middleware('auth:provider');

Route::post('acceptbooking','ProviderController@acceptbooking')->middleware('auth:provider');
Route::post('rejectbooking','ProviderController@rejectbooking')->middleware('auth:provider');
Route::post('cancelbyprovider','ProviderController@cancelbyprovider')->middleware('auth:provider');
Route::post('starttocustomerplace','ProviderController@starttocustomerplace')->middleware('auth:provider');
Route::post('startedjob','ProviderController@startedjob')->middleware('auth:provider');
Route::post('completedjob','ProviderController@completedjob')->middleware('auth:provider');
Route::post('paymentaccept','ProviderController@paymentaccept')->middleware('auth:provider');
Route::post('userreviews','ProviderController@user_reviews')->middleware('auth:provider');
Route::post('add_category','ProviderController@add_category')->middleware('auth:provider');
Route::post('edit_category','ProviderController@edit_category')->middleware('auth:provider');
Route::post('delete_category','ProviderController@delete_category')->middleware('auth:provider');
Route::post('update_address','ProviderController@update_address')->middleware('auth:provider');
Route::post('logout','ProviderController@logout')->middleware('auth:provider');
Route::post('accept_random_request','ProviderController@accept_random_request')->middleware('auth:provider');
Route::post('reject_random_request','ProviderController@reject_random_request')->middleware('auth:provider');
Route::post('providercal','ProviderController@providercal');

/** provider calender **/
Route::post('providercalender','ProviderController@providercalender')->middleware('auth:provider');

Route::post('calenderbookingdetails','ProviderController@calenderbookingdetails')->middleware('auth:provider');

Route::post('startjobendjobdetails','ProviderController@startjobendjobdetails');


Route::post('emergency-contacts-add',"EmergencyContactController@store");
Route::post('emergency-contacts-list',"EmergencyContactController@listcontact");
Route::post('emergency-contacts-delete',"EmergencyContactController@delete");

Route::post('send-support-mail',"SupportController@store");

// upload provider documents
Route::post('uploadproviderdocument','ProviderController@uploadProviderDocument');
Route::post('viewproviderdocument','ProviderController@viewProviderDocument');

Route::post('getuserfeedback','ProviderController@get_user_feedback');

