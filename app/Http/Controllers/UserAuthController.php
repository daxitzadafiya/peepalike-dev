<?php

namespace App\Http\Controllers;

use App\Imageupload;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Provider;
use App\ProviderCategory;
use Illuminate\Support\Facades\Auth;
use Session;

class UserAuthController extends Controller
{
    public function dashboard()
    {
        return view('users.index');
    }

    public function logout()
    {
        Auth::guard('user_web')->logout();
        return redirect()->back();
    }

    public function changePassword(Request $request) 
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::find(Auth::guard('user_web')->user()->id);
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
            'email' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required'
        ]);

        $user = User::find(Auth::guard('user_web')->user()->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->mobile = $request->phone;
        if ($user->save()) {
            Session::flash('success', 'Profile updated successfully.');
        } else {
            Session::flash('error', 'Failed !');
        }
        return redirect()->back();
    }

    public function uploadProfileImage(Request $request)
    {
        if (!empty($request->image)) {
            $user = User::find(Auth::guard('user_web')->user()->id);
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