<?php

namespace App\Http\Controllers;

use App\Imageupload;
use App\Provider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProviderAuthController extends Controller
{
    public function dashboard()
    {
        return view('providers.index');
    }

    public function logout()
    {
//		  $userid = Auth::guard('provider_web')->user();
//        $update = Provider::where('id', $userid->id)->update(['fcm_token' => " "]);

        Auth::guard('provider_web')->logout();
        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        $user = Provider::find(Auth::guard('provider_web')->user()->id);
        $user->password = bcrypt($request->password);
        if ($user->save()) {
            Session::flash('success', 'Password changed successfully.');
        } else {
            Session::flash('error', 'Failed !');
        }
        return redirect()->back();
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        $provider = Provider::find(Auth::guard('provider_web')->user()->id);
        $provider->first_name = $request->first_name;
        $provider->last_name = $request->last_name;
        $provider->about = $request->about;
        $provider->workexperience = $request->workexperience;
        $provider->dob = $request->dob;
//        $provider->gender = $request->gender;
        if ($provider->save()) {
            Session::flash('success', 'Profile updated successfully.');
        } else {
            Session::flash('error', 'Failed !');
        }
        return redirect()->back();
    }

    public function updateAddress(Request $request)
    {
        $this->validate($request, [
            'address1' => 'required',
            'address2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required'
        ]);

        $provider = Provider::find(Auth::guard('provider_web')->user()->id);
        $provider->addressline1 = $request->address1;
        $provider->addressline2 = $request->address2;
        $provider->city = $request->city;
        $provider->state = $request->state;
        $provider->zipcode = $request->zipcode;
        if ($provider->save()) {
            Session::flash('success', 'Address updated successfully.');
        } else {
            Session::flash('error', 'Failed !');
        }
        return redirect()->back();
    }

    public function uploadProfileImage(Request $request)
    {
        if (!empty($request->image)) {
            $user = Provider::find(Auth::guard('provider_web')->user()->id);
            $imageUpload = new Imageupload();
            $user->image = config('app.url').'/images/'.$imageUpload->imgupload($request->image);
            if ($user->save()) {
                Session::flash('success', 'Profile updated successfully.');
            } else {
                Session::flash('error', 'Failed !');
            }
            return redirect()->back();
        }
    }
}
