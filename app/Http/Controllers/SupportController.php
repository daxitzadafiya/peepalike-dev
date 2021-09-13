<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support;

class SupportController extends Controller {
	
	
	
	/*
	public function test()
    {

        $support = new Support();
        $support->user_id = 354;
		$support->subject = 'this is subject';
		$support->message = 'message';
        $support->save();
    }*/
	
	
	public function store(Request $request)
    {
		
		/*
		$this->validate($request, [
            'reason_to_contact' => 'required',
            'your_query' 		=> 'required'
        ]);
		*/
		
		if($request->has('reason_to_contact')==false){
			return $this->makeError('Subject is required.');
    	}else if($request->has('your_query')==false){
			return $this->makeError('Message is required.');
		}
		
		

        $support = new Support();
        $support->user_id = $request->user_id;
		$support->subject = $request->reason_to_contact;
		$support->message = $request->your_query;
		$support->type 	  = $request->type;
		
        if($support->save())
		    return $this->makeResponse('Your message has been saved');
		else 
			return $this->makeError('Something went wrong.');
     }
	
	
	
	
	
	/**
     * @param Request $request
     * @return mixed
     * Created by VDM
     */
    public function store1(Request $request)
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

        if ($user->save()) {

            $body = 'Dear ' . $user->first_name . ', OTP for Taskmate is ' . $otp . '.';
            $sendOtp = $this->sendSms($body, '+' . $user->mobile);

            if ($sendOtp) {
                return $this->makeResponse('OTP sent to your registered mobile number.', ['id' => $user->id]);
            } else {
                return $this->makeError('Something went wrong.', []);
            }
        } else {
            return $this->makeError('Registration failed !');
        }
    }

}
