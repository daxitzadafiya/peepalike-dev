<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Provider;
use App\Imageupload;
use App\FCMPushNotification;
use App\Bookings;
use App\Useraddress;
use App\Location;
use App\Timeslots;
use App\Category;
use App\Subcategory;
use App\Providerservices;
use App\Providerschedules;
use App\Providerreviews;
use App\Userreports;
use App\Walletusers;
use App\Wallettransaction;
use App\Smslogs;
use App\UserCategory;
use App\Userprofileimage;
use App\UserEvents;
use App\Groupchat;
use App\UserChatGroup;
use App\Providerstripeaccount;
use App\Otp;
use App\EventTicket;
use App\EventPremium;
use App\Transactions;
use App\PremiumUsers;
use App\EventBenner;
use App\EventUserStatus;
use App\UserStatus;
use App\UserMeetup;
use App\UserJoinEvent;
use App\UserMeetupGroup;
use App\MeetupGroupUsers;
use App\UserAbuseReport;
use App\UserProfileView;
use App\UserMeetupList;
use App\PushNotificationHistory;
use App\Services\EventService;
use Mail;
use DB;
use PDF;
use URL;
use File;
use Pusher\Pusher;
// use PDF;
use Validator;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Guzzle\Http\Exception\ServerErrorResponseException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Stripe\Error\Card;
use App\Mail\RegistrationEmail;

class UserController extends Controller {


    // Event api list--------------------------------------------------------------------------------------------------------------------------------------

