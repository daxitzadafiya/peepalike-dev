<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmergencyContact;

class EmergencyContactController extends Controller {
	
	/*{"user_id":"349","name":"Any","number":"0818988971"}*/
	/*
	public function test()
    {
		$em = EmergencyContact::where('user_id', 349)->where('id',15)->delete();
		print_r($em);
    }*/
	
	
	public function store(Request $request)
    {
		
		$phone_number 	= $request->number;
		$user_id 		= $request->user_id;
		$name 			= $request->name;
		$type 		= $request->type;
		
		
		
		$em = EmergencyContact::where('number', $phone_number)
							  ->where('user_id', $user_id)
							  ->exists();
		if($em){
			return $this->makeError('Phone number already exists!.');
		}
		
		
		$ec = new EmergencyContact();
        $ec->user_id	= $user_id;
		$ec->name 		= $name;
		$ec->number 	= $phone_number;
		if($type)
			$ec->type 	= $type;
			
		
		if($ec->save())
		    return $this->makeResponse('Your message has been saved');
		else 
			return $this->makeError('Something went wrong.');
	}
	
	public function delete(Request $request)
    {
		$user_id 	= $request->user_id;
		$id 		= $request->id;
		
		$em = EmergencyContact::where('user_id', $user_id)->where('id',$id)->delete();
		if($em > 0)
		    return $this->makeResponse('Your message has been deleted');
		else 
			return $this->makeError('Something went wrong.');
	}


	public function listcontact(Request $request)
    {
		$user_id  = $request->user_id;
		$contacts = EmergencyContact::where('user_id', $user_id)->get();
		$response['error'] = 'false';
        $response['error_message'] = 'success';
        $response['data'] = $contacts;
		echo json_encode($response);
   
    }



	
	
}
