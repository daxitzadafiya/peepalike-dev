<?php

namespace App\Http\Controllers;

use App\Imageupload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\User;
use App\Admin;
use App\Provider;
use App\UserEvents;
use App\EventTicket;
use App\EventPremium;
use App\Transactions;
use App\PremiumUsers;
use App\EventBenner;
use App\EventUserStatus;
use App\ProviderCategory;
use App\TempUser;
use App\PushNotifications;
use App\TempProvider;
use App\WebResetPassword;
use App\Category;
use App\blogCategory;
use App\Blogs;
use App\BlogTags;
use App\City;
use App\State;
use App\Country;
use App\Userprofileimage;
use App\UserMeetup;
use App\UserJoinEvent;
use App\UserMeetupGroup;
use App\MeetupGroupUsers;
use App\UserMeetupList;
use App\Smslogs;
use App\UserAbuseReport;
use App\Services\EventService;
use Illuminate\Support\Facades\Mail;
use Session;
use Illuminate\Support\Facades\Auth;
use DB;
use Twilio\Rest\Client as TwilioClient;


class EventUserController extends Controller
{
    public function eventUserLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('admin_web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed...
           // dd(Auth::guard('admin_web')->user());
            return redirect()->route('admin.dashboard');
        } else {
            Session::flash('error', 'Incorrect email or password.');
            return redirect()->back();
        }
    }

    public function dashboard()
    {
        $eventList = UserEvents::all();
        $all_user = User::all()->count();
        $male_user = User::where('gender','=','male')->count();
        $female_user = User::where('gender','=','female')->count();
        $premium_users = PremiumUsers::count();
        $users = User::all();
        return view('eventusers.dashboard', compact('eventList','male_user','female_user','premium_users','all_user','users'));
    }

    public function logout()
    {
        Auth::guard('admin_web')->logout();
        return redirect()->back();
    }

    public function changePassword()
    {
        return view('eventusers.changePassword');
    }

    public function postChangePassword(Request $request)
    {

        $user = Admin::find(Auth::guard('admin_web')->user()->id);
        $user->password = bcrypt($request->npassword);
        if ($user->save()) {
            Session::flash('success', 'Password changed successfully.');
        } else {
            Session::flash('error', 'Failed !');
        }
        return response()->json(['error' => false, 'message' => trans('successfully.')]);
    }

    // event module code --------------------------------------------

    public function eventList(Request $request)
    {
        $eventList = UserEvents::all();
        return view('eventusers.eventList', compact('eventList'));
    }

    public function addEvent(Request $request)
    {
        $countries = Country::get();
        $category = DB::table('event_categories')->get()->where('cstatus',0);
        $UserProfile = USer::where('id',0)->first();
        return view('eventusers.addEvent', compact('countries','category','UserProfile'));
    }

    public function insertEvent(request $request)
    {

        $event_name = $request->event_name;
        $vanue_name = $request->vanue_name;
        $trending_event = $request->trending_event;
        $description = $request->description;
        $category = $request->category;
        $event_start_date = $request->event_start_date;
        $event_start_time = $request->event_start_time;
        $event_end_date = $request->event_end_date;
        $event_end_time = $request->event_end_time;
        //$distance = $request->distance;
        $job = $request->event_job;
        $space = $request->space;
        $eventvideo =  $request->eventvideo;
        $distance = 10;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $event_location = $request->event_location;
        $event_type = $request->event_type;
        $address = $request->address;
        $city = $request->city;
        $state = $request->state;
        $postal_code = $request->postal_code;
        $country = $request->country;

        // variables for storing in user table

        $name = $request->name ;
        $phone = $request->mobilenumber ;
        $email = $request->email ;
        $userjob = $request->job ;

        $fbid = $request->fbid ;
        $twitid = $request->twit ;
        $linkedin = $request->linkedin;
        $youtube = $request->youtube;


   //     $UserEventsData = UserEvents::where(['event_name' => $event_name])->first();
        if(empty($UserEventsData)){
            try {
                $image = '';
                if ($request->event_image != "") {
                    $image = time() . '_' . uniqid() . '.' . $request->event_image->getClientOriginalExtension();
                    $request->event_image->move(public_path('images/'), $image);
                    $image = $image;
                }

                $addEvent = new UserEvents();
                $addEvent->user_id = 0;
                $addEvent->event_name = $event_name;
                $addEvent->venue_name = $vanue_name;
                $addEvent->is_trending_event = $trending_event;
                $addEvent->description = $description;
                $addEvent->ecid = $category;

                $addEvent->job = $job;
                $addEvent->space = $space;
                $addEvent->event_video = $eventvideo;

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


                $adduser = User::find(0);
               
                $adduser->first_name  = $name;
                $adduser->job = $userjob;
                $adduser->mobile = $phone;
                $adduser->email = $email;
                $adduser->facebookid = $fbid;
                $adduser->twitterid =$twitid;
                $adduser->linkedinid =$linkedin;
                $adduser->youtubeid =$youtube;
                $adduser->save();


            } catch (Exception $ex) {
                $jsonresp = $ex->getMessage();
                return redirect()->route('admin.eventList')->with('error', $jsonresp);
                die;
            }
            if ($addEvent) {

                return redirect()->route('admin.eventList')->with('success', 'Your Event created successfully');
            } else {

                return redirect()->route('admin.eventList')->with('error', 'Error in Creating.');

            }
        }else{

            return redirect()->route('admin.eventList')->with('error', 'Event name already added');
        }
    }

    public function editEvent($id,Request $request)
    {
        $countries = Country::get();
        $UserEvents = UserEvents::find($id);
        $category = DB::table('event_categories')->get()->where('cstatus',0);
        $UserProfiles = User::get()->where('id',0);

        return view('eventusers.editEvent', compact('countries','UserEvents','category','UserProfiles'));
    }

    public function updateEvent(request $request)
    {
        $id = $request->id;
        $event_name = $request->event_name;
        $venue_name = $request->vanue_name;
        $trending_event = $request->trending_event;
        $description = $request->description;
        $category = $request->category;
        $job = $request->event_job;
        $space = $request->space;
        $eventvideo =  $request->eventvideo;
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

        $name = $request->name ;
        $phone = $request->mobilenumber ;
        $email = $request->email ;
        $userjob = $request->job ;

        $fbid = $request->fbid ;
        $twitid = $request->twit ;
        $linkedin = $request->linkedin;
        $youtube = $request->youtube;



        $eventData = UserEvents::where(['event_name' => $event_name])->where('id','!=', $id)->first();
        if(empty($eventData)){

            $update_event = UserEvents::where('id', $id)
            ->update(['event_name' => $event_name,'venue_name' => $venue_name, 'description' => $description,'job'=>$job,'event_video'=>$eventvideo,'space'=>$space ,'ecid' => $category, 'event_start_date' => $event_start_date, 'event_start_time' => $event_start_time,'event_end_date' => $event_end_date,'event_end_time' => $event_end_time, 'event_location' => $event_location, 'distance' => $distance, 'latitude' => $latitude, 'longitude' => $longitude,'event_type' => $event_type,'address' => $address, 'city' => $city, 'state' => $state, 'postal_code' => $postal_code, 'country' => $country, 'is_trending_event' => $trending_event]);


            $update_profile = User::where('id', Auth::user()->id)->update(['first_name'=>$name,'email'=>$email,'job'=>$userjob,'mobile'=>$phone,'youtubeid'=>$youtube,'linkedinid'=>$linkedin,'twitterid'=>$twitid,'facebookid'=>$fbid]);
            if ($request->image != "") {
                $image = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('images/'), $image);
                $image = $image;

                $update_event1 = UserEvents::where('id', $id)->update(['event_image' => $image]);
            }

            if ($update_event) {
                return redirect()->route('admin.eventList')->with('success', 'Your Event update successfully');
            } else {
                return redirect()->route('admin.eventList')->with('error', 'Error in Creating.');
            }
        }else{
            return redirect()->route('admin.eventList')->with('error', 'Event name already added');
        }
    }

    public function update_event_status(request $request)
    {
        if ($request->id && $request->status) {
            $id = $request->id;

            if ($request->status == 'true') {
                $status = '0';
            } else {
                $status = '1';
            }
            $updatestatus = UserEvents::where('id', $id)->update(['status' => $status]);
            if ($updatestatus) {
                $response['error'] = 'false';
                $response['error_message'] = 'updated';
            } else {
                $response['error'] = 'true';
                $response['error_message'] = 'Not Updated';
            }
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'Mandatory Params are empty';

        }

        echo json_encode($response);
    }

    public function deleteEvent(request $request)
    {
        $id = $request->did;
        $delete_event = DB::table('user_events')->where('id', $id)->delete();
        if ($delete_event) {
            return redirect()->route('admin.eventList')->with('success', 'Your Event delete successfully');
        } else {
            return redirect()->route('admin.eventList')->with('error', 'Error in delete.');
        }
    }

    public function activeEvent(request $request)
    {
        $id = $request->active;
        $update_event = UserEvents::where('id', $id)->update(['status' => '0']);
        if ($update_event) {
            return redirect()->route('admin.eventList')->with('success', 'Your Event status active successfully');
        } else {
            return redirect()->route('admin.eventList')->with('error', 'Error in delete.');
        }
    }

    public function inactiveEvent(request $request)
    {
        $id = $request->deactive;
        $update_event = UserEvents::where('id', $id)->update(['status' => '1']);
        if ($update_event) {
            return redirect()->route('admin.eventList')->with('success', 'Your Event status active successfully');
        } else {
            return redirect()->route('admin.eventList')->with('error', 'Error in delete.');
        }
    }

    public function getStates($country_id){
        $State = State::where(['country_id' => $country_id])->get();
        if(!empty($State)){
            echo json_encode(['status' => 1, 'message' => $State]);
        }else{
            echo json_encode(['status' => 0, 'message' => 'No states found.']);
        }
    }

    public function getCity($state_id){
        $City = City::where(['state_id' => $state_id])->get();
        if(!empty($City)){
            echo json_encode(['status' => 1, 'message' => $City]);
        }else{
            echo json_encode(['status' => 0, 'message' => 'No city found.']);
        }
    }

    // hangout module code --------------------------------------------

    public function hangoutList(Request $request)
    {
        $groupList = UserMeetupGroup::select(DB::raw('user_meetup_group.*,users.first_name,users.last_name,user_address.address_line_1,user_address.latitude,user_address.longitude,user_address.is_favorite'))
        ->leftJoin('user_address', 'user_address.id', '=', 'user_meetup_group.location_id')
        ->leftJoin('users', 'users.id', '=', 'user_meetup_group.user_id')
        ->orderBy('user_meetup_group.id', 'desc')->get();
        return view('eventusers.hangout.hangoutList', compact('groupList'));
    }

    // Ticket list view ------------------------------------

    public function eventTicket($id,Request $request)
    {
        $eventTicketList = EventTicket::where('event_id','=',$id)->get();
        return view('eventusers.ticket.eventTicketList', compact('eventTicketList','id'));
    }

    public function addTicket($id,Request $request)
    {
        $countries = Country::get();
        return view('eventusers.ticket.addTicket', compact('countries','id'));
    }

    public function insertTicket(request $request)
    {

        $event_id = $request->event_id;
        $ticket_name = $request->ticket_name;
        $available_quantity = $request->available_quantity;
        $ticket_price = $request->ticket_price;
        $visibility = $request->visibility;
        $minimum_quantity = $request->minimum_quantity;
        $maximum_quantity = $request->maximum_quantity;
        $description = $request->description;

        $EventTicketData = EventTicket::where(['ticket_name' => $ticket_name])->first();
        if(empty($EventTicketData)){
            try {

                $addEventTicket = new EventTicket();
                $addEventTicket->event_id = $event_id;
                $addEventTicket->ticket_name = $ticket_name;
                $addEventTicket->available_quantity = $available_quantity;
                $addEventTicket->ticket_price = $ticket_price;
                $addEventTicket->description = $description;
                $addEventTicket->visibility = $visibility;
                $addEventTicket->minimum_quantity = $minimum_quantity;
                $addEventTicket->maximum_quantity=$maximum_quantity;
                $addEventTicket->save();

                if ($addEventTicket) {
                    return redirect('eventuser/eventTicket/'.$event_id)->withErrors('Your Event Ticket created successfully');
                } else {
                    return redirect('eventuser/eventTicket/'.$event_id)->withErrors('Error in Creating.');
                }
            } catch (Exception $ex) {
                $jsonresp = $ex->getMessage();
                return redirect('eventuser/eventTicket/'.$event_id)->withErrors($jsonresp);
                die;
            }
        }else{
            return redirect('eventuser/eventTicket/'.$event_id)->withErrors('Ticket name already added');
        }
    }

    public function editTicket($id,Request $request)
    {
        $EventTicket = EventTicket::find($id);
        if(!empty($EventTicket)){
            return view('eventusers.ticket.editTicket', compact('EventTicket','id'));
        }else{
            return Redirect::back()->withInput()->withErrors('Ticket name already added');
        }
    }

    public function updateTicket(request $request)
    {
        $id = $request->ticket_id;
        $event_id = $request->event_id;
        $ticket_name = $request->ticket_name;
        $available_quantity = $request->available_quantity;
        $ticket_price = $request->ticket_price;
        $visibility = $request->visibility;
        $minimum_quantity = $request->minimum_quantity;
        $maximum_quantity = $request->maximum_quantity;
        $description = $request->description;

        $EventTicketData = EventTicket::where(['ticket_name' => $ticket_name])->where('id','!=', $id)->first();
        if(empty($EventTicketData)){
            try {

                $update_ticket = EventTicket::where('id', $id)
                ->update(['ticket_name' => $ticket_name, 'available_quantity' => $available_quantity, 'ticket_price' => $ticket_price, 'description' => $description,'visibility' => $visibility,'minimum_quantity' => $minimum_quantity, 'maximum_quantity' => $maximum_quantity]);
                if ($update_ticket) {
                    return redirect('eventuser/eventTicket/'.$event_id)->withErrors('Your Event Ticket update successfully');
                } else {
                    return redirect('eventuser/eventTicket/'.$event_id)->withErrors('Error in Creating.');
                }
            } catch (Exception $ex) {
                $jsonresp = $ex->getMessage();
                return redirect('eventuser/eventTicket/'.$event_id)->withErrors($jsonresp);
                die;
            }

        }else{
            return redirect('eventuser/eventTicket/'.$event_id)->withErrors('Ticket name already added');
        }

    }

    public function deleteTicket(request $request)
    {
        $id = $request->did;
        $delete_event = DB::table('event_ticket')->where('id', $id)->delete();
        if ($delete_event) {
            return Redirect::back()->withInput()->withErrors('Your Ticket delete successfully');
        } else {
            return redirect()->route('admin.eventList');
        }
    }

    public function activeTicket(request $request)
    {
        $id = $request->active;
        $update_event = EventTicket::where('id', $id)->update(['visibility' => 'visible']);
        if ($update_event) {
            return Redirect::back()->withInput()->withErrors('Your Ticket status active successfully');
        } else {
            return Redirect::back()->withInput()->withErrors('Error in update.');
        }
    }

    public function inactiveTicket(request $request)
    {
        $id = $request->deactive;
        $update_event = EventTicket::where('id', $id)->update(['visibility' => 'hidden']);
        if ($update_event) {
            return Redirect::back()->withInput()->withErrors('Your Ticket status inactive successfully');
        } else {
            return Redirect::back()->withInput()->withErrors('Error in update.');
        }
    }

    // Benner list view ------------------------------------

    public function eventBenner($id,Request $request)
    {
        $eventBennerList = EventBenner::where('event_id','=',$id)->get();
        return view('eventusers.benner.eventBennerList', compact('eventBennerList','id'));
    }

    public function addBenner($id,Request $request)
    {
        $countries = Country::get();
        $eventBennerList = EventBenner::where('event_id','=',$id)->get();
        return view('eventusers.benner.addBenner', compact('eventBennerList','countries','id'));
    }

    public function insertBenner(request $request)
    {

        $event_id = $request->event_id;
        try {
            $image = '';
            $img_type = '0';
            if ($request->banner_image != "") {
                $image = time() . '_' . uniqid() . '.' . $request->banner_image->getClientOriginalExtension();
                $request->banner_image->move(public_path('images/'), $image);
                $image = $image;
                if($request->banner_image->getClientOriginalExtension() == 'mp4'){
                    $img_type = '1';
                }else{
                    $img_type = '0';
                }
            }
            $addEventBenner = new EventBenner();
            $addEventBenner->event_id = $event_id;
            $addEventBenner->banner_image = $image;
            $addEventBenner->img_type = $img_type;
            $addEventBenner->save();
            if ($addEventBenner) {
                return redirect('eventuser/eventBenner/'.$event_id)->withErrors('Your Event Benner created successfully');
            } else {
                return redirect('eventuser/eventBenner/'.$event_id)->withErrors('Error in Creating.');
            }
        } catch (Exception $ex) {
            $jsonresp = $ex->getMessage();
            return redirect('eventuser/eventBenner/'.$event_id)->withErrors($jsonresp);
            die;
        }
    }

    public function editBenner($id,Request $request)
    {
        $EventBenner = EventBenner::find($id);
        if(!empty($EventBenner)){
            return view('eventusers.benner.editBenner', compact('EventBenner','id'));
        }else{
            return Redirect::back()->withInput()->withErrors('no data found');
        }
    }

    public function updateBenner(request $request)
    {
        $id = $request->id;
        $event_id = $request->event_id;
        try {

            if ($request->banner_image != "") {
                $image = time() . '_' . uniqid() . '.' . $request->banner_image->getClientOriginalExtension();
                $request->banner_image->move(public_path('images/'), $image);
                $image = $image;

                if($request->banner_image->getClientOriginalExtension() == 'mp4'){
                    $img_type = '1';
                }else{
                    $img_type = '0';
                }

                $update_event1 = EventBenner::where('id', $id)->update(['banner_image' => $image,'img_type' => $img_type]);
            }

            return redirect('eventuser/eventBenner/'.$event_id)->withErrors('Your Event banner update successfully');
        } catch (Exception $ex) {
            $jsonresp = $ex->getMessage();
            return redirect('eventuser/eventBenner/'.$event_id)->withErrors($jsonresp);
            die;
        }
    }

    public function deleteBenner(request $request)
    {
        $id = $request->did;
        $delete_event = DB::table('event_benner')->where('id', $id)->delete();
        if ($delete_event) {
            return Redirect::back()->withInput()->withErrors('Your benner delete successfully');
        } else {
            return redirect()->route('admin.eventList');
        }
    }

    // user list view ------------------------------------

    public function usersList(Request $request)
    {
        $userList = User::all();
        return view('eventusers.user.userList', compact('userList'));
    }

    public function usersProfileList($id,Request $request)
    {
        $userprofileimageList = Userprofileimage::where('user_id','=',$id)->get();
        return view('eventusers.user.usersProfileList', compact('userprofileimageList','id'));
    }

    public function editUser($id,Request $request)
    {
        $userDetail = User::find($id);
        if(!empty($userDetail)){
            return view('eventusers.user.userEdit', compact('userDetail','id'));
        }else{
            return Redirect::back()->withInput()->withErrors('no data found');
        }
    }

    public function updateUser(request $request)
    {
        $id = $request->id;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $email = $request->email;
        $mobile = $request->mobile;
        $age = $request->age;
        $UserEmailData = User::where(['email' => $email])->where('id','!=', $id)->first();
        if(empty($UserEmailData)){
            $UserPhoneData = User::where(['mobile' => $mobile])->where('id','!=', $id)->first();
            if(empty($UserPhoneData)){
                try {

                    $update_user = User::where('id', $id)
                    ->update(['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'mobile' => $mobile,'age' => $age]);

                    if ($request->event_image != "") {
                        $image = time() . '_' . uniqid() . '.' . $request->event_image->getClientOriginalExtension();
                        $request->event_image->move(public_path('images/'), $image);
                        $image = $image;

                        $update_users = User::where('id', $id)->update(['image' => $image]);
                    }
                    if ($update_user) {
                        return Redirect::back()->withInput()->withErrors('User update successfully');
                    } else {
                        return Redirect::back()->withInput()->withErrors('Error in Creating.');
                    }
                } catch (Exception $ex) {
                    $jsonresp = $ex->getMessage();
                    return Redirect::back()->withInput()->withErrors($jsonresp);
                    die;
                }
            }else{
                return Redirect::back()->withInput()->withErrors('Phone number already added');
            }

        }else{
            return Redirect::back()->withInput()->withErrors('Email already added');
        }

    }

    public function deleteUser(request $request)
    {
        $id = $request->did;
        $delete_event = DB::table('users')->where('id', $id)->delete();
        if ($delete_event) {
            return Redirect::back()->withInput()->withErrors('Your User delete successfully');
        } else {
            return Redirect::back()->withInput()->withErrors('Error in delete.');
        }
    }

    public function deleteUserProfile(request $request)
    {
        $id = $request->did;
        $delete_event = DB::table('user_profile_image')->where('id', $id)->delete();
        if ($delete_event) {
            return Redirect::back()->withInput()->withErrors('Your User image successfully');
        } else {
            return Redirect::back()->withInput()->withErrors('Error in delete.');
        }
    }

    public function activeUser(request $request)
    {
        $id = $request->active;
        $update_event = User::where('id', $id)->update(['status' => 'active']);
        if ($update_event) {
            return Redirect::back()->withInput()->withErrors('Your User status active successfully');
        } else {
            return Redirect::back()->withInput()->withErrors('Error in update.');
        }
    }

    public function inactiveUser(request $request)
    {
        $id = $request->deactive;
        $update_event = User::where('id', $id)->update(['status' => 'inactive']);
        if ($update_event) {
            return Redirect::back()->withInput()->withErrors('Your User status inactive successfully');
        } else {
            return Redirect::back()->withInput()->withErrors('Error in update.');
        }
    }

    // premium list view ------------------------------------

    public function premiumList(Request $request)
    {
        $EventPremiumList = EventPremium::all();
        return view('eventusers.premium.premiumList', compact('EventPremiumList'));
    }

    public function addPremium(Request $request)
    {
        return view('eventusers.premium.addPremium');
    }

    public function insertPremium(request $request)
    {

        $plan_name = $request->plan_name;
        $price = $request->price;
        $description = $request->description;
        $duration = $request->duration;

        $EventPremiumData = EventPremium::where(['plan_name' => $plan_name])->first();
        if(empty($EventPremiumData)){
            try {

                $addEventPremium = new EventPremium();
                $addEventPremium->plan_name = $plan_name;
                $addEventPremium->description = $description;
                $addEventPremium->duration = $duration;
                $addEventPremium->price = $price;
                $addEventPremium->save();

            } catch (Exception $ex) {
                $jsonresp = $ex->getMessage();
                return redirect()->route('admin.premiumList')->with('error', $jsonresp);
                die;
            }
            if ($addEventPremium) {

                return redirect()->route('admin.premiumList')->with('success', 'Your Premium created successfully');
            } else {

                return redirect()->route('admin.premiumList')->with('error', 'Error in Creating.');

            }
        }else{

            return redirect()->route('admin.premiumList')->with('error', 'Premium name already added');
        }
    }

    public function editPremium($id,Request $request)
    {
        $EventPremium = EventPremium::find($id);
        return view('eventusers.premium.editPremium', compact('EventPremium'));
    }

    public function updatePremium(request $request)
    {
        $id = $request->plan_id;
        $plan_name = $request->plan_name;
        $price = $request->price;
        $description = $request->description;
        $duration = $request->duration;

        $EventPremiumData = EventPremium::where(['plan_name' => $plan_name])->where('id','!=', $id)->first();
        if(empty($EventPremiumData)){

            $update_premium = EventPremium::where('id', $id)
            ->update(['plan_name' => $plan_name,'description' => $description, 'duration' => $duration, 'price' => $price]);

            if ($update_premium) {
                return redirect()->route('admin.premiumList')->with('success', 'Your Premium update successfully');
            } else {
                return redirect()->route('admin.premiumList')->with('error', 'Error in Creating.');
            }
        }else{
            return redirect()->route('admin.premiumList')->with('error', 'Premium name already added');
        }
    }

    public function deletePremium(request $request)
    {
        $id = $request->did;
        $delete_event = DB::table('event_premium')->where('id', $id)->delete();
        if ($delete_event) {
            return redirect()->route('admin.premiumList')->with('success', 'Your Premium delete successfully');
        } else {
            return redirect()->route('admin.premiumList')->with('error', 'Error in delete.');
        }
    }

    public function activePremium(request $request)
    {
        $id = $request->active;
        $update_event = EventPremium::where('id', $id)->update(['status' => '0']);
        if ($update_event) {
            return redirect()->route('admin.premiumList')->with('success', 'Your Premium status active successfully');
        } else {
            return redirect()->route('admin.premiumList')->with('error', 'Error in delete.');
        }
    }

    public function inactivePremium(request $request)
    {
        $id = $request->deactive;
        $update_event = EventPremium::where('id', $id)->update(['status' => '1']);
        if ($update_event) {
            return redirect()->route('admin.premiumList')->with('success', 'Your Premium status active successfully');
        } else {
            return redirect()->route('admin.premiumList')->with('error', 'Error in delete.');
        }
    }


    // Transaction list view ------------------------------------

    public function transactionsList(Request $request)
    {
        $TransactionsList = Transactions::all();
        return view('eventusers.transactions.transactionsList', compact('TransactionsList'));
    }


    // Premium Users list view ------------------------------------

    public function premiumUsersList(Request $request)
    {
        $PremiumUsersList = PremiumUsers::all();
        return view('eventusers.premiumUsers.premiumUsersList', compact('PremiumUsersList'));
    }

    // Status list view ------------------------------------

    public function userStatusList(Request $request)
    {
        $EventUserStatusList = EventUserStatus::all();
        return view('eventusers.userStatus.userStatusList', compact('EventUserStatusList'));
    }

    public function insertUserStatus(request $request)
    {

        $user_status = $request->user_status;

        $EventUserStatusData = EventUserStatus::where(['status_name' => $user_status])->first();
        if(empty($EventUserStatusData)){
            try {

                $addEventUserStatus = new EventUserStatus();
                $addEventUserStatus->status_name = $user_status;
                $addEventUserStatus->save();

            } catch (Exception $ex) {
                $jsonresp = $ex->getMessage();
                return redirect()->route('admin.userStatusList')->with('error', $jsonresp);
                die;
            }
            if ($addEventUserStatus) {

                return redirect()->route('admin.userStatusList')->with('success', 'Your Status created successfully');
            } else {

                return redirect()->route('admin.userStatusList')->with('error', 'Error in Creating.');

            }
        }else{

            return redirect()->route('admin.userStatusList')->with('error', 'Status name already added');
        }
    }

    public function editUserStatus(Request $request)
    {
        $EventUserStatus = EventUserStatus::find($request->id);
        echo json_encode($EventUserStatus);
    }

    public function updateUserStatus(request $request)
    {
        $id = $request->eid;
        $user_status = $request->euser_status;

        $EventUserStatusData = EventUserStatus::where(['status_name' => $user_status])->where('id','!=', $id)->first();
        if(empty($EventUserStatusData)){

            $update_status = EventUserStatus::where('id', $id)
            ->update(['status_name' => $user_status]);

            if ($update_status) {
                return redirect()->route('admin.userStatusList')->with('success', 'Your Status update successfully');
            } else {
                return redirect()->route('admin.userStatusList')->with('error', 'Error in Creating.');
            }
        }else{
            return redirect()->route('admin.userStatusList')->with('error', 'Status name already added');
        }
    }

    public function deleteUserStatus(request $request)
    {
        $id = $request->did;
        $delete_event = DB::table('event_user_status')->where('id', $id)->delete();
        if ($delete_event) {
            return redirect()->route('admin.userStatusList')->with('success', 'Your Status delete successfully');
        } else {
            return redirect()->route('admin.userStatusList')->with('error', 'Error in delete.');
        }
    }

    // category list view ------------------------------------

    public function categoryList(Request $request)
    {
        $CategoryList = Category::all();
        return view('eventusers.category.categoryList', compact('CategoryList'));
    }

    public function insertCategory(request $request)
    {

        $category_name = $request->category_name;
        $icon = $request->icon;
        $category_type = $request->category_type;
        $short_description = $request->short_description;
        $long_description = $request->long_description;
        $CategoryData = Category::where(['category_name' => $category_name])->first();
        if(empty($CategoryData)){
            try {

                $image = '';
                if ($request->icon != "") {
                    $image = time() . '_' . uniqid() . '.' . $request->icon->getClientOriginalExtension();
                    $request->icon->move(public_path('category/'), $image);
                    $image =  url('/').'/category/'.$image;
                }

                $addcategory = new Category();
                $addcategory->category_name = $category_name;
                $addcategory->icon = $image;
                $addcategory->type = $category_type;
                $addcategory->short_description = $short_description;
                $addcategory->long_description = $long_description;
                $addcategory->save();
                if ($addcategory) {
                    return redirect()->route('admin.categoryList')->with('success', 'Your Category created successfully');
                } else {
                    return redirect()->route('admin.categoryList')->with('error', 'Error in Creating.');
                }
            } catch (Exception $ex) {
                $jsonresp = $ex->getMessage();

                return redirect()->route('admin.categoryList')->with('error', $jsonresp);
                die;
            }

        }else{

            return redirect()->route('admin.categoryList')->with('error', 'Category name already added');
        }
    }

    public function editCategory(Request $request)
    {
        $Category = Category::find($request->id);
        echo json_encode($Category);
    }

    public function updateCategory(request $request)
    {
        $id = $request->eid;
        $category_name = $request->ecategory_name;
        $category_type = $request->ecategory_type;
        $short_description = $request->eshort_description;
        $long_description = $request->elong_description;

        $CategoryData = Category::where(['category_name' => $category_name])->where('id','!=', $id)->first();
        if(empty($CategoryData)){

            $updatecategory = Category::where('id', $id)->update(['category_name' => $category_name, 'type' => $category_type, 'short_description' => $short_description, 'long_description' => $long_description]);

            if ($request->eicon != "") {
                $image = time() . '_' . uniqid() . '.' . $request->eicon->getClientOriginalExtension();
                $request->eicon->move(public_path('category/'), $image);
                $image = url('/').'/category/'.$image;

                $update_category = Category::where('id', $id)->update(['icon' => $image]);
            }

            if ($updatecategory) {
                return redirect()->route('admin.categoryList')->with('success', 'Category update successfully');
            } else {
                return redirect()->route('admin.categoryList')->with('error', 'Error in Creating.');
            }
        }else{
            return redirect()->route('admin.categoryList')->with('error', 'Category name already added');
        }
    }

    public function deleteCategory(request $request)
    {
        $id = $request->did;
        $delete_event = DB::table('service_category')->where('id', $id)->delete();
        if ($delete_event) {
            return redirect()->route('admin.categoryList')->with('success', 'Category delete successfully');
        } else {
            return redirect()->route('admin.categoryList')->with('error', 'Error in delete.');
        }
    }


    //Blog Information -----------------------------
    public function blogList(Request $request)
    {
        $BlogList = Blogs::all();
        $Category = blogCategory::where('is_active','active')->get();
        $Tags = BlogTags::where('status','active')->get();
        return view('eventusers.blog.blogs', compact('BlogList','Category','Tags'));
    }

    public function addBlog(request $request){
        return view('eventusers.blog.addNewBlog');
    }

    public function insertBlog(request $request)
    {
        $title = $request->title;
        $BlogData = Blogs::where(['blog_title' => $title])->first();
        if(empty($BlogData)){
            try {
                $image = '';
                if ($request->image != "") {
                    $image = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
                    $request->image->move(public_path('blog/'), $image);
                    $image =  url('/').'/blog/'.$image;
                }

                $values = array(
                    "blog_title" => $request->title,
                    "blog_content" => $request->content,
                    "category_type" => $request->category,
                    "blog_tags" => $request->tags,
                    "blog_author" => $request->author,
                    "meta_tag" => $request->meta_tag,
                    "meta_description" => $request->meta_des,
                    "status" => $request->status,
                    "blog_image" => $image
                );
                DB::table('blogs')->insert($values);
                if ($values) {
                    return redirect()->route('admin.blogList')->with('success', 'Your Blog created successfully');
                } else {
                    return redirect()->route('admin.blogList')->with('error', 'Error in Creating.');
                }
            } catch (Exception $ex) {
                $jsonresp = $ex->getMessage();

                return redirect()->route('admin.blogList')->with('error', $jsonresp);
                die;
            }
        }else{
            return redirect()->route('admin.blogList')->with('error', 'Blog name already added');
        }
    }

    public function editBlog(Request $request)
    {
        $blogs = Blogs::where('id',$request->id)->first();
        return response()->json($blogs, 200);
    }

    public function updateBlog(request $request)
    {
        $id = $request->eid;
        $title = $request->etitle;
        $blogData = Blogs::where('id','!=', $id)->first();
        if(!empty($blogData)){
            $updateblog = Blogs::where('id', $id)->update([
                "blog_title" => $request->etitle,
                "blog_content" => $request->econtent,
                "category_type" => $request->ecategory,
                "blog_tags" => $request->etags,
                "blog_author" => $request->eauthor,
                "meta_tag" => $request->emeta_tag,
                "meta_description" => $request->emeta_des,
                "status" => $request->estatus
            ]);
            if ($request->eimage != "") {
                $image = time() . '_' . uniqid() . '.' . $request->eimage->getClientOriginalExtension();
                $request->eimage->move(public_path('blog/'), $image);
                $image = url('/').'/blog/'.$image;

                $update_category = Blogs::where('id', $id)->update(['blog_image' => $image]);
            }
            if ($updateblog) {
                return redirect()->route('admin.blogList')->with('success', 'Blog update successfully');
            } else {
                return redirect()->route('admin.blogList')->with('error', 'Error in Creating.');
            }
        }else{
            return redirect()->route('admin.blogList')->with('error', 'Blog name already added');
        }
    }

    public function deleteBlog(request $request)
    {
        $id = $request->did;
        $delete_event = Blogs::where('id', $id)->delete();
        if ($delete_event) {
            return redirect()->route('admin.blogList')->with('success', 'Blog delete successfully');
        } else {
            return redirect()->route('admin.blogList')->with('error', 'Error in delete.');
        }
    }

// Event Category Information-----------------------Events---------------------------









    //Blog category Information -----------------------------
    public function blogCategoryList(Request $request)
    {
        $BlogCategoryList = blogCategory::all();
        return view('eventusers.blog.blogCategoryList', compact('BlogCategoryList'));
    }

    public function insertBlogCategory(request $request)
    {

        $category_name = $request->category_name;
        $is_active = $request->status;
        $CategoryData = blogCategory::where(['category_name' => $category_name])->first();
        if(empty($CategoryData)){
            try {

                $values = array('category_name' => $category_name,
                    "is_active" => $is_active
                );
                DB::table('blog_categories')->insert($values);

                if ($values) {
                    return redirect()->route('admin.blogCategoryList')->with('success', 'Your Category created successfully');
                } else {
                    return redirect()->route('admin.blogCategoryList')->with('error', 'Error in Creating.');
                }
            } catch (Exception $ex) {
                $jsonresp = $ex->getMessage();

                return redirect()->route('admin.blogCategoryList')->with('error', $jsonresp);
                die;
            }
        }else{
            return redirect()->route('admin.blogCategoryList')->with('error', 'Category name already added');
        }
    }

    public function editBlogCategory(Request $request)
    {
        $Category = blogCategory::where('id',$request->id)->first();
        return response()->json($Category, 200);
    }

    public function updateBlogCategory(request $request)
    {
        $id = $request->eid;
        $category_name = $request->ecategory_name;
        $is_active = $request->estatus;
        $CategoryData = blogCategory::where(['category_name' => $category_name])->where('id','!=', $id)->first();
        if(empty($CategoryData)){
            $updatecategory = blogCategory::where('id', $id)->update(['category_name' => $category_name, 'is_active' => $is_active]);
            if ($updatecategory) {
                return redirect()->route('admin.blogCategoryList')->with('success', 'Category update successfully');
            } else {
                return redirect()->route('admin.blogCategoryList')->with('error', 'Error in Creating.');
            }
        }else{
            return redirect()->route('admin.blogCategoryList')->with('error', 'Category name already added');
        }
    }

    public function deleteBlogCategory(request $request)
    {
        $id = $request->did;
        $delete_event = blogCategory::where('id', $id)->delete();
        if ($delete_event) {
            return redirect()->route('admin.blogCategoryList')->with('success', 'Category delete successfully');
        } else {
            return redirect()->route('admin.blogCategoryList')->with('error', 'Error in delete.');
        }
    }

    //Blog tag Information -----------------------------
    public function blogTagList(Request $request)
    {
        $BlogTagsList = BlogTags::all();
        return view('eventusers.blog.blogTagList', compact('BlogTagsList'));
    }

    public function insertBlogTag(request $request)
    {

        $tag_name = $request->tag_name;
        $status = $request->status;
        $tagData = BlogTags::where(['tag_name' => $tag_name])->first();
        if(empty($tagData)){
            try {
                $values = array('tag_name' => $tag_name,
                    "status" => $status
                );
                DB::table('blog_tags')->insert($values);

                if ($values) {
                    return redirect()->route('admin.blogTagList')->with('success', 'Your Tag created successfully');
                } else {
                    return redirect()->route('admin.blogTagList')->with('error', 'Error in Creating.');
                }
            } catch (Exception $ex) {
                $jsonresp = $ex->getMessage();

                return redirect()->route('admin.blogTagList')->with('error', $jsonresp);
                die;
            }
        }else{
            return redirect()->route('admin.blogTagList')->with('error', 'Tag name already added');
        }
    }

    public function editBlogTag(Request $request)
    {
        $Tags = BlogTags::where('id',$request->id)->first();
        return response()->json($Tags, 200);
    }

    public function updateBlogTag(request $request)
    {
        $id = $request->eid;
        $tag_name = $request->etag_name;
        $status = $request->estatus;
        $tagData = BlogTags::where(['tag_name' => $tag_name])->where('id','!=', $id)->first();
        if(empty($tagData)){
            $updatetag = BlogTags::where('id', $id)->update(['tag_name' => $tag_name, 'status' => $status]);
            if ($updatetag) {
                return redirect()->route('admin.blogTagList')->with('success', 'Tag update successfully');
            } else {
                return redirect()->route('admin.blogTagList')->with('error', 'Error in Creating.');
            }
        }else{
            return redirect()->route('admin.blogTagList')->with('error', 'Tag name already added');
        }
    }

    public function deleteBlogTag(request $request)
    {
        $id = $request->did;
        $delete_event = BlogTags::where('id', $id)->delete();
        if ($delete_event) {
            return redirect()->route('admin.blogTagList')->with('success', 'Tag delete successfully');
        } else {
            return redirect()->route('admin.blogTagList')->with('error', 'Error in delete.');
        }
    }
    // pushNotifications list view ------------------------------------

    public function pushNotificationsList(Request $request)
    {
        $PushNotificationsList = PushNotifications::select(DB::raw('notification_history.*,users.first_name,users.last_name'))->leftJoin('users', 'users.id', '=', 'notification_history.user_id')->get();
        return view('eventusers.pushNotification', compact('PushNotificationsList'));
    }

    public function sendPushNotifications(Request $request)
    {

        $message = $request->message;
        $notification_type = $request->notification_type;

        $users = User::where('status', 'active')->get();
        if (count($users) > 0) {
            foreach ($users as $user) {
                $userId = $user->id;

                if ($notification_type == 'sms') { // send sms to all active user
                    $phone = $user->mobile;
                    if ($phone != '' || $phone != null) {
                        try {
                            //$getSettings = Settings::find(1);
                            $sid = '';
                            $token = '';
                            $callfrom = '';
                            $client = new TwilioClient($sid, $token);

                            $messagesms = $client->messages
                                ->create('+' . $phone, // to
                                    array(
                                        "body" => $message,
                                        "from" => $callfrom,
                                        // "statusCallback" => url('api/getSmsResponse')
                                    )
                                );

                            //User Notification History
                            $PushNotifications = PushNotifications::create([
                                'user_id' => $user->id,
                                'type' => 'sms',
                                'message' => $message,
                                'SmsSid' => $messagesms->sid,
                                'notificationStatus' => 'sent',
                                'isread' => '0',

                            ]);
                            //User Notification History ends

                        } catch (\Throwable $th) {

                            //return response()->json(['error' => true, 'message'  => trans('Number is not valid')]);

                        }

                    }

                } elseif ($notification_type == 'email') { // send email to all active user

                    try {
                        $data = new stdClass();
                        $data->user_name = $user->first_name . ' ' . $user->last_name;
                        $data->message = $message;

                        // Send the activation code through email
                        Mail::to($user->email)->send(new Notifications($data));

                        //User Notification History
                        $PushNotifications = PushNotifications::create([
                            'user_id' => $user->id,
                            'type' => 'email',
                            'message' => $message,
                            'SmsSid' => '',
                            'notificationStatus' => 'sent',
                            'isread' => '0',

                        ]);
                        //User Notification History ends
                     } catch (\Throwable $th) {

                    //         //return response()->json(['error' => true, 'message'  => trans('Number is not valid')]);

                     }

                } elseif ($notification_type == 'notification') { // send push notification to all active user
                    try {
                        $deviceToken = $user->device_token;

                        if ($deviceToken != '') {
                            $main_title = 'Admin notification';
                            $body = $message;
                            $otherData = array('type'=>'Notification');
                            $t = $this->sendPushNotification([$deviceToken],$main_title,$body,$otherData,'Peepalike');

                            //User Notification History
                            $PushNotifications = PushNotifications::create([
                                'user_id' => $user->id,
                                'type' => 'notification',
                                'message' => $message,
                                'SmsSid' => '',
                                'notificationStatus' => 'sent',
                                'isread' => '0',

                            ]);

                        }
                    } catch (\Throwable $th) {
                        //dd($th);
                            //return response()->json(['error' => true, 'message'  => trans('Number is not valid')]);

                    }
                }
               // dd($user);
            }
        }
        return redirect()->route('admin.pushNotificationsList')->with('success', 'Your Status created successfully');

    }

    public function getChatUserList(Request $request){

        $chat_user = $request->chat_user;
        $chat_type = $request->chat_type;
        if($chat_type == 'user'){
            $chatUserList = UserMeetupList::select(DB::raw('user_meetup_list.*,users.first_name,users.last_name,users.image'))
            ->leftJoin('users', 'users.id', '=', 'user_meetup_list.user_id')
            ->where('user_meetup_list.meetup_user_id','=',$chat_user)
            ->where('user_meetup_list.is_approve','=','Accepted')->orderBy('user_meetup_list.updated_at', 'desc')->get();
        }elseif ($chat_type == 'event') {
            $chatUserList = DB::select(DB::raw("SELECT user_join_event.*,user_events.event_name,user_events.vanue_name,user_events.event_start_date,user_events.event_start_time,user_events.event_end_date,user_events.event_end_time,user_events.event_image,user_events.event_location,user_events.latitude,user_events.longitude,user_events.distance,user_events.description,user_events.event_rating,user_events.event_type,user_events.status,user_events.is_trending_event,user_events.address FROM `user_join_event` LEFT JOIN user_events ON user_events.id = user_join_event.event_id WHERE user_join_event.`user_id`= '$chat_user' AND user_events.status = '0' ORDER by user_events.updated_at desc"));
        }else{
            $chatUserList = MeetupGroupUsers::select(DB::raw('meetup_group_users.*,user_meetup_group.*'))->leftJoin('user_meetup_group', 'user_meetup_group.id', '=', 'meetup_group_users.user_meetup_group_id')->where('meetup_group_users.meetup_user_id','=',$chat_user)->where('meetup_group_users.is_approve','=','Accepted')->orderBy('meetup_group_users.updated_at', 'desc')->where(DB::raw('DATE(user_meetup_group.expired_date_time)'),'>=',date('Y-m-d'))->get();
        }
        //dd($chatUserList);
        echo json_encode($chatUserList);
    }

    public function getUserChat(Request $request, EventService $EventService){
        $chat_user = $request->chat_user;
        $chat_type = $request->chat_type;
        $chat_chater = $request->chat_chater;

        if($chat_type == 'user'){
            $channel_id = 'user_'.$chat_chater;
            $Smslogsdetails = Smslogs::where('channel_id','=',$channel_id)->get();
        }elseif ($chat_type == 'event') {
            $channel_id = 'event_'.$chat_chater;
            $Smslogsdetails = Smslogs::where('channel_id','=',$channel_id)->get();
        }else{
            $channel_id = 'group_'.$chat_chater;
            $Smslogsdetails = Smslogs::where('channel_id','=',$channel_id)->get();
        }
        if(!empty($Smslogsdetails)){
            foreach ($Smslogsdetails as $key => $value) {
                $userdetails = User::where('id', $value->sender_id)->first();
                if(!empty($userdetails)){
                    if($userdetails->image != ''){
                       $Smslogsdetails[$key]->sender_image= url('/').'/images/'.$userdetails->image;
                    }else{
                        $Smslogsdetails[$key]->sender_image= '';
                    }
                }else{
                    $Smslogsdetails[$key]->sender_image= '';
                }
                $receiveruserdetails = User::where('id', $value->receiver_id)->first();
                if(!empty($receiveruserdetails)){
                    if($receiveruserdetails->image != ''){
                       $Smslogsdetails[$key]->receiver_image= url('/').'/images/'.$receiveruserdetails->image;
                    }else{
                        $Smslogsdetails[$key]->receiver_image= '';
                    }
                }else{
                    $Smslogsdetails[$key]->receiver_image= '';
                }

            }
        }


        $view = \View::make('eventusers.chatViewRender',compact('Smslogsdetails','chat_user','chat_type','chat_chater'));
        $html = $view->render();
        return response()->json(['error' => false, 'html' => $html]);
    }

    // users locations view ------------------------------------

    public function usersLocations(Request $request)
    {
        $users = User::all();
        return view('eventusers.usersLocation', compact('users'));
    }

    public function chatView(){
        $users = User::get();
        return view('eventusers.chat', get_defined_vars());
    }

    public function userReport(Request $request){

        $UserAbuseReportList = UserAbuseReport::select(DB::raw('user_abuse_report.*,users.first_name,users.last_name'))
        ->leftJoin('users', 'users.id', '=', 'user_abuse_report.created_by')->get();
        return view('eventusers.user-report', compact('UserAbuseReportList'));
    }

    public function adminTransactions(){
        return view('eventusers.transactions.adminTransactions');
    }

    public function staticPages(){
        return view('eventusers.staticPages');
    }

    public function customPush(){
        return view('eventusers.customPush');
    }





 public function eventCategoryList(Request $request)
    {
        $EventCategoryList =  DB::table('event_categories')->get();
        return view('eventusers.event.eventCategoryList', compact('EventCategoryList'));
    }

    public function insertEventCategory(request $request)
    {

        $category_name = $request->category_name;
        $is_active = $request->status;
        $CategoryData = DB::table('event_categories')->where(['cname' => $category_name])->first();
        if(empty($CategoryData)){
            try {

                $values = array('cname' => $category_name,
                    "cstatus" => $is_active
                );
                DB::table('event_categories')->insert($values);

                if ($values) {
                    return redirect()->route('admin.eventCategoryList')->with('success', 'Your Category created successfully');
                } else {
                    return redirect()->route('admin.eventCategoryList')->with('error', 'Error in Creating.');
                }
            } catch (Exception $ex) {
                $jsonresp = $ex->getMessage();

                return redirect()->route('admin.eventCategoryList')->with('error', $jsonresp);
                die;
            }
        }else{
            return redirect()->route('admin.eventCategoryList')->with('error', 'Category name already added');
        }
    }

    public function editEventCategory(Request $request)
    {
        $Category = DB::table('event_categories')->where('ecid',$request->id)->first();
        return response()->json($Category, 200);
    }

    public function updateEventCategory(request $request)
    {
        $id = $request->eid;
        $category_name = $request->ecategory_name;
        $is_active = $request->estatus;
        $CategoryData = DB::table('event_categories')->where(['cname' => $category_name])->where('ecid','!=', $id)->first();
        if(empty($CategoryData)){
            $updatecategory = DB::table('event_categories')->where('ecid', $id)->update(['cname' => $category_name, 'cstatus' => $is_active]);
            if ($updatecategory) {
                return redirect()->route('admin.eventCategoryList')->with('success', 'Category update successfully');
            } else {
                return redirect()->route('admin.eventCategoryList')->with('error', 'Error in Creating.');
            }
        }else{
            return redirect()->route('admin.eventCategoryList')->with('error', 'Category name already added');
        }
    }

    public function deleteEventCategory(request $request)
    {
        $id = $request->did;
        $delete_event = DB::table('event_categories')->where('ecid', $id)->delete();
        if ($delete_event) {
            return redirect()->route('admin.eventCategoryList')->with('success', 'Category delete successfully');
        } else {
            return redirect()->route('admin.eventCategoryList')->with('error', 'Error in delete.');
        }
    }
}