    /**
     * @param Request $request
     * @return mixed
     * Created by VDM
     */
    public function user_login(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            
        ]);
        if($request->type == 'facebook'){
            $getUserId = $request->getUserId;
            if ($getUserId == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please send getUserId';
                echo json_encode($response);
                exit;
            }

            $user = User::where('login_type', $request->type)->where('facebook_token', $request->getUserId)->first();
        }elseif ($request->type == 'google') {
            $getUserId = $request->getUserId;
            if ($getUserId == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please send getUserId';
                echo json_encode($response);
                exit;
            }

            $user = User::where('login_type', $request->type)->where('google_token', $request->getUserId)->first();
        }else{
            $email = $request->email;
            if ($email == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please send email';
                echo json_encode($response);
                exit;
            }
            $user = User::where('email', $request->email)->first();
        }
        $user = User::where('email', $request->email)->first();
        if (!empty($user)) {
            if($user->status == 'active'){
                $update_user = User::where('id', $user->id)->update(['os_type' => $request->os_type,'device_token' => $request->device_token ]);

                $user = User::find($user->id);
                $token = $user->createToken(\Config::get('app.name'))->accessToken;
                $data = [
                    "user" => $user,
                    "token" => $token,
                    "user_type" => 'old'
                ];
                return $this->makeResponse('Successfully !', $data);
            }else{
                $response['error'] = 'true';
                $response['message'] = 'Your account is Blocked, please contact to admin.';
                echo json_encode($response);
                exit;
            }
            
        } else {

            $data = [
                "user" => '',
                "token" => '',
                "user_type" => 'new'
            ];
            return $this->makeResponse('Successfully !', $data);
        }
    }

    public function plan_list(request $request)
    {
        
        try
        {
            $EventPremium = EventPremium::where('status','=','0')->get();

            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['plan'] = $EventPremium;
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function add_profile(request $request) {

        if ($request->first_name == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send first name';
            echo json_encode($response);
            exit;
        }
        if ($request->last_name == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send last name';
            echo json_encode($response);
            exit;
        }
        if ($request->age == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send age';
            echo json_encode($response);
            exit;
        }
        if ($request->gender == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send gender';
            echo json_encode($response);
            exit;
        }
        if ($request->os_type == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send os type';
            echo json_encode($response);
            exit;
        }
        if ($request->latitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send latitude';
            echo json_encode($response);
            exit;
        }
        if ($request->longitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send longitude';
            echo json_encode($response);
            exit;
        }
        if ($request->plan_id == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send plan';
            echo json_encode($response);
            exit;
        }
        if ($request->login_type == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send login type';
            echo json_encode($response);
            exit;
        }
        if ($request->device_token == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send device token';
            echo json_encode($response);
            exit;
        }


        if ($request->first_name && $request->last_name && $request->age && $request->gender && $request->os_type && $request->latitude && $request->longitude ) {
            $user = '';
            $phone_number = str_replace('+','',$request->phone_number);
            $phone_number = str_replace(' ','',$phone_number);
            $phone_number = str_replace('-','',$phone_number);
            if($request->login_type == 'facebook'){
                if ($request->facebook_token == '') {
                    $response['error'] = 'true';
                    $response['message'] = 'Please send facebook token';
                    echo json_encode($response);
                    exit;
                }
                $user = User::where('login_type', $request->login_type)->where('facebook_token', $request->facebook_token)->first();
            }elseif ($request->login_type == 'google') {
                if ($request->google_token == '') {
                    $response['error'] = 'true';
                    $response['message'] = 'Please send google token';
                    echo json_encode($response);
                    exit;
                }
                $user = User::where('login_type', $request->login_type)->where('google_token', $request->google_token)->first();
            }elseif ($request->login_type == 'email'){
                if ($request->email == '') {
                    $response['error'] = 'true';
                    $response['message'] = 'Please send email';
                    echo json_encode($response);
                    exit;
                }
                $user = User::where('email', $request->email)->first();
            }elseif ($request->login_type == 'phone'){
                if ($request->phone_number == '') {
                    $response['error'] = 'true';
                    $response['message'] = 'Please send phone number';
                    echo json_encode($response);
                    exit;
                }
                $user = User::where('mobile', $phone_number)->first();
            }else{
                if ($request->email == '') {
                    $response['error'] = 'true';
                    $response['message'] = 'Please send email';
                    echo json_encode($response);
                    exit;
                }
                $user = User::where('email', $request->email)->first();
                if(empty($user)){
                    $user = User::where('email', $request->email)->first();
                
                }
            }
            

            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $interest = $request->interest;
            $age_interest = $request->age_interest;
            $plan_id = $request->plan_id;

            $profile_img = $request->profile_img;
            $profile_img = '';
            if ($request->profile_img != "") {
                $profile_img = time() . '_' . uniqid() . '.' . $request->profile_img->getClientOriginalExtension();
                $request->profile_img->move(public_path('images/'), $profile_img);
                $profile_img = $profile_img;

            }

            $token = '';
            if ($user) {
                $user = User::find($user->id);
                if($user->status == 'active'){
                    $token = $user->createToken(\Config::get('app.name'))->accessToken;
                    $email = '';
                    if($request->email != ''){
                        $email = $request->email;
                    }else{
                        if($email != ''){
                            $email = $useremail->email;
                        }else{
                            $email = str_replace(' ', '', $request->first_name.'.'.$request->last_name).'@gmail.com';
                        }
                    }
                    $useremail = User::where('id','!=', $user->id)->where('email', $email)->first();
                    if(empty($useremail)){
                        
                        
                        $user = User::where('id', $user->id)->update(['first_name' => $request->first_name,'last_name' => $request->last_name,'email' =>$email, 'mobile' => $phone_number,'os_type' => $request->os_type, 'status' => 'active', 'login_type' => $request->login_type, 'fcm_token' => $request->fcm_token, 'facebook_token' => $request->facebook_token, 'google_token' => $request->google_token, 'latitude' => $latitude, 'longitude' => $longitude , 'age' => $request->age, 'gender' => $request->gender,'address' => $request->address,'image' => $profile_img,'description' => $request->description,'is_online' => 'online','device_token' => $request->device_token,'plan_id' => $plan_id ]);

                    }else{
                        $response['error'] = 'true';
                        $response['error_message'] = 'This email already used, please use diffrent email address.';
                        echo json_encode($response);
                        exit;
                    }

                }else{

                }
                
            }else{
                if($request->email == ''){
                    $email = str_replace(' ', '', $request->first_name.'.'.$request->last_name).'@gmail.com';
                }else{
                    $email = $request->email;
                }
                

                $user = new User();
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->password = bcrypt($phone_number);
                $user->email = $email;
                $user->mobile = $phone_number;
                $user->os_type = $request->os_type;
                $user->image = $profile_img;
                $user->status = 'active';
                $user->login_type = $request->login_type;
                $user->fcm_token = $request->fcm_token;
                $user->facebook_token = $request->facebook_token;
                $user->google_token = $request->google_token;
                $user->age = $request->age;
                $user->gender = $request->gender;
                $user->max_distance = '20';
                $user->address = $request->address;
                $user->latitude = $request->latitude;
                $user->longitude = $request->longitude;
                $user->latitude = $request->latitude;
                $user->interest = $request->interest;
                $user->description = $request->description;
                $user->age_interest = $request->age_interest;
                $user->device_token = $request->device_token;
                $user->os_type = $request->os_type;
                $user->plan_id = $plan_id;
                $user->is_online = 'online';
                $user->save();

                if($profile_img != ''){
                    $Userprofileimage = new Userprofileimage();
                    $Userprofileimage->user_id = $user->id;
                    $Userprofileimage->image = $profile_img;
                    $Userprofileimage->save();
                }

                $token = $user->createToken(\Config::get('app.name'))->accessToken;
            }
            
            
            if ($user) {
                $response['error'] = 'false';
                $response['error_message'] = 'success';
                $response['token'] = $token;
                
            } else {
                $response['error'] = 'true';
                $response['error_message'] = 'not added.';
                echo json_encode($response);
                exit;
            }
        }else {
            $response['error'] = 'true';
            $response['error_message'] = 'Mandatory Parameter are empty';
        }
        
        
        echo json_encode($response);
    }

    public function user_sendotp(Request $request) {
        
        $mobile_number = str_replace('+','',$request->mobile);
        $sendMail = false;
        if ($mobile_number == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send mobile number';
            echo json_encode($response);
            exit;
        }
        $otp = $this->otpGenerator();
        
        $userotp = Otp::where('mobile', $mobile_number)->first();
        if ($userotp) {
            $userotp->otp = $otp;
            $userotp->save();
            
        } else {
            $userotp = new Otp();
            $userotp->otp = $otp;
            $userotp->mobile = $mobile_number;
            $userotp->save();
        }

        $body = 'Dear User, OTP for verify your number is ' . $otp . '.';
        $sendOtp = $this->sendSms($body, '+' . $mobile_number);
        if ($sendOtp) {
            $response['error'] = 'false';
            $response['error_message'] = 'OTP sent successfully';
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'OTP not sent';
        }
        echo json_encode($response);
    }

    public function user_verifyotp(Request $request) {
        if ($request->otp && $request->mobile) {
            
            $otp = $request->otp;
            $mobile = str_replace('+','',$request->mobile);
            //$mobile = $request->mobile;
            $device_token = $request->device_token;
            $os_type = $request->os_type;

            if ($otp == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please send otp';
                echo json_encode($response);
                exit;
            }
            if ($mobile == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please send mobile';
                echo json_encode($response);
                exit;
            }
            if ($device_token == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please send device token';
                echo json_encode($response);
                exit;
            }
            // if ($os_type == '') {
            //     $response['error'] = 'true';
            //     $response['message'] = 'Please send os type';
            //     echo json_encode($response);
            //     exit;
            // }
            
            $otp_details = Otp::where('mobile', $mobile)->first();
            if ($otp_details) {
                if ($otp_details->otp == $otp) {

                    $otp_details->otp = null;
                    $otp_details->save();

                    $os_type = (isset($request->os_type)) ? $request->os_type : 'ios';

                    $userdetails = User::where('mobile', $mobile)->first();
                    if(!empty($userdetails)){
                        $userstype = 'old';
                        $user = User::where('id', $userdetails->id)->update(['os_type' => $os_type,'login_type' => 'phone','device_token' => $request->device_token ]);
                        $token = $userdetails->createToken(\Config::get('app.name'))->accessToken;
                    }else{
                        $userdetails = new User();
                        $userdetails->first_name = $mobile;
                        $userdetails->last_name = '';
                        $userdetails->email = '';
                        $userdetails->password = bcrypt($mobile);
                        $userdetails->mobile = $mobile;
                        $userdetails->device_token = $device_token;
                        $userdetails->os_type = $os_type;
                        $userdetails->plan_id = '1';
                        $userdetails->login_type = 'phone';
                        $userdetails->save();

                        $Userprofileimage = new Userprofileimage();
                        $Userprofileimage->user_id = $userdetails->id;
                        $Userprofileimage->save();

                        $userstype = 'new';
                        $token = $userdetails->createToken(\Config::get('app.name'))->accessToken;
                    }
                    
                    $data = [
                        "user" => $userdetails,
                        "user_type" => $userstype,
                        "token" => $token
                    ];
                    
                    $response['error'] = "false";
                    $response['error_message'] = "Otp verified.";
                    $response['user_details'] = $data;
                } else {
                    $response['error'] = "true";
                    $response['error_message'] = "Invalid Otp.";
                }
            } else {
                $response['error'] = "true";
                $response['error_message'] = "Mobile No is not registered with us.";
            }
        } else {
            $response['error'] = "true";
            $response['error_message'] = "otp  is empty";
        }

        echo json_encode($response);
    }

    public function view_profile(request $request) {
        $userid = Auth::guard('api')->user()->id;
        $userdetails = User::where('id', $userid)->first();
        if ($userdetails) {
            if($userdetails->image != ''){
               $userdetails->image=  url('/').'/images/'.$userdetails->image;
            }else{
                $userdetails->image= '';
            }
            $Userprofileimage = Userprofileimage::where('user_id','=',$userid)->get();
            if(!empty($Userprofileimage)){
                $getimg = array();
                foreach ($Userprofileimage as $ikey => $ivalue) {
                    $Userprofileimage[$ikey]->image =  ($ivalue->image != '') ? url('/').'/images/'.$ivalue->image : '';   
                    
                }
                $userdetails->profile_images = $Userprofileimage;
            }
            $UserCategory = UserCategory::select(DB::raw('user_categories.*,service_category.category_name,service_category.icon as category_image'))->leftJoin('service_category', 'service_category.id', '=', 'user_categories.category_id')->where('user_categories.user_id','=',$userid)->get();
            
            if(!empty($UserCategory)){
                $userdetails->category = $UserCategory;
            }else{
                $userdetails->category = '';
            }

            $UserStatus = UserStatus::select(DB::raw('user_status.*,event_user_status.status_name'))->where('user_status.user_id','=',$userid)->leftJoin('event_user_status', 'event_user_status.id', '=', 'user_status.user_status_id')->get();
            if(!empty($UserStatus)){
                $userdetails->user_status = $UserStatus;
            }else{
                $userdetails->user_status = '';
            }
            
            $response['error'] = 'false';
            $response['error_message'] = 'success';
            $response['user_details'] = $userdetails;
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'fail';
        //            $response['error_message']='fail';
        }
        echo json_encode($response);
    }

    public function update_profile(request $request) {
        $userid = Auth::guard('api')->user()->id;
        
        $phone_number = str_replace('+','',$request->phone_number);
        $phone_number = str_replace(' ','',$phone_number);
        $phone_number = str_replace('-','',$phone_number);

        if ($request->first_name == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send first name';
            echo json_encode($response);
            exit;
        }
        if ($request->last_name == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send last name';
            echo json_encode($response);
            exit;
        }
        if ($request->age == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send age';
            echo json_encode($response);
            exit;
        }
        if ($request->gender == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send gender';
            echo json_encode($response);
            exit;
        }
        if ($request->email == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send email';
            echo json_encode($response);
            exit;
        }
        if ($request->latitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send latitude';
            echo json_encode($response);
            exit;
        }
        if ($request->longitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send longitude';
            echo json_encode($response);
            exit;
        }

        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $email = $request->email;
        $mobile = $phone_number;
        $age = $request->age;
        $address = $request->address;
        $gender = $request->gender;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $max_distance = $request->max_distance;
        $age_interest = $request->age_interest;

        $image = $request->image;
        $images = '';
        if ($request->image != "") {
            $image = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/'), $image);
            $images = $image;

        }
        $update = User::where('id', $userid)->update(['first_name' => $first_name, 'last_name' => $last_name, 'image' => $images, 'age' => $age,'mobile' => $mobile, 'address' => $address, 'gender' => $gender, 'max_distance' => $max_distance,'age_interest' => $age_interest,  'latitude' => $latitude, 'longitude' => $longitude,'description' => $request->description]);
        if ($update) {
            $response['error'] = 'false';
            $response['error_message'] = 'success';
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'not updated.';
        }
        
        echo json_encode($response);
    }

    public function update_profile_image(request $request) {
        $userid = Auth::guard('api')->user()->id;
        $userdetails = Userprofileimage::where('user_id','=',$userid)->count();
        if($userdetails < 10){
            
            if ($request->image != "") {
                $image = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('images/'), $image);
                $image = $image;
                if ($image != "") {
                    $Userprofileimage = new Userprofileimage();
                    $Userprofileimage->user_id = $userid;
                    $Userprofileimage->image = $image;
                    $Userprofileimage->save();

                    $userImagedetails = User::where('id', $userid)->first();
                    if ($userImagedetails->image == '') {
                        $update = User::where('id', $userid)->update(['image' => $image]);
                    }

                    $response['error'] = 'false';
                    $response['error_message'] = 'success';
                }else{
                    $response['error'] = 'true';
                    $response['error_message'] = 'Please upload image';
                }
            }else{
                $response['error'] = 'true';
                $response['error_message'] = 'Please upload image';
            }
        }else{
            $response['error'] = 'true';
            $response['error_message'] = 'You already uploaded 10 images';
        }
        echo json_encode($response);
    }

    public function deleteProfileImage(request $request) {
        $userid = Auth::guard('api')->user()->id;
        $id = $request->id;
        $delete = Userprofileimage::where(['id' => $id])->delete();
        
        if ($delete) {
            $response['error'] = 'false';
            $response['error_message'] = 'Deleted successfully';
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'Invalid image id';
        }
        
        echo json_encode($response);
    }

    public function user_category_list(request $request) {
        $userid = Auth::guard('api')->user()->id;
        
            $UserCategory = UserCategory::select(DB::raw('user_categories.*,service_category.category_name'))->where('user_categories.user_id','=',$userid)->leftJoin('service_category', 'service_category.id', '=', 'user_categories.category_id')->get();
        
            if ($UserCategory) {
                $response['error'] = 'false';
                $response['error_message'] = 'success';
                $response['UserCategory'] = $UserCategory;
            } else {
                $response['error'] = 'true';
                $response['error_message'] = 'not found.';
            }
        
        echo json_encode($response);
    }

    public function category_list(request $request) {
        //$userid = Auth::guard('api')->user()->id;
        
            $category = Category::where('status','=','active')->get();
        
            if ($category) {
                $response['error'] = 'false';
                $response['error_message'] = 'success';
                $response['category'] = $category;
            } else {
                $response['error'] = 'true';
                $response['error_message'] = 'not found.';
            }
        
        echo json_encode($response);
    }

    public function update_category(request $request) {
        $userid = Auth::guard('api')->user()->id;
        if ($request->category_id == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send category id';
            echo json_encode($response);
            exit;
        }

        if ($request->category_id) {
            $category_id = $request->category_id;
            $sub_category_id = $request->sub_category_id;

            $explod_cat = explode(',', $category_id);
            foreach ($explod_cat as $key => $value) {
                $UserCategory = UserCategory::where('user_id','=',$userid)->where('category_id','=',$value)->first();
                if(empty($UserCategory)){
                    $AddUserCategory = new UserCategory();
                    $AddUserCategory->user_id = $userid;
                    $AddUserCategory->category_id = $value;
                    $AddUserCategory->sub_category_id = $sub_category_id;
                    $AddUserCategory->save();
                }else{
                    $AddUserCategory = UserCategory::where('id', $UserCategory->id)->update(['category_id' => $value, 'sub_category_id' => $sub_category_id]);
                }
            }
            
            
            if ($AddUserCategory) {
                $response['error'] = 'false';
                $response['error_message'] = 'success';
            } else {
                $response['error'] = 'true';
                $response['error_message'] = 'not updated.';
            }
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'Mandatory Parameter are empty';
        }
        echo json_encode($response);
    }

    public function addUserEvent(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $event_name = $request->event_name;
        try
        {
            $user_events = new UserEvents();
            $user_events->user_id = $userid;
            $user_events->event_name = $request->event_name;
            $user_events->description = $request->description;
            $user_events->status = '0';
            $user_events->save();

            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function currentEventList(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $userdetails = User::where('id', $userid)->first();
        $max_distance = $userdetails->max_distance;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        if ($latitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send latitude';
            echo json_encode($response);
            exit;
        }
        if ($longitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send longitude';
            echo json_encode($response);
            exit;
        }
        try
        {
            $currentdate = date('Y-m-d');
            
            // $UserEvents = DB::select(DB::raw("select id,user_id,event_name,vanue_name,event_start_date,event_start_time,event_end_date,event_end_time,event_image,address,city,state,postal_code,country,latitude,longitude,description,status,event_rating,is_trending_event,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `user_events` where `status` = '0' and DATE(event_start_date) <= '$currentdate' and DATE(event_end_date) >= '$currentdate' GROUP BY id HAVING distance <= '$max_distance' ORDER by distance ASC"));

            $UserEvents = DB::select(DB::raw("select id,user_id,event_name,vanue_name,event_start_date,event_start_time,event_end_date,event_end_time,event_image,address,city,state,postal_code,country,latitude,longitude,description,status,event_rating,is_trending_event,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `user_events` where `status` = '0' and DATE(event_end_date) >= '$currentdate'  ORDER by distance ASC"));
            $new_event_list =array();
            foreach ($UserEvents as $key => $value) {

                if($value->event_image != ''){
                       $UserEvents[$key]->event_image=  url('/').'/images/'.$value->event_image;
                }else{
                    $UserEvents[$key]->event_image= '';
                }
                $eventBennerList = EventBenner::where('event_id','=',$value->id)->get();
                if(!empty($eventBennerList)){
                    $benner_list = array();
                    foreach ($eventBennerList as $bkey => $bvalue) {
                        if($bvalue->banner_image != ''){
                           $bvalue->banner_image= url('/').'/images/'.$bvalue->banner_image;
                        }else{
                            $bvalue->banner_image= '';
                        } 
                        array_push($benner_list, $bvalue);
                    }
                   $UserEvents[$key]->event_benner_image= $benner_list;
                }else{
                    $UserEvents[$key]->event_benner_image= '';
                } 

                $UserJoinEvent = UserJoinEvent::where('user_id','=',$userid)->where('event_id','=',$value->id)->first();
                if (!empty($UserJoinEvent)) {
                    $UserEvents[$key]->is_join_event= 'yes';
                }else{
                    $UserEvents[$key]->is_join_event= 'no';
                }
                $JoinEventUserList = UserJoinEvent::select(DB::raw('user_join_event.*,users.first_name,users.last_name,users.email,users.image,users.age'))->leftJoin('users', 'users.id', '=', 'user_join_event.user_id')->where('event_id','=',$value->id)->get();
                if (!empty($JoinEventUserList)) {
                    foreach ($JoinEventUserList as $ekey => $evalue) {
                        if($evalue->image != ''){
                           $evalue->image= url('/').'/images/'.$evalue->image;
                        }else{
                            $evalue->image= '';
                        } 
                    }
                    $UserEvents[$key]->join_event_user_list= $JoinEventUserList;
                }else{
                    $UserEvents[$key]->join_event_user_list= [];
                }

                $UserJoinEvent = UserJoinEvent::where('user_id','=',$userid)->where('event_id','=',$value->id)->first();
                if(!empty($UserJoinEvent)){
                    unset($UserEvents[$key]);
                }else{
                   array_push($new_event_list, $UserEvents[$key]);
                }
                
            }
            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['groups'] = $new_event_list;
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function upcomingEventList(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $userdetails = User::where('id', $userid)->first();
        $max_distance = $userdetails->max_distance;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        if ($latitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send latitude';
            echo json_encode($response);
            exit;
        }
        if ($longitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send longitude';
            echo json_encode($response);
            exit;
        }
        try
        {
            $currentdate = date('Y-m-d');

            // $UserEvents = DB::select(DB::raw("select id,user_id,event_name,vanue_name,event_start_date,event_start_time,event_end_date,event_end_time,event_image,address,city,state,postal_code,country,latitude,longitude,description,status,event_rating,is_trending_event,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `user_events` where `status` = '0' and DATE(event_start_date) >= '$currentdate' GROUP BY id HAVING distance <= '$max_distance' ORDER by distance ASC"));

            $UserEvents = DB::select(DB::raw("select id,user_id,event_name,vanue_name,event_start_date,event_start_time,event_end_date,event_end_time,event_image,address,city,state,postal_code,country,latitude,longitude,description,status,event_rating,is_trending_event,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `user_events` where `status` = '0' and DATE(event_start_date) >= '$currentdate' ORDER by distance ASC"));
            $new_event_list =array();
            foreach ($UserEvents as $key => $value) {
                if($value->event_image != ''){
                   $UserEvents[$key]->event_image=  url('/').'/images/'.$value->event_image;
                }else{
                    $UserEvents[$key]->event_image= '';
                }
                $eventBennerList = EventBenner::where('event_id','=',$value->id)->get();
                if(!empty($eventBennerList)){
                    $benner_list = array();
                    foreach ($eventBennerList as $bkey => $bvalue) {
                        if($bvalue->banner_image != ''){
                           $bvalue->banner_image= url('/').'/images/'.$bvalue->banner_image;
                        }else{
                            $bvalue->banner_image= '';
                        } 
                        array_push($benner_list, $bvalue);
                    }
                   $UserEvents[$key]->event_benner_image= $benner_list;
                }else{
                    $UserEvents[$key]->event_benner_image= '';
                } 

                $UserJoinEvent = UserJoinEvent::where('user_id','=',$userid)->where('event_id','=',$value->id)->first();
                if (!empty($UserJoinEvent)) {
                    $UserEvents[$key]->is_join_event= 'yes';
                }else{
                    $UserEvents[$key]->is_join_event= 'no';
                }
                $JoinEventUserList = UserJoinEvent::select(DB::raw('user_join_event.*,users.first_name,users.last_name,users.email,users.image,users.age'))->leftJoin('users', 'users.id', '=', 'user_join_event.user_id')->where('event_id','=',$value->id)->get();
                if (!empty($JoinEventUserList)) {
                    foreach ($JoinEventUserList as $ekey => $evalue) {
                        if($evalue->image != ''){
                           $evalue->image= url('/').'/images/'.$evalue->image;
                        }else{
                            $evalue->image= '';
                        } 
                    }
                    $UserEvents[$key]->join_event_user_list= $JoinEventUserList;
                }else{
                    $UserEvents[$key]->join_event_user_list= [];
                } 

                $UserJoinEvent = UserJoinEvent::where('user_id','=',$userid)->where('event_id','=',$value->id)->first();
                if(!empty($UserJoinEvent)){
                    unset($UserEvents[$key]);
                }else{
                   array_push($new_event_list, $UserEvents[$key]);
                }
            }

                
            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['groups'] = $new_event_list;
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function pastEventList(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $userdetails = User::where('id', $userid)->first();
        $max_distance = $userdetails->max_distance;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        if ($latitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send latitude';
            echo json_encode($response);
            exit;
        }
        if ($longitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send longitude';
            echo json_encode($response);
            exit;
        }
        try
        {
            $currentdate = date('Y-m-d');

            // $UserEvents = DB::select(DB::raw("select id,user_id,event_name,vanue_name,event_start_date,event_start_time,event_end_date,event_end_time,event_image,address,city,state,postal_code,country,latitude,longitude,description,status,event_rating,is_trending_event,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `user_events` where `status` = '0' and DATE(event_end_date) <= '$currentdate' GROUP BY id HAVING distance <= '$max_distance' ORDER by distance ASC"));

            $UserEvents = DB::select(DB::raw("select id,user_id,event_name,vanue_name,event_start_date,event_start_time,event_end_date,event_end_time,event_image,address,city,state,postal_code,country,latitude,longitude,description,status,event_rating,is_trending_event,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `user_events` where `status` = '0' and DATE(event_end_date) <= '$currentdate' ORDER by distance ASC"));
            $new_event_list =array();
            foreach ($UserEvents as $key => $value) {

                if($value->event_image != ''){
                   $UserEvents[$key]->event_image=  url('/').'/images/'.$value->event_image;
                }else{
                    $UserEvents[$key]->event_image= '';
                }
                $eventBennerList = EventBenner::where('event_id','=',$value->id)->get();
                if(!empty($eventBennerList)){
                    $benner_list = array();
                    foreach ($eventBennerList as $bkey => $bvalue) {
                        if($bvalue->banner_image != ''){
                           $bvalue->banner_image= url('/').'/images/'.$bvalue->banner_image;
                        }else{
                            $bvalue->banner_image= '';
                        } 
                        array_push($benner_list, $bvalue);
                    }
                   $UserEvents[$key]->event_benner_image= $benner_list;
                }else{
                    $UserEvents[$key]->event_benner_image= '';
                } 

                $UserJoinEvent = UserJoinEvent::where('user_id','=',$userid)->where('event_id','=',$value->id)->first();
                if (!empty($UserJoinEvent)) {
                    $UserEvents[$key]->is_join_event= 'yes';
                }else{
                    $UserEvents[$key]->is_join_event= 'no';
                }
                $JoinEventUserList = UserJoinEvent::select(DB::raw('user_join_event.*,users.first_name,users.last_name,users.email,users.image,users.age'))->leftJoin('users', 'users.id', '=', 'user_join_event.user_id')->where('event_id','=',$value->id)->get();
                if (!empty($JoinEventUserList)) {
                    foreach ($JoinEventUserList as $ekey => $evalue) {
                        if($evalue->image != ''){
                           $evalue->image= url('/').'/images/'.$evalue->image;
                        }else{
                            $evalue->image= '';
                        } 
                    }
                    $UserEvents[$key]->join_event_user_list= $JoinEventUserList;
                }else{
                    $UserEvents[$key]->join_event_user_list= [];
                }

                $UserJoinEvent = UserJoinEvent::where('user_id','=',$userid)->where('event_id','=',$value->id)->first();
                if(!empty($UserJoinEvent)){
                    unset($UserEvents[$key]);
                }else{
                   array_push($new_event_list, $UserEvents[$key]);
                }
                
            }
            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['groups'] = $new_event_list;
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function todayEventList(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $userdetails = User::where('id', $userid)->first();
        $max_distance = $userdetails->max_distance;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $todaydate = $request->todaydate;
        if ($latitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send latitude';
            echo json_encode($response);
            exit;
        }
        if ($longitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send longitude';
            echo json_encode($response);
            exit;
        }
        if ($todaydate == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send todaydate';
            echo json_encode($response);
            exit;
        }
        try
        {

            // $UserEvents = DB::select(DB::raw("select id,user_id,event_name,vanue_name,event_start_date,event_start_time,event_end_date,event_end_time,event_image,address,city,state,postal_code,country,latitude,longitude,description,status,event_rating,is_trending_event,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `user_events` where `status` = '0' and DATE(event_start_date) <= '$todaydate' and DATE(event_end_date) >= '$todaydate' GROUP BY id HAVING distance <= '$max_distance' ORDER by distance ASC"));

            $UserEvents = DB::select(DB::raw("select id,user_id,event_name,vanue_name,event_start_date,event_start_time,event_end_date,event_end_time,event_image,address,city,state,postal_code,country,latitude,longitude,description,status,event_rating,is_trending_event,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `user_events` where `status` = '0' and DATE(event_start_date) <= '$todaydate' and DATE(event_end_date) >= '$todaydate' ORDER by distance ASC"));
            $new_event_list =array();
            foreach ($UserEvents as $key => $value) {
                if($value->event_image != ''){
                   $UserEvents[$key]->event_image=  url('/').'/images/'.$value->event_image;
                }else{
                    $UserEvents[$key]->event_image= '';
                }
                $eventBennerList = EventBenner::where('event_id','=',$value->id)->get();
                if(!empty($eventBennerList)){
                    $benner_list = array();
                    foreach ($eventBennerList as $bkey => $bvalue) {
                        if($bvalue->banner_image != ''){
                           $bvalue->banner_image= url('/').'/images/'.$bvalue->banner_image;
                        }else{
                            $bvalue->banner_image= '';
                        } 
                        array_push($benner_list, $bvalue);
                    }
                   $UserEvents[$key]->event_benner_image= $benner_list;
                }else{
                    $UserEvents[$key]->event_benner_image= '';
                } 

                $UserJoinEvent = UserJoinEvent::where('user_id','=',$userid)->where('event_id','=',$value->id)->first();
                if (!empty($UserJoinEvent)) {
                    $UserEvents[$key]->is_join_event= 'yes';
                }else{
                    $UserEvents[$key]->is_join_event= 'no';
                }
                $JoinEventUserList = UserJoinEvent::select(DB::raw('user_join_event.*,users.first_name,users.last_name,users.email,users.image,users.age'))->leftJoin('users', 'users.id', '=', 'user_join_event.user_id')->where('event_id','=',$value->id)->get();
                if (!empty($JoinEventUserList)) {
                    foreach ($JoinEventUserList as $ekey => $evalue) {
                        if($evalue->image != ''){
                           $evalue->image= url('/').'/images/'.$evalue->image;
                        }else{
                            $evalue->image= '';
                        } 
                    }
                    $UserEvents[$key]->join_event_user_list= $JoinEventUserList;
                }else{
                    $UserEvents[$key]->join_event_user_list= [];
                }

                $UserJoinEvent = UserJoinEvent::where('user_id','=',$userid)->where('event_id','=',$value->id)->first();
                if(!empty($UserJoinEvent)){
                    unset($UserEvents[$key]);
                }else{
                   array_push($new_event_list, $UserEvents[$key]);
                }
            }
            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['groups'] = $new_event_list;
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function trendingEventList(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $userdetails = User::where('id', $userid)->first();
        $max_distance = $userdetails->max_distance;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        if ($latitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send latitude';
            echo json_encode($response);
            exit;
        }
        if ($longitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send longitude';
            echo json_encode($response);
            exit;
        }
        try
        {
            $todaydate = date('Y-m-d');

            // $UserEvents = DB::select(DB::raw("select id,user_id,event_name,vanue_name,event_start_date,event_start_time,event_end_date,event_end_time,event_image,address,city,state,postal_code,country,latitude,longitude,description,status,event_rating,is_trending_event,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `user_events` where `status` = '0' and `is_trending_event` = 'yes' and DATE(event_end_date) >= '$todaydate' GROUP BY id HAVING distance <= '$max_distance' ORDER by distance ASC"));

            $UserEvents = DB::select(DB::raw("select id,user_id,event_name,vanue_name,event_start_date,event_start_time,event_end_date,event_end_time,event_image,address,city,state,postal_code,country,latitude,longitude,description,status,event_rating,is_trending_event,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `user_events` where `status` = '0' and `is_trending_event` = 'yes' and DATE(event_end_date) >= '$todaydate' ORDER by distance ASC"));
            $new_event_list =array();
            foreach ($UserEvents as $key => $value) {
                if($value->event_image != ''){
                   $UserEvents[$key]->event_image=  url('/').'/images/'.$value->event_image;
                }else{
                    $UserEvents[$key]->event_image= '';
                }
                $eventBennerList = EventBenner::where('event_id','=',$value->id)->get();
                if(!empty($eventBennerList)){
                    $benner_list = array();
                    foreach ($eventBennerList as $bkey => $bvalue) {
                        if($bvalue->banner_image != ''){
                           $bvalue->banner_image= url('/').'/images/'.$bvalue->banner_image;
                        }else{
                            $bvalue->banner_image= '';
                        } 
                        array_push($benner_list, $bvalue);
                    }
                   $UserEvents[$key]->event_benner_image= $benner_list;
                }else{
                    $UserEvents[$key]->event_benner_image= '';
                } 

                $UserJoinEvent = UserJoinEvent::where('user_id','=',$userid)->where('event_id','=',$value->id)->first();
                if (!empty($UserJoinEvent)) {
                    $UserEvents[$key]->is_join_event= 'yes';
                }else{
                    $UserEvents[$key]->is_join_event= 'no';
                }
                $JoinEventUserList = UserJoinEvent::select(DB::raw('user_join_event.*,users.first_name,users.last_name,users.email,users.image,users.age'))->leftJoin('users', 'users.id', '=', 'user_join_event.user_id')->where('event_id','=',$value->id)->get();
                if (!empty($JoinEventUserList)) {
                    foreach ($JoinEventUserList as $ekey => $evalue) {
                        if($evalue->image != ''){
                           $evalue->image= url('/').'/images/'.$evalue->image;
                        }else{
                            $evalue->image= '';
                        } 
                    }
                    $UserEvents[$key]->join_event_user_list= $JoinEventUserList;
                }else{
                    $UserEvents[$key]->join_event_user_list= [];
                }

                $UserJoinEvent = UserJoinEvent::where('user_id','=',$userid)->where('event_id','=',$value->id)->first();
                if(!empty($UserJoinEvent)){
                    unset($UserEvents[$key]);
                }else{
                   array_push($new_event_list, $UserEvents[$key]);
                }
            }
            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['groups'] = $new_event_list;
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function hangoutUpcomingEvent(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $userdetails = User::where('id', $userid)->first();
        $max_distance = $userdetails->max_distance;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        if ($latitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send latitude';
            echo json_encode($response);
            exit;
        }
        if ($longitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send longitude';
            echo json_encode($response);
            exit;
        }
        try
        {
            $currentdate = date('Y-m-d');

            // $UserEvents = DB::select(DB::raw("select id,user_id,event_name,vanue_name,event_start_date,event_start_time,event_end_date,event_end_time,event_image,address,city,state,postal_code,country,latitude,longitude,description,status,event_rating,is_trending_event,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `user_events` where `status` = '0' and DATE(event_start_date) >= '$currentdate' GROUP BY id HAVING distance <= '$max_distance' ORDER by distance ASC"));

            $UserEvents = DB::select(DB::raw("SELECT user_join_event.*,user_events.event_name,user_events.vanue_name,user_events.event_start_date,user_events.event_start_time,user_events.event_end_date,user_events.event_end_time,user_events.event_image,user_events.event_location,user_events.latitude,user_events.longitude,user_events.distance,user_events.description,user_events.event_rating,user_events.event_type,user_events.status,user_events.is_trending_event,user_events.address,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance FROM `user_join_event` LEFT JOIN user_events ON user_events.id = user_join_event.event_id WHERE user_join_event.`user_id`= '$userid' AND user_events.status = '0' and DATE(user_events.event_end_date) >= '$currentdate' ORDER by user_events.distance ASC"));
            
            foreach ($UserEvents as $key => $value) {
                if($value->event_image != ''){
                   $UserEvents[$key]->event_image=  url('/').'/images/'.$value->event_image;
                }else{
                    $UserEvents[$key]->event_image= '';
                }
                $eventBennerList = EventBenner::where('event_id','=',$value->event_id)->get();
                if(!empty($eventBennerList)){
                    $benner_list = array();
                    foreach ($eventBennerList as $bkey => $bvalue) {
                        if($bvalue->banner_image != ''){
                           $bvalue->banner_image= url('/').'/images/'.$bvalue->banner_image;
                        }else{
                            $bvalue->banner_image= '';
                        } 
                        array_push($benner_list, $bvalue);
                    }
                   $UserEvents[$key]->event_benner_image= $benner_list;
                }else{
                    $UserEvents[$key]->event_benner_image= '';
                } 

                $UserJoinEvent = UserJoinEvent::where('user_id','=',$userid)->where('event_id','=',$value->event_id)->first();
                if (!empty($UserJoinEvent)) {
                    $UserEvents[$key]->is_join_event= 'yes';
                }else{
                    $UserEvents[$key]->is_join_event= 'no';
                }
                $JoinEventUserList = UserJoinEvent::select(DB::raw('user_join_event.*,users.first_name,users.last_name,users.email,users.image,users.age'))->leftJoin('users', 'users.id', '=', 'user_join_event.user_id')->where('event_id','=',$value->event_id)->get();
                if (!empty($JoinEventUserList)) {
                    foreach ($JoinEventUserList as $ekey => $evalue) {
                        if($evalue->image != ''){
                           $evalue->image= url('/').'/images/'.$evalue->image;
                        }else{
                            $evalue->image= '';
                        } 
                    }
                    $UserEvents[$key]->join_event_user_list= $JoinEventUserList;
                }else{
                    $UserEvents[$key]->join_event_user_list= [];
                }
            }
            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['groups'] = $UserEvents;
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function hangoutPastEvent(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $userdetails = User::where('id', $userid)->first();
        $max_distance = $userdetails->max_distance;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        if ($latitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send latitude';
            echo json_encode($response);
            exit;
        }
        if ($longitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send longitude';
            echo json_encode($response);
            exit;
        }
        try
        {
            $currentdate = date('Y-m-d');

            // $UserEvents = DB::select(DB::raw("select id,user_id,event_name,vanue_name,event_start_date,event_start_time,event_end_date,event_end_time,event_image,address,city,state,postal_code,country,latitude,longitude,description,status,event_rating,is_trending_event,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `user_events` where `status` = '0' and DATE(event_start_date) >= '$currentdate' GROUP BY id HAVING distance <= '$max_distance' ORDER by distance ASC"));

            $UserEvents = DB::select(DB::raw("SELECT user_join_event.*,user_events.event_name,user_events.vanue_name,user_events.event_start_date,user_events.event_start_time,user_events.event_end_date,user_events.event_end_time,user_events.event_image,user_events.event_location,user_events.latitude,user_events.longitude,user_events.distance,user_events.description,user_events.event_rating,user_events.event_type,user_events.status,user_events.is_trending_event,user_events.address,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance FROM `user_join_event` LEFT JOIN user_events ON user_events.id = user_join_event.event_id WHERE user_join_event.`user_id`= '$userid' AND user_events.status = '0' and DATE(user_events.event_end_date) <= '$currentdate' ORDER by user_events.distance ASC"));
            
            foreach ($UserEvents as $key => $value) {
                if($value->event_image != ''){
                   $UserEvents[$key]->event_image=  url('/').'/images/'.$value->event_image;
                }else{
                    $UserEvents[$key]->event_image= '';
                }
                $eventBennerList = EventBenner::where('event_id','=',$value->event_id)->get();
                if(!empty($eventBennerList)){
                    $benner_list = array();
                    foreach ($eventBennerList as $bkey => $bvalue) {
                        if($bvalue->banner_image != ''){
                           $bvalue->banner_image= url('/').'/images/'.$bvalue->banner_image;
                        }else{
                            $bvalue->banner_image= '';
                        } 
                        array_push($benner_list, $bvalue);
                    }
                   $UserEvents[$key]->event_benner_image= $benner_list;
                }else{
                    $UserEvents[$key]->event_benner_image= '';
                } 

                $UserJoinEvent = UserJoinEvent::where('user_id','=',$userid)->where('event_id','=',$value->event_id)->first();
                if (!empty($UserJoinEvent)) {
                    $UserEvents[$key]->is_join_event= 'yes';
                }else{
                    $UserEvents[$key]->is_join_event= 'no';
                }
                $JoinEventUserList = UserJoinEvent::select(DB::raw('user_join_event.*,users.first_name,users.last_name,users.email,users.image,users.age'))->leftJoin('users', 'users.id', '=', 'user_join_event.user_id')->where('event_id','=',$value->event_id)->get();
                if (!empty($JoinEventUserList)) {
                    foreach ($JoinEventUserList as $ekey => $evalue) {
                        if($evalue->image != ''){
                           $evalue->image= url('/').'/images/'.$evalue->image;
                        }else{
                            $evalue->image= '';
                        } 
                    }
                    $UserEvents[$key]->join_event_user_list= $JoinEventUserList;
                }else{
                    $UserEvents[$key]->join_event_user_list= [];
                }
            }
            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['groups'] = $UserEvents;
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function eventDetail(request $request){
        $userid          = Auth::guard('api')->user()->id;
        $userdetails = User::where('id', $userid)->first();
        $max_distance = $userdetails->max_distance;

        $latitude = $request->latitude;
        $longitude = $request->longitude;
        if ($latitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send latitude';
            echo json_encode($response);
            exit;
        }
        if ($longitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send longitude';
            echo json_encode($response);
            exit;
        }
        try
        {
            
            $UserEvents = UserEvents::select(DB::raw('id,user_id,event_name,vanue_name,event_start_date,event_start_time,event_end_date,event_end_time,event_image,address,city,state,postal_code,country,latitude,longitude,description,status,event_rating,is_trending_event,(6371  * acos (cos ( radians(' . $latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $longitude . ') )+ sin ( radians(' . $latitude . ') ) * sin( radians( latitude ) ) ) ) AS distance'))->find($request->id);
            
            if(!empty($UserEvents)){
                if($UserEvents->event_image != ''){
                   $UserEvents->event_image= url('/').'/images/'.$UserEvents->event_image;
                }else{
                    $UserEvents->event_image= '';
                } 

                $eventBennerList = EventBenner::where('event_id','=',$request->id)->get();
                if(!empty($eventBennerList)){
                    $benner_list = array();
                    foreach ($eventBennerList as $bkey => $bvalue) {
                        if($bvalue->banner_image != ''){
                           $bvalue->banner_image= url('/').'/images/'.$bvalue->banner_image;
                        }else{
                            $bvalue->banner_image= '';
                        } 
                        array_push($benner_list, $bvalue);
                    }
                   $UserEvents->event_benner_image= $benner_list;
                }else{
                    $UserEvents->event_benner_image= '';
                } 

                $UserJoinEvent = UserJoinEvent::where('user_id','=',$userid)->where('event_id','=',$request->id)->first();
                if (!empty($UserJoinEvent)) {
                    $UserEvents->is_join_event= 'yes';
                }else{
                    $UserEvents->is_join_event= 'no';
                }
                
                $JoinEventUserList = UserJoinEvent::select(DB::raw('user_join_event.*,users.first_name,users.last_name,users.email,users.image,users.age'))->leftJoin('users', 'users.id', '=', 'user_join_event.user_id')->where('event_id','=',$request->id)->get();
                if (!empty($JoinEventUserList)) {
                    foreach ($JoinEventUserList as $ekey => $evalue) {
                        if($evalue->image != ''){
                           $evalue->image= url('/').'/images/'.$evalue->image;
                        }else{
                            $evalue->image= '';
                        } 
                    }
                    $UserEvents->join_event_user_list= $JoinEventUserList;
                }else{
                    $UserEvents->join_event_user_list= [];
                }

                $response['error']         = 'false';
                $response['error_message'] = ' successfully.';
                $response['event'] = $UserEvents;
            }else{
                $response['error']         = 'false';
                $response['error_message'] = 'no data found';
            }
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);

    }

    public function userLatLongUpdate(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        try
        {
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            if ($latitude == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please send latitude';
                echo json_encode($response);
                exit;
            }
            if ($longitude == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please send longitude';
                echo json_encode($response);
                exit;
            }
            $updateUser = User::where('id', $userid)->update(['latitude' => $latitude, 'longitude' => $longitude]);

            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function userStatusList(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        try
        {
            $EventUserStatus = EventUserStatus::where('status','=','0')->get();

            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['status'] = $EventUserStatus;
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function usersList(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $search = $request->search;
        $userdetails = User::where('id', $userid)->first();
        $max_distance = $userdetails->max_distance;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        if ($latitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send latitude';
            echo json_encode($response);
            exit;
        }
        if ($longitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send longitude';
            echo json_encode($response);
            exit;
        }
        try
        {
            if($search != ''){
                $User = DB::select(DB::raw("select *,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `users` where `is_online` = 'online' and `status` = 'active' and id != $userid And (`first_name` LIKE '%$search%' OR `last_name` LIKE '%$search%' OR `email` LIKE '%$search%' OR `mobile` LIKE '%$search%')  ORDER by distance ASC"));
                foreach ($User as $key => $value) {
                    if($value->image != ''){
                       $value->image= url('/').'/images/'.$value->image;
                    }else{
                        $value->image= '';
                    }
                }
                
            }else{
                $User = DB::select(DB::raw("select *,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `users` where `is_online` = 'online' and `status` = 'active' and id != $userid  ORDER by distance ASC"));
                foreach ($User as $key => $value) {
                    if($value->image != ''){
                       $value->image= url('/').'/images/'.$value->image;
                    }else{
                        $value->image= '';
                    }
                }
            
            }
            

            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['users'] = $User;
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function groupsList(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $search = $request->search;
        
        try
        {
            if($search != ''){
                //DB::enableQueryLog();
                $UserMeetupGroup = UserMeetupGroup::where('status','=','0')
                ->where(function($query) use($search)  {
                    $query->where('group_name','like', '%' . $search . '%');
                })->get();
                //dd(DB::getQueryLog());exit;
            }else{
                $UserMeetupGroup = UserMeetupGroup::where('status','=','0')
                ->get();
            }
            if(!empty($UserMeetupGroup)){
                foreach ($UserMeetupGroup as $key => $value) {
                    $MeetupGroupUsers = MeetupGroupUsers::where('meetup_user_id','=',$value->user_id)->where('user_meetup_group_id','=',$value->id)->first();
                    if (!empty($MeetupGroupUsers)) {
                        $UserMeetupGroup[$key]->is_join_group= 'yes';
                    }else{
                        $UserMeetupGroup[$key]->is_join_group= 'no';
                    }
                    $Userprofileimage = User::find($value->user_id);
                    if(!empty($Userprofileimage)){
                        $Userprofileimage->image =  ($Userprofileimage->image != '') ? url('/').'/images/'.$Userprofileimage->image : '';
                        $UserMeetupGroup[$key]->admin_user = $Userprofileimage;
                    }else{
                        $UserMeetupGroup[$key]->admin_user = '';
                    }

                    $MeetupGroupUsersList = MeetupGroupUsers::where('meetup_user_id','!=',$value->user_id)->where('user_meetup_group_id','=',$value->id)->where('is_approve','=','Accepted')->get();
                    if(!empty($MeetupGroupUsersList)){
                        foreach ($MeetupGroupUsersList as $mgkey => $mgvalue) {
                            $otherUserprofileimage = User::select(DB::raw('users.first_name,users.last_name,users.image'))->find($mgvalue->meetup_user_id);
                            if(!empty($otherUserprofileimage)){
                                $MeetupGroupUsersList[$mgkey]->image =  ($otherUserprofileimage->image != '') ? url('/').'/images/'.$otherUserprofileimage->image : '';
                                $MeetupGroupUsersList[$mgkey]->first_name = $otherUserprofileimage->first_name;
                                $MeetupGroupUsersList[$mgkey]->last_name = $otherUserprofileimage->last_name;
                            }else{
                                $MeetupGroupUsersList[$mgkey]->image = '';
                                $MeetupGroupUsersList[$mgkey]->first_name = '';
                                $MeetupGroupUsersList[$mgkey]->last_name = '';
                            }
                        }
                        $UserMeetupGroup[$key]->other_users = $MeetupGroupUsersList;
                    }else{
                        $UserMeetupGroup[$key]->other_users = '';
                    }
                }
            }

            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['groups'] = $UserMeetupGroup;
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function eventsList(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $search = $request->search;
        $userdetails = User::where('id', $userid)->first();
        $max_distance = $userdetails->max_distance;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        if ($latitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send latitude';
            echo json_encode($response);
            exit;
        }
        if ($longitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send longitude';
            echo json_encode($response);
            exit;
        }
        try
        {
            if($search != ''){
                $UserEvents = DB::select(DB::raw("select id,user_id,event_name,vanue_name,event_start_date,event_start_time,event_end_date,event_end_time,event_image,address,city,state,postal_code,country,latitude,longitude,description,status,event_rating,is_trending_event,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `user_events` where `status` = '0' and  `event_name` LIKE '%$search%'  ORDER by distance ASC"));
                
            }else{
                $UserEvents = DB::select(DB::raw("select id,user_id,event_name,vanue_name,event_start_date,event_start_time,event_end_date,event_end_time,event_image,address,city,state,postal_code,country,latitude,longitude,description,status,event_rating,is_trending_event,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `user_events` where `status` = '0'  ORDER by distance ASC"));
            }
            $new_event_list =array();
            if(!empty($UserEvents)){
                foreach ($UserEvents as $key => $value) {
                if($value->event_image != ''){
                   $UserEvents[$key]->event_image=  url('/').'/images/'.$value->event_image;
                }else{
                    $UserEvents[$key]->event_image= '';
                }
                $eventBennerList = EventBenner::where('event_id','=',$value->id)->get();
                if(!empty($eventBennerList)){
                    $benner_list = array();
                    foreach ($eventBennerList as $bkey => $bvalue) {
                        if($bvalue->banner_image != ''){
                           $bvalue->banner_image= url('/').'/images/'.$bvalue->banner_image;
                        }else{
                            $bvalue->banner_image= '';
                        } 
                        array_push($benner_list, $bvalue);
                    }
                   $UserEvents[$key]->event_benner_image= $benner_list;
                }else{
                    $UserEvents[$key]->event_benner_image= '';
                } 

                $UserJoinEvent = UserJoinEvent::where('user_id','=',$userid)->where('event_id','=',$value->id)->first();
                if (!empty($UserJoinEvent)) {
                    $UserEvents[$key]->is_join_event= 'yes';
                }else{
                    $UserEvents[$key]->is_join_event= 'no';
                }
                $JoinEventUserList = UserJoinEvent::select(DB::raw('user_join_event.*,users.first_name,users.last_name,users.email,users.image,users.age'))->leftJoin('users', 'users.id', '=', 'user_join_event.user_id')->where('event_id','=',$value->id)->get();
                if (!empty($JoinEventUserList)) {
                    foreach ($JoinEventUserList as $ekey => $evalue) {
                        if($evalue->image != ''){
                           $evalue->image= url('/').'/images/'.$evalue->image;
                        }else{
                            $evalue->image= '';
                        } 
                    }
                    $UserEvents[$key]->join_event_user_list= $JoinEventUserList;
                }else{
                    $UserEvents[$key]->join_event_user_list= [];
                }

                $UserJoinEvent = UserJoinEvent::where('user_id','=',$userid)->where('event_id','=',$value->id)->first();
                if(!empty($UserJoinEvent)){
                    unset($UserEvents[$key]);
                }else{
                   array_push($new_event_list, $UserEvents[$key]);
                }
            }
            }
            
            
            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['events'] = $new_event_list;
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function usersProfileView(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $userdetails = User::where('id', $userid)->first();
        $max_distance = $userdetails->max_distance;
        $user_id = $request->user_id;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        if ($latitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send latitude';
            echo json_encode($response);
            exit;
        }
        if ($longitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send longitude';
            echo json_encode($response);
            exit;
        }
        if ($user_id == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send user';
            echo json_encode($response);
            exit;
        }
        try
        {
            
            $User = User::select(DB::raw('users.*,(6371  * acos (cos ( radians(' . $latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $longitude . ') )+ sin ( radians(' . $latitude . ') ) * sin( radians( latitude ) ) ) ) AS distance'))->where('id','=',$user_id)->first();

            if(!empty($User)){
                if($User->image != ''){
                   $User->image= url('/').'/images/'.$User->image;
                }else{
                    $User->image= '';
                }
                $Userprofileimage = Userprofileimage::where('user_id','=',$user_id)->get();
                if(!empty($Userprofileimage)){
                    $getimg = array();
                    foreach ($Userprofileimage as $ikey => $ivalue) {
                        
                        $Userprofileimage[$ikey]->image =  ($ivalue->image != '') ? url('/').'/images/'.$ivalue->image : '';
                    }
                    $User->profile_images = $Userprofileimage;
                }
                $UserCategory = UserCategory::select(DB::raw('user_categories.*,service_category.category_name,service_category.icon as category_image'))->where('user_categories.user_id','=',$user_id)->leftJoin('service_category', 'service_category.id', '=', 'user_categories.category_id')->get();
                if(!empty($UserCategory)){
                    $User->category = $UserCategory;
                }else{
                    $User->category = '';
                }

                $UserStatus = UserStatus::select(DB::raw('user_status.*,event_user_status.status_name'))->where('user_status.user_id','=',$user_id)->leftJoin('event_user_status', 'event_user_status.id', '=', 'user_status.user_status_id')->get();
                if(!empty($UserStatus)){
                    $User->user_status = $UserStatus;
                }else{
                    $User->user_status = '';
                }
                $UserMeetup = UserMeetupList::where('user_id','=',$userid)->where('meetup_user_id','=',$user_id)->first();
                if(!empty($UserMeetup)){

                    $User->meetup_is_approve = $UserMeetup->is_approve;
                }else{
                    $UserMeetup = UserMeetupList::where('user_id','=',$user_id)->where('meetup_user_id','=',$userid)->first();
                    if(!empty($UserMeetup)){
                        $User->meetup_is_approve = $UserMeetup->is_approve;
                    }else{
                        $User->meetup_is_approve = 'Request Meetup';
                    }
                    
                }

                $checkUserProfileView = UserProfileView::where('user_id','=',$userid)->where('view_user_id','=',$user_id)->first();
                if(empty($checkUserProfileView)){
                    $AddUserProfileView = new UserProfileView();
                    $AddUserProfileView->user_id = $userid;
                    $AddUserProfileView->view_user_id = $user_id;
                    $AddUserProfileView->save();

                    $profile_view_count = $User->profile_view_count + 1;
                    $UpdateUser = User::where('id', $user_id)->update(['profile_view_count' => $profile_view_count]);
                }

                $response['error']         = 'false';
                $response['error_message'] = ' successfully.';
                $response['users'] = $User;
            }else{
                $response['error']         = 'false';
                $response['error_message'] = 'No user found';
            }
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function updateUserStatus(request $request) {
        $userid = Auth::guard('api')->user()->id;
        if ($request->user_status) {
            $UserStatus = UserStatus::where('user_id','=',$userid)->first();
            if(empty($UserStatus)){
                $AddUserStatus = new UserStatus();
                $AddUserStatus->user_id = $userid;
                $AddUserStatus->user_status_id = $request->user_status;
                $AddUserStatus->save();
            }else{
                $AddUserStatus = UserStatus::where('id', $UserStatus->id)->update(['user_status_id' => $request->user_status]);
            }
            
            if ($AddUserStatus) {
                $response['error'] = 'false';
                $response['error_message'] = 'success';
            } else {
                $response['error'] = 'true';
                $response['error_message'] = 'not updated.';
            }
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'Mandatory Parameter are empty';
        }
        echo json_encode($response);
    }

    public function updateUserProfileImage(request $request) {
        $userid = Auth::guard('api')->user()->id;
        if ($request->img_id) {
            $Userprofileimage = Userprofileimage::find($request->img_id);
            if(!empty($Userprofileimage)){
                $update = User::where('id', $userid)->update(['image' => $Userprofileimage->image]);
            
                if ($update) {
                    $response['error'] = 'false';
                    $response['error_message'] = 'success';
                } else {
                    $response['error'] = 'true';
                    $response['error_message'] = 'not updated.';
                }
            }else{
                $response['error'] = 'true';
                $response['error_message'] = 'Profile image not found';
            }
            
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'Mandatory Parameter are empty';
        }
        echo json_encode($response);
    }

    public function nearByUsersList(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $userdetails = User::where('id', $userid)->first();
        $max_distance = $userdetails->max_distance;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $min_age = $request->min_age;
        $max_age = $request->max_age;
        $distance = $request->distance;
        if ($latitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send latitude';
            echo json_encode($response);
            exit;
        }
        if ($longitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send longitude';
            echo json_encode($response);
            exit;
        }
        try
        {
            // $User = DB::select(DB::raw("select *,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `users` where `is_online` = 'online' and `status` = 'active' and id != $userid  GROUP BY id HAVING distance <= '$max_distance' ORDER by distance ASC"));
            if($min_age != '' && $max_age != '' && $distance != ''){
                $User = DB::select(DB::raw("select *,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `users` where `is_online` = 'online' and `status` = 'active' and id != $userid and (`age` <= '$max_age' and `age` >= '$min_age') GROUP BY id HAVING distance <= '$distance' ORDER by distance ASC"));
            }elseif($min_age != '' && $max_age != '' && $distance == ''){
                $User = DB::select(DB::raw("select *,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `users` where `is_online` = 'online' and `status` = 'active' and id != $userid and (`age` <= '$max_age' and `age` >= '$min_age') ORDER by distance ASC"));
            }elseif($min_age == '' && $max_age == '' && $distance != ''){
                $User = DB::select(DB::raw("select *,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `users` where `is_online` = 'online' and `status` = 'active' and id != $userid  GROUP BY id HAVING distance <= '$distance' ORDER by distance ASC"));
            }else{
                $User = DB::select(DB::raw("select *,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `users` where `is_online` = 'online' and `status` = 'active' and id != $userid  ORDER by distance ASC"));
            }
            
            foreach ($User as $key => $value) {
                if($value->image != ''){
                   $value->image= url('/').'/images/'.$value->image;
                }else{
                    $value->image= '';
                }

                $UserMeetup = UserMeetupList::where('user_id','=',$userid)->where('meetup_user_id','=',$value->id)->first();
                if(!empty($UserMeetup)){

                    $User[$key]->meetup_is_approve = $UserMeetup->is_approve;
                }else{
                    $UserMeetup = UserMeetupList::where('user_id','=',$value->id)->where('meetup_user_id','=',$userid)->first();
                    if(!empty($UserMeetup)){
                        $User[$key]->meetup_is_approve = $UserMeetup->is_approve;
                    }else{
                        $User[$key]->meetup_is_approve = 'Request Meetup';
                    }
                    
                }
            }
            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['users'] = $User;
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function populerUsersList(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $userdetails = User::where('id', $userid)->first();
        $max_distance = $userdetails->max_distance;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $min_age = $request->min_age;
        $max_age = $request->max_age;
        $distance = $request->distance;
        if ($latitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send latitude';
            echo json_encode($response);
            exit;
        }
        if ($longitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send longitude';
            echo json_encode($response);
            exit;
        }
        try
        {
            // $User = DB::select(DB::raw("select *,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `users` where `is_online` = 'online' and `status` = 'active' and id != $userid  GROUP BY id HAVING distance <= '$max_distance' ORDER by distance ASC"));
            if($min_age != '' && $max_age != '' && $distance != ''){
                $User = DB::select(DB::raw("select *,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `users` where `is_online` = 'online' and `status` = 'active' and id != $userid and (`age` <= '$max_age' and `age` >= '$min_age') GROUP BY id HAVING distance <= '$distance' ORDER by profile_view_count DESC"));
            }elseif($min_age != '' && $max_age != '' && $distance == ''){
                $User = DB::select(DB::raw("select *,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `users` where `is_online` = 'online' and `status` = 'active' and id != $userid and (`age` <= '$max_age' and `age` >= '$min_age') ORDER by profile_view_count DESC"));
            }elseif($min_age == '' && $max_age == '' && $distance != ''){
                $User = DB::select(DB::raw("select *,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `users` where `is_online` = 'online' and `status` = 'active' and id != $userid  GROUP BY id HAVING distance <= '$distance' ORDER by profile_view_count DESC"));
            }else{
                $User = DB::select(DB::raw("select *,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `users` where `is_online` = 'online' and `status` = 'active' and id != $userid  ORDER by profile_view_count DESC"));
            }
            
            foreach ($User as $key => $value) {
                if($value->image != ''){
                   $value->image= url('/').'/images/'.$value->image;
                }else{
                    $value->image= '';
                }
            }
            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['users'] = $User;
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function partyNowUsersList(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $userdetails = User::where('id', $userid)->first();
        $max_distance = $userdetails->max_distance;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        if ($latitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send latitude';
            echo json_encode($response);
            exit;
        }
        if ($longitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send longitude';
            echo json_encode($response);
            exit;
        }
        try
        {
            // $User = DB::select(DB::raw("select *,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `users` where `is_online` = 'online' and `status` = 'active' and  id != $userid  GROUP BY id HAVING distance <= '$max_distance' ORDER by id ASC"));
            $User = DB::select(DB::raw("select *,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `users` where `is_online` = 'online' and `status` = 'active' and  id != $userid  ORDER by distance ASC"));
            foreach ($User as $key => $value) {
                if($value->image != ''){
                   $value->image= url('/').'/images/'.$value->image;
                }else{
                    $value->image= '';
                }
            }
            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['users'] = $User;
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function userOnlineStatus(request $request){
        $userid = Auth::guard('api')->user()->id;
        
        $userdetails = User::where('id', $userid)->first();
        $max_distance = $userdetails->max_distance;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        if ($latitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send latitude';
            echo json_encode($response);
            exit;
        }
        if ($longitude == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send longitude';
            echo json_encode($response);
            exit;
        }
        $status = $request->status;
        if ($status == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please send status';
            echo json_encode($response);
            exit;
        }
        $update = User::where('id', $userid)->update(['is_online' => $status]);
        if ($update) {
            $currentdate = date('Y-m-d');
            // $UserEvents = DB::select(DB::raw("select id,user_id,event_name,vanue_name,event_start_date,event_start_time,event_end_date,event_end_time,event_image,address,city,state,postal_code,country,latitude,longitude,description,status,event_rating,is_trending_event,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `user_events` where `status` = '0' and DATE(event_start_date) <= '$currentdate' and DATE(event_end_date) >= '$currentdate' GROUP BY id HAVING distance <= '$max_distance' ORDER by distance ASC"));

            $UserEvents = DB::select(DB::raw("select count(*) as ecount,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `user_events` where `status` = '0' and DATE(event_start_date) <= '$currentdate' and DATE(event_end_date) >= '$currentdate' ORDER by distance ASC"));

            // $User = DB::select(DB::raw("select *,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `users` where `is_online` = 'online' and `status` = 'active' and  id != $userid  GROUP BY id HAVING distance <= '$max_distance' ORDER by id ASC"));
            $Users = DB::select(DB::raw("select count(*) as count,(6371  * acos (cos ( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') )+ sin ( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance from `users` where `is_online` = 'online' and `status` = 'active' and  id != $userid  ORDER by distance ASC "));
            
            $response['events'] = $UserEvents[0]->ecount;
            $response['users'] = $Users[0]->count;
            $response['error'] = 'false';
            $response['error_message'] = 'success';
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'not updated.';
        }
        
        echo json_encode($response);
    }

    public function sendUserMeetup(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $sender_userdetails = User::where('id', $userid)->first();
        $user_id = $request->user_id;
        if ($user_id == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please select user';
            echo json_encode($response);
            exit;
        }
        try
        {
            $UserMeetup = UserMeetup::where('user_id','=',$userid)->where('meetup_user_id','=',$user_id)->first();
            if (empty($UserMeetup)) {
                $user_meetup = new UserMeetup();
                $user_meetup->user_id = $userid;
                $user_meetup->meetup_user_id = $user_id;
                $user_meetup->is_approve = 'Pending';
                $user_meetup->save();

                $userdetails = User::where('id', $user_id)->first();
                if(!empty($userdetails)){
                    $device_token = $userdetails->device_token;
                    $notification_count = $userdetails->notification_count;
                    $msg_count = $userdetails->msg_count;
                    $badge = $notification_count + $msg_count;
                    $main_title = 'New meetup request';
                    $body = 'New user '.$sender_userdetails->first_name.' send meetup request';
                    $otherData = array('type'=>'new_meetup_request','meet_id'=>$user_meetup->id);
                    $t = $this->sendPushNotification([$device_token],$main_title,$body,$otherData,'Peepalike',$userdetails->badge_count);

                    $u_push_count = $userdetails->notification_count + 1;
                    $u_badge_count = $userdetails->badge_count + 1;
                    $update_user_count = User::where('id', $userdetails->id)->update(['notification_count' => $u_push_count,'badge_count' => $u_badge_count]);

                    $addPushNotificationHistory = new PushNotificationHistory();
                    $addPushNotificationHistory->user_id = $user_id;
                    $addPushNotificationHistory->message = $body;
                    $addPushNotificationHistory->status = 'sent';
                    $addPushNotificationHistory->type = 'new_meetup_request';
                    $addPushNotificationHistory->other_type = 'meet_id';
                    $addPushNotificationHistory->other_id = $user_meetup->id;
                    $addPushNotificationHistory->sender_id = $userid;
                    $addPushNotificationHistory->receiver_id = $user_id;
                    $addPushNotificationHistory->sender_name = Auth::guard('api')->user()->first_name;
                    $addPushNotificationHistory->receiver_name = $userdetails->first_name;
                    $addPushNotificationHistory->other_name = '';
                    $addPushNotificationHistory->save();

                    $addUserMeetupList = new UserMeetupList();
                    $addUserMeetupList->user_id = $user_id;
                    $addUserMeetupList->meetup_user_id = $userid;
                    $addUserMeetupList->user_meetup_id = $user_meetup->id;
                    $addUserMeetupList->status = 'Pending';
                    $addUserMeetupList->is_approve = 'Pending';
                    $addUserMeetupList->save();

                    $addUserMeetupList = new UserMeetupList();
                    $addUserMeetupList->user_id = $userid;
                    $addUserMeetupList->meetup_user_id = $user_id;
                    $addUserMeetupList->user_meetup_id = $user_meetup->id;
                    $addUserMeetupList->status = 'Pending';
                    $addUserMeetupList->is_approve = 'Pending';
                    $addUserMeetupList->save();
                }
                

                $response['error']         = 'false';
                $response['error_message'] = ' successfully.';
            }else{
                $response['error']         = 'false';
                $response['error_message'] = 'you already sent request';
            }
        } catch (\Throwable $th)
        {
            //dd($th);
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function userMeetupList(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        try
        {
            $UserMeetup = UserMeetup::select(DB::raw('user_meetup.*,users.first_name,users.last_name'))->leftJoin('users', 'users.id', '=', 'user_meetup.meetup_user_id')->where('user_meetup.user_id','=',$userid)->get();

            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['status'] = $UserMeetup;
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function meetupRequestAcceptReject(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $main_userdetails = User::where('id', $userid)->first();

        $meet_id = $request->meet_id;
        $is_approve = $request->is_approve;
        if ($meet_id == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please pass meet up id';
            echo json_encode($response);
            exit;
        }
        if ($is_approve == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please pass status';
            echo json_encode($response);
            exit;
        }
        try
        {
            $getUserMeetup = UserMeetup::find($meet_id);
            if(!empty($getUserMeetup)){
                $UserMeetup = UserMeetup::where('id', $meet_id)->update(['is_approve' => $request->is_approve]);
            
                if($request->is_approve == 'Accepted'){
                    $userdetails = User::where('id', $getUserMeetup->user_id)->first();
                    if(!empty($userdetails)){
                        $device_token = $userdetails->device_token;
                        $notification_count = $userdetails->notification_count;
                        $msg_count = $userdetails->msg_count;
                        $badge = $notification_count + $msg_count;
                        $main_title = 'Your request is accepted';
                        $body = $main_userdetails->first_name.' has accepted your request';
                        $otherData = array('type'=>'meetup_request_accepted','meet_id'=>$meet_id);
                        $t = $this->sendPushNotification([$device_token],$main_title,$body,$otherData,'Peepalike',$userdetails->badge_count);

                        $u_push_count = $userdetails->notification_count + 1;
                        $u_badge_count = $userdetails->badge_count + 1;
                        $update_user_count = User::where('id', $userdetails->id)->update(['notification_count' => $u_push_count,'badge_count' => $u_badge_count]);

                        $addPushNotificationHistory = new PushNotificationHistory();
                        $addPushNotificationHistory->user_id = $getUserMeetup->user_id;
                        $addPushNotificationHistory->message = $body;
                        $addPushNotificationHistory->status = 'sent';
                        $addPushNotificationHistory->type = 'meetup_request_accepted';
                        $addPushNotificationHistory->other_type = 'meet_id';
                        $addPushNotificationHistory->other_id = $meet_id;
                        $addPushNotificationHistory->sender_id = $userid;
                        $addPushNotificationHistory->receiver_id = $getUserMeetup->user_id;
                        $addPushNotificationHistory->sender_name = Auth::guard('api')->user()->first_name;
                        $addPushNotificationHistory->receiver_name = $userdetails->first_name;
                        $addPushNotificationHistory->other_name = '';
                        $addPushNotificationHistory->save();
                        
                        $updateUserMeetupList = UserMeetupList::where('user_id', $getUserMeetup->user_id)->where('meetup_user_id', $userid)->where('user_meetup_id', $meet_id)->update(['status' => 'Accepted','is_approve' => 'Accepted']);

                        $updateUserMeetupList2 = UserMeetupList::where('user_id', $userid)->where('meetup_user_id', $getUserMeetup->user_id)->where('user_meetup_id', $meet_id)->update(['status' => 'Accepted','is_approve' => 'Accepted']);

                        // $addUserMeetupList = new UserMeetupList();
                        // $addUserMeetupList->user_id = $getUserMeetup->user_id;
                        // $addUserMeetupList->meetup_user_id = $userid;
                        // $addUserMeetupList->user_meetup_id = $meet_id;
                        // $addUserMeetupList->status = 'Accepted';
                        // $addUserMeetupList->is_approve = 'Accepted';
                        // $addUserMeetupList->save();

                        // $addUserMeetupList = new UserMeetupList();
                        // $addUserMeetupList->user_id = $userid;
                        // $addUserMeetupList->meetup_user_id = $getUserMeetup->user_id;
                        // $addUserMeetupList->user_meetup_id = $meet_id;
                        // $addUserMeetupList->status = 'Accepted';
                        // $addUserMeetupList->is_approve = 'Accepted';
                        // $addUserMeetupList->save();

                        $channel_id = 'event_'.$meet_id;
                        $chat_type = 'event';
                        $sendtype = 'join';
                        $msg_body = $userdetails->first_name.' Joined';
                        $Smslogs = Smslogs::create([
                            'channel_id' => $channel_id,
                            'user_id' => $getUserMeetup->user_id,
                            'group_id' => $meet_id,
                            'event_id' => '',
                            'sender_id' => $userid,
                            'receiver_id' => $getUserMeetup->user_id,
                            'type' => $sendtype,
                            'chat_type' => $chat_type,
                            'msg_body' => $msg_body,
                            'media_url' => '',
                            'status' => 'sent',
                        ]);

                        $updatePushNotificationHistory = PushNotificationHistory::where('id', $request->notification_id)->update(['type' => 'meetup_request_accepted','request_accepted_by' => $userid,'request_by_name' => Auth::guard('api')->user()->first_name]);

                        //$deletePushNotificationHistory = PushNotificationHistory::where(['id' => $request->notification_id])->delete();
                    }
                    
                }

                if($request->is_approve == 'Rejected'){
                    $userdetails = User::where('id', $getUserMeetup->user_id)->first();
                    if(!empty($userdetails)){
                        $device_token = $userdetails->device_token;
                        $notification_count = $userdetails->notification_count;
                        $msg_count = $userdetails->msg_count;
                        $badge = $notification_count + $msg_count;
                        $main_title = 'Your request is rejected';
                        $body = $main_userdetails->first_name.' has rejected your request';
                        $otherData = array('type'=>'meetup_request_rejected','meet_id'=>$meet_id);
                        $t = $this->sendPushNotification([$device_token],$main_title,$body,$otherData,'Peepalike',$userdetails->badge_count);

                        $u_push_count = $userdetails->notification_count + 1;
                        $u_badge_count = $userdetails->badge_count + 1;
                        $update_user_count = User::where('id', $userdetails->id)->update(['notification_count' => $u_push_count,'badge_count' => $u_badge_count]);

                        $addPushNotificationHistory = new PushNotificationHistory();
                        $addPushNotificationHistory->user_id = $getUserMeetup->user_id;
                        $addPushNotificationHistory->message = $body;
                        $addPushNotificationHistory->status = 'sent';
                        $addPushNotificationHistory->type = 'meetup_request_rejected';
                        $addPushNotificationHistory->other_type = 'meet_id';
                        $addPushNotificationHistory->other_id = $meet_id;
                        $addPushNotificationHistory->sender_id = $userid;
                        $addPushNotificationHistory->receiver_id = $getUserMeetup->user_id;
                        $addPushNotificationHistory->sender_name = Auth::guard('api')->user()->first_name;
                        $addPushNotificationHistory->receiver_name = $userdetails->first_name;
                        $addPushNotificationHistory->other_name = '';
                        $addPushNotificationHistory->save();

                        $updatePushNotificationHistory = PushNotificationHistory::where('id', $request->notification_id)->update(['type' => 'meetup_request_rejected','request_rejected_by' => $userid,'request_by_name' => Auth::guard('api')->user()->first_name]);

                        //$deletePushNotificationHistory = PushNotificationHistory::where(['id' => $request->notification_id])->delete();
                    }
                    
                }

                $response['error']         = 'false';
                $response['error_message'] = ' successfully.';
            }else{
                $response['error']         = 'false';
                $response['error_message'] = 'data not found';
            }
            
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function joinEvent(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $user_first_name         = Auth::guard('api')->user()->first_name;
        $event_id = $request->event_id;
        if ($event_id == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please select event';
            echo json_encode($response);
            exit;
        }
        
        try
        {
            $UserJoinEvent = UserJoinEvent::where('user_id','=',$userid)->where('event_id','=',$event_id)->first();
            if (empty($UserJoinEvent)) {
                $addUserJoinEvent = new UserJoinEvent();
                $addUserJoinEvent->user_id = $userid;
                $addUserJoinEvent->event_id = $event_id;
                $addUserJoinEvent->save();


                $eventdetails = UserJoinEvent::where('event_id', $addUserJoinEvent->id)->get();
                if(!empty($eventdetails)){
                    foreach($eventdetails as $key=>$vals){
                        if($vals->user_id == $userid){
                            $userdetails = User::where('id', $vals->user_id)->first();
                            if(!empty($userdetails)){
                                $device_token = $userdetails->device_token;
                                $notification_count = $userdetails->notification_count;
                                $msg_count = $userdetails->msg_count;
                                $badge = $notification_count + $msg_count;
                                $main_title = $user_first_name.' join event';
                                $body = $user_first_name.' join event';
                                $otherData = array('type'=>'event_join','event_id'=>$event_id);
                                $t = $this->sendPushNotification([$device_token],$main_title,$body,$otherData,'Peepalike',$userdetails->badge_count);

                                $u_push_count = $userdetails->notification_count + 1;
                                $u_badge_count = $userdetails->badge_count + 1;
                                $update_user_count = User::where('id',$userdetails->id)->update(['notification_count' => $u_push_count,'badge_count' => $u_badge_count]);
                            }
                        }
                    }
                }

                $channel_id = 'event_'.$event_id;
                $chat_type = 'event';
                $sendtype = 'join';
                $msg_body = $user_first_name.' join event';
                $Smslogs = Smslogs::create([
                    'channel_id' => $channel_id,
                    'user_id' => $userid,
                    'group_id' => '',
                    'event_id' => $event_id,
                    'sender_id' => $userid,
                    'receiver_id' => $userid,
                    'type' => $sendtype,
                    'chat_type' => $chat_type,
                    'msg_body' => $msg_body,
                    'media_url' => '',
                    'status' => 'sent',
                ]);

                $response['error']         = 'false';
                $response['error_message'] = ' successfully.';
            }else{
                $response['error']         = 'false';
                $response['error_message'] = 'you already sent request';
            }
        } catch (\Throwable $th)
        {
            dd($th);
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function addUserLocation(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $address = $request->address;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        try
        {
            $Useraddress = new Useraddress();
            $Useraddress->user_id = $userid;
            $Useraddress->address_line_1 = $address;
            $Useraddress->latitude = $latitude;
            $Useraddress->longitude = $longitude;
            $Useraddress->save();

            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function usersLocationList(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        try
        {
            $Useraddress = Useraddress::where('user_id','=',$userid)->get();

            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['address'] = $Useraddress;
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function deleteUsersLocation(request $request) {
        $userid = Auth::guard('api')->user()->id;
        $id = $request->id;
        $delete = Useraddress::where(['id' => $id,'user_id'=>$userid])->delete();
        
        if ($delete) {
            $response['error'] = 'false';
            $response['error_message'] = 'Deleted successfully';
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'Invalid  id';
        }
        
        echo json_encode($response);
    }

    public function addFavUsersLocation(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $id = $request->id;
        $is_favorite = $request->is_favorite;
        try
        {
            $Useraddress = Useraddress::where('id', $id)->update(['is_favorite' => $is_favorite]);

            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function addUserMeetupGroup(request $request){
        $userid          = Auth::guard('api')->user()->id;
        $userdetails = User::where('id', $userid)->first();
        $group_name = $request->group_name;
        $location_id = $request->location_id;
        $expired_time = $request->expired_time;
        $new_time = date("Y-m-d H:i:s", strtotime('+'.$expired_time.' hours'));

        try
        {
            //DB::enableQueryLog();
            $addUserMeetupGroup = new UserMeetupGroup();
            $addUserMeetupGroup->user_id = $userid;
            $addUserMeetupGroup->event_id = '0';
            $addUserMeetupGroup->group_name = $group_name;
            $addUserMeetupGroup->location_id = $location_id;
            $addUserMeetupGroup->expired_time = $expired_time;
            $addUserMeetupGroup->expired_date_time = $new_time;
            $addUserMeetupGroup->save();
            //dd(DB::getQueryLog());exit;
            $MeetupGroupUsers = new MeetupGroupUsers();
            $MeetupGroupUsers->user_meetup_group_id = $addUserMeetupGroup->id;
            $MeetupGroupUsers->admin_user_id = $userid;
            $MeetupGroupUsers->meetup_user_id = $userid;
            $MeetupGroupUsers->is_approve = 'Accepted';
            $MeetupGroupUsers->save();

            $channel_id = 'group_'.$addUserMeetupGroup->id;
            $chat_type = 'group';
            $sendtype = 'create';
            $msg_body = $userdetails->first_name.' created this group';
            $Smslogs = Smslogs::create([
                'channel_id' => $channel_id,
                'user_id' => $userid,
                'group_id' => $addUserMeetupGroup->id,
                'event_id' => '',
                'sender_id' => $userid,
                'receiver_id' => $userid,
                'type' => $sendtype,
                'chat_type' => $chat_type,
                'msg_body' => $msg_body,
                'media_url' => '',
                'status' => 'sent',
            ]);

            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function userMeetupGroupList(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        try
        {
            $UserMeetupGroup = UserMeetupGroup::select(DB::raw('user_meetup_group.*,user_address.address_line_1,user_address.latitude,user_address.longitude,user_address.is_favorite'))
            ->leftJoin('user_address', 'user_address.id', '=', 'user_meetup_group.location_id')->where(DB::raw('DATE(user_meetup_group.expired_date_time)'),'>=',date('Y-m-d'))->orderBy('user_meetup_group.id', 'desc')->get();
            if(!empty($UserMeetupGroup)){
                foreach ($UserMeetupGroup as $key => $value) {
                    $MeetupGroupUsers = MeetupGroupUsers::where('meetup_user_id','=',$value->user_id)->where('user_meetup_group_id','=',$value->id)->first();
                    if (!empty($MeetupGroupUsers)) {
                        $UserMeetupGroup[$key]->is_join_group= 'yes';
                    }else{
                        $UserMeetupGroup[$key]->is_join_group= 'no';
                    }
                    $Userprofileimage = User::find($value->user_id);
                    if(!empty($Userprofileimage)){
                        $Userprofileimage->image =  ($Userprofileimage->image != '') ? url('/').'/images/'.$Userprofileimage->image : '';
                        $UserMeetupGroup[$key]->admin_user = $Userprofileimage;
                    }else{
                        $UserMeetupGroup[$key]->admin_user = '';
                    }

                    $MeetupGroupUsersList = MeetupGroupUsers::where('meetup_user_id','!=',$value->user_id)->where('user_meetup_group_id','=',$value->id)->where('is_approve','=','Accepted')->get();
                    if(!empty($MeetupGroupUsersList)){
                        foreach ($MeetupGroupUsersList as $mgkey => $mgvalue) {
                            $otherUserprofileimage = User::select(DB::raw('users.first_name,users.last_name,users.image'))->find($mgvalue->meetup_user_id);
                            if(!empty($otherUserprofileimage)){
                                $MeetupGroupUsersList[$mgkey]->image =  ($otherUserprofileimage->image != '') ? url('/').'/images/'.$otherUserprofileimage->image : '';
                                $MeetupGroupUsersList[$mgkey]->first_name = $otherUserprofileimage->first_name;
                                $MeetupGroupUsersList[$mgkey]->last_name = $otherUserprofileimage->last_name;
                            }else{
                                $MeetupGroupUsersList[$mgkey]->image = '';
                                $MeetupGroupUsersList[$mgkey]->first_name = '';
                                $MeetupGroupUsersList[$mgkey]->last_name = '';
                            }
                        }
                        $UserMeetupGroup[$key]->other_users = $MeetupGroupUsersList;
                    }else{
                        $UserMeetupGroup[$key]->other_users = '';
                    }
                }
            }
            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['address'] = $UserMeetupGroup;
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function userMeetupGroupDetails(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $group_id =  $request->group_id;
        try
        {
            $UserMeetupGroup = UserMeetupGroup::select(DB::raw('user_meetup_group.*,user_address.address_line_1,user_address.latitude,user_address.longitude,user_address.is_favorite'))->leftJoin('user_address', 'user_address.id', '=', 'user_meetup_group.location_id')->where('user_meetup_group.id','=',$group_id)->get();
            if(!empty($UserMeetupGroup)){
                foreach ($UserMeetupGroup as $key => $value) {
                    $Userprofileimage = User::find($value->user_id);
                    if(!empty($Userprofileimage)){
                        $Userprofileimage->image =  ($Userprofileimage->image != '') ? url('/').'/images/'.$Userprofileimage->image : '';
                        $UserMeetupGroup[$key]->admin_user = $Userprofileimage;
                    }else{
                        $UserMeetupGroup[$key]->admin_user = '';
                    }
                    $MeetupGroupUsers = MeetupGroupUsers::where('meetup_user_id','=',$userid)->where('user_meetup_group_id','=',$value->id)->first();
                    if (!empty($MeetupGroupUsers)) {
                        $UserMeetupGroup[$key]->is_join_group= $MeetupGroupUsers->is_approve;
                    }else{
                        $UserMeetupGroup[$key]->is_join_group= 'no';
                    }
                    $MeetupGroupUsersList = MeetupGroupUsers::where('meetup_user_id','!=',$value->user_id)->where('user_meetup_group_id','=',$value->id)->where('is_approve','=','Accepted')->get();
                    if(!empty($MeetupGroupUsersList)){
                        foreach ($MeetupGroupUsersList as $mgkey => $mgvalue) {
                            $otherUserprofileimage = User::select(DB::raw('users.first_name,users.last_name,users.image'))->find($mgvalue->meetup_user_id);
                            if(!empty($otherUserprofileimage)){
                                $MeetupGroupUsersList[$mgkey]->image =  ($otherUserprofileimage->image != '') ? url('/').'/images/'.$otherUserprofileimage->image : '';
                                $MeetupGroupUsersList[$mgkey]->first_name = $otherUserprofileimage->first_name;
                                $MeetupGroupUsersList[$mgkey]->last_name = $otherUserprofileimage->last_name;
                            }else{
                                $MeetupGroupUsersList[$mgkey]->image = '';
                                $MeetupGroupUsersList[$mgkey]->first_name = '';
                                $MeetupGroupUsersList[$mgkey]->last_name = '';
                            }
                        }
                        $UserMeetupGroup[$key]->other_users = $MeetupGroupUsersList;
                    }else{
                        $UserMeetupGroup[$key]->other_users = '';
                    }

                   
                }
            }
            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['address'] = $UserMeetupGroup;
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function joinUserMeetupGroup(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $group_id = $request->group_id;
        
        try
        {
            $UserMeetupGroup = UserMeetupGroup::find($group_id);

            $MeetupGroupUsers = MeetupGroupUsers::where('user_meetup_group_id','=',$group_id)->where('admin_user_id','=',$UserMeetupGroup->user_id)->where('meetup_user_id','=',$userid)->first();
            if (empty($MeetupGroupUsers)) {
                $MeetupGroupUsers = new MeetupGroupUsers();
                $MeetupGroupUsers->user_meetup_group_id = $group_id;
                $MeetupGroupUsers->admin_user_id = $UserMeetupGroup->user_id;
                $MeetupGroupUsers->meetup_user_id = $userid;
                $MeetupGroupUsers->save();

                $getMeetupGroupUsers = MeetupGroupUsers::where('user_meetup_group_id','=',$group_id)->where('is_approve','=','Accepted')->get();
                foreach ($getMeetupGroupUsers as $key => $value) {
                    $userdetails = User::where('id', $value->user_id)->first();
                    if(!empty($userdetails)){
                        $device_token = $userdetails->device_token;
                        $notification_count = $userdetails->notification_count;
                        $msg_count = $userdetails->msg_count;
                        $badge = $notification_count + $msg_count;
                        $main_title = 'New user requested to join group';
                        $body = Auth::guard('api')->user()->first_name.' requested to join '.$UserMeetupGroup->group_name.' group';
                        $otherData = array('type'=>'join_group_request','meetup_group_id'=>$MeetupGroupUsers->id);
                        $t = $this->sendPushNotification([$device_token],$main_title,$body,$otherData,'Peepalike',$userdetails->badge_count);

                        $u_push_count = $userdetails->notification_count + 1;
                        $u_badge_count = $userdetails->badge_count + 1;
                        $update_user_count = User::where('id', $userdetails->id)->update(['notification_count' => $u_push_count,'badge_count' => $u_badge_count]);

                        $addPushNotificationHistory = new PushNotificationHistory();
                        $addPushNotificationHistory->user_id = $value->user_id;
                        $addPushNotificationHistory->message = $body;
                        $addPushNotificationHistory->status = 'sent';
                        $addPushNotificationHistory->type = 'join_group_request';
                        $addPushNotificationHistory->other_type = 'meetup_group_id';
                        $addPushNotificationHistory->other_id = $MeetupGroupUsers->id;
                        $addPushNotificationHistory->sender_id = $userid;
                        $addPushNotificationHistory->sender_name = Auth::guard('api')->user()->first_name;
                        $addPushNotificationHistory->receiver_id = $value->user_id;
                        $addPushNotificationHistory->receiver_name = $userdetails->first_name;
                        $addPushNotificationHistory->other_name = '';
                        $addPushNotificationHistory->group_name = $UserMeetupGroup->group_name;
                        $addPushNotificationHistory->group_id = $group_id;
                        $addPushNotificationHistory->save();
                    }
                }

                $userdetails = User::where('id', $UserMeetupGroup->user_id)->first();
                if(!empty($userdetails)){
                    $device_token = $userdetails->device_token;
                    $notification_count = $userdetails->notification_count;
                    $msg_count = $userdetails->msg_count;
                    $badge = $notification_count + $msg_count;
                    $main_title = 'New user requested to join group';
                    $body = Auth::guard('api')->user()->first_name.' requested to join '.$UserMeetupGroup->group_name.' group';
                    $otherData = array('type'=>'join_group_request','meetup_group_id'=>$MeetupGroupUsers->id);
                    $t = $this->sendPushNotification([$device_token],$main_title,$body,$otherData,'Peepalike',$userdetails->badge_count);

                    $u_push_count = $userdetails->notification_count + 1;
                    $u_badge_count = $userdetails->badge_count + 1;
                    $update_user_count = User::where('id', $userdetails->id)->update(['notification_count' => $u_push_count,'badge_count' => $u_badge_count]);

                    $addPushNotificationHistory = new PushNotificationHistory();
                    $addPushNotificationHistory->user_id = $UserMeetupGroup->user_id;
                    $addPushNotificationHistory->message = $body;
                    $addPushNotificationHistory->status = 'sent';
                    $addPushNotificationHistory->type = 'join_group_request';
                    $addPushNotificationHistory->other_type = 'meetup_group_id';
                    $addPushNotificationHistory->other_id = $MeetupGroupUsers->id;
                    $addPushNotificationHistory->sender_id = $userid;
                    $addPushNotificationHistory->sender_name = Auth::guard('api')->user()->first_name;
                    $addPushNotificationHistory->receiver_id = $UserMeetupGroup->user_id;
                    $addPushNotificationHistory->receiver_name = $userdetails->first_name;
                    $addPushNotificationHistory->other_name = '';
                    $addPushNotificationHistory->group_name = $UserMeetupGroup->group_name;
                    $addPushNotificationHistory->group_id = $group_id;
                    $addPushNotificationHistory->save();
                }
                

                $response['error']         = 'false';
                $response['error_message'] = ' successfully.';
            }else{
                $response['error']         = 'false';
                $response['error_message'] = 'You already sent request for join.';
            }
        } catch (\Throwable $th)
        {
            dd($th);
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function groupRequestAcceptReject(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $group_id = $request->group_id;
        $is_approve = $request->is_approve;
        if ($group_id == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please pass group id';
            echo json_encode($response);
            exit;
        }
        if ($is_approve == '') {
            $response['error'] = 'true';
            $response['message'] = 'Please pass status';
            echo json_encode($response);
            exit;
        }
        try
        {

            $MeetupGroupUsers = MeetupGroupUsers::where('id', $group_id)->update(['is_approve' => $request->is_approve]);
            $getMeetupGroupUsers = MeetupGroupUsers::find($group_id);
            $UserMeetupGroup = UserMeetupGroup::find($getMeetupGroupUsers->user_meetup_group_id);
            if($request->is_approve == 'Accepted'){
                $userdetails = User::where('id', $getMeetupGroupUsers->meetup_user_id)->first();
                if(!empty($userdetails)){
                    $device_token = $userdetails->device_token;
                    $notification_count = $userdetails->notification_count;
                    $msg_count = $userdetails->msg_count;
                    $badge = $notification_count + $msg_count;
                    $main_title = 'Your group request accepted';
                    $body = 'Your group request accepted';
                    $otherData = array('type'=>'group_request_accepted','group_id'=>$group_id);
                    $t = $this->sendPushNotification([$device_token],$main_title,$body,$otherData,'Peepalike',$userdetails->badge_count);

                    $u_push_count = $userdetails->notification_count + 1;
                    $u_badge_count = $userdetails->badge_count + 1;
                    $update_user_count = User::where('id', $userdetails->id)->update(['notification_count' => $u_push_count,'badge_count' => $u_badge_count]);

                    $addPushNotificationHistory = new PushNotificationHistory();
                    $addPushNotificationHistory->user_id = $getMeetupGroupUsers->meetup_user_id;
                    $addPushNotificationHistory->message = $body;
                    $addPushNotificationHistory->status = 'sent';
                    $addPushNotificationHistory->type = 'group_request_accepted';
                    $addPushNotificationHistory->other_type = 'group_id';
                    $addPushNotificationHistory->other_id = $group_id;
                    $addPushNotificationHistory->sender_id = $userid;
                    $addPushNotificationHistory->receiver_id = $getMeetupGroupUsers->meetup_user_id;
                    $addPushNotificationHistory->sender_name = Auth::guard('api')->user()->first_name;
                    $addPushNotificationHistory->receiver_name = $userdetails->first_name;
                    $addPushNotificationHistory->other_name = '';
                    $addPushNotificationHistory->group_name = $UserMeetupGroup->group_name;
                    $addPushNotificationHistory->save();

                    $channel_id = 'group_'.$group_id;
                    $chat_type = 'group';
                    $sendtype = 'join';
                    $msg_body = $userdetails->first_name.' join';
                    $Smslogs = Smslogs::create([
                        'channel_id' => $channel_id,
                        'user_id' => $getMeetupGroupUsers->meetup_user_id,
                        'group_id' => $group_id,
                        'event_id' => '',
                        'sender_id' => $userid,
                        'receiver_id' => $getMeetupGroupUsers->meetup_user_id,
                        'type' => $sendtype,
                        'chat_type' => $chat_type,
                        'msg_body' => $msg_body,
                        'media_url' => '',
                        'status' => 'sent',
                    ]);

                    $MeetupGroupUsers = MeetupGroupUsers::where('id', $group_id)->update(['request_accepted_by' => $userid,'request_by_name' => Auth::guard('api')->user()->first_name]);

                    $updatePushNotificationHistory = PushNotificationHistory::where('id', $request->notification_id)->update(['type' => 'group_request_accepted','request_accepted_by' => $userid,'request_by_name' => Auth::guard('api')->user()->first_name]);

                    //$deletePushNotificationHistory = PushNotificationHistory::where(['id' => $request->notification_id])->delete();
                }
            }

            if($request->is_approve == 'Rejected'){
                $userdetails = User::where('id', $getMeetupGroupUsers->meetup_user_id)->first();
                if(!empty($userdetails)){
                    $device_token = $userdetails->device_token;
                    $notification_count = $userdetails->notification_count;
                    $msg_count = $userdetails->msg_count;
                    $badge = $notification_count + $msg_count;
                    $main_title = 'Your group request rejected';
                    $body = 'Your group request rejected';
                    $otherData = array('type'=>'group_request_rejected','group_id'=>$group_id);
                    $t = $this->sendPushNotification([$device_token],$main_title,$body,$otherData,'Peepalike',$userdetails->badge_count);

                    $u_push_count = $userdetails->notification_count + 1;
                    $u_badge_count = $userdetails->badge_count + 1;
                    $update_user_count = User::where('id', $userdetails->id)->update(['notification_count' => $u_push_count,'badge_count' => $u_badge_count]);

                    $addPushNotificationHistory = new PushNotificationHistory();
                    $addPushNotificationHistory->user_id = $getMeetupGroupUsers->meetup_user_id;
                    $addPushNotificationHistory->message = $body;
                    $addPushNotificationHistory->status = 'sent';
                    $addPushNotificationHistory->type = 'group_request_rejected';
                    $addPushNotificationHistory->other_type = 'group_id';
                    $addPushNotificationHistory->other_id = $group_id;
                    $addPushNotificationHistory->sender_id = $userid;
                    $addPushNotificationHistory->receiver_id = $getMeetupGroupUsers->meetup_user_id;
                    $addPushNotificationHistory->sender_name = Auth::guard('api')->user()->first_name;
                    $addPushNotificationHistory->receiver_name = $userdetails->first_name;
                    $addPushNotificationHistory->other_name = '';
                    $addPushNotificationHistory->group_name = $UserMeetupGroup->group_name;
                    $addPushNotificationHistory->save();

                    $MeetupGroupUsers = MeetupGroupUsers::where('id', $group_id)->update(['request_by_name' => Auth::guard('api')->user()->first_name,'request_rejected_by' => $userid]);

                    $updatePushNotificationHistory = PushNotificationHistory::where('id', $request->notification_id)->update(['type' => 'group_request_rejected','request_rejected_by' => $userid,'request_by_name' => Auth::guard('api')->user()->first_name]);

                    //$deletePushNotificationHistory = PushNotificationHistory::where(['id' => $request->notification_id])->delete();
                }
            }

            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function notificationList(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        try
        {
            $PushNotificationHistory = PushNotificationHistory::select(DB::raw('push_notification_history.*,users.image'))->leftJoin('users', 'users.id', '=', 'push_notification_history.sender_id')->where('push_notification_history.user_id','=',$userid)->orderBy('id','desc')->get();
            foreach ($PushNotificationHistory as $key => $value) {
                if($value->image != ''){
                   $PushNotificationHistory[$key]->image= url('/').'/images/'.$value->image;
                }else{
                    $PushNotificationHistory[$key]->image= '';
                }
            }
            //$PushNotificationHistory = PushNotificationHistory::select(DB::raw('push_notification_history.*'))->where('push_notification_history.user_id','=',$userid)->get();
            
            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['notification'] = $PushNotificationHistory;
        } catch (\Throwable $th)
        {
            //dd($th);
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function myEventList(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        
        try
        {
            
            $UserEvents = DB::select(DB::raw("SELECT user_join_event.*,user_events.event_name,user_events.vanue_name,user_events.event_start_date,user_events.event_start_time,user_events.event_end_date,user_events.event_end_time,user_events.event_image,user_events.event_location,user_events.latitude,user_events.longitude,user_events.distance,user_events.description,user_events.event_rating,user_events.event_type,user_events.status,user_events.is_trending_event,user_events.address FROM `user_join_event` LEFT JOIN user_events ON user_events.id = user_join_event.event_id WHERE user_join_event.`user_id`= '$userid' AND user_events.status = '0' ORDER by user_events.updated_at desc"));
            
            foreach ($UserEvents as $key => $value) {
                if($value->event_image != ''){
                   $UserEvents[$key]->event_image=  url('/').'/images/'.$value->event_image;
                }else{
                    $UserEvents[$key]->event_image= '';
                }
                $eventBennerList = EventBenner::where('event_id','=',$value->event_id)->get();
                if(!empty($eventBennerList)){
                    $benner_list = array();
                    foreach ($eventBennerList as $bkey => $bvalue) {
                        if($bvalue->banner_image != ''){
                           $bvalue->banner_image= url('/').'/images/'.$bvalue->banner_image;
                        }else{
                            $bvalue->banner_image= '';
                        } 
                        array_push($benner_list, $bvalue);
                    }
                   $UserEvents[$key]->event_benner_image= $benner_list;
                }else{
                    $UserEvents[$key]->event_benner_image= '';
                } 

                $UserJoinEvent = UserJoinEvent::where('user_id','=',$userid)->where('event_id','=',$value->event_id)->first();
                if (!empty($UserJoinEvent)) {
                    $UserEvents[$key]->is_join_event= 'yes';
                }else{
                    $UserEvents[$key]->is_join_event= 'no';
                }
                $JoinEventUserList = UserJoinEvent::select(DB::raw('user_join_event.*,users.first_name,users.last_name,users.email,users.image,users.age'))->leftJoin('users', 'users.id', '=', 'user_join_event.user_id')->where('event_id','=',$value->event_id)->get();
                if (!empty($JoinEventUserList)) {
                    foreach ($JoinEventUserList as $ekey => $evalue) {
                        if($evalue->image != ''){
                           $evalue->image= url('/').'/images/'.$evalue->image;
                        }else{
                            $evalue->image= '';
                        } 
                    }
                    $UserEvents[$key]->join_event_user_list= $JoinEventUserList;
                }else{
                    $UserEvents[$key]->join_event_user_list= [];
                }
            }
            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['groups'] = $UserEvents;
        } catch (\Throwable $th)
        {
            //dd($th);
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function myMeetupUserList(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        try
        {
            
            $UserMeetup = UserMeetupList::select(DB::raw('user_meetup_list.*,users.first_name,users.last_name,users.image'))
            ->leftJoin('users', 'users.id', '=', 'user_meetup_list.user_id')
            ->where('user_meetup_list.meetup_user_id','=',$userid)
            ->where('user_meetup_list.is_approve','=','Accepted')->orderBy('user_meetup_list.updated_at', 'desc')->get();
            foreach ($UserMeetup as $key => $value) {
                if($value->image != ''){
                   $UserMeetup[$key]->image= url('/').'/images/'.$value->image;
                }else{
                    $UserMeetup[$key]->image= '';
                }
            }

            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['groups'] = $UserMeetup;
        } catch (\Throwable $th)
        {
            dd($th);
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function myGroupList(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        try
        {
            $MeetupGroupUsers = MeetupGroupUsers::select(DB::raw('meetup_group_users.*,user_meetup_group.*'))->leftJoin('user_meetup_group', 'user_meetup_group.id', '=', 'meetup_group_users.user_meetup_group_id')->where('meetup_group_users.meetup_user_id','=',$userid)->where('meetup_group_users.is_approve','=','Accepted')->orderBy('meetup_group_users.updated_at', 'desc')->where(DB::raw('DATE(user_meetup_group.expired_date_time)'),'>=',date('Y-m-d'))->get();
            foreach ($MeetupGroupUsers as $key => $value) {
                $Userprofileimage = User::find($value->user_id);
                if(!empty($Userprofileimage)){
                    $Userprofileimage->image =  ($Userprofileimage->image != '') ? url('/').'/images/'.$Userprofileimage->image : '';
                    $MeetupGroupUsers[$key]->admin_user = $Userprofileimage;
                }else{
                    $MeetupGroupUsers[$key]->admin_user = '';
                }
                    
                    $MeetupGroupUsersList = MeetupGroupUsers::where('meetup_user_id','!=',$value->user_id)->where('user_meetup_group_id','=',$value->user_meetup_group_id)->get();
                    if(!empty($MeetupGroupUsersList)){
                        foreach ($MeetupGroupUsersList as $mgkey => $mgvalue) {
                            $otherUserprofileimage = User::select(DB::raw('users.first_name,users.last_name,users.image'))->find($mgvalue->meetup_user_id);
                            if(!empty($otherUserprofileimage)){
                                $MeetupGroupUsersList[$mgkey]->image =  ($otherUserprofileimage->image != '') ? url('/').'/images/'.$otherUserprofileimage->image : '';
                                $MeetupGroupUsersList[$mgkey]->first_name = $otherUserprofileimage->first_name;
                                $MeetupGroupUsersList[$mgkey]->last_name = $otherUserprofileimage->last_name;
                            }else{
                                $MeetupGroupUsersList[$mgkey]->image = '';
                                $MeetupGroupUsersList[$mgkey]->first_name = '';
                                $MeetupGroupUsersList[$mgkey]->last_name = '';
                            }
                        }
                        $MeetupGroupUsers[$key]->other_users = $MeetupGroupUsersList;
                    }else{
                        $MeetupGroupUsers[$key]->other_users = '';
                    }
            }
            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['groups'] = $MeetupGroupUsers;
        } catch (\Throwable $th)
        {
            //dd($th);
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function addUserChat(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
       
        $user_id = $request->user_id;
        $group_id = $request->group_id;
        $event_id = $request->event_id;
        $chat_type = $request->chat_type;
        $msg_body = $request->msg_body;
        $channel_id = $request->channel_id;

        //upload image
        if ($request->file('mms_file') != "") {
            $mms_file = time() . '_' . uniqid() . '.' . $request->file('mms_file')->getClientOriginalExtension();
            $request->file('mms_file')->move(public_path('mms_images/'), $mms_file);
            $media_url = url('/').'/mms_images/'.$mms_file;
            $sendtype = 'mms';
        } else {
            $media_url = '';
            $sendtype = 'sms';
        }

        try
        {
           $userdetails = User::where('id', $userid)->first();
            if(!empty($userdetails)){
               $sender_image= url('/').'/images/'.$userdetails->image;
            }else{
                $sender_image= '';
            }
            $Smslogs = Smslogs::create([
                'channel_id' => $channel_id,
                'user_id' => $user_id,
                'group_id' => $group_id,
                'event_id' => $event_id,
                'sender_id' => $userid,
                'receiver_id' => $user_id,
                'type' => $sendtype,
                'chat_type' => $chat_type,
                'msg_body' => $msg_body,
                'media_url' => $media_url,
                'status' => 'sent',
            ]);

            if($chat_type == 'personal'){
                $channel_id_explod = explode('_',$channel_id);
                $UserMeetupList = UserMeetupList::where('user_meetup_id', $channel_id_explod[1])->update(['last_chat_message' => $msg_body,'last_chat_type' => $sendtype,'last_chat_time' => date('Y-m-d H:i:s')]);

                $userdetails = User::where('id', $user_id)->first();
                if(!empty($userdetails)){
                    $device_token = $userdetails->device_token;
                    $notification_count = $userdetails->notification_count;
                    $msg_count = $userdetails->msg_count;
                    $badge = $notification_count + $msg_count;
                    $main_title = 'You have new message';
                    if($sendtype == 'sms'){
                        $body = $msg_body;
                    }else{
                        $body = 'image';
                    }
                    $get_unread_count_updtae = UserMeetupList::where('user_meetup_id', $channel_id_explod[1])->where('meetup_user_id', $user_id)->first();
                    $old_unread_count = $get_unread_count_updtae->unread_count + 1;
                    $unread_count_updtae = UserMeetupList::where('user_meetup_id', $channel_id_explod[1])->where('meetup_user_id', $user_id)->update(['unread_count' => $old_unread_count]);

                    $unread_count_updtae = UserMeetupList::where('user_meetup_id', $channel_id_explod[1])->where('meetup_user_id', $userid)->update(['unread_count' => '0']);
                    
                    $otherData = array('type'=>'new_msg','chat_type'=>'personal','user_id'=>$user_id);
                    $t = $this->sendPushNotification([$device_token],$main_title,$body,$otherData,'Peepalike',$userdetails->badge_count);

                    $u_push_count = $userdetails->msg_count + 1;
                    $u_badge_count = $userdetails->badge_count + 1;
                    $update_user_count = User::where('id', $userdetails->id)->update(['msg_count' => $u_push_count,'badge_count' => $u_badge_count]);
                }
            }

            if($chat_type == 'event'){
                $UserJoinEvent = UserJoinEvent::where('event_id', $event_id)->update(['last_chat_message' => $msg_body,'last_chat_type' => $sendtype,'last_chat_time' => date('Y-m-d H:i:s')]);
                $getUserJoinEvent = UserJoinEvent::where('event_id', $event_id)->get();
                foreach($getUserJoinEvent as $key=>$val){
                    $userdetails = User::where('id', $val->user_id)->first();
                    if(!empty($userdetails)){
                        if($userdetails->id != $userid){
                            $device_token = $userdetails->device_token;
                            $notification_count = $userdetails->notification_count;
                            $msg_count = $userdetails->msg_count;
                            $badge = $notification_count + $msg_count;
                            $main_title = 'You have new message';
                            if($sendtype == 'sms'){
                                $body = $msg_body;
                            }else{
                                $body = 'image';
                            }
                            $old_unread_count = $val->unread_count + 1;
                            $unread_count_updtae = UserJoinEvent::where('id', $val->id)->update(['unread_count' => $old_unread_count]);

                            $unread_count_updtae = UserJoinEvent::where('event_id', $event_id)->where('user_id', $userid)->update(['unread_count' => '0']);

                            $otherData = array('type'=>'new_msg','chat_type'=>'event','event_id'=>$event_id);
                            $t = $this->sendPushNotification([$device_token],$main_title,$body,$otherData,'Peepalike',$userdetails->badge_count);

                            $u_push_count = $userdetails->msg_count + 1;
                            $u_badge_count = $userdetails->badge_count + 1;
                            $update_user_count = User::where('id', $userdetails->id)->update(['msg_count' => $u_push_count,'badge_count' => $u_badge_count]);
                        }
                        
                    }
                }

            }

            if($chat_type == 'group'){
                $MeetupGroupUsers = MeetupGroupUsers::where('user_meetup_group_id', $group_id)->update(['last_chat_message' => $msg_body,'last_chat_type' => $sendtype,'last_chat_time' => date('Y-m-d H:i:s')]);

                $getMeetupGroupUsers = MeetupGroupUsers::where('user_meetup_group_id', $group_id)->where('is_approve', 'Accepted')->get();
                foreach($getMeetupGroupUsers as $key=>$val){
                    $userdetails = User::where('id', $val->meetup_user_id)->first();
                    if(!empty($userdetails)){
                        if($userdetails->id != $userid){
                            $device_token = $userdetails->device_token;
                            $notification_count = $userdetails->notification_count;
                            $msg_count = $userdetails->msg_count;
                            $badge = $notification_count + $msg_count;
                            $main_title = 'You have new message';
                            if($sendtype == 'sms'){
                                $body = $msg_body;
                            }else{
                                $body = 'image';
                            }
                            $old_unread_count = $val->unread_count + 1;
                            $unread_count_updtae = MeetupGroupUsers::where('id', $val->id)->update(['unread_count' => $old_unread_count]);

                            $unread_count_updtae = MeetupGroupUsers::where('user_meetup_group_id', $group_id)->where('meetup_user_id', $userid)->update(['unread_count' => '0']);

                            $otherData = array('type'=>'new_msg','chat_type'=>'group','group_id'=>$group_id);
                            $t = $this->sendPushNotification([$device_token],$main_title,$body,$otherData,'Peepalike',$userdetails->badge_count);

                            $u_push_count = $userdetails->msg_count + 1;
                            $u_badge_count = $userdetails->badge_count + 1;
                            $update_user_count = User::where('id', $userdetails->id)->update(['msg_count' => $u_push_count,'badge_count' => $u_badge_count]);
                        }
                        
                    }
                }
            }
            
            $pusher = new Pusher(config('app.PUSHER_APP_KEY'), config('app.PUSHER_APP_SECRET'), config('app.PUSHER_APP_ID'), array('cluster' => config('app.PUSHER_APP_CLUSTER')));
            $pusher->trigger('peepalike-channel', $channel_id, array('message' => 'send_chat_msg','channel_id'=>$channel_id,'user_id'=>$user_id,'group_id'=>$group_id,'event_id'=>$event_id,'sender_id'=>(string)$userid,'receiver_id'=>$user_id,'type'=>$sendtype,'chat_type'=>$chat_type,'msg_body'=>$msg_body,'media_url'=>$media_url,'sender_image'=>$sender_image,'status'=>'sent','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')));
            
            
            $response['error']         = 'false';
            $response['error_message'] = 'Send successfully.';
            
        } catch (\Throwable $th)
        {
            dd($th);
            $err = explode(':', $th->getMessage());
            $response['error']         = 'true';
            $response['error_message'] = $th->getMessage();
        }
        echo json_encode($response);
    }

    public function getAllChatMessage(request $request, EventService $EventService){

        $userid          = Auth::guard('api')->user()->id;
       
        $user_id = $request->user_id;
        $group_id = $request->group_id;
        $event_id = $request->event_id;
        $chat_type = $request->chat_type;
        $channel_id = $request->channel_id;
        try
        {
           $Smslogsdetails = $EventService->getChatMessageApi($request, '10');
            //dd($Smslogsdetails['Smslogs']);
            foreach ($Smslogsdetails['Smslogs'] as $key => $value) {
                $userdetails = User::where('id', $value->sender_id)->first();
                if($userdetails->image != ''){
                   $Smslogsdetails['Smslogs'][$key]->sender_image= url('/').'/images/'.$userdetails->image;
                }else{
                    $Smslogsdetails['Smslogs'][$key]->sender_image= '';
                }
            }

            if($chat_type == 'user'){
                $channel_id_explod = explode('_',$channel_id);
                $unread_count_updtae = UserMeetupList::where('user_meetup_id', $channel_id_explod[1])->where('meetup_user_id', $userid)->update(['unread_count' => '0']);
            }elseif ($chat_type == 'group') {
                $unread_count_updtae = MeetupGroupUsers::where('user_meetup_group_id', $group_id)->where('meetup_user_id', $userid)->update(['unread_count' => '0']);
            }elseif ($chat_type == 'event') {
               $unread_count_updtae = UserJoinEvent::where('event_id', $event_id)->where('user_id', $userid)->update(['unread_count' => '0']);
            }

            
            $response['error']         = 'false';
            $response['error_message'] = 'successfully.';
            $response['user_chat'] = $Smslogsdetails;
            
        } catch (\Throwable $th)
        {
            //dd($th);
            $err = explode(':', $th->getMessage());
            $response['error']         = 'true';
            $response['error_message'] = $th->getMessage();
        }
        echo json_encode($response);
    }

    public function addAbuseReport(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $type = $request->type;
        $user_id = $request->user_id;
        $event_id = $request->event_id;
        $group_id = $request->group_id;
        $user_comment = $request->user_comment;
        try
        {
            $name = '';
            if($type == 'user'){
                $userdetails = User::find($user_id);
                $name = $userdetails->first_name.' '.$userdetails->last_name;
            }elseif ($type == 'group') {
                $groupdetails = UserMeetupGroup::find($group_id);
                $name = $groupdetails->group_name;
            }elseif ($type == 'event') {
                $eventdetails = UserEvents::find($event_id);
                $name = $eventdetails->event_name;
            }
            $user_abuse_report = new UserAbuseReport();
            $user_abuse_report->type = $type;
            $user_abuse_report->user_id = $user_id;
            $user_abuse_report->event_id = $event_id;
            $user_abuse_report->group_id = $group_id;
            $user_abuse_report->name = $name;
            $user_abuse_report->user_comment = $user_comment;
            $user_abuse_report->created_by = $userid;
            $user_abuse_report->save();

            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function resetNotificationCount(request $request){

        $userid          = Auth::guard('api')->user()->id;
        $type = $request->type;
        
        try
        {
            
            if($type == 'notification'){
                $update_user_count = User::where('id', $userid)->update(['notification_count' => '0']);
            }elseif($type == 'message'){
                $update_user_count = User::where('id', $userid)->update(['msg_count' => '0']);
            }elseif($type == 'badge'){
                $update_user_count = User::where('id', $userid)->update(['badge_count' => '1']);
            }
            $userdetails = User::find($userid);
            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['user']         = $userdetails;
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function addEvent(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        
        try
        {
            $event_name = $request->event_name;
            $vanue_name = $request->vanue_name;
            $trending_event = $request->trending_event;
            $description = $request->description;
            $event_start_date = $request->event_start_date;
            $event_start_time = $request->event_start_time;
            $event_end_date = $request->event_end_date;
            $event_end_time = $request->event_end_time;
            $distance = $request->distance;
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $event_location = $request->event_location;
            $event_type = $request->event_type;
            $address = $request->address;
            $city = $request->city;
            $state = $request->state;
            $postal_code = $request->postal_code;
            $country = $request->country;

            if ($event_name == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass event name';
                echo json_encode($response);
                exit;
            }
            if ($vanue_name == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass vanue name';
                echo json_encode($response);
                exit;
            }
            if ($trending_event == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass trending event';
                echo json_encode($response);
                exit;
            }
            if ($description == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass description';
                echo json_encode($response);
                exit;
            }
            if ($request->event_image == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass event image';
                echo json_encode($response);
                exit;
            }
            if ($event_start_date == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass event start date';
                echo json_encode($response);
                exit;
            }
            if ($event_start_time == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass event start time';
                echo json_encode($response);
                exit;
            }
            if ($event_end_date == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass event end date';
                echo json_encode($response);
                exit;
            }
            if ($event_end_time == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass event end time';
                echo json_encode($response);
                exit;
            }
            if ($distance == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass distance';
                echo json_encode($response);
                exit;
            }
            if ($latitude == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass latitude';
                echo json_encode($response);
                exit;
            }
            if ($longitude == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass longitude';
                echo json_encode($response);
                exit;
            }
            if ($event_location == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass event location';
                echo json_encode($response);
                exit;
            }
            if ($event_type == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass event type';
                echo json_encode($response);
                exit;
            }
            if ($address == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass address';
                echo json_encode($response);
                exit;
            }
            if ($city == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass city';
                echo json_encode($response);
                exit;
            }
            if ($state == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass state';
                echo json_encode($response);
                exit;
            }
            if ($postal_code == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass postal code';
                echo json_encode($response);
                exit;
            }
            if ($country == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass country';
                echo json_encode($response);
                exit;
            }


            $UserEventsData = UserEvents::where(['event_name' => $event_name])->first();
            if(empty($UserEventsData)){
                $image = '';
                $img_type = '0';
                if ($request->event_image != "") {
                    $image = time() . '_' . uniqid() . '.' . $request->event_image->getClientOriginalExtension();
                    $request->event_image->move(public_path('images/'), $image);
                    $image = $image;
                    if($request->event_image->getClientOriginalExtension() == 'mp4'){
                        $img_type = '1';
                    }else{
                        $img_type = '0';
                    }
                }

                $addEvent = new UserEvents();
                $addEvent->user_id = $userid;
                $addEvent->event_name = $event_name;
                $addEvent->vanue_name = $vanue_name;
                $addEvent->is_trending_event = $trending_event;
                $addEvent->description = $description;
                $addEvent->event_start_date = $event_start_date;
                $addEvent->event_start_time = $event_start_time;
                $addEvent->event_end_date = $event_end_date;
                $addEvent->event_end_time = $event_end_time;
                $addEvent->event_location = $event_location;
                $addEvent->distance=$distance;
                $addEvent->latitude=$latitude;
                $addEvent->longitude=$longitude;
                $addEvent->event_image=$image;
                $addEvent->event_type=$event_type;
                $addEvent->address=$address;
                $addEvent->city=$city;
                $addEvent->state=$state;
                $addEvent->postal_code=$postal_code;
                $addEvent->country=$country;
                $addEvent->save();

                $addEventBenner = new EventBenner();
                $addEventBenner->event_id = $addEvent->id;
                $addEventBenner->banner_image = $image;
                $addEventBenner->img_type = $img_type;
                $addEventBenner->save();

                $response['error']         = 'false';
                $response['error_message'] = 'successfully.';
            }else{
                
                $response['error']         = 'true';
                $response['error_message'] = 'Event name already added';
            }
            
        } catch (\Throwable $th)
        {
            //dd($th);
            $err = explode(':', $th->getMessage());
            $response['error']         = 'true';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function updateEvent(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        try
        {
            $id = $request->event_id;
            $event_name = $request->event_name;
            $vanue_name = $request->vanue_name;
            $trending_event = $request->trending_event;
            $description = $request->description;
            $event_start_date = $request->event_start_date;
            $event_start_time = $request->event_start_time;
            $event_end_date = $request->event_end_date;
            $event_end_time = $request->event_end_time;
            $event_location = $request->event_location;
            $distance = $request->distance;
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $event_type = $request->event_type;
            $address = $request->address;
            $city = $request->city;
            $state = $request->state;
            $postal_code = $request->postal_code;
            $country = $request->country;

            if ($id == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass event id';
                echo json_encode($response);
                exit;
            }
            if ($event_name == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass event name';
                echo json_encode($response);
                exit;
            }
            if ($vanue_name == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass vanue name';
                echo json_encode($response);
                exit;
            }
            if ($trending_event == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass trending event';
                echo json_encode($response);
                exit;
            }
            if ($description == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass description';
                echo json_encode($response);
                exit;
            }
            if ($event_start_date == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass event start date';
                echo json_encode($response);
                exit;
            }
            if ($event_start_time == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass event start time';
                echo json_encode($response);
                exit;
            }
            if ($event_end_date == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass event end date';
                echo json_encode($response);
                exit;
            }
            if ($event_end_time == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass event end time';
                echo json_encode($response);
                exit;
            }
            if ($distance == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass distance';
                echo json_encode($response);
                exit;
            }
            if ($latitude == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass latitude';
                echo json_encode($response);
                exit;
            }
            if ($longitude == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass longitude';
                echo json_encode($response);
                exit;
            }
            if ($event_location == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass event location';
                echo json_encode($response);
                exit;
            }
            if ($event_type == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass event type';
                echo json_encode($response);
                exit;
            }
            if ($address == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass address';
                echo json_encode($response);
                exit;
            }
            if ($city == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass city';
                echo json_encode($response);
                exit;
            }
            if ($state == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass state';
                echo json_encode($response);
                exit;
            }
            if ($postal_code == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass postal code';
                echo json_encode($response);
                exit;
            }
            if ($country == '') {
                $response['error'] = 'true';
                $response['message'] = 'Please pass country';
                echo json_encode($response);
                exit;
            }

            $eventData = UserEvents::where(['event_name' => $event_name])->where('id','!=', $id)->first();
            if(empty($eventData)){

                $update_event = UserEvents::where('id', $id)
                ->update(['event_name' => $event_name,'vanue_name' => $vanue_name, 'description' => $description, 'event_start_date' => $event_start_date, 'event_start_time' => $event_start_time,'event_end_date' => $event_end_date,'event_end_time' => $event_end_time, 'event_location' => $event_location, 'distance' => $distance, 'latitude' => $latitude, 'longitude' => $longitude,'event_type' => $event_type,'address' => $address, 'city' => $city, 'state' => $state, 'postal_code' => $postal_code, 'country' => $country, 'is_trending_event' => $trending_event]);

                if ($request->image != "") {
                    $image = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
                    $request->image->move(public_path('images/'), $image);
                    $image = $image;

                    $update_event1 = UserEvents::where('id', $id)->update(['event_image' => $image]);
                }

                if ($update_event) {
                    
                    $response['error']         = 'false';
                    $response['error_message'] = 'Your Event update successfully';
                } else {
                    
                    $response['error']         = 'true';
                    $response['error_message'] = 'Error in Creating.';
                }
            }else{
                
                $response['error']         = 'true';
                $response['error_message'] = 'Event name already added';
            }

        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'true';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function deleteEvent(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        try
        {
            $id = $request->event_id;
            $delete_event = DB::table('user_events')->where('id', $id)->delete();
            if ($delete_event) {
                $response['error']         = 'false';
                $response['error_message'] = ' Your Event delete successfully.';
            } else {
                return redirect()->route('admin.eventList')->with('error', 'Error in delete.');
                $response['error']         = 'true';
                $response['error_message'] = 'Error in delete.';
            }
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'true';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
        
    }



    public function addGroup(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $group_name = $request->group_name;
        try
        {
            $group_chat = new Groupchat();
            $group_chat->name = $group_name;
            $group_chat->created_by = $userid;
            $group_chat->save();

            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function groupList(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        try
        {
            $Groupchat = Groupchat::where('created_by','=',$userid)->get();

            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['groups'] = $Groupchat;
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function addUserChatGroup(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        $group_name = $request->group_name;
        try
        {
            $UserChatGroup = new UserChatGroup();
            $UserChatGroup->group_id = $request->group_id;
            $UserChatGroup->user_id =$request->user_id;
            $UserChatGroup->created_by = $userid;
            $UserChatGroup->save();

            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function userChatGroupList(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;
        try
        {
            $Groupchat = UserChatGroup::where('created_by','=',$userid)->get();
            foreach ($Groupchat as $key => $value) {
                $users = User::find($value->user_id);
                if(!empty($users)){
                    $Groupchat[$key]->user_name = $users->first_name.''.$users->last_name;
                }else{
                    $Groupchat[$key]->user_name = '';
                }

                $Groupname = Groupchat::find($value->group_id);
                if(!empty($Groupname)){
                    $Groupchat[$key]->group_name = $Groupname->name;
                }else{
                    $Groupchat[$key]->group_name = '';
                }
            }

            $response['error']         = 'false';
            $response['error_message'] = ' successfully.';
            $response['user_chat'] = $Groupchat;
            
        } catch (\Throwable $th)
        {
            $err = explode(':', $th->getMessage());
            $response['error']         = 'false';
            $response['error_message'] = $err;
        }
        echo json_encode($response);
    }

    public function userChatHistory(request $request)
    {
        $userid          = Auth::guard('api')->user()->id;

        $sms_logs = DB::table('sms_logs')->where('booking_id', $request->booking_id)->get();
        if ($sms_logs) {
            foreach ($sms_logs as $key=>$value){
                
                if($value->media_url == null){
                    $sms_logs[$key]->media_url = '';
                }else{
                    $sms_logs[$key]->media_url = url('/').'/mms_images/'.$value->media_url;
                }

            }

            $response['error']         = 'false';
            $response['error_message'] = 'success';
            $response['chat_logs'] = $sms_logs;
        } else {
            $response['error']         = 'true';
            $response['error_message'] = 'No Logs';
        }
        echo json_encode($response);
    }

    public function testsocket(request $request){

        // set some variables
        $host = "peepalike.com";
        $port = 25008;
        // don't timeout!
        set_time_limit(0);
        // create socket
        $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
        // bind socket to port
        $result = socket_bind($socket, $host, $port) or die("Could not bind to socket\n");
        // start listening for connections
        $result = socket_listen($socket, 3) or die("Could not set up socket listener\n");

        // accept incoming connections
        // spawn another socket to handle communication
        $spawn = socket_accept($socket) or die("Could not accept incoming connection\n");
        // read client input
        $input = socket_read($spawn, 1254) or die("Could not read input\n");
        // clean up input string
        $input = trim($input);
        echo "Client Message : ".$input;
        // reverse client input and send back
        $output = strrev($input) . "\n";
        socket_write($spawn, $output, strlen ($output)) or die("Could not write output\n");
        // close sockets
        socket_close($spawn);
        socket_close($socket);

    }





 //========================================Old Code======================================================================================================================//

	public function testsms(Request $request){
        
        // $pusher = new Pusher(config('app.PUSHER_APP_KEY'), config('app.PUSHER_APP_SECRET'), config('app.PUSHER_APP_ID'), array('cluster' => config('app.PUSHER_APP_CLUSTER')));
        //     $pusher->trigger('peepalike-channel', 'peepalike', array('message' => 'send_chat_msg','agentname'=>'123'));

        $device_token = $request->device_token;
        //$device_token = 'f8P3s_VNDEFfvkucJEH-PK:APA91bGWUnnMpuV7c4MZaNBw7VOxaODMJbN3KwYVu2VEmNWhhUmT2wkz9nmLBRTQWbpMcZNPyASpqWiGMIEZARDGgYhtX6iT5wdZxfq8ZRHXHNukNXEUvkvw9-nt_AlaDlrpNJsTaACY';
        $main_title = 'Test notification';
        $body = 'New Notification';
        $otherData = 'Hello This is test notification';
        //$t = $this->sendPushNotification([$device_token],$main_title,$body,$otherData,'Peepalike');


        $otherData = array('type'=>'new_msg','chat_type'=>'group','group_id'=>'1');
        $t = $this->sendPushNotification([$device_token],$main_title,$body,$otherData,'Peepalike','1');
        echo '<pre>';print_r($t);

		// dd($t);
		// $body = 'Hallo, this is from ReadiWork 14:15';
		// //$mobile = "254722175570";
  //       $mobile = "6281808028674";
        
		// $sendOtp = $this->sendSms($body, '+' . $mobile);
	
	}
    
    /**
     * @param Request $request
     * @return mixed
     * Created by VDM
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'mobile' => 'required|unique:users',
            'login_type' => 'required'
        ]);

        $otp = $this->otpGenerator();

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->login_type = $request->login_type;
        $user->image = $request->image;
        $user->otp = $otp;
        $user->image = '';
//        if ($request->image != '') {
//            $imageUpload = new Imageupload();
//            $user->image = $imageUpload->imgupload($request->image);
//        }

        if ($user->save()) {
			$body = 'Dear ' . $user->first_name . ', OTP for ReadiWork is ' . $otp . '.';
            $sendOtp = $this->sendSms($body, '+' . $user->mobile);

            if ($sendOtp) {
                return $this->makeResponse('OTP sent to your registered mobile number.', ['id' => $user->id]);
            } else {
                return $this->makeError('Something went wrong.', []);
            }
			
             //return $this->makeResponse('OTP sent to your registered mobile number.', ['id' => $user->id]);
			
			
        } else {
            return $this->makeError('Registration failed !');
        }
    }

    /**
     * @param Request $request
     * @return mixed
     * Created by VDM
     */
    public function verifySignupOtp(Request $request)
    {
        $user = User::find($request->id);
        if ($user->otp == $request->otp) {
            $user->otp = '';
            $user->status = 'verified';
            //$user->status = 'active';
            
			$user->save();

            $data['first_name'] = $user->first_name;
            $data['last_name'] = $user->last_name;
            $data['email'] = $user->email;

            try {
                \Mail::to($user->email)->send((new RegistrationEmail($data)));
            } catch (\Exception $e) {
            }

            return $this->makeResponse('Verified successfully.', []);
        }
        return $this->makeError('Invalid verification code !');
    }

    /**
     * @param Request $request
     * @return mixed
     * Created by VDM
     */
    public function resendSignupOtp(Request $request)
    {
        $user = User::find($request->id);
        if ($user) {
            $body = 'Dear ' . $user->first_name . ', OTP for ReadiWork is ' . $user->otp . '.';
            $sendOtp = $this->sendSms($body, '+' . $user->mobile);

            if ($sendOtp) {
                return $this->makeResponse('OTP sent to your registered mobile number.', []);
            } else {
                return $this->makeError('Something went wrong.', []);
            }
        }
        return $this->makeError('Something went wrong !');
    }

    /**
     * @param Request $request
     * @return mixed
     * Created by VDM
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $client = new Client();
            try {
                $res = $client->request('POST', url('oauth/token'), [
                    'form_params' => [
                        'client_id' => 4,
                        'client_secret' => 'Lj5y6YL76kYjvVFAnsgH6ko6NAhZRi75snqmme90',
                        'grant_type' => 'password',
                        'username' => $request->email,
                        'password' => $request->password,
                        'scope' => '*',
                        'provider' => "User"
                    ]
                ]);
            } catch (\GuzzleHttp\Exception\BadResponseException $ex) {
                return $this->makeError('Incorrect email or password !');
            }
            if ($user->status != 'active') {
                return $this->makeError('Your account is not active, please contact support!');
            }

            $token = json_decode((string) $res->getBody(), true)['access_token'];
            $data = [
                "user" => $user,
                "token" => $token
            ];
            return $this->makeResponse('Login Successfully !', $data);
        } else {
            return $this->makeError('Incorrect email !');
        }
    }

    public function signup(Request $request) {
        if ($request->first_name && $request->last_name && $request->email && $request->password && $request->mobile) {
            $firstname = $request->first_name;
            $lastname = $request->last_name;
            $email = $request->email;
            $password = bcrypt($request->password);
            $mobile = $request->mobile;
            $image = !empty($request->image) ? $request->image : '';
            //$stripe = Stripe::make('STRIPE_KEY');
            //$customer = $stripe->customers()->create([
            //    'email' => $email,
            //]);
            //$customer_id=$customer['id'];

            $user_check = User::where('email', $email)->first();

            if ($user_check) {
                if ($user_check->login_type == 'google') {
                    $response['error'] = 'true';
                    $response['message'] = 'Already Signed using Google Login';
                }
                if ($user_check->login_type == 'facebook') {
                    $response['error'] = 'true';
                    $response['message'] = 'Already Signed using Facebook Login';
                }
                if ($user_check->login_type == 'manual') {
                    $response['error'] = 'true';
                    $response['message'] = 'Already Signed Registered';
                }
                echo json_encode($response);
                die;
            }
            $client = new Client();

            try {
                $newuser = new User();
                $newuser->first_name = $firstname;
                $newuser->last_name = $lastname;
                $newuser->email = $email;
                $newuser->password = $password;
                //$newuser->stripe_payment_account=$customer_id;
                $newuser->mobile = $mobile;
                if ($request->image) {
                    $newuser->image = $image;
                } else {
                    $newuser->image = " ";
                }

                $newuser->login_type = 'manual';
                $newuser->save();
            } catch (\Illuminate\Database\QueryException $ex) {
                $response['error'] = 'true';
                $response['message'] = 'Database Exception Error';
                echo json_encode($response);
                die;
            }
            if ($newuser) {
                $get_user = User::where('id', $newuser->id)->first();
                $token = $get_user->createToken('Token Name')->accessToken;

                $response['error'] = "false";
                $response['message'] = "Registration Successfully !";
                $responsee['access_token'] = $token;
            } else {
                $response['error'] = "true";
                $response['message'] = "Oops something went wrong.";
            }
        } else {
            $response['error'] = "true";
            $response['message'] = "Mandatory Parameters are Missing";
        }
        echo json_encode($response);
    }

    public function userlogin(Request $request) {
        if ($request->email && $request->password && $request->user_type) {
            $provider = $request->user_type;
            // $email=$request->email;
            //$password=$request->password;

            $email = trim($request->email);
            //$email=$request->email;
            $password = trim($request->password);
            $check_userlogin = User::where('email', $email)->first();

            if ($check_userlogin) {
                if ($check_userlogin->login_type == 'manual') {

//                    if ($check_userlogin->status == 'active') {
                    $client = new Client();

                    try {
                        $res = $client->request('POST', 'http://157.230.1.223/uber_test/public/oauth/token', [
                            'form_params' => [
                                'client_id' => 4,
                                'client_secret' => 'Lj5y6YL76kYjvVFAnsgH6ko6NAhZRi75snqmme90',
                                'grant_type' => 'password',
                                'username' => $email,
                                'password' => $password,
                                'scope' => '*',
                                'provider' => $provider
                            ]
                        ]);
                    } catch (\GuzzleHttp\Exception\BadResponseException $ex) {
                        $jsonresp = $ex->getMessage();
                        $response['error'] = 'true';
                        $response['message'] = 'User Credentials are incorrect.';
                        echo json_encode($response);
                        die;
                    }
                    $access_token = json_decode((string) $res->getBody(), true)['access_token'];

                    $response['error'] = 'false';
                    $response['message'] = 'Success';
                    $response['access_token'] = $access_token;
                    $response['id'] = $check_userlogin['id'];
                    $response['first_name'] = $check_userlogin['first_name'];
                    $response['last_name'] = $check_userlogin['last_name'];
                    $response['email'] = $check_userlogin['email'];
                    $response['mobile'] = $check_userlogin['mobile'];
                    $response['image'] = $check_userlogin['image'];
                    $response['latitude'] = $check_userlogin['latitude'];
                    $response['longitude'] = $check_userlogin['longitude'];

//                    } else {
//
//                        $response['error'] = 'true';
//                        $response['message'] = 'User is not activated !';
//                    }
                }
                if ($check_userlogin->login_type == 'google') {
                    $response['error'] = 'true';
                    $response['message'] = 'Already Signed using Google Login';
                } elseif ($check_userlogin->login_type == 'facebook') {
                    $response['error'] = 'true';
                    $response['message'] = 'Already Signed using Facebook Login';
                }
            } else {
                $response['error'] = 'true';
                $response['message'] = 'Incorrect username or password !';
            }
        } else {
            $response['error'] = 'true';
            $response['message'] = 'Mandatory Parameters are missing';
        }
        echo json_encode($response);
    }

// public function  basic_email(request $request){
// $data = array('name'=>"Virat Gandhi");
// // Mail::send('errors.503',$data,function($message) use ($email,$otpnumber){
// //                       $message->To($email)->subject('FORGOT PASSWORD')->setBody($otpnumber);
// //                       });
// //                $resp
//       // Mail::send(['text'=>'mail'], $data, function($message) {
//       //    $message->to('ramkumars7395@gmail.com', 'Tutorials Point')->subject
//       //       ('Laravel Basic Testing Mail');
//       //    $message->from('jaaavvaaa@gmail.com','9551392249');
//       // });
//       // echo "Basic Email Sent. Check your inbox.";
//     $user="ramkumars7395@gmail.com";
//     $username="ram";
//     $link="welcome";
//   Mail::send( 'errors.503',['user' => $user], function ($m) use ($user,$link) {
//             $m->from('hello@app.com', 'welcome to laravel');
//             $m->to($user, 'ram')->subject('Your Reminder!')->setBody($link);
//         });
//   echo "welcome";
//    }

    public function sociallogin(request $request) {
        if ($request->socialtoken && $request->email && $request->firstname && $request->lastname && $request->social_type) {
            $socialtoken = $request->socialtoken;
            $type = $request->social_type;
            $email = $request->email;

            $firstname = $request->firstname;
            $lastname = $request->lastname;
            if (isset($request->provider) && $request->provider == "provider") {
                $user_type = 'provider';
                $check_userdetails = Provider::where(['email' => $email])->first();
            } else {
                $user_type = 'user';
                $check_userdetails = User::where(['email' => $email])->first();
            }


            if ($check_userdetails) {
                if ($type == 'google' || 'facebook') {
                    if ($check_userdetails['login_type'] == $type) {
                        if ($type == 'google') {
                            if ($check_userdetails->google_token == $socialtoken) {
                                if (isset($request->image)) {
                                    $check_userdetails->image = $request->image;
                                    $check_userdetails->save();
                                }
                                $token = $check_userdetails->createToken('Token Name')->accessToken;
                                $data = [
                                    $user_type => $check_userdetails,
                                    "token" => $token
                                ];
                                return $this->makeResponse('Login Successfully !', $data);

//                                $response['error'] = "false";
//                                $response['error_message'] = "Login Successfully";
//                                $response['id'] = $check_userdetails['id'];
//                                $response['access_token'] = $token;
                            } else {
                                $response['error'] = "true";
                                $response['error_message'] = 'Already Signed using ' . $check_userdetails['login_type'] . ' login';
                            }
                        }
                        if ($type == 'facebook') {
                            if ($check_userdetails->facebook_token == $socialtoken) {
                                $token = $check_userdetails->createToken('Token Name')->accessToken;
                                if (isset($request->image)) {
                                    $check_userdetails->image = $request->image;
                                    $check_userdetails->save();
                                }
                                $data = [
                                    $user_type => $check_userdetails,
                                    "token" => $token
                                ];
                                return $this->makeResponse('Login Successfully !', $data);
//                                $response['error'] = "false";
//                                $response['error_message'] = "Login Successfully";
//                                $response['id'] = $check_userdetails['id'];
//                                $response['access_token'] = $token;
                            } else {
                                $response['error'] = "true";
                                $response['error_message'] = 'Already Signed using ' . $check_userdetails['login_type'] . ' login';
                            }
                        }
                    } else {
                        $response['error'] = "true";
                        $response['error_message'] = 'Already Signed using ' . $check_userdetails['login_type'] . ' login';
                    }
                } else {
                    $response['error'] = "true";
                    $response['error_message'] = 'Invalid Social type';
                }
            } else {
                $stripe = Stripe::make(config('services.stripe.secret'));
                $customer = $stripe->customers()->create([
                    'email' => $email,
                ]);
                $customer_id = $customer['id'];
                $client = new client();
                try {
                    if ($user_type == "provider") {
                        $new_socialuser = new Provider();
                    } else {
                        $new_socialuser = new User();
                        $new_socialuser->stripe_payment_account = $customer_id;
                    }

                    $new_socialuser->email = $email;
                    $new_socialuser->first_name = $firstname;
                    $new_socialuser->last_name = $lastname;
                    $new_socialuser->login_type = $type;

                    if ($request->image) {
                        $new_socialuser->image = $request->image;
                    }
                    if ($type == 'google') {
                        $new_socialuser->google_token = $socialtoken;
                    } elseif ($type == 'facebook') {
                        $new_socialuser->facebook_token = $socialtoken;
                    }
                    $new_socialuser->save();
                } catch (\Illuminate\Database\QueryException $ex) {
                    $jsonresp = $ex->getMessage();
                    $response['error'] = 'true';
                    $response['message'] = $jsonresp;
                    echo json_encode($response);
                    die;
                }
                if ($new_socialuser) {

                    if ($user_type == "provider") {
                        $get_user = Provider::where('id', $new_socialuser->id)->first();
                    } else {
                        $get_user = User::where('id', $new_socialuser->id)->first();
                    }
                    $token = $get_user->createToken('Token Name')->accessToken;

                    $data = [
                        $user_type => $get_user,
                        "token" => $token
                    ];
                    return $this->makeResponse('Login Successfully !', $data);

//                    $response['error'] = "false";
//                    $response['success'] = true;
//                    $response['user'] = $get_user;
//                    $response['error_message'] = "Inserted Successfully";
//                    $response['token'] = $token;
//                    $response['id'] = $new_socialuser->id;
                } else {
                    $response['error'] = "true";
                    $response['error_message'] = "Not Inserted.";
                }
            }
        } else {
            $response['error'] = "true";
            $response['error_message'] = "Mandatory Parameters are Missing";
        }
        echo json_encode($response);
    }

    public function sociallogin1(request $request) {
        if ($request->socialtoken && $request->email && $request->firstname && $request->lastname && $request->social_type) {
            $socialtoken = $request->socialtoken;
            $type = $request->social_type;
            $email = $request->email;
            $provider = $request->provider;

            $firstname = $request->firstname;
            $lastname = $request->lastname;
            $check_userdetails = User::where(['email' => $email])->first();

            if ($check_userdetails) {
                if ($type == 'google' || 'facebook') {
                    if ($check_userdetails['login_type'] == $type) {
                        if ($type == 'google') {
                            if ($check_userdetails->google_token == $socialtoken) {
                                if (isset($request->image)) {
                                    $check_userdetails->image = $request->image;
                                    $check_userdetails->save();
                                }
                                $token = $check_userdetails->createToken('Token Name')->accessToken;
                                if ($provider == 'provider') {
                                    $data = [
                                        "provider" => $check_userdetails,
                                        //"access_token" => $token
                                        "token" => $token
                                    ];
                                } else {
                                    $data = [
                                        "user" => $check_userdetails,
                                        //"access_token" => $token
                                        "token" => $token
                                    ];
                                }
                                return $this->makeResponse('Login Successfully !', $data);

//                                $response['error'] = "false";
//                                $response['error_message'] = "Login Successfully";
//                                $response['id'] = $check_userdetails['id'];
//                                $response['access_token'] = $token;
                            } else {
                                $response['error'] = "true";
                                $response['error_message'] = 'Already Signed using ' . $check_userdetails['login_type'] . ' login';
                            }
                        }
                        if ($type == 'facebook') {
                            if ($check_userdetails->facebook_token == $socialtoken) {
                                $token = $check_userdetails->createToken('Token Name')->accessToken;
                                if (isset($request->image)) {
                                    $check_userdetails->image = $request->image;
                                    $check_userdetails->save();
                                }
                                if ($provider == 'provider') {
                                    $data = [
                                        "provider" => $check_userdetails,
                                        //"access_token" => $token
                                        "token" => $token
                                    ];
                                } else {
                                    $data = [
                                        "user" => $check_userdetails,
                                        //"access_token" => $token
                                        "token" => $token
                                    ];
                                }
                                return $this->makeResponse('Login Successfully !', $data);
//                                $response['error'] = "false";
//                                $response['error_message'] = "Login Successfully";
//                                $response['id'] = $check_userdetails['id'];
//                                $response['access_token'] = $token;
                            } else {
                                $response['error'] = "true";
                                $response['error_message'] = 'Already Signed using ' . $check_userdetails['login_type'] . ' login';
                            }
                        }
                    } else {
                        $response['error'] = "true";
                        $response['error_message'] = 'Already Signed using ' . $check_userdetails['login_type'] . ' login';
                    }
                } else {
                    $response['error'] = "true";
                    $response['error_message'] = 'Invalid Social type';
                }
            } else {
                $stripe = Stripe::make(config('services.stripe.secret'));
                $customer = $stripe->customers()->create([
                    'email' => $email,
                ]);
                $customer_id = $customer['id'];
                $client = new client();
                try {

                    $new_socialuser = new User();
                    $new_socialuser->email = $email;
                    $new_socialuser->first_name = $firstname;
                    $new_socialuser->last_name = $lastname;
                    $new_socialuser->login_type = $type;
                    $new_socialuser->stripe_payment_account = $customer_id;
                    if ($request->image) {
                        $new_socialuser->image = $request->image;
                    }
                    if ($type == 'google') {
                        $new_socialuser->google_token = $socialtoken;
                    } elseif ($type == 'facebook') {
                        $new_socialuser->facebook_token = $socialtoken;
                    }
                    $new_socialuser->save();
                } catch (\Illuminate\Database\QueryException $ex) {
                    $jsonresp = $ex->getMessage();
                    $response['error'] = 'true';
                    $response['message'] = $jsonresp;
                    echo json_encode($response);
                    die;
                }
                if ($new_socialuser) {
                    $get_user = User::where('id', $new_socialuser->id)->first();
                    $token = $get_user->createToken('Token Name')->accessToken;
                    if ($provider == 'provider') {
                        $data = [
                            "provider" => $get_user,
//                        "access_token" => $token
                            "token" => $token
                        ];
                    } else {
                        $data = [
                            "user" => $get_user,
//                        "access_token" => $token
                            "token" => $token
                        ];
                    }
                    return $this->makeResponse('Login Successfully !', $data);

//                    $response['error'] = "false";
//                    $response['success'] = true;
//                    $response['user'] = $get_user;
//                    $response['error_message'] = "Inserted Successfully";
//                    $response['token'] = $token;
//                    $response['id'] = $new_socialuser->id;
                } else {
                    $response['error'] = "true";
                    $response['error_message'] = "Not Inserted.";
                }
            }
        } else {
            $response['error'] = "true";
            $response['error_message'] = "Mandatory Parameters are Missing";
        }
        echo json_encode($response);
    }




	public function forgot_password(request $request) {
		
		 //generate random password
		$new_password = strtoupper(substr(md5(microtime()),0,8));
		$encryptpassword = bcrypt($new_password);
    	    
		
        if ($request->email) {
            $email = $request->email;
            $get_user = User::where('email', $email)->first();
            if ($get_user) {
                $data = [];
			    User::where('email', $email)->update(['password' => $encryptpassword]);
            	
				$Mail = Mail::send('errors.503', $data, function ($message) use ($email, $new_password) {
                    $msg = "Your new password is : "  . $new_password;
					$message->To($email)->subject('RESET PASSWORD')->setBody($msg);
                });
                $response['error'] = 'false';
                $response['message'] = "Your new password has been sent to your email!";
            } else {
                $response['error'] = "true";
                $response['error_message'] = "Email is not Registered.";
            }
        }else if ($request->mobile) { 
			$mobile = $request->mobile;
            $get_user = User::where('mobile', $mobile)->first();
          
		     if ($get_user) {
                $data = [];
			    User::where('mobile', $mobile)->update(['password' => $encryptpassword]);
				
				$body = 'Dear ' . $get_user->first_name . ', new password for ReadiWork is : ' . $new_password . '.';
				$sendOtp = $this->sendSms($body, '+' . $get_user->mobile);
				$response['error'] = 'false';
                $response['message'] = "Your new password has been sent to your phone number!";
				
			 }else {
                $response['error'] = "true";
                $response['error_message'] = "Phone number is not registered";
             }
		
		
		
		
		
		}else {
            $response['error'] = "true";
            $response['error_message'] = "Invalid Email";
        }
        echo json_Encode($response);
    }



	/*
    public function forgot_password(request $request) {
        if ($request->email) {
            $email = $request->email;
            $get_user = User::where('email', $email)->first();
            if ($get_user) {
                $otpnumber = mt_rand(100000, 999999);
                $data = [];
                User::where('email', $email)->update(['otp' => $otpnumber]);
                $Mail = Mail::send('errors.503', $data, function ($message) use ($email, $otpnumber) {
                            $message->To($email)->subject('FORGOT PASSWORD')->setBody($otpnumber);
                        });
                $response['error'] = 'false';
                $response['otp'] = $otpnumber;
				$response['id'] = $get_user->id;
			    $response['error_message'] = "OTP Sent";
            } else {
                $response['error'] = "true";
                $response['error_message'] = "Email is not Registered with us.";
            }
        } else {
            $response['error'] = "true";
            $response['error_message'] = "Invalid Email";
        }
        echo json_Encode($response);
    }*/

    public function otpcheck(request $request) {
        if ($request->otp && $request->email) {
            $otp = $request->otp;
            $email = $request->email;
            $user_details = User::where('email', $email)->first();
            if ($user_details) {
                if ($user_details->otp == $otp) {
                    User::where('email', $email)->update(['otp' => null]);
                    $response['error'] = "false";
                    $response['error_message'] = "Otp verified.";
                } else {
                    $response['error'] = "true";
                    $response['error_message'] = "Invalid Otp.";
                }
            } else {
                $response['error'] = "true";
                $response['error_message'] = "Email is not registered with us.";
            }
        } else {
            $response['error'] = "true";
            $response['error_message'] = "otp or Email is empty";
        }

        echo json_encode($response);
    }

    public function resetpassword(request $request) {

        if ($request->email && $request->password && $request->confirmpassword) {
            $password = $request->password;
            $cnfpassword = $request->confirmpassword;
            $email = $request->email;
            if ($password == $cnfpassword) {
                $encryptpassword = bcrypt($password);
                User::where('email', $email)->update(['password' => $encryptpassword]);
                $response['error'] = "false";
                $response['error_message'] = "Password Reset Successfully.";
            } else {
                $response['error'] = "true";
                $response['error_message'] = "Password & Confirm Password are not same.";
            }
        } else {
            $response['error'] = "true";
            $response['error_message'] = "Mandatory Parameters are missing.";
        }

        echo json_encode($response);
    }

    public function updatedevicetoken(request $request) {
        $userid = Auth::guard('api')->user()->id;

        if ($request->fcm_token && $request->os) {
            $fcmtoken = $request->fcm_token;
            $os = $request->os;
            User::where('id', $userid)->update(['fcm_token' => $fcmtoken, 'os_type' => $os]);
            $response['error'] = "false";
            $response['error_message'] = "fcm token updated.";
        } else {
            $response['error'] = "true";
            $response['error_message'] = "fcm token is empty.";
        }
        echo json_encode($response);
    }

    public function addaddress(Request $request) {
        $this->validate($request, [
            'address' => 'required',
            'doorno' => 'required',
            'landmark' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'city' => 'required',
            'title' => 'required',
            'user_id' => 'required'
        ]);

        $user = new Useraddress();
        $user->address_line_1 = $request->address;
        $user->doorno = $request->doorno;
        $user->landmark = $request->landmark;
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
        $user->city = $request->city;
        $user->user_id = $request->user_id;
        $user->title = $request->title;

        if ($user->save()) {
            return $this->makeResponse('Added Successfully !', ['address' => $user]);
        } else {
            return $this->makeError('Added failed !');
        }

//        if ($request->address && $request->doorno && $request->landmark && $request->latitude && $request->longitude && $request->title && $request->city) {
//            $address = $request->address;
//            $doorno = $request->doorno;
//            $landmark = $request->landmark;
//            $latitude = $request->latitude;
//            $longitude = $request->longitude;
//            $city = $request->city;
//            $title = $request->title;
//            $userid = Auth::guard('api')->user()->id;
//            $client = new client();
//
//            try {
//                $addaddress = new Useraddress();
//                $addaddress->user_id = $userid;
//                $addaddress->address_line_1 = $address;
//                $addaddress->doorno = $doorno;
//                $addaddress->landmark = $landmark;
//                $addaddress->latitude = $latitude;
//                $addaddress->longitude = $longitude;
//                $addaddress->city = $city;
//                $addaddress->title = $title;
//                $addaddress->save();
//            } catch (\Illuminate\Database\QueryException $ex) {
//                $jsonresp = $ex->getMessage();
//                $response['error'] = 'true';
//                $response['message'] = $jsonresp;
//                echo json_encode($response);
//                die;
//            }
//            if ($addaddress) {
//                $response['error'] = 'false';
//                $response['error_message'] = 'address created.';
//
//            } else {
//                $response['error'] = 'true';
//                $response['error_message'] = 'No Address created.';
//
//            }
//        } else {
//            $response['error'] = 'true';
//            $response['error_message'] = 'Mandatory Params are empty.';
//        }
//        echo json_encode($response);
    }

    public function viewaddress(request $request) {
//        $userid = Auth::guard('api')->user()->id;
        $useraddress = Useraddress::where('user_id', $request->user_id)->get();
        if ($useraddress) {
            $response['error'] = 'false';
            $response['error_message'] = 'success';
            $response['list_address'] = $useraddress;
        } else {
            $response['error'] = 'false';
            $response['error_message'] = 'success';
            $response['list_address'] = [];
        }
        echo json_encode($response);
    }

    public function updateaddress(request $request) {
        if (($request->id)) {
            $id = $request->id;
            $address = $request->address;
            $doorno = $request->doorno;
            $landmark = $request->landmark;
            $latitude = $request->latitude;
            $title = $request->title;
            $longitude = $request->longitude;
//            $userid = Auth::guard('api')->user()->id;

            $update = Useraddress::where('id', $id)->update([
//                'user_id' => $userid,
                'address_line_1' => $address,
                'doorno' => $doorno,
                'landmark' => $landmark,
                'latitude' => $latitude,
                'title' => $title,
                'longitude' => $longitude
            ]);
            if ($update) {
                $response['error'] = 'false';
                $response['error_message'] = 'updated';
            } else {
                $response['error'] = 'true';
                $response['error_message'] = 'not updated';
            }
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'Id is empty';
        }
        echo json_encode($response);
    }

    public function deleteaddress(request $request) {

        if ($request->id) {
            $id = $request->id;
            $userid = Auth::guard('api')->user()->id;
            $delete = Useraddress::where(['id' => $id])->delete();
            if ($delete) {
                $response['error'] = 'false';
                $response['error_message'] = 'Address Deleted';
            } else {
                $response['error'] = 'true';
                $response['error_message'] = 'Invalid User id';
            }
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'Invalid Address id.';
        }
        echo json_encode($response);
    }

    public function viewprofile(request $request) {
        $userid = Auth::guard('api')->user()->id;
        $userdetails = User::select('first_name', 'last_name', 'mobile', 'image')->where('id', $userid)->first();
        if ($userdetails) {
            $response['error'] = 'false';
            $response['error_message'] = 'success';
            $response['user_details'] = $userdetails;
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'fail';
//            $response['error_message']='fail';
        }
        echo json_encode($response);
    }

    public function updateprofile(request $request) {
        $userid = Auth::guard('api')->user()->id;
        if ($request->first_name && $request->last_name && $request->mobile) {
            $first_name = $request->first_name;
            $last_name = $request->last_name;
            $mobile = $request->mobile;
            $image = $request->image;
            /*$image = '';
            if ($request->image != '') {
                $imageUpload = new Imageupload();
                $image = $imageUpload->imgupload($request->image);
            }*/
            $update = User::where('id', $userid)->update(['first_name' => $first_name, 'last_name' => $last_name, 'mobile' => $mobile, 'image' => $image]);
            if ($update) {
                $response['error'] = 'false';
                $response['error_message'] = 'success';
            } else {
                $response['error'] = 'true';
                $response['error_message'] = 'not updated.';
            }
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'Mandatory Parameter are empty';
        }
        echo json_encode($response);
    }

    public function changepassword(request $request) {
        if ($request->oldpassword && $request->newpassword && $request->cnfpassword) {
            $oldpassword = $request->oldpassword;
            $email = Auth::guard('api')->user()->email;
            $userid = Auth::guard('api')->user()->id;
            $password = User::where('id', $userid)->value('password');
            if (password_verify($oldpassword, $password)) {
                if ($request->newpassword == $request->cnfpassword) {
                    $newpassword = $request->newpassword;
                    $updatepassword = bcrypt($newpassword);
                    User::where('id', $userid)->update(['password' => $updatepassword]);

                    $response['error'] = 'false';
                    $response['error_message'] = 'Password changed';
                } else {
                    $response['error'] = 'true';
                    $response['error_message'] = 'Password and Confirm Password are not same';
                }
            } else {
                $response['error'] = 'true';
                $response['error_message'] = 'The Entered Password is incorrect';
            }
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'Mandatory Parameters are empty';
        }
        echo json_encode($response);
    }

    public function dashboard(request $request) {

        $location = Location::all();
//        $get_category = Category::get();
//        $list_types = Category::all();
            $list_types = Category::where(['status' => 'active'])->get();
//        $all_banners = DB::table('banner_images')->get();

        $new = DB::table('banner_images')->select('id', 'banner_name as name', 'banner_logo as icon')->get();

//        if (count($list_types) > 0) {
//            foreach ($list_types as $types) {
//                $maintype = $types->type;
//                $type_category = Category::where(['type' => $maintype])->get();
////          foreach($type_category as $newcategory)
////          {
////                  $newcategory->image="http://IP/UberDoo/public/images/".$newcategory->image;
////                  $newcategory->icon="http://IP/UberDoo/public/images/".$newcategory->icon;
////          }
//// //
//                $all_categories[$maintype] = $type_category;
//            }
//            $arraycategory[] = $all_categories;
////         $response['list_category']=$arraycategory;
//        } else {
//            $arraycategory = [];
//        }

        $response['list_category'] = $list_types;
        $response['error'] = 'false';
        $response['error_message'] = 'success';
        $response['banner_images'] = $new;
        if (Auth::guard('api')->check()) {
            $userid = Auth::guard('api')->user()->id;
            $username = Auth::guard('api')->user()->first_name;
            $image = Auth::guard('api')->user()->image;
            $response['username'] = $username;
            $response['image'] = $image;
        }
        $response['location'] = $location;

        echo json_encode($response);
    }

    public function list_subcategory(request $request) {
        if ($request->id) {
            $categoryid = $request->id;
            $get_subcategory = Subcategory::where(['category_id' => $categoryid, 'status' => 'active'])->get();

            if ($get_subcategory) {


                //     foreach($get_subcategory as $newsubcategory)
                // {
                //     $newsubcategory->image="http://IP/UberDoo/public/images/".$newsubcategory->image;
                //     $newsubcategory->icon="http://IP/UberDoo/public/images/".$newsubcategory->icon;
                // }
                $response['error'] = 'false';
                $response['error_message'] = 'success';
                $response['list_subcategory'] = $get_subcategory;
            } else {
                $response['error'] = 'false';
                $response['list_subcategory'] = [];
                $response['error_message'] = 'No Subcategories available';
            }
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'Invalid id';
        }
        echo json_encode($response);
    }

    /*
      public function appsettings(request $request)
      {
      $location=Location::get();
      $timeslots=Timeslots::get();

      $response['error']='false';
      $response['error_message']='success';
      $response['location']=$location;
      $response['timeslots']=$timeslots;
      if(Auth::guard('api')->check())
      {

      $userid=Auth::guard('api')->user()->id;

      //BLK = Is Blocked
      //DSP = is in Dispute
      //REP=review pending
      //PYP=Payment Pending
      //INP =Invoice Pending
      //PAID= Paid
      //PPCNF=Pending Payment Confirmation
      //PCNF =Payment Confirmation
      //Accept= Accepted Job
      //Reject = Reject job
      //Start = Start Job
      //Complete = Complete Job

      $listofstatus=array('Blocked','Dispute','Reviewpending','Completedjob','Waitingforpaymentconfirmation');
      for($i=0;$i<=count($listofstatus)-1;$i++)
      {
      //        $bookingdetails=Bookings::where(['user_id'=>$userid,'status'=>$listofstatus[$i]])->get();
      // $bookingdetails=Bookings::select(DB::raw("distinct(bookings.id),bookings.booking_order_id,CONCAT(users.first_name,users.last_name) AS username,CONCAT(provider.first_name,provider.last_name) AS providername,provider.id as provider_id,provider.image,service_sub_category.sub_category_name,service_sub_category.icon,time_slots.timing,bookings.booking_date,bookings.tax_name,bookings.gst_percent,bookings.gst_cost,bookings.total_cost,provider_schedules.days,bookings.job_start_time,bookings.job_end_time,bookings.cost,user_address.doorno,user_address.landmark,user_address.address_line_1,bookings.rating,bookings.service_category_id AS categoryId,bookings.status,bookings.feedback,case when(bookings.status) IN ('Completedjob','Reviewpending','Waitingforpaymentconfirmation','Finished') then '1' else '0' end as show_bill_flag,bookings.worked_mins,bookings.created_at,bookings.updated_at"))
      //                ->join('user_address', 'bookings.address_id', '=', 'user_address.id')
      //                ->join('users', 'bookings.user_id', '=', 'users.id')
      //                ->join('provider', 'bookings.provider_id', '=', 'provider.id')
      //                ->join('service_sub_category', 'bookings.service_category_type_id', '=', 'service_sub_category.id')
      //                ->join('provider_schedules', 'bookings.provider_schedules_id', '=', 'provider_schedules.id')
      //                ->join('time_slots', 'provider_schedules.time_slots_id', '=', 'time_slots.id')
      //                ->where(['bookings.user_id'=>$userid,'bookings.status'=>$listofstatus[$i]])
      //                ->groupBy('bookings.id')
      //                ->orderBy('bookings.updated_at', 'desc')
      //                ->get();


      $bookingdetails=Bookings::select(DB::raw("distinct(bookings.id),bookings.booking_order_id,CONCAT(users.first_name,users.last_name) AS username,CONCAT(provider.first_name,provider.last_name) AS providername,provider.id as provider_id,provider.image,service_sub_category.sub_category_name,service_sub_category.icon,time_slots.timing,bookings.booking_date,bookings.tax_name,bookings.gst_percent,bookings.gst_cost,bookings.total_cost,provider_schedules.days,bookings.job_start_time,bookings.job_end_time,bookings.cost,user_address.doorno,user_address.landmark,user_address.address_line_1,service_category.baseamount,bookings.rating,bookings.status,bookings.feedback,case when(bookings.status) IN ('Completedjob','Reviewpending','Waitingforpaymentconfirmation','Finished') then '1' else '0' end as show_bill_flag,bookings.worked_mins,bookings.created_at,bookings.updated_at"))
      ->join('user_address', 'bookings.address_id', '=', 'user_address.id')
      ->join('users', 'bookings.user_id', '=', 'users.id')
      ->join('provider', 'bookings.provider_id', '=', 'provider.id')
      ->join('service_sub_category', 'bookings.service_category_type_id', '=', 'service_sub_category.id')
      ->join('provider_schedules', 'bookings.provider_schedules_id', '=', 'provider_schedules.id')
      ->join('service_category','bookings.service_category_id','=','service_category.id')
      ->join('time_slots', 'provider_schedules.time_slots_id', '=', 'time_slots.id')
      //->join('tax_calculation','bookings.id', '=','tax_calculation.booking_id')
      ->where(['bookings.user_id'=>$userid,'bookings.status'=>$listofstatus[$i]])
      ->where('service_category.baseamount_status','=','active')
      ->groupBy('bookings.id')
      ->orderBy('bookings.updated_at', 'desc')
      ->get();


      if($bookingdetails)
      {
      //             foreach($bookingdetails as $details)
      //             {

      //             $yesdata['booking_id']=$details->id;
      //             $yesdata['booking_order_id']=$details->booking_order_id;
      //             $yesdata['username']=$details->username;
      //             $yesdata['providername']=$details->providername;
      //             $yesdata['provider_id']=$details->provider_id;
      //             $yesdata['sub_category_name']=$details->sub_category_name;
      //             $yesdata['timing']=$details->timing;
      //             $yesdata['booking_date']=$details->booking_date;
      //             $yesdata['days']=$details->days;
      //             $yesdata['job_start_time']=$details->job_start_time;
      //             $yesdata['job_end_time']=$details->job_end_time;

      //             if($details->cost == 0)
      //             {
      //               $yesdata['cost'] = 50;
      //             }else
      //             {
      //               $yesdata['cost']=$details->cost;//android
      //             }

      //             $yesdata['tax_name']=$details->tax_name;
      //             $yesdata['gst_percent']=$details->gst_percent;
      //             $yesdata['gst_cost']=$details->gst_cost;
      //             if($details->total_cost == 0){
      //               $yesdata['total_cost']= 50;
      //             }
      //             else{
      //               $yesdata['total_cost']=$details->total_cost;
      //             }
      //             $yesdata['doorno']=$details->doorno;
      //             $yesdata['landmark']=$details->landmark;
      //             $yesdata['address_line_1']=$details->address_line_1;
      //             $yesdata['rating']=$details->rating;
      //             $yesdata['worked_mins']=$details->worked_mins;
      // //            $yesdata['created_at']=$details->created_at;
      // //            $yesdata['updated_at']=$details->updated_at;
      //             $yesdata['status']=$listofstatus[$i];
      //             $newdata[]=$yesdata;
      //             }

      foreach($bookingdetails as $details)
      {


      $yesdata['booking_id']=$details->id;
      $yesdata['booking_order_id']=$details->booking_order_id;
      $yesdata['username']=$details->username;
      $yesdata['providername']=$details->providername;
      $yesdata['provider_id']=$details->provider_id;
      $yesdata['sub_category_name']=$details->sub_category_name;
      $yesdata['timing']=$details->timing;
      $yesdata['booking_date']=$details->booking_date;
      $yesdata['days']=$details->days;
      $yesdata['job_start_time']=$details->job_start_time;
      $yesdata['job_end_time']=$details->job_end_time;

      $yesdata['tax_name']=$details->tax_name;
      $yesdata['gst_percent']=$details->gst_percent;
      $yesdata['gst_cost']=$details->gst_cost;
      //$yesdata['baseamount']=$details->charge;

      if($details->total_cost <= $details->baseamount){

      $yesdata['total_cost']= $details->baseamount;
      }
      else{
      $yesdata['total_cost']=$details->total_cost;
      }

      if($details->cost <= $details->baseamount){

      $yesdata['cost']=$details->baseamount;
      }
      else{
      $yesdata['cost']=$details->cost;
      }
      $yesdata['doorno']=$details->doorno;
      $yesdata['landmark']=$details->landmark;
      $yesdata['address_line_1']=$details->address_line_1;
      $yesdata['rating']=$details->rating;
      $yesdata['worked_mins']=$details->worked_mins;
      //            $yesdata['created_at']=$details->created_at;
      //            $yesdata['updated_at']=$details->updated_at;
      $yesdata['status']=$listofstatus[$i];



      // $yesdata[]=$yesdata;
      //$id=$details->id;
      }




      // $yesdata[]=$yesdata;
      //$id=$details->id;





      }
      //        $lastdata=$newdata;
      //
      //
      //                 $newdata[$listofstatus[$i]]=$yesdata;
      //        }else{
      ////            $yesdata['booking_id']=$bookingdetails['id'];
      ////            $yesdata['status']="0";
      ////            $newdata[$listofstatus[$i]]=$yesdata;
      //        }
      //
      }





      if(isset($yesdata))
      {



      $query_data = DB::table('tax_calculation')
      ->where('booking_id', '=', $yesdata['booking_id'])
      //->orWhere('ac_customer_id', '=', 13)
      ->get();

      // print_r($query_data);
      // exit;

      $yesdata['alltax']=array();
      foreach ($query_data as $tax) {

      // $taxs['taxname']= $tax->taxname;
      $taxs['tax_amount']= $tax->tax_amount;
      $taxs['tax_totalamount']= $tax->tax_total_amount;
      array_push($yesdata['alltax'],$taxs);
      }








      //$yesdata['alltax']=array();

      //array_push($yesdata['alltax'],$gettax);
      //$yesdata=$gettax;
      $response['status']=$yesdata;



      }else{
      $response['status']=[];
      }

      //     $new[]=$yesdata;

      }
      echo json_encode($response);
      }


     */

    public function pdfgenerator(request $request) {


        $bookingid = $request->bookingid;

        $location = Location::get();
        $timeslots = Timeslots::get();

        $response['error'] = 'false';
        $response['error_message'] = 'success';
        // $response['location']=$location;
        // $response['timeslots']=$timeslots;
        //BLK = Is Blocked
        //DSP = is in Dispute
        //REP=review pending
        //PYP=Payment Pending
        //INP =Invoice Pending
        //PAID= Paid
        //PPCNF=Pending Payment Confirmation
        //PCNF =Payment Confirmation
        //Accept= Accepted Job
        //Reject = Reject job
        //Start = Start Job
        //Complete = Complete Job
//        $bookingdetails=Bookings::where(['user_id'=>$userid,'status'=>$listofstatus[$i]])->get();
        $bookingdetails = Bookings::select(DB::raw("distinct(bookings.id),bookings.booking_order_id,CONCAT(users.first_name,users.last_name) AS username,CONCAT(provider.first_name,provider.last_name) AS providername,provider.id as provider_id,provider.image,provider.mobile,provider.email,service_sub_category.sub_category_name,service_sub_category.icon,time_slots.timing,bookings.booking_date,'bookings.payment_type',bookings.tax_name,bookings.gst_percent,bookings.gst_cost,bookings.total_cost,bookings.coupon_applied,bookings.reduced_cost,provider_schedules.days,bookings.job_start_time,bookings.job_end_time,bookings.cost,user_address.doorno,user_address.landmark,user_address.address_line_1,bookings.rating,bookings.service_category_id AS categoryId,bookings.status,bookings.worked_mins,bookings.feedback,case when(bookings.status) IN ('Completedjob','Reviewpending','Waitingforpaymentconfirmation','Finished') then '1' else '0' end as show_bill_flag,bookings.worked_mins,bookings.created_at,bookings.updated_at"))
                ->join('user_address', 'bookings.address_id', '=', 'user_address.id')
                ->join('users', 'bookings.user_id', '=', 'users.id')
                ->join('provider', 'bookings.provider_id', '=', 'provider.id')
                ->join('service_sub_category', 'bookings.service_category_type_id', '=', 'service_sub_category.id')
                ->join('provider_schedules', 'bookings.provider_schedules_id', '=', 'provider_schedules.id')
                ->join('time_slots', 'provider_schedules.time_slots_id', '=', 'time_slots.id')
                ->where(['bookings.id' => $bookingid])
                ->groupBy('bookings.id')
                ->orderBy('bookings.updated_at', 'desc')
                ->get();


        if ($bookingdetails) {
            foreach ($bookingdetails as $details) {


                $yesdata['booking_id'] = $details->id;
                $yesdata['booking_order_id'] = $details->booking_order_id;
                $yesdata['username'] = $details->username;
                $yesdata['providername'] = $details->providername;

                $yesdata['mobile'] = $details->mobile;
                $yesdata['email'] = $details->email;
                $yesdata['provider_id'] = $details->provider_id;
                $yesdata['sub_category_name'] = $details->sub_category_name;
                $yesdata['timing'] = $details->timing;
                $yesdata['booking_date'] = $details->booking_date;
                $yesdata['days'] = $details->days;
                $yesdata['job_start_time'] = $details->job_start_time;
                $yesdata['job_end_time'] = $details->job_end_time;
                $yesdata['payment_type'] = $details->payment_type;
                $yesdata['status'] = $details->status;
                $yesdata['worked_mins'] = $details->worked_mins;
                $yesdata['doorno'] = $details->doorno;
                $yesdata['landmark'] = $details->landmark;
                $yesdata['address_line_1'] = $details->address_line_1;
                if ($details->coupon_applied == null) {
                    $yesdata['coupon_applied'] = "";
                } else {
                    $yesdata['coupon_applied'] = $details->coupon_applied;
                }
                if ($details->reduced_cost == null) {
                    $yesdata['off'] = "";
                } else {
                    $yesdata['off'] = $details->reduced_cost;
                }

                if ($details->cost == 0) {
                    $yesdata['cost'] = 50;
                } else {
                    $yesdata['cost'] = $details->cost; //android
                }

                $yesdata['tax_name'] = $details->tax_name;
                $yesdata['gst_percent'] = $details->gst_percent;
                $yesdata['gst_cost'] = $details->gst_cost;
                if ($details->total_cost == 0) {
                    $yesdata['total_cost'] = 50;
                } else {
                    $yesdata['total_cost'] = $details->total_cost;
                }
                $yesdata['doorno'] = $details->doorno;
                $yesdata['landmark'] = $details->landmark;
                $yesdata['address_line_1'] = $details->address_line_1;
                $yesdata['rating'] = $details->rating;
                $yesdata['worked_mins'] = $details->worked_mins;
//            $yesdata['created_at']=$details->created_at;
//            $yesdata['updated_at']=$details->updated_at;
                //$yesdata['status']=;
                $newdata[] = $yesdata;
            }
        }
//        $lastdata=$newdata;
//
//
//                 $newdata[$listofstatus[$i]]=$yesdata;
//        }else{
////            $yesdata['booking_id']=$bookingdetails['id'];
////            $yesdata['status']="0";
////            $newdata[$listofstatus[$i]]=$yesdata;
//        }
//

        if (isset($newdata)) {
            $data['status'] = $newdata;
        } else {
            $data['status'] = [];
        }

//     $new[]=$yesdata;
        // $pdf =\PDF::loadView('invoice', $data)->setPaper('a4');


        $name = $bookingid . '_' . date('Y-m-d H:i:s') . '.pdf';


        $pdf = \PDF::loadView('invoice', $data, compact('invoice'))->save('/var/www/html/uber_test/public/pdf/' . $name);


        $path = 'http://IP/uber_test/public/pdf/' . $name;
        $result = DB::table('bookings')->where(['id' => $bookingid])->update(['invoicelink' => $path]);


        if ($result) {

            $newpath = Bookings::select('invoicelink')->where(['id' => $bookingid])->get();

            $response['error'] = 'false';
            $response['error_message'] = 'success';
            $response['invoicelink'] = $newpath;
        } else {

            $response['error'] = 'false';
            $response['error_message'] = 'no pdf aviable';
        }


        echo json_encode($response);
    }

    public function appsettings(request $request) {
        $location = Location::get();
        $timeslots = Timeslots::get();

        $response['error'] = 'false';
        $response['error_message'] = 'success';
        $response['location'] = $location;
        $response['timeslots'] = $timeslots;
        if (Auth::guard('api')->check()) {

            $userid = Auth::guard('api')->user()->id;


            //BLK = Is Blocked
            //DSP = is in Dispute
            //REP=review pending
            //PYP=Payment Pending
            //INP =Invoice Pending
            //PAID= Paid
            //PPCNF=Pending Payment Confirmation
            //PCNF =Payment Confirmation
            //Accept= Accepted Job
            //Reject = Reject job
            //Start = Start Job
            //Complete = Complete Job

            $listofstatus = array('Blocked', 'Dispute', 'Reviewpending', 'Completedjob', 'Waitingforpaymentconfirmation');
            for ($i = 0; $i <= count($listofstatus) - 1; $i++) {
//        $bookingdetails=Bookings::where(['user_id'=>$userid,'status'=>$listofstatus[$i]])->get();
                $bookingdetails = Bookings::select(DB::raw("distinct(bookings.id),bookings.booking_order_id,CONCAT(users.first_name,users.last_name) AS username,CONCAT(provider.first_name,provider.last_name) AS providername,provider.id as provider_id,provider.image,service_sub_category.sub_category_name,service_sub_category.icon,time_slots.timing,bookings.booking_date,bookings.tax_name,bookings.gst_percent,bookings.gst_cost,bookings.total_cost,bookings.coupon_applied,bookings.reduced_cost,provider_schedules.days,bookings.job_start_time,bookings.job_end_time,bookings.cost,user_address.doorno,user_address.landmark,user_address.address_line_1,bookings.rating,bookings.service_category_id AS categoryId,bookings.status,bookings.feedback,case when(bookings.status) IN ('Completedjob','Reviewpending','Waitingforpaymentconfirmation','Finished') then '1' else '0' end as show_bill_flag,bookings.worked_mins,bookings.created_at,bookings.updated_at"))
                        ->join('user_address', 'bookings.address_id', '=', 'user_address.id')
                        ->join('users', 'bookings.user_id', '=', 'users.id')
                        ->join('provider', 'bookings.provider_id', '=', 'provider.id')
                        ->join('service_sub_category', 'bookings.service_category_type_id', '=', 'service_sub_category.id')
                        ->join('provider_schedules', 'bookings.provider_schedules_id', '=', 'provider_schedules.id')
                        ->join('time_slots', 'provider_schedules.time_slots_id', '=', 'time_slots.id')
                        ->where(['bookings.user_id' => $userid, 'bookings.status' => $listofstatus[$i]])
                        ->groupBy('bookings.id')
                        ->orderBy('bookings.updated_at', 'desc')
                        ->get();


                if ($bookingdetails) {
                    foreach ($bookingdetails as $details) {


                        $yesdata['booking_id'] = $details->id;
                        $yesdata['booking_order_id'] = $details->booking_order_id;
                        $yesdata['username'] = $details->username;
                        $yesdata['providername'] = $details->providername;
                        $yesdata['provider_id'] = $details->provider_id;
                        $yesdata['sub_category_name'] = $details->sub_category_name;
                        $yesdata['timing'] = $details->timing;
                        $yesdata['booking_date'] = $details->booking_date;
                        $yesdata['days'] = $details->days;
                        $yesdata['job_start_time'] = $details->job_start_time;
                        $yesdata['job_end_time'] = $details->job_end_time;

                        if ($details->coupon_applied == null) {
                            $yesdata['coupon_applied'] = "";
                        } else {
                            $yesdata['coupon_applied'] = $details->coupon_applied;
                        }
                        if ($details->reduced_cost == null) {
                            $yesdata['off'] = "";
                        } else {
                            $yesdata['off'] = $details->reduced_cost;
                        }

                        if ($details->cost == 0) {
                            $yesdata['cost'] = 50;
                        } else {
                            $yesdata['cost'] = $details->cost; //android
                        }

                        $yesdata['tax_name'] = $details->tax_name;
                        $yesdata['gst_percent'] = $details->gst_percent;
                        $yesdata['gst_cost'] = $details->gst_cost;
                        if ($details->total_cost == 0) {
                            $yesdata['total_cost'] = 50;
                        } else {
                            $yesdata['total_cost'] = $details->total_cost;
                        }
                        $yesdata['doorno'] = $details->doorno;
                        $yesdata['landmark'] = $details->landmark;
                        $yesdata['address_line_1'] = $details->address_line_1;
                        $yesdata['rating'] = $details->rating;
                        $yesdata['worked_mins'] = $details->worked_mins;
//            $yesdata['created_at']=$details->created_at;
//            $yesdata['updated_at']=$details->updated_at;
                        $yesdata['status'] = $listofstatus[$i];


                        $newdata[] = $yesdata;
                    }
                }
//        $lastdata=$newdata;
//
//
//                 $newdata[$listofstatus[$i]]=$yesdata;
//        }else{
////            $yesdata['booking_id']=$bookingdetails['id'];
////            $yesdata['status']="0";
////            $newdata[$listofstatus[$i]]=$yesdata;
//        }
//
            }
            if (isset($newdata)) {


                $wallet = DB::table('Walletusers')->where(['userid' => $userid])->get();


                $response['status'] = $newdata;
                $response['wallet'] = $wallet;
            } else {
                $response['status'] = [];
            }

//     $new[]=$yesdata;
        }
        echo json_encode($response);
    }

    function getRealQuery($query, $dumpIt = false) {
        $params = array_map(function ($item) {
            return "'{$item}'";
        }, $query->getBindings());
        $result = str_replace_array('\?', $params, $query->toSql());
        if ($dumpIt) {
            dd($result);
        }
        return $result;
    }

    public function listprovider(request $request) {

        if ($request->service_sub_category_id && $request->time_slot_id && $request->date && $request->city && $request->lat && $request->lon) {
            $subcategoryid = $request->service_sub_category_id;
            $slotid = $request->time_slot_id;
            $latitude = $request->lat;

            $longitude = $request->lon;
            $city = $request->city;

            $radius_data = DB::table('radius')->where('id', '1')->first();

            $radius = $radius_data->radius;

// $providerid=$request->provider_id;
            $date = $request->date;
            $day = date('D', strtotime($date));
            // $day=$date;
            DB::enableQueryLog();

            $allprovider = DB::select(DB::raw("select distinct(provider.id),CONCAT(first_name,' ',last_name) as name,email,image,mobile,latitude,longitude,about, (
      6371 * acos (
      cos ( radians('$latitude') )
      * cos( radians( provider.latitude ) )
      * cos( radians( provider.longitude ) - radians('$longitude') )
      + sin ( radians('$latitude') )
      * sin( radians( provider.latitude ) )
    )
) AS distance,addressline1,addressline2,city,state,zipcode from provider Inner join provider_schedules on provider_schedules.provider_id=provider.id Inner join provider_services on provider_services.provider_id=provider.id where provider_schedules.time_slots_id='$slotid' and provider.status = 'active' and provider_schedules.days='$day' and provider_schedules.status='1' and provider_services.service_sub_category_id='$subcategoryid' and provider.isOnline = 1 and provider.id Having distance < '$radius' ORDER by distance asc"));
//			$queries = DB::getQueryLog();
//print_r($queries);
//			getRealQuery($allprovider,true);
//print_r($query->getBindings() );
//			dd(DB::getQueryLog());
//			$sql = str_replace_array('?', $allprovider->getBindings(), $allprovider->toSql());
            //dd($allprovider->toSql());
// print_r($allprovider);
            // exit;
// $allprovider=DB::select(DB::raw("select distinct(provider.id),CONCAT(first_name,' ',last_name) as name,email,image,mobile,latitude,longitude,about, (
//       6371 * acos (
//       cos ( radians('$latitude') )
//       * cos( radians( provider.latitude ) )
//       * cos( radians( provider.longitude ) - radians('$longitude') )
//       + sin ( radians('$latitude') )
//       * sin( radians( provider.latitude ) )
//     )
// ) AS distance from provider Inner join provider_schedules on provider_schedules.provider_id=provider.id Inner join provider_services on provider_services.provider_id=provider.id where provider_schedules.time_slots_id='$slotid' and provider_schedules.days='$day' and provider_services.service_sub_category_id='$subcategoryid' and provider.city='$city' and provider.id NOT IN (select distinct(provider.id) from provider inner join bookings on bookings.provider_id=provider.id inner join provider_schedules on provider_schedules.provider_id=provider.id where provider_schedules.time_slots_id='$slotid' and provider_schedules.days='$day' and bookings.service_category_type_id='$subcategoryid' and bookings.booking_date='$date' and provider.city='$city') ORDER BY distance ASC"));
// $allprovider = DB::select(DB::raw("select CONCAT(first_name,' ',last_name) as name,email,mobile,latitude,longitude from provider where provider.id NOT IN (select distinct(provider.id) from provider inner join bookings on bookings.provider_id=provider.id inner join provider_schedules on provider_schedules.provider_id=provider.id where provider_schedules.time_slots_id='$slotid' and provider_schedules.days='$day' and bookings.service_category_type_id='$subcategoryid' and bookings.status='Accepted' and bookings.booking_date='$date')"));
// $allprovider = DB::select(DB::raw("select distinct(provider.id),CONCAT(provider.first_name,' ',provider.last_name) as name,provider.email,provider.mobile,provider.latitude,provider.longitude, (
//      6371 * acos (
//      cos ( radians($latitude) )
//      * cos( radians( provider.latitude ) )
//      * cos( radians( provider.longitude ) - radians($longitude) )
//      + sin ( radians($longitude) )
//      * sin( radians( provider.latitude ) )
//    )
//) AS distance from provider Inner join provider_schedules on provider_schedules.id where provider.id NOT IN (select distinct(provider.id) from provider inner join bookings on bookings.provider_id=provider.id inner join provider_schedules on provider_schedules.provider_id=provider.id where provider_schedules.time_slots_id='$slotid' and provider_schedules.days='$day' and bookings.service_category_type_id='$subcategoryid' and bookings.booking_date='$date' and provider.city='$city')"));
//// echo json_encode($allprovider); die;



            foreach ($allprovider as $newprovider) {


                $services_details = Providerservices::where(['provider_id' => $newprovider->id, 'service_sub_category_id' => $subcategoryid])->first();
                $provider_reviews = Providerreviews::select(DB::raw("CONCAT(provider.first_name,' ',provider.last_name) as providername,CONCAT(users.first_name,' ',users.last_name) as username,provider_reviews.feedback,provider_reviews.rating"))->join('provider', 'provider.id', '=', 'provider_reviews.provider_id')->join('users', 'users.id', '=', 'provider_reviews.user_id')->where(['provider_id' => $newprovider->id])->get();
                $sumrating = Providerreviews::where(['provider_id' => $newprovider->id])->sum('rating');
                $reviewcount = count($provider_reviews);


                if ($sumrating == '0') {
                    $provider_rating = 0;
                } else {


                    if ($reviewcount == '0') {

                        $reviewcount = 1;
                    }


                    $provider_rating = $sumrating / $reviewcount;
                }

                $provider_services = Providerservices::select('provider_services.id', 'service_sub_category.sub_category_name', 'provider_services.quickpitch', 'provider_services.priceperhour', 'provider_services.experience')->join('service_sub_category', 'service_sub_category.id', '=', 'provider_services.service_sub_category_id')->where(['provider_id' => $newprovider->id])->get();
                // $newprovider->distance=floatval($newprovider->distance);


                $newprovider->quickpitch = $services_details['quickpitch'];
                $newprovider->priceperhour = $services_details['priceperhour'];
                $newprovider->experience = $services_details['experience'];
                $newprovider->avg_rating = $provider_rating;
                $newprovider->reviews = $provider_reviews;
                $newprovider->distance = round($newprovider->distance, 2);
                $newprovider->provider_services = $provider_services;
            }
// die;
// die;
            if ($allprovider) {
                $response['error'] = 'false';
                $response['error_message'] = "success";
                $response['all_providers'] = $allprovider;
            } else {
                $response['error'] = 'true';
                $response['error_message'] = "No Providers Available";
                $response['all_providers'] = [];
            }
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'mandatory params are empty';
        }
        echo json_encode($response);
    }

    public function newbooking(request $request) {

        if ($request->time_slot_id && $request->provider_id && $request->date && $request->service_sub_category_id && $request->address_id) {
            $userid = Auth::guard('api')->user()->id;
            $timeslot = $request->time_slot_id;
            $providerid = $request->provider_id;
            $date = $request->date;
            $address_id = $request->address_id;
            $subcategoryid = $request->service_sub_category_id;
            $categoryid = Subcategory::where('id', $subcategoryid)->value('category_id');
            $day = date('D', strtotime($date));
            $provider_details = Provider::where('id', $providerid)->first();
            $provider_schedule_id = Providerschedules::where(['time_slots_id' => $timeslot, 'provider_id' => $providerid, 'days' => $day])->value('id');
            $booking_order_id = "UX" . mt_rand(1000000, 9999999);

            $provider_status = Bookings::select('status')->where(['provider_schedules_id' => $provider_schedule_id, 'provider_id' => $providerid, 'booking_date' => $date])->first();
            $sta = $provider_status['status'];
            if ($sta == 'Accepted' || $sta == 'StarttoCustomerPlace' || $sta == 'Startedjob') {
                $response['error'] = 'true';
                $response['error_message'] = 'unable to book provider is busy at that time';
                echo json_encode($response);
                die;
            } else {
                // echo "booking made";
                // die;
                try {
                    $newbooking = new Bookings();
                    $newbooking->user_id = $userid;
                    $newbooking->provider_id = $providerid;
                    $newbooking->service_category_id = $categoryid;
                    $newbooking->service_category_type_id = $subcategoryid;
                    $newbooking->provider_schedules_id = $provider_schedule_id;
                    $newbooking->booking_date = $date;
                    $newbooking->address_id = $address_id;
                    $newbooking->booking_order_id = $booking_order_id;
                    $newbooking->status = "Pending";
                    $newbooking->Pending_time = date('Y-m-d H:i:s');
                    $newbooking->save();
                } catch (\Illuminate\Database\QueryException $ex) {
                    $jsonresp = $ex->getMessage();
                    $response['error'] = 'true';
                    $response['message'] = $jsonresp;
                    echo json_encode($response);
                    die;
                }


                if ($newbooking) {
                    $service_name = Subcategory::where('id', $subcategoryid)->value('sub_category_name');
                    $serverkey = "AAAAyPflDGI:APA91bHQJeAPU-Er00_He01IIJO1jPJhrwWRWuwLyuWef5vrLQfvfYgm3G82Z4i6EmeLgfIm4e575HbhdFNKpQpzuR79dCX6P58_xL9bW3ce9VCbEUFWpCXEKPAQhuHfkZkOtaY65bnp";
                    $gcpm = new FCMPushNotification($serverkey);
                    $title = "New Booking Request";
                    $message = "You have a new booking request for $service_name";
                    $os = $provider_details['os_type'];
                    $data = array('image' => "NULL",
                        'title' => $title, 'notification_type' => 'newbooking');
                    $gcpm->setDevices($provider_details['fcm_token']);
                    // $gcpm->setDevices("epERrayTJmw:APA91bFNs1QwHNnVZdqId4_GKSqZylK-k6A2VbTSsvpHXoKbOTJCTHNZm13KcbP7247dAiiG16iXZDo6MV4ZO-Bb0-KWAfy3mkxI1Kj4jQ_UKkTxjVUn3o5XfbXqHZ3ONBdna0GZGteX");
                    $newresponse[] = $gcpm->send($message, $data, $os, $title, $message);


                    // $gcpm = new FCMPushNotification();
                    // $title = "Moip Account password link";
                    // $message =$provider_details['moippaslink'];
                    // $os=$provider_details['os_type'];
                    // $data = array('image' => "NULL",
                    //        'title' => $title,'notification_type'=>'link');
                    // $gcpm->setDevices($provider_details['fcm_token']);
                    // // $gcpm->setDevices("epERrayTJmw:APA91bFNs1QwHNnVZdqId4_GKSqZylK-k6A2VbTSsvpHXoKbOTJCTHNZm13KcbP7247dAiiG16iXZDo6MV4ZO-Bb0-KWAfy3mkxI1Kj4jQ_UKkTxjVUn3o5XfbXqHZ3ONBdna0GZGteX");
                    // $newresponse[] = $gcpm->send($message, $data,$os,$title, $message);


                    $response['error'] = 'false';
                    $response['error_message'] = 'Booked Successfully';
                } else {
                    $response['error'] = 'true';
                    $response['error_message'] = 'unable to book.';
                }
            }
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'Mandatory Parameters are missing';
        }
        echo json_encode($response);
    }

    public function view_bookings(request $request) {
        $userid = Auth::guard('api')->user()->id;

        $all_bookings = Bookings::select(DB::raw("distinct(bookings.id),bookings.booking_order_id,users.mobile as user_mobile,provider.mobile as provider_mobile,CONCAT(users.first_name,users.last_name) AS username,CONCAT(provider.first_name,provider.last_name) AS providername,provider.image,provider.id as provider_id,provider.latitude as provider_latitude,provider.longitude as provider_longitude,provider.Bearing as provider_bearing,service_sub_category.sub_category_name,time_slots.timing,bookings.booking_date,provider_schedules.days,bookings.Pending_time,bookings.Accepted_time,bookings.Rejected_time,bookings.Finished_time,bookings.startjob_timestamp,bookings.endjob_timestamp,bookings.CancelledbyUser_time,bookings.CancelledbyProvider_time,bookings.StarttoCustomerPlace_time,bookings.job_start_time,bookings.job_end_time,bookings.cost,bookings.tax_name,bookings.gst_percent,bookings.gst_cost,bookings.total_cost,service_sub_category.icon,user_address.doorno,user_address.landmark,user_address.address_line_1,user_address.latitude as boooking_latitude ,user_address.longitude as booking_longitude,bookings.rating,bookings.status,bookings.feedback,case when(bookings.status) IN ('Completedjob','Reviewpending','Waitingforpaymentconfirmation','Finished') then '1' else '0' end as show_bill_flag,bookings.worked_mins,bookings.created_at,bookings.updated_at"))
                ->join('user_address', 'bookings.address_id', '=', 'user_address.id')
                ->join('users', 'bookings.user_id', '=', 'users.id')
                ->join('provider', 'bookings.provider_id', '=', 'provider.id')
                ->join('service_sub_category', 'bookings.service_category_type_id', '=', 'service_sub_category.id')
                ->join('provider_schedules', 'bookings.provider_schedules_id', '=', 'provider_schedules.id')
                ->join('time_slots', 'provider_schedules.time_slots_id', '=', 'time_slots.id')
                ->where('bookings.user_id', $userid)
                ->groupBy('bookings.id')
                ->orderBy('bookings.updated_at', 'desc')
                ->get();

        if ($all_bookings) {
            $response['error'] = 'false';
            $response['error_message'] = 'success';
            $response['all_bookings'] = $all_bookings;
        } else {

            $response['error'] = 'true';
            $response['error_message'] = 'No Bookings';
            $response['all_bookings'] = [];
        }
        echo json_encode($response);
    }

    public function getproviderlocation(request $request) {
        if ($request->provider_id) {
            $providerid = $request->provider_id;
            $provider_location = Provider::select('latitude', 'longitude', 'Bearing')->where('id', $providerid)->first();
            if ($provider_location) {
                $response['error'] = 'false';
                $response['error_message'] = 'success';
                $response['latitude'] = $provider_location['latitude'];
                $response['longitude'] = $provider_location['longitude'];
                $response['Bearer'] = $provider_location['Bearer'];
            } else {
                $response['error'] = 'true';
                $response['error_message'] = 'latitude & longitude empty';
            }
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'invalid provider_id';
        }
        echo json_encode($response);
    }

    public function cancel_request(request $request) {
        $userid = Auth::guard('api')->user()->id;
        $booking_request_id = $request->id;
        $rejecttime = date('Y-m-d H:i:s');
        $random_update_status = DB::table('provider_request')->where(['booking_id' => $booking_request_id])->delete();
        $startendJob = DB::table('startendjobdetails')->where(['booking_id' => $booking_request_id])->delete();
        $cancel_booking = DB::table('bookings')->where(['id' => $booking_request_id])->delete();
        $response['error'] = 'false';
        $response['error_message'] = 'Random Request Rejected';

        echo json_encode($response);
    }

    public function paidstatus(request $request) {
        if ($request->id) {
            $booking_request_id = $request->id;
            $accept = Bookings::where('id', $booking_request_id)->update(['status' => 'Paid']);
            if ($accept) {
                $response['error'] = 'false';
                $response['error_message'] = 'Updated.';
            } else {
                $response['error'] = 'true';
                $response['error_message'] = 'Not Updated.';
            }
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'Invalid Booking id.';
        }
        echo json_encode($response);
    }

    public function review_feedback(request $request) {
        if ($request->id && $request->rating) {
            $providerid = $request->id;
            $userid = Auth::guard('api')->user()->id;
            $rating = $request->rating;
            $booking_id = $request->booking_id;
            $reviewinsert = new Providerreviews();
            $reviewinsert->provider_id = $providerid;
            $reviewinsert->user_id = $userid;
            if ($request->feedback) {
                $feedback = $request->feedback;
                $reviewinsert->feedback = $feedback;
            }
            $reviewinsert->rating = $rating;
            $reviewinsert->booking_id = $booking_id;
            $reviewinsert->save();

            if ($reviewinsert) {
                Bookings::where('id', $booking_id)->update(['status' => 'Finished']);
                $response['error'] = 'false';
                $response['error_message'] = 'review Inserted';
            } else {
                $response['error'] = 'true';
                $response['error_message'] = 'review not updated.';
            }
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'Review is empty.';
        }
        echo json_encode($response);
    }

    public function payment_method(request $request) {
        if ($request->method && $request->id) {
            $user_name = Auth::guard('api')->user()->first_name;
            $method = $request->method;
            $bookingid = $request->id;
            if ($method == 'cash') {
                Bookings::where('id', $bookingid)->update(['status' => 'Waitingforpaymentconfirmation', 'provider_owe_status' => 'completed', 'admin_owe_status' => 'pending', 'payment_type' => 'cash']);

                $provider_id = Bookings::where('id', $bookingid)->value('provider_id');
                $provider_details = Provider::where('id', $provider_id)->first();
                $provider_name=$provider_details['first_name'];
                $response['error'] = 'false';
                $response['error_message'] = $provider_name;
                $serverkey = "AAAAyPflDGI:APA91bHQJeAPU-Er00_He01IIJO1jPJhrwWRWuwLyuWef5vrLQfvfYgm3G82Z4i6EmeLgfIm4e575HbhdFNKpQpzuR79dCX6P58_xL9bW3ce9VCbEUFWpCXEKPAQhuHfkZkOtaY65bnp";
                $gcpm = new FCMPushNotification($serverkey);
                $title = "Confirm Payment.";
                $message = "$user_name has paid through cash.";
                $os = $provider_details['os_type'];
                $data = array('image' => "NULL",
                    'title' => $title, 'notification_type' => 'Waitingforpaymentconfirmation');
                $gcpm->setDevices($provider_details['fcm_token']);
                // $gcpm->setDevices("epERrayTJmw:APA91bFNs1QwHNnVZdqId4_GKSqZylK-k6A2VbTSsvpHXoKbOTJCTHNZm13KcbP7247dAiiG16iXZDo6MV4ZO-Bb0-KWAfy3mkxI1Kj4jQ_UKkTxjVUn3o5XfbXqHZ3ONBdna0GZGteX");
                $newresponse[] = $gcpm->send($message, $data, $os, $title, $message);
            } else {
                $response['error'] = 'true';
                $response['error_message'] = 'invalid payment method';
            }
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'invalid bookingid';
        }
        echo json_encode($response);
    }

    public function cancelbyuser(request $request) {
        if ($request->id) {
            $booking_request_id = $request->id;

            // $status=Bookings::where(['id'=>$booking_request_id])->value('status');
            // if($status == 'Accepted')
            // {

            $canceldate = date('Y-m-d H:i:s');
            $accept = Bookings::where('id', $booking_request_id)->update(['status' => 'CancelledbyUser', 'CancelledbyUser_time' => $canceldate]);
            if ($accept) {
                $response['error'] = 'false';
                $response['error_message'] = 'Updated.';

                $provider_id = Bookings::where('id', $booking_request_id)->value('provider_id');
                $provider_details = Provider::where('id', $provider_id)->first();
                $user_name = Auth::guard('api')->user()->first_name;
                $response['error'] = 'false';
                $response['error_message'] = 'updated.';
                                      $serverkey = "AAAAyPflDGI:APA91bHQJeAPU-Er00_He01IIJO1jPJhrwWRWuwLyuWef5vrLQfvfYgm3G82Z4i6EmeLgfIm4e575HbhdFNKpQpzuR79dCX6P58_xL9bW3ce9VCbEUFWpCXEKPAQhuHfkZkOtaY65bnp";

                $gcpm = new FCMPushNotification($serverkey);
                $title = "Booking Cancelled.";
                $message = "$user_name has Cancelled your booking.";
                $os = $provider_details['os_type'];
                $data = array('image' => "NULL",
                    'title' => $title,
                    'notification_type' => 'cancelbooking');
                $gcpm->setDevices($provider_details['fcm_token']);
                // $gcpm->setDevices("epERrayTJmw:APA91bFNs1QwHNnVZdqId4_GKSqZylK-k6A2VbTSsvpHXoKbOTJCTHNZm13KcbP7247dAiiG16iXZDo6MV4ZO-Bb0-KWAfy3mkxI1Kj4jQ_UKkTxjVUn3o5XfbXqHZ3ONBdna0GZGteX");
                $newresponse[] = $gcpm->send($message, $data, $os, $title, $message);
            } else {
                $response['error'] = 'true';
                $response['error_message'] = 'Not Updated.';
            }
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'Invalid Booking id.';
        }
        echo json_encode($response);
    }

    public function list_payment_methods(request $request) {
        $payment_type = DB::table('payments_type')->get();
        if ($payment_type) {
            $response['error'] = 'false';
            $response['error_message'] = 'success';
            $response['payment_types'] = $payment_type;
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'No Payment';
        }
        echo json_encode($response);
    }

    public function logout(Request $request) {

        $user = Auth::guard('api')->user()->token();

        $userid = Auth::guard('api')->user()->id;

        User::where('id', $userid)->update(['device_token' => ""]);
         $user->revoke();

//        $request->guard('api')->user()->token()->revoke();
//        $userid = Auth::guard('api')->user();
//        $update = User::where('id', $userid->id)->update(['fcm_token' => " "]);
//        if ($update) {
        $response['error'] = 'false';
        $response['error_message'] = 'Logout Successfully.';

//        } else {
//            $response['error'] = 'true';
//            $response['error_message'] = 'not logged out';
//        }
        echo json_encode($response);
    }

    public function ephemeral_keys(request $request) {
        if ($request->api_version) {
            try {
                $userid = Auth::guard('api')->user()->id;
                $customer_id = Auth::guard('api')->user()->stripe_payment_account;
                $stripe = Stripe::make('STRIPE_KEY');
                $setkey = \Stripe\Stripe::setApiKey('STRIPE_KEY');
                $key = \Stripe\EphemeralKey::create(
                                array("customer" => $customer_id), array("stripe_version" => $request->api_version)
                );

                echo json_encode($key);
            } catch (Exception $e) {
                exit(http_response_code(500));
            }
        }
    }

    public function postPaymentWithStripe(Request $request) {
        $username = Auth::guard('api')->user()->firstname;
        $customer_id = Auth::guard('api')->user()->stripe_payment_account;
        $input = $request->all();
        $token = $request->token;
        $booking_id = $request->id;
        $booking_details = Bookings::where(['id' => $booking_id])->first();
        if ($request->id) {

            $provider_id = $booking_details->provider_id;
            $provider_details = Provider::where('id', $provider_id)->first();


            $amount = $request->amount;


            $converted_amount = $booking_details->total_cost / 4.7;


            if ($converted_amount > 0) {
                $amount = $converted_amount;
            } else {
                $amount = 50; //ste default amount
            }
            Bookings::where(['id' => $booking_id])->update(['total_cost' => $amount]);

            // if ($validator->passes()) {
            // $input = array_except($input,array('_token'));
            $stripe = Stripe::make('STRIPE_KEY');


            try {

                // $token = $stripe->tokens()->create([
                //     'card' => [
                //         'number'    => $request->get('card_no'),
                //         'exp_month' => $request->get('ccExpiryMonth'),
                //         'exp_year'  => $request->get('ccExpiryYear'),
                //         'cvc'       => $request->get('cvvNumber'),
                //     ],
                // ]);
                // if ($token) {
                //     // \Session::put('error','The Stripe Token was not generated correctly');
                //     // return redirect()->route('stripform');
                // }


                $charge = $stripe->charges()->create([
                    'source' => $token,
                    'customer' => $customer_id,
                    'currency' => 'USD',
                    'amount' => $amount,
                    'description' => 'Add in wallet',
                ]);

                // echo $charge;
                // echo "inside";
                // die;
                if ($charge['status'] == 'succeeded') {
                    /**
                     * Write Here Your Database insert logic.
                     */
                    Bookings::where(['id' => $booking_id, 'provider_id' => $provider_id])->update(['status' => 'Reviewpending', 'provider_owe_status' => 'pending', 'admin_owe_status' => 'completed', 'payment_type' => 'card']);
                    $response['error'] = 'false';
                    $response['error_message'] = 'success';
                    $response['order_details'] = $charge;
                                      $serverkey = "AAAAyPflDGI:APA91bHQJeAPU-Er00_He01IIJO1jPJhrwWRWuwLyuWef5vrLQfvfYgm3G82Z4i6EmeLgfIm4e575HbhdFNKpQpzuR79dCX6P58_xL9bW3ce9VCbEUFWpCXEKPAQhuHfkZkOtaY65bnp";

                    $gcpm = new FCMPushNotification($serverkey);
                    $title = "Payment Completed";
                    $message = "$username have paid for your service";
                    $os = $provider_details['os_type'];
                    $data = array('image' => "NULL",
                        'title' => $title, 'notification_type' => 'payment');
                    $gcpm->setDevices($provider_details['fcm_token']);
                    // $gcpm->setDevices("epERrayTJmw:APA91bFNs1QwHNnVZdqId4_GKSqZylK-k6A2VbTSsvpHXoKbOTJCTHNZm13KcbP7247dAiiG16iXZDo6MV4ZO-Bb0-KW            Afy3mkxI1Kj4jQ_UKkTxjVUn3o5XfbXqHZ3ONBdna0GZGteX");
                    $newresponse[] = $gcpm->send($message, $data, $os, $title, $message);
                    // echo 'payment successfull';
                    // return redirect()->route('stripform');
                } else {
                    $response['error'] = 'true';
                    $response['error_message'] = 'Money not added';
                }
            } catch (Exception $e) {
                $response['error'] = 'true';
                $response['error_message'] = $e->getMessage();
                // return redirect()->route('stripform');
            } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {

                $response['error'] = 'true';
                $response['error_message'] = $e->getMessage();
                // return redirect()->route('stripform');
            } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                $response['error'] = 'true';
                $response['error_message'] = $e->getMessage();
                // return redirect()->route('stripform');
            }
        } else {
            $response['error'] = 'true';
            $response['error_message'] = "Invalid Params";
        }

        // }
        echo json_encode($response);
    }

    public function viewbalance(request $request) {


        $userid = Auth::guard('api')->user()->id;

        $walletusercheck = Walletusers::where('userid', '=', $userid)->get();


        if ($walletusercheck->isEmpty()) {

            $response['error'] = 'true';
            $response['error_message'] = "This user is not  wallet user";
        } else {


            $response['error'] = 'false';
            $response['error_message'] = "successfully show the balance";
            $response['walletdetails'] = $walletusercheck;
        }

        echo json_encode($response);
    }

    public function charge(Request $request) {
        $username = Auth::guard('api')->user()->firstname;
        $customer_id = Auth::guard('api')->user()->stripe_payment_account;
        $input = $request->all();
        $token = $request->token;
        $booking_id = $request->id;
        $booking_details = Bookings::where(['id' => $booking_id])->first();
        if ($request->id && $request->amount) {
            $provider_id = $booking_details->provider_id;
            $provider_details = Provider::where('id', $provider_id)->first();
            $amount = $request->amount;

            // if ($validator->passes()) {
            // $input = array_except($input,array('_token'));
            $stripe = Stripe::make('STRIPE_KEY');
            try {
                // $token = $stripe->tokens()->create([
                //     'card' => [
                //         'number'    => $request->get('card_no'),
                //         'exp_month' => $request->get('ccExpiryMonth'),
                //         'exp_year'  => $request->get('ccExpiryYear'),
                //         'cvc'       => $request->get('cvvNumber'),
                //     ],
                // ]);
                // if ($token) {
                //     // \Session::put('error','The Stripe Token was not generated correctly');
                //     // return redirect()->route('stripform');
                // }
                $charge = $stripe->charges()->create([
                    'source' => $token,
                    'customer' => $customer_id,
                    'currency' => 'USD',
                    'amount' => $amount,
                    'description' => 'Add in wallet',
                ]);
                if ($charge['status'] == 'succeeded') {
                    /**
                     * Write Here Your Database insert logic.
                     */
                    Bookings::where(['id' => $booking_id, 'provider_id' => $provider_id])->update(['status' => 'Reviewpending']);
//                    $response['error']='false';
//                    $response['error_message']='success';
//                    $response['order_details']=$charge;
                                      $serverkey = "AAAAyPflDGI:APA91bHQJeAPU-Er00_He01IIJO1jPJhrwWRWuwLyuWef5vrLQfvfYgm3G82Z4i6EmeLgfIm4e575HbhdFNKpQpzuR79dCX6P58_xL9bW3ce9VCbEUFWpCXEKPAQhuHfkZkOtaY65bnp";

                    $gcpm = new FCMPushNotification($serverkey);
                    $title = "Payment Completed";
                    $message = "$username have paid for your service";
                    $os = $provider_details['os_type'];
                    $data = array('image' => "NULL",
                        'title' => $title, 'notification_type' => 'payment');
                    $gcpm->setDevices($provider_details['fcm_token']);
                    // $gcpm->setDevices("epERrayTJmw:APA91bFNs1QwHNnVZdqId4_GKSqZylK-k6A2VbTSsvpHXoKbOTJCTHNZm13KcbP7247dAiiG16iXZDo6MV4ZO-Bb0-KW            Afy3mkxI1Kj4jQ_UKkTxjVUn3o5XfbXqHZ3ONBdna0GZGteX");
                    $newresponse[] = $gcpm->send($message, $data, $os, $title, $message);
                    // echo 'payment successfull';
                    // return redirect()->route('stripform');
                } else {
                    $response['error'] = 'true';
                    $response['error_message'] = 'Money not added';
                }
                echo json_encode($charge);
                die;
            } catch (Exception $e) {
                echo http_response_code(500);
                die;
                // return redirect()->route('stripform');
            }
        } else {
            echo http_response_code(500);
            die;
        }

        // }
    }

    public function fcmtest() {
                                      $serverkey = "AAAAyPflDGI:APA91bHQJeAPU-Er00_He01IIJO1jPJhrwWRWuwLyuWef5vrLQfvfYgm3G82Z4i6EmeLgfIm4e575HbhdFNKpQpzuR79dCX6P58_xL9bW3ce9VCbEUFWpCXEKPAQhuHfkZkOtaY65bnp";

        $gcpm = new FCMPushNotification($serverkey);
        $title = "New Booking Request";
        $message = "Request";
        $os = 'iOS';
        $data = array('image' => "NULL",
            'title' => $title);
        // $gcpm->setDevices($devicetoken);
        $gcpm->setDevices("cneUKeW-eQQ:APA91bF2-1MsroxLIlS9jZ314OPGyt04sNEt66Pys0cHj2rpdMhonoD96YhNMO-c4LPH-l2dqZfKF7Rh6u9_J_RfkiA9aKPS8ASLB4swnoyq6QQx2GGs-etmTFJQzJymL96sLo_xUO8g");
        $newresponse[] = $gcpm->send($message, $data, $os, "UberX", $message);
        echo json_encode($newresponse);
    }

    public function listprovidertest(request $request) {

        if ($request->service_sub_category_id && $request->time_slot_id && $request->date && $request->city && $request->lat && $request->lon) {
            $subcategoryid = $request->service_sub_category_id;
            $slotid = $request->time_slot_id;
            $latitude = $request->lat;

            $longitude = $request->lon;
            $city = $request->city;

            $radius_data = DB::table('radius')->where('id', '1')->first();

            $radius = $radius_data->radius;

// $providerid=$request->provider_id;
            $date = $request->date;
            $day = date('D', strtotime($date));
            $allprovider = DB::select(DB::raw("select distinct(provider.id),CONCAT(first_name,' ',last_name) as name,email,image,mobile,latitude,longitude,about, (
      6371 * acos (
      cos ( radians('$latitude') )
      * cos( radians( provider.latitude ) )
      * cos( radians( provider.longitude ) - radians('$longitude') )
      + sin ( radians('$latitude') )
      * sin( radians( provider.latitude ) )
    )
) AS distance,addressline1,addressline2,city,state,zipcode,premium from provider Inner join provider_schedules on provider_schedules.provider_id=provider.id Inner join provider_services on provider_services.provider_id=provider.id where provider_schedules.time_slots_id='$slotid' and provider_schedules.days='$day' and provider_services.service_sub_category_id='$subcategoryid' and provider.id Having distance < '$radius' ORDER by distance asc LIMIT 12"));

//echo json_encode($allprovider);die;
            foreach ($allprovider as $newprovider) {
                $services_details = Providerservices::where(['provider_id' => $newprovider->id, 'service_sub_category_id' => $subcategoryid])->first();
                $provider_reviews = Providerreviews::select(DB::raw("CONCAT(provider.first_name,' ',provider.last_name) as providername,CONCAT(users.first_name,' ',users.last_name) as username,provider_reviews.feedback,provider_reviews.rating"))->join('provider', 'provider.id', '=', 'provider_reviews.provider_id')->join('users', 'users.id', '=', 'provider_reviews.user_id')->where(['provider_id' => $newprovider->id])->get();
                $sumrating = Providerreviews::where(['provider_id' => $newprovider->id])->sum('rating');
                $reviewcount = count($provider_reviews);
                if ($sumrating == '0') {
                    $provider_rating = 0;
                } else {
                    $provider_rating = $sumrating / $reviewcount;
                }

                $provider_services = Providerservices::select('provider_services.id', 'service_sub_category.sub_category_name', 'provider_services.quickpitch', 'provider_services.priceperhour', 'provider_services.experience')->join('service_sub_category', 'service_sub_category.id', '=', 'provider_services.service_sub_category_id')->where(['provider_id' => $newprovider->id])->get();
                // $newprovider->distance=floatval($newprovider->distance);


                $newprovider->quickpitch = $services_details['quickpitch'];
                $newprovider->priceperhour = $services_details['priceperhour'];
                $newprovider->experience = $services_details['experience'];
                $newprovider->avg_rating = $provider_rating;
                $newprovider->reviews = $provider_reviews;
                $newprovider->distance = round($newprovider->distance, 2);
                $newprovider->provider_services = $provider_services;
            }

            $newlist = json_encode($allprovider);

            $sortarray = json_decode($newlist);
            usort($sortarray, array("App\Http\Controllers\UserController", "premium"));

            if ($sortarray) {
                $response['error'] = 'false';
                $response['error_message'] = "success";
                $response['all_providers'] = $sortarray;
            } else {
                $response['error'] = 'true';
                $response['error_message'] = "No Providers Available";
                $response['all_providers'] = [];
            }
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'mandatory params are empty';
        }
        echo json_encode($response);
    }

    public function premium($a, $b) {

        if ($a->premium == $b->premium)
            return 0;
        return ($a->premium > $b->premium) ? -1 : 1;
    }

    public function couponverify(request $request) {

        if ($request->couponname && $request->booking_order_id) {
            $booking_order_id = $request->booking_order_id;
            $customer_time = date('Y-m-d');

            $bookings = Bookings::where('booking_order_id', $booking_order_id)->first();
            $coupon = DB::table('coupons')->where('coupon_code', $request->couponname)->first();

            // echo($bookings->coupon_applied);
            if (empty($bookings->coupon_applied)) {
                // die;

                if ($bookings->coupon_applied == $request->couponname) {
                    $response['error'] = 'true';
                    $response['error_message'] = 'Coupon Code Already Applied';
                } else {
                    if ($coupon) {
                        if ($coupon->valid_from <= $customer_time && $coupon->valid_to >= $customer_time) {

                            if ($bookings->total_cost >= $coupon->discount_value) {
                                $response['error'] = 'false';
                                $response['error_message'] = 'Coupon Applied';
                                $response['off'] = $coupon->discount_value;
                                $reduced = $bookings->total_cost - $coupon->discount_value;
                                $updateamount = Bookings::where(['booking_order_id' => $booking_order_id])->update(['total_cost' => $reduced, 'coupon_applied' => $request->couponname, 'original_amount' => $bookings->total_cost, 'reduced_cost' => $coupon->discount_value]);
                                $response['total_cost'] = ($reduced);
                            } else {
                                $response['error'] = 'true';
                                $response['error_message'] = 'Amount is Minimum';
                                $response['amount'] = ($bookings->total_cost);
                            }
                        } else {
                            $response['error'] = 'true';
                            $response['error_message'] = 'Coupon Expired';
                        }
                    } else {
                        $response['error'] = 'true';
                        $response['error_message'] = 'Coupon Not Applied';
                    }
                }
            } else {
                $response['error'] = 'true';
                $response['error_message'] = 'A Coupon Applied Already';
            }
            echo json_encode($response);
        }
    }

    public function couponremove(request $request) {

        if ($request->couponname && $request->booking_order_id) {
            $booking_order_id = $request->booking_order_id;

            $bookings = Bookings::where('booking_order_id', $booking_order_id)->first();
            $total_cost = $bookings->original_amount;
            if ($bookings->coupon_applied == $request->couponname) {
                $updateamount = Bookings::where(['booking_order_id' => $booking_order_id])->update(['total_cost' => $total_cost, 'coupon_applied' => NULL, 'reduced_cost' => NULL]);
                if ($updateamount) {
                    $response['error'] = 'false';
                    $response['error_message'] = 'Coupon Removed';
                } else {
                    $response['error'] = 'true';
                    $response['error_message'] = 'Coupon Not Removed';
                }
            } else {
                $response['error'] = 'true';
                $response['error_message'] = 'Coupon Not Applied';
            }
            echo json_encode($response);
        }
    }

    public function startjobendjobdetails(request $request) {

        if ($request->booking_id) {


            $coupon = DB::table('startendjobdetails')->where('booking_id', $request->booking_id)->first();

            $response['error'] = "false";
            $response['error_message'] = "details fetched";
            $response['data'] = $coupon;


            $bookingid = $request->booking_id;

            $location = Location::get();
            $timeslots = Timeslots::get();

            $response['error'] = 'false';
            $response['error_message'] = 'success';
            // $response['location']=$location;
            // $response['timeslots']=$timeslots;
            //BLK = Is Blocked
            //DSP = is in Dispute
            //REP=review pending
            //PYP=Payment Pending
            //INP =Invoice Pending
            //PAID= Paid
            //PPCNF=Pending Payment Confirmation
            //PCNF =Payment Confirmation
            //Accept= Accepted Job
            //Reject = Reject job
            //Start = Start Job
            //Complete = Complete Job


            $bookingdetails = Bookings::select(DB::raw("distinct(bookings.id),bookings.booking_order_id,CONCAT(users.first_name,users.last_name) AS username,CONCAT(provider.first_name,provider.last_name) AS providername,provider.id as provider_id,provider.image,provider.mobile,provider.email,service_sub_category.sub_category_name,service_sub_category.icon,time_slots.timing,bookings.booking_date,'bookings.payment_type',bookings.tax_name,bookings.gst_percent,bookings.gst_cost,bookings.total_cost,bookings.coupon_applied,bookings.reduced_cost,provider_schedules.days,bookings.job_start_time,bookings.job_end_time,bookings.cost,user_address.doorno,user_address.landmark,user_address.address_line_1,bookings.rating,bookings.service_category_id AS categoryId,bookings.status,bookings.worked_mins,bookings.feedback,case when(bookings.status) IN ('Completedjob','Reviewpending','Waitingforpaymentconfirmation','Finished') then '1' else '0' end as show_bill_flag,bookings.worked_mins,bookings.created_at,bookings.updated_at"))
                    ->join('user_address', 'bookings.address_id', '=', 'user_address.id')
                    ->join('users', 'bookings.user_id', '=', 'users.id')
                    ->join('provider', 'bookings.provider_id', '=', 'provider.id')
                    ->join('service_sub_category', 'bookings.service_category_type_id', '=', 'service_sub_category.id')
                    ->join('provider_schedules', 'bookings.provider_schedules_id', '=', 'provider_schedules.id')
                    ->join('time_slots', 'provider_schedules.time_slots_id', '=', 'time_slots.id')
                    ->where(['bookings.id' => $bookingid])
                    ->groupBy('bookings.id')
                    ->orderBy('bookings.updated_at', 'desc')
                    ->get();


//


            if ($bookingdetails) {
                foreach ($bookingdetails as $details) {


                    $yesdata['booking_id'] = $details->id;
                    $yesdata['booking_order_id'] = $details->booking_order_id;
                    $yesdata['username'] = $details->username;
                    $yesdata['providername'] = $details->providername;

                    $yesdata['mobile'] = $details->mobile;
                    $yesdata['email'] = $details->email;
                    $yesdata['provider_id'] = $details->provider_id;
                    $yesdata['sub_category_name'] = $details->sub_category_name;
                    $yesdata['timing'] = $details->timing;
                    $yesdata['booking_date'] = $details->booking_date;
                    $yesdata['days'] = $details->days;
                    $yesdata['job_start_time'] = $details->job_start_time;
                    $yesdata['job_end_time'] = $details->job_end_time;
                    $yesdata['payment_type'] = $details->payment_type;
                    $yesdata['status'] = $details->status;
                    $yesdata['worked_mins'] = $details->worked_mins;
                    $yesdata['doorno'] = $details->doorno;
                    $yesdata['landmark'] = $details->landmark;
                    $yesdata['address_line_1'] = $details->address_line_1;
                    if ($details->coupon_applied == null) {
                        $yesdata['coupon_applied'] = "";
                    } else {
                        $yesdata['coupon_applied'] = $details->coupon_applied;
                    }
                    if ($details->reduced_cost == null) {
                        $yesdata['off'] = "";
                    } else {
                        $yesdata['off'] = $details->reduced_cost;
                    }

                    if ($details->cost == 0) {
                        $yesdata['cost'] = 50;
                    } else {
                        $yesdata['cost'] = $details->cost; //android
                    }

                    $yesdata['tax_name'] = $details->tax_name;
                    $yesdata['gst_percent'] = $details->gst_percent;
                    $yesdata['gst_cost'] = $details->gst_cost;
                    if ($details->total_cost == 0) {
                        $yesdata['total_cost'] = 50;
                    } else {
                        $yesdata['total_cost'] = $details->total_cost;
                    }
                    $yesdata['doorno'] = $details->doorno;
                    $yesdata['landmark'] = $details->landmark;
                    $yesdata['address_line_1'] = $details->address_line_1;
                    $yesdata['rating'] = $details->rating;
                    $yesdata['worked_mins'] = $details->worked_mins;
//            $yesdata['created_at']=$details->created_at;
//            $yesdata['updated_at']=$details->updated_at;
                    //$yesdata['status']=;
                    $newdata[] = $yesdata;
                }
            }
//        $lastdata=$newdata;
//
//
//                 $newdata[$listofstatus[$i]]=$yesdata;
//        }else{
////            $yesdata['booking_id']=$bookingdetails['id'];
////            $yesdata['status']="0";
////            $newdata[$listofstatus[$i]]=$yesdata;
//        }
//

            if (isset($newdata)) {
                $data['status'] = $newdata;
            } else {
                $data['status'] = [];
            }

//     $new[]=$yesdata;
            // $pdf =\PDF::loadView('invoice', $data)->setPaper('a4');


            $name = rand(11111, 99999) . '.' . $bookingid . '.pdf';


            $pdf = \PDF::loadView('invoice', $data, compact('invoice'))->save('/var/www/html/uber_test/public/pdf/' . $name);


            $path = 'http://IP/uber_test/public/pdf/' . $name;
            $result = DB::table('bookings')->where(['id' => $bookingid])->update(['invoicelink' => $path]);


            if ($result) {

                $newpath = Bookings::select('invoicelink')->where(['id' => $bookingid])->get();


                $response['invoicelink'] = $newpath;
            }
        } else {
            $response['error'] = "true";
            $response['error_message'] = "cannot fetch details";
            $response['data'] = $coupon;
        }
        echo json_encode($response);
    }

    public function searchproivder(request $request) {


        $providersearchlist = provider::Select('id', 'proivder_name')
                ->orWhere('name', 'like', '%' . $name . '%')
                ->get();
    }

    public function reportuser(request $request) {


        if ($request->proivder_id && $request->user_id && $request->reportmessage && $request->reportimage) {

            $proivder_id = $request->proivder_id;
            $user_id = $request->user_id;
            $reportmessage = $request->reportmessage;
            $reportimage = $request->reportimage;

            try {
                $reports = new Userreports();
                $reports->provider_id = $proivder_id;
                $addprovider->user_id = $user_id;
                $addprovider->reportmessage = $reportmessage;
                $reports->reportimage = $reportimage;
                $reports->save();
            } catch (\Illuminate\Database\QueryException $ex) {
                $jsonresp = $ex->getMessage();
                $response['error'] = 'true';
                $response['error_message'] = $jsonresp;
                echo json_encode($response);
                die;
            }


            if ($reports) {

                $response['error'] = 'false';
                $response['error_message'] = "user report update successfully";
            }
        } else {


            $response['error'] = 'true';
            $response['error_message'] = "Mandatory parameter is missing";
        }


        echo json_encode($response);
    }

    public function addmoneywallet(request $request) {

        $userid = Auth::guard('api')->user()->id;
        $wallet_amount = $request->amount;
        $customer_id = Auth::guard('api')->user()->stripe_payment_account;
        $token = $request->token;


        $stripe = Stripe::make('STRIPE_KEY');

        try {

            $charge = $stripe->charges()->create([
                'source' => $token,
                'customer' => $customer_id,
                'currency' => 'USD',
                'amount' => $wallet_amount,
                'description' => 'Add in wallet',
            ]);


            if ($charge['status'] == 'succeeded') {


                $walletusercheck = Walletusers::where('userid', '=', $userid)->first();


                if ($walletusercheck) {

                    $total_amount = $walletusercheck->balance + $wallet_amount;

                    $updatestatus = DB::table('Walletusers')->where('userid', '=', $userid)->update(['balance' => $total_amount]);

                    if ($updatestatus) {

                        $response['error'] = 'false';
                        $response['error_message'] = 'successfully add the money in wallet';
                    } else {

                        $response['error'] = 'false';
                        $response['error_message'] = 'something went wrong';
                    }
                } else {


                    try {


                        $walletuser = new Walletusers();
                        $walletuser->userid = $userid;
                        $walletuser->balance = $wallet_amount;
                        $walletuser->save();
                    } catch (\Illuminate\Database\QueryException $ex) {
                        $response['error'] = 'true';
                        $response['error_message'] = 'Database Exception Error';
                        echo json_encode($response);
                        die;
                    }


                    if ($walletuser) {

                        $response['error'] = 'false';
                        $response['error_message'] = 'successfully add the money in wallet';
                    } else {

                        $response['error'] = 'true';
                        $response['error_message'] = 'something went wrong';
                    }
                }


                $response['error'] = 'true';
                $response['error_message'] = "successfully add money Uberdoo wallet";
            } else {

                $response['error'] = 'true';
                $response['error_message'] = 'Not added in Uberdoo Wallet';
            }
        } catch (Exception $e) {
            $response['error'] = 'true';
            $response['error_message'] = $e->getMessage();
            // return redirect()->route('stripform');
        } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {

            $response['error'] = 'true';
            $response['error_message'] = $e->getMessage();
            // return redirect()->route('stripform');
        } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            $response['error'] = 'true';
            $response['error_message'] = $e->getMessage();
            // return redirect()->route('stripform');
        }


        echo json_encode($response);
    }

    public function wallettransction(Request $request) {

        $username = Auth::guard('api')->user()->firstname;
        $customer_id = Auth::guard('api')->user()->stripe_payment_account;
        $userid = Auth::guard('api')->user()->id;
        $input = $request->all();
        $token = $request->token;
        $booking_id = $request->id;
        $walletkey = $request->walletkey;
        $booking_details = Bookings::where(['id' => $booking_id])->first();

        if ($request->id) {


            $provider_id = $booking_details->provider_id;
            $provider_details = Provider::where('id', $provider_id)->first();

            $providerstripeaccount = Providerstripeaccount::where(['provider_id' => $provider_id])->first();

            $provider_stripe_account = $providerstripeaccount->stripeaccount_number;


            // $amount=$request->amount;
            $provideramount = $booking_details->provider_share;
            $provider_share = round($provideramount);


            if ($walletkey == 1) {
                $walletusercheck = Walletusers::where('userid', '=', $userid)->first();
                $walletamount = $walletusercheck->balance;
                $booking_details = Bookings::where(['id' => $booking_id])->first();
                $bookingamount = $booking_details->total_cost;

                $bookingtotalamount = round($bookingamount);

                $provideramount = $provider_share;
                $adminamount = $bookingtotalamount;


                if ($provideramount >= 0 && $adminamount >= 0) {


                    $adminamount = 1 * 100;
                    $provideramount = 5 * 10;
                } else {

                    $adminamount = $adminamount * 100;
                    $provideramount = $provideramount * 100;
                }


                // $stripe=Stripe::setApiKey("STRIPE_KEY");
                $stripe = Stripe::make('STRIPE_KEY');

                // echo $provider_stripe_account; die;
                if ($walletamount == $adminamount) {

                    $transfer = $stripe->transfers()->create([
                        'amount' => $provideramount,
                        'currency' => 'chf',
                        'destination' => "{$provider_stripe_account}",
                    ]);

                    try {

                        $results = Wallettransaction::where(['userid' => $userid])->update(['transactin_amount' => $adminamount, 'bookingid' => $booking_id]);
                        $res = Walletusers::where('userid', '=', $userid)->update(['balance' => 0]);
                    } catch (\Illuminate\Database\QueryException $ex) {
                        $jsonresp = $ex->getMessage();
                        $response['error'] = 'true';
                        $response['error_message'] = $jsonresp;
                        echo json_encode($response);
                        die;
                    }


                    Bookings::where(['id' => $booking_id, 'provider_id' => $provider_id])->update(['status' => 'Reviewpending', 'provider_owe_status' => 'pending', 'admin_owe_status' => 'completed', 'payment_type' => 'card']);
                    $response['error'] = 'false';
                    $response['error_message'] = 'success';
                                      $serverkey = "AAAAyPflDGI:APA91bHQJeAPU-Er00_He01IIJO1jPJhrwWRWuwLyuWef5vrLQfvfYgm3G82Z4i6EmeLgfIm4e575HbhdFNKpQpzuR79dCX6P58_xL9bW3ce9VCbEUFWpCXEKPAQhuHfkZkOtaY65bnp";

                    $gcpm = new FCMPushNotification($serverkey);
                    $title = "Payment Completed";
                    $message = "$username have paid for your service";
                    $os = $provider_details['os_type'];
                    $data = array('image' => "NULL",
                        'title' => $title, 'notification_type' => 'payment');
                    $gcpm->setDevices($provider_details['fcm_token']);
                    // $gcpm->setDevices("epERrayTJmw:APA91bFNs1QwHNnVZdqId4_GKSqZylK-k6A2VbTSsvpHXoKbOTJCTHNZm13KcbP7247dAiiG16iXZDo6MV4ZO-Bb0-KW            Afy3mkxI1Kj4jQ_UKkTxjVUn3o5XfbXqHZ3ONBdna0GZGteX");
                    $newresponse[] = $gcpm->send($message, $data, $os, $title, $message);

                    $response['error'] = "false";
                    $response['error_message'] = "successfully Finished   wallet payment";
                } else {


                    // $input = array_except($input,array('_token'));


                    try {

                        // $token = $stripe->tokens()->create([
                        //     'card' => [
                        //         'number'    => $request->get('card_no'),
                        //         'exp_month' => $request->get('ccExpiryMonth'),
                        //         'exp_year'  => $request->get('ccExpiryYear'),
                        //         'cvc'       => $request->get('cvvNumber'),
                        //     ],
                        // ]);
                        // if ($token) {
                        //     // \Session::put('error','The Stripe Token was not generated correctly');
                        //     // return redirect()->route('stripform');
                        // }


                        $charge = $stripe->charges()->create([
                            'source' => $token,
                            'customer' => $customer_id,
                            'currency' => 'USD',
                            'amount' => $adminamount,
                            'description' => 'Add in wallet',
                        ]);

                        // echo $charge;
                        // echo "inside";
                        // die;
                        if ($charge['status'] == 'succeeded') {
                            /**
                             * Write Here Your Database insert logic.
                             */
                            $transfer = $stripe->transfers()->create([
                                'amount' => $provideramount,
                                'currency' => 'chf',
                                "source_transaction" => $charge['id'],
                                'destination' => "{$provider_stripe_account}",
                            ]);

                            Bookings::where(['id' => $booking_id, 'provider_id' => $provider_id])->update(['status' => 'Reviewpending', 'provider_owe_status' => 'pending', 'admin_owe_status' => 'completed', 'payment_type' => 'card']);
                            $response['error'] = 'false';
                            $response['error_message'] = 'success';
                            $response['order_details'] = $charge;
                                      $serverkey = "AAAAyPflDGI:APA91bHQJeAPU-Er00_He01IIJO1jPJhrwWRWuwLyuWef5vrLQfvfYgm3G82Z4i6EmeLgfIm4e575HbhdFNKpQpzuR79dCX6P58_xL9bW3ce9VCbEUFWpCXEKPAQhuHfkZkOtaY65bnp";

                            $gcpm = new FCMPushNotification($serverkey);
                            $title = "Payment Completed";
                            $message = "$username have paid for your service";
                            $os = $provider_details['os_type'];
                            $data = array('image' => "NULL",
                                'title' => $title, 'notification_type' => 'payment');
                            $gcpm->setDevices($provider_details['fcm_token']);
                            // $gcpm->setDevices("epERrayTJmw:APA91bFNs1QwHNnVZdqId4_GKSqZylK-k6A2VbTSsvpHXoKbOTJCTHNZm13KcbP7247dAiiG16iXZDo6MV4ZO-Bb0-KW            Afy3mkxI1Kj4jQ_UKkTxjVUn3o5XfbXqHZ3ONBdna0GZGteX");
                            $newresponse[] = $gcpm->send($message, $data, $os, $title, $message);
                            // echo 'payment successfull';
                            // return redirect()->route('stripform');
                        } else {
                            $response['error'] = 'true';
                            $response['error_message'] = 'Money not added';
                        }
                    } catch (Exception $e) {
                        $response['error'] = 'true';

                        $response['error_message'] = $e->getMessage();
                        // return redirect()->route('stripform');
                    } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {

                        $response['error'] = 'true';
                        $response['error_message'] = $e->getMessage();
                        // return redirect()->route('stripform');
                    } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                        $response['error'] = 'true';
                        $response['error_message'] = $e->getMessage();
                        // return redirect()->route('stripform');
                    }
                }
            }
        }


        echo json_encode($response);
    }

    public function sendOtp(Request $request) {
        $type = $request->type;
        $mobile_number = $request->mobile;
        $sendMail = false;

        $otp = $this->otpGenerator();
        if ($type == 'user') {
            $user = Auth::guard('api')->user();
            if ($user) {
                $mobile_number = $user->mobile;
            } else if ($request->email) {
                $sendMail = true;
                $user = User::where('email', $request->email)->first();
            } else if ($request->mobile) {
                $user = User::where('mobile', $mobile_number)->first();
            }
        } else {
            $user = Auth::guard('provider')->user();
            if ($user) {
                $mobile_number = $user->mobile;
            } else if ($request->email) {
                $sendMail = true;
                $user = Provider::where('email', $request->email)->first();
            } else if ($request->mobile) {
                $user = Provider::where('mobile', $mobile_number)->first();
            }
        }

//        Otp::where('mobile', $mobile_number)->update(['active' => 0]);
//
//        $otpObj = new Otp();
//        $otpObj->otp = $otp;
//        $otpObj->mobile = $mobile_number;
//        $otpObj->active = 1;
//        $otpObj->save();

        $user->otp = $otp;
        $user->save();

        if ($sendMail) {
            $email = $request->email;
            $data = [];
            $body = 'Dear ' . $type . ', OTP for accessing your account is ' . $otp . '.';
            $mail = Mail::send('errors.503', $data, function ($message) use ($email, $body) {
                        $message->To($email)->subject('FORGOT PASSWORD')->setBody($body);
                    });
            $sendOtp = true;
        } else {
//        echo '<pre>'; print_r($user);exit;
            $body = 'Dear ' . $type . ', OTP for verify your number is ' . $otp . '.';
            $sendOtp = $this->sendSms($body, '+' . $mobile_number);
        }
        if ($sendOtp) {
            $response['error'] = 'false';
            $response['error_message'] = 'OTP sent successfully';
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'OTP not sent';
        }
        echo json_encode($response);
    }

    public function verifyOtp(Request $request) {
        if (($request->otp && $request->email) || ($request->otp && $request->mobile)) {
            $type = $request->type;
            $otp = $request->otp;
            $email = $request->email;
            $mobile = $request->mobile;
            if ($type == 'user') {
                if ($request->email) {
                    $user_details = User::where('email', $email)->first();
                } else {
                    $user_details = User::where('mobile', $mobile)->first();
                }
            } else if ($type == 'provider') {
                if ($request->email) {
                    $user_details = Provider::where('email', $email)->first();
                } else {
                    $user_details = Provider::where('mobile', $mobile)->first();
                }
            }

            if ($user_details) {
                if ($user_details->otp == $otp) {
                    $user_details->otp = null;
                    $user_details->save();
                    $response['error'] = "false";
                    $response['error_message'] = "Otp verified.";
                } else {
                    $response['error'] = "true";
                    $response['error_message'] = "Invalid Otp.";
                }
            } else {
                $response['error'] = "true";
                $response['error_message'] = "Email/Mobile No is not registered with us.";
            }
        } else {
            $response['error'] = "true";
            $response['error_message'] = "otp or Email is empty";
        }

        echo json_encode($response);
    }

    
    

}
