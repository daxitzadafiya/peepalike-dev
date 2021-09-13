<?php

namespace App\Http\Controllers;

use App\Models\EventCategory;
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
use App\usertatus;
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
use File;
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
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use Twilio\Rest\Client as TwilioClient;


class UserEventController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:user_web');
    }

    public function userLoginDetail(Request $request)
    {
        // $this->validate($request, [
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);

        return redirect()->route('user.dashboard');
        // if (Auth::guard('admin_web')->attempt(['email' => $request->email, 'password' => $request->password])) {
        //     // Authentication passed...
        //    // dd(Auth::guard('admin_web')->user());
        // } else {
        //     Session::flash('error', 'Incorrect email or password.');
        //     return redirect()->back();
        // }
    }

    public function dashboard()
    {
        $eventList = UserEvents::all();
        $all_user = User::all()->count();
        $male_user = User::where('gender', '=', 'male')->count();
        $female_user = User::where('gender', '=', 'female')->count();
        $premium_users = PremiumUsers::count();
        $users = User::all();
        return view('user.dashboard', compact('eventList', 'male_user', 'female_user', 'premium_users', 'all_user', 'users'));
    }

    public function logout()
    {
        Auth::guard('user_web')->logout();
        return redirect('/');
    }

    public function changePassword()
    {
        return view('user.changePassword');
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
        $eventList = UserEvents::all()->where('user_id', '=', (Auth::user()->id));

        return view('user.eventList', compact('eventList'));
    }

    public function addEvent(Request $request)
    {
        $countries = Country::get();
        $category = DB::table('event_categories')->get()->where('cstatus', 0);

        return view('user.addEvent', compact('countries', 'category'));
    }

    public function insertEvent(Request $request)
    {

        if (isset(Auth::user()->id)) {
            $event_name = $request->event_name;
            $vanue_name = $request->vanue_name;
            $trending_event = $request->trending_event;
            $description = $request->description;
            $category = $request->category;
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

            $UserEventsData = UserEvents::where(['event_name' => $event_name])->first();
            if (empty($UserEventsData)) {
                try {
                    $image = '';
                    if ($request->event_image != "") {
                        $image = time() . '_' . uniqid() . '.' . $request->event_image->getClientOriginalExtension();
                        $request->event_image->move(public_path('images/'), $image);
                        $image = $image;
                    }

                    $addEvent = new UserEvents();
                    $addEvent->user_id = Auth::user()->id;
                    $addEvent->event_name = $event_name;
                    $addEvent->venue_name = $vanue_name;
                    $addEvent->is_trending_event = $trending_event;
                    $addEvent->description = $description;
                    $addEvent->ecid = $category;
                    $addEvent->event_start_date = $event_start_date;
                    $addEvent->event_start_time = $event_start_time;
                    $addEvent->event_end_date = $event_end_date;
                    $addEvent->event_end_time = $event_end_time;
                    $addEvent->event_location = $event_location;
                    $addEvent->distance = $distance;
                    $addEvent->latitude = $latitude;
                    $addEvent->longitude = $longitude;
                    $addEvent->event_image = $image;
                    $addEvent->event_type = $event_type;
                    $addEvent->address = $address;
                    $addEvent->city = $city;
                    $addEvent->state = $state;
                    $addEvent->postal_code = $postal_code;
                    $addEvent->country = $country;
                    $addEvent->save();
                } catch (Exception $ex) {
                    $jsonresp = $ex->getMessage();

                    return redirect()->route('user.eventList')->with('error', $jsonresp);
                    die;
                }
                if ($addEvent) {

                    return redirect()->route('user.eventList')->with('success', 'Your Event created successfully');
                } else {

                    return redirect()->route('user.eventList')->with('error', 'Error in Creating.');
                }
            } else {

                return redirect()->route('user.eventList')->with('error', 'Event name already added');
            }
        }
    }

    public function editEvent($id, Request $request)
    {
        $countries = Country::get();
        $UserEvents = UserEvents::find($id);
        $category = DB::table('event_categories')->get()->where('cstatus', 0);
        return view('user.editEvent', compact('countries', 'UserEvents'));
    }

    public function updateEvent(request $request)
    {
        $category = $request->category;
        $id = $request->id;
        $event_name = $request->event_name;
        $vanue_name = $request->vanue_name;
        $trending_event = $request->trending_event;
        $description = $request->description;
        $category = $request->category;
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
        $eventData = UserEvents::where(['event_name' => $event_name])->where('id', '!=', $id)->first();
        $cid = DB::table('event_categories')->get()->where('cname', $category);
        if (empty($eventData)) {

            $update_event = UserEvents::where('id', $id)
                ->update(['event_name' => $event_name, 'venue_name' => $vanue_name, 'description' => $description, 'category' => $cid, 'event_start_date' => $event_start_date, 'event_start_time' => $event_start_time, 'event_end_date' => $event_end_date, 'event_end_time' => $event_end_time, 'event_location' => $event_location, 'distance' => $distance, 'latitude' => $latitude, 'longitude' => $longitude, 'event_type' => $event_type, 'address' => $address, 'city' => $city, 'state' => $state, 'postal_code' => $postal_code, 'country' => $country, 'is_trending_event' => $trending_event]);

            if ($request->image != "") {
                $image = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('images/'), $image);
                $image = $image;

                $update_event1 = UserEvents::where('id', $id)->update(['event_image' => $image]);
            }

            if ($update_event) {
                return redirect()->route('user.eventList')->with('success', 'Your Event update successfully');
            } else {
                return redirect()->route('user.eventList')->with('error', 'Error in Creating.');
            }
        } else {
            return redirect()->route('user.eventList')->with('error', 'Event name already added');
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
            return redirect()->route('user.eventList')->with('success', 'Your Event delete successfully');
        } else {
            return redirect()->route('user.eventList')->with('error', 'Error in delete.');
        }
    }

    public function activeEvent(request $request)
    {
        $id = $request->active;
        $update_event = UserEvents::where('id', $id)->update(['status' => '0']);
        if ($update_event) {
            return redirect()->route('user.eventList')->with('success', 'Your Event status active successfully');
        } else {
            return redirect()->route('user.eventList')->with('error', 'Error in delete.');
        }
    }

    public function inactiveEvent(request $request)
    {
        $id = $request->deactive;
        $update_event = UserEvents::where('id', $id)->update(['status' => '1']);
        if ($update_event) {
            return redirect()->route('user.eventList')->with('success', 'Your Event status active successfully');
        } else {
            return redirect()->route('user.eventList')->with('error', 'Error in delete.');
        }
    }

    public function getStates($country_id)
    {

        $State = State::where(['country_id' => $country_id])->get();
        if (!empty($State)) {
            echo json_encode(['status' => 1, 'message' => $State]);
        } else {
            echo json_encode(['status' => 0, 'message' => 'No states found.']);
        }
    }

    public function getCity($state_id)
    {
        $City = City::where(['state_id' => $state_id])->get();
        if (!empty($City)) {
            echo json_encode(['status' => 1, 'message' => $City]);
        } else {
            echo json_encode(['status' => 0, 'message' => 'No city found.']);
        }
    }

    // Ticket list view ------------------------------------

    public function eventTicket($id, Request $request)
    {
        $eventTicketList = EventTicket::where('event_id', '=', $id)->get();

        return view('user.ticket.eventTicketList', compact('eventTicketList', 'id'));
    }

    public function addTicket($id, Request $request)
    {
        $countries = Country::get();

        return view('user.ticket.addTicket', compact('countries', 'id'));
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
        if (empty($EventTicketData)) {
            try {

                $addEventTicket = new EventTicket();
                $addEventTicket->event_id = $event_id;
                $addEventTicket->ticket_name = $ticket_name;
                $addEventTicket->available_quantity = $available_quantity;
                $addEventTicket->ticket_price = $ticket_price;
                $addEventTicket->description = $description;
                $addEventTicket->visibility = $visibility;
                $addEventTicket->minimum_quantity = $minimum_quantity;
                $addEventTicket->maximum_quantity = $maximum_quantity;
                $addEventTicket->save();

                if ($addEventTicket) {
                    return redirect('user/eventTicket/' . $event_id)->withErrors('Your Event Ticket created successfully');
                } else {
                    return redirect('user/eventTicket/' . $event_id)->withErrors('Error in Creating.');
                }
            } catch (Exception $ex) {
                $jsonresp = $ex->getMessage();
                return redirect('user/eventTicket/' . $event_id)->withErrors($jsonresp);
                die;
            }
        } else {
            return redirect('user/eventTicket/' . $event_id)->withErrors('Ticket name already added');
        }
    }

    public function editTicket($id, Request $request)
    {
        $EventTicket = EventTicket::find($id);
        if (!empty($EventTicket)) {
            return view('user.ticket.editTicket', compact('EventTicket', 'id'));
        } else {
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

        $EventTicketData = EventTicket::where(['ticket_name' => $ticket_name])->where('id', '!=', $id)->first();
        if (empty($EventTicketData)) {
            try {

                $update_ticket = EventTicket::where('id', $id)
                    ->update(['ticket_name' => $ticket_name, 'available_quantity' => $available_quantity, 'ticket_price' => $ticket_price, 'description' => $description, 'visibility' => $visibility, 'minimum_quantity' => $minimum_quantity, 'maximum_quantity' => $maximum_quantity]);
                if ($update_ticket) {
                    return redirect('user/eventTicket/' . $event_id)->withErrors('Your Event Ticket update successfully');
                } else {
                    return redirect('user/eventTicket/' . $event_id)->withErrors('Error in Creating.');
                }
            } catch (Exception $ex) {
                $jsonresp = $ex->getMessage();
                return redirect('user/eventTicket/' . $event_id)->withErrors($jsonresp);
                die;
            }
        } else {
            return redirect('user/eventTicket/' . $event_id)->withErrors('Ticket name already added');
        }
    }

    public function deleteTicket(request $request)
    {
        $id = $request->did;
        $delete_event = DB::table('event_ticket')->where('id', $id)->delete();
        if ($delete_event) {
            return Redirect::back()->withInput()->withErrors('Your Ticket delete successfully');
        } else {
            return redirect()->route('user.eventTicket');
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

    public function eventBenner($id, Request $request)
    {
        $eventBennerList = EventBenner::where('event_id', '=', $id)->get();

        return view('user.benner.eventBennerList', compact('eventBennerList', 'id'));
    }

    public function addBenner($id, Request $request)
    {
        $countries = Country::get();

        return view('user.benner.addBenner', compact('countries', 'id'));
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
                if ($request->banner_image->getClientOriginalExtension() == 'mp4') {
                    $img_type = '1';
                } else {
                    $img_type = '0';
                }
            }
            $addEventBenner = new EventBenner();
            $addEventBenner->event_id = $event_id;
            $addEventBenner->banner_image = $image;
            $addEventBenner->img_type = $img_type;
            $addEventBenner->save();
            if ($addEventBenner) {
                return redirect('user/eventBenner/' . $event_id)->withErrors('Your Event Benner created successfully');
            } else {
                return redirect('user/eventBenner/' . $event_id)->withErrors('Error in Creating.');
            }
        } catch (Exception $ex) {
            $jsonresp = $ex->getMessage();
            return redirect('user/eventBenner/' . $event_id)->withErrors($jsonresp);
            die;
        }
    }

    public function editBenner($id, Request $request)
    {
        $EventBenner = EventBenner::find($id);
        if (!empty($EventBenner)) {
            return response()->json($EventBenner, 200);
        } else {
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

                if ($request->banner_image->getClientOriginalExtension() == 'mp4') {
                    $img_type = '1';
                } else {
                    $img_type = '0';
                }

                $update_event1 = EventBenner::where('id', $id)->update(['banner_image' => $image, 'img_type' => $img_type]);
            }

            return redirect('user/eventBenner/' . $event_id)->withErrors('Your Event banner update successfully');
        } catch (Exception $ex) {
            $jsonresp = $ex->getMessage();
            return redirect('user/eventBenner/' . $event_id)->withErrors($jsonresp);
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
            return redirect()->route('user.eventBenner');
        }
    }

    public function showProfile(Request $request)
    {
        return view('user.profile');
    }

    public function storeProfile(Request $request)
    {
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $email = $request->input('email');
        $mobile = $request->input('mobile');
        $id = $request->input('id');
        $file = $request->image;
        $address = $request->input('address');

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'image' => 'mimes:jpeg,png,jpg|max:2048'
        ]);
        $user = User::find($id);
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->email = $email;
        $user->mobile = $mobile;
        $user->address = $address;
        if (isset($file)) {
            $path = public_path() . '/images/user_profile';
            if (!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            if (File::exists($path . "/" . $user->image) && $user->image != null) {
                $image_path = $path . "/" . $user->image;
                unlink($image_path);
            }
            $name = $id . '.' . $request->image->getClientOriginalExtension();
            $request->image->move($path, $name);
            $user->image = $name;
            $user->is_avatar = '0';
        }
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully');;
    }

    public function removeImage(Request $request, $id)
    {
        $user = User::find($id);
        $path = public_path() . '/images/user_profile';

        $image_path = $path . "/" . $user->image;

        if (File::exists($image_path)) {
            unlink($image_path);
        }

        $user->image = null;
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Image removed successfully');;
    }

    public function updatePassword(Request $request, $id)
    {
        $old_password = $request->input('old_password');
        $new_password = $request->input('new_password');
        $confirm_password = $request->input('password_confirmation');

        $request->validate([
            'old_password' => ['required', Auth::user()->password != null ? new MatchOldPassword : ''],
            'new_password' => ['required'],
            'password_confirmation' => ['same:new_password']
        ]);

        $user = User::find($id);
        $user->password = Hash::make($new_password);
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Password updated successfully');
    }
}
